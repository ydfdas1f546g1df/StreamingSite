<?php
/**
 * @var mysqli $mysqli
 */


$username = "";

if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    $username = $data->u;
}
if ($username > 1) {
    $index = true;
}
elseif (isset($_POST["u"])) {
    $username = $_POST["u"];
//    echo 11;
} elseif (isset($_GET["u"])) {
//    echo 22;
    $username = $_GET["u"];
} elseif (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
//    echo 33;
} else {
    header("Location: /login/");
}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($username) > 1) {

    $stmt = $mysqli->prepare('SELECT t.showName, t.name as series, te.name, ROW_NUMBER() OVER () as rn,
                (select count(te2.name) from tbl_episode as te2
                    inner join tbl_season s on te2.season = s.id
                    inner join tbl_series ts2 on s.series = ts2.id where ts2.name = t.name) as episodes, te.episode,
                (select count(distinct s2.id) from tbl_episode as te2
                    inner join tbl_season s2 on te2.season = s2.id
                    inner join tbl_series ts2 on s2.series = ts2.id where ts2.name = t.name) as seasons, ts.season, tu.name as uname, tu.username as usname
        FROM tbl_watched as twd
            inner join tbl_users tu on tu.id = twd.user
            inner join tbl_episode te on twd.episode = te.id
            inner join tbl_season ts on te.season = ts.id
            inner join tbl_series t on ts.series = t.id
        where tu.username = ? order by rn');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $ResultsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ResultsArray[] = $row;
    }
    if (isset($index)) {
        echo json_encode($ResultsArray);
    } else {
        echo "<script>
            document.title='Watched'
          </script>";
        echo "<pre>";
        echo print_r($ResultsArray);
        echo "</pre>";
    }

} else {
//    http_response_code(400);
    echo 400;
}





