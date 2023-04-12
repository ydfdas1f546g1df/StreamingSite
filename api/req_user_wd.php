<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;
$username = $_GET["u"];

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($username) > 1) {
// TODO: fertig machen
    $stmt = $mysqli->prepare('SELECT distinct t.showName, t.name, 
                (select count(te2.name) from tbl_episode as te2
                    inner join tbl_season s on te2.season = s.id
                    inner join tbl_series ts2 on s.series = ts2.id) as episodes,
                (select count(distinct s2.season) from tbl_episode as te2 
                    inner join tbl_season s2 on te2.season = s2.id
                    inner join tbl_series ts2 on s2.series = ts2.id) as seasons 
        FROM tbl_watched as twl
            inner join tbl_users tu on tu.id = twl.user
            inner join tbl_episode te on twl.episode = te.id
            inner join tbl_season ts on te.season = ts.id
            inner join tbl_series t on ts.series = t.id
        where tu.username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $ResultsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ResultsArray[] = $row;
    }
    echo "<script>
            document.title='Watched'
          </script>";
    echo "<pre>"; echo print_r($ResultsArray); echo "</pre>";

} else {
    http_response_code(400);
}


