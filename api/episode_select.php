<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;
//$series_name = 'vinland-saga';
if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    $series_name = $data->series;
    $season_num = $data->season;
    $episode_num = $data->episode;
    $index = $data->index;
    $token = $data->token;
}
//$index = true;
if (strlen($series_name) < 1) {
    $index = true;
}


//if (isset($_POST["s"])) {
//    $series_name = $_POST["s"];
//}elseif (isset($_GET["s"])) {
//    $series_name = $_GET["s"];
//} else {
//    header("Location: /login/");
//}
$finalResultArray = [];

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');

$stmt = $mysqli->prepare('Select ts.season, 1 as "index" from tbl_season as ts
                                               
inner join tbl_series t on ts.series = t.id
where t.name = ?');
$stmt->bind_param('s', $series_name);

$stmt->execute();
$result = $stmt->get_result();

$ResultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $ResultsArray[] = $row;
}
$finalResultArray[] = $ResultsArray;
//echo json_encode($ResultsArray);

if ($index == 0 || $index == 1) {

} elseif ($index == 2) {
    $stmt = $mysqli->prepare('SELECT ts.season, 3 as "index",
  
    (SELECT COUNT(*) FROM tbl_season
        INNER JOIN tbl_series s ON tbl_season.series = s.id
        WHERE s.name = ?
    ) AS seasons,
    te.episode, tw.user, te.name  
FROM tbl_episode AS te
INNER JOIN tbl_season ts ON te.season = ts.id
INNER JOIN tbl_series t ON ts.series = t.id
LEFT JOIN tbl_watched tw ON te.id = tw.episode
WHERE ts.season = ? AND t.name = ?');

    $stmt->bind_param('sis', $series_name, $season_num, $series_name);
//    $stmt->bind_param('isssisiss', $season_num, $series_name, $token, $series_name, $season_num, $series_name, $season_num, $series_name);
    $stmt->execute();
    $result = $stmt->get_result();

    $ResultsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ResultsArray[] = $row;
    }
    $finalResultArray[] = $ResultsArray;

    echo json_encode($finalResultArray);

}







