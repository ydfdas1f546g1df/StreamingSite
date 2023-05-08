<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;
//$series_name = 'vinland-saga';
if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    if (isset($data->s)) {
        $series_name = $data->s;
    } else {
        header("Location: /error/404.php");
    }
    if (isset($data->u)) {
        $token = $data->u;
    } else {
        $token = "ewuirgvwohebpjberoizgboiebrfpsjndfpboubwepirubgpubsdfpibvbspeeurbpgieubrpgi";
    }
}
//$index = true;
if ($series_name < 1) {
    $index = true;
}


//if (isset($_POST["s"])) {
//    $series_name = $_POST["s"];
//}elseif (isset($_GET["s"])) {
//    $series_name = $_GET["s"];
//} else {
//    header("Location: /login/");
//}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');

$stmt = $mysqli->prepare('SELECT *,
          (SELECT COUNT(*) FROM tbl_watched as twd
           INNER JOIN tbl_episode te ON twd.episode = te.id
           INNER JOIN tbl_season t ON te.season = t.id
           INNER JOIN tbl_series s ON t.series = s.id
           WHERE s.name = ?) AS watched,
          (SELECT COUNT(*) FROM tbl_watchlist as tws
           INNER JOIN tbl_series s ON tws.series = s.id
           WHERE s.name = ?) AS watchlist,
          (SELECT count(*) FROM tbl_watchlist as tws2
           INNER JOIN tbl_series s2 ON tws2.series = s2.id
           inner join tbl_users tu on tws2.user = tu.id
           inner join tbl_apitoken ta on tu.id = ta.user
           WHERE s2.name = ? and ta.id = ?) AS onWatchlist,
          (SELECT tr.name from tbl_episode as twe
           inner join tbl_regisseur tr on twe.regisseur = tr.id
           inner join tbl_season ts2 on twe.season = ts2.id
           inner join tbl_series ts3 on ts2.series = ts3.id
           where ts3.name = ? limit 1) as regisseur,
          (SELECT tl.name from tbl_episode as twe
           inner join tbl_languages tl on twe.language = tl.id
           inner join tbl_season ts2 on twe.season = ts2.id
           inner join tbl_series ts3 on ts2.series = ts3.id
           where ts3.name = ? limit 1) as language
           FROM tbl_series AS ts where name = ?;
');
$stmt->bind_param('sssssss', $series_name,$series_name, $series_name, $token, $series_name, $series_name, $series_name);

$stmt->execute();
$result = $stmt->get_result();

$ResultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $ResultsArray[] = $row;
}
if (isset($index)) {
    echo 1;
    echo "<pre>";
    echo print_r($ResultsArray);
    echo "</pre>";
} else {

echo json_encode($ResultsArray);
}






