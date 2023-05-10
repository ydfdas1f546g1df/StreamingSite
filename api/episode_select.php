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

$stmt = $mysqli->prepare('Select tse.season, 1 as "index" ,
    (SELECT COUNT(*) FROM tbl_episode AS te
        INNER JOIN tbl_season s ON te.season = s.id
        INNER JOIN tbl_watched tw ON te.id = tw.episode
        INNER JOIN tbl_series ts2 ON s.series = ts2.id
        WHERE s.season = tse.season AND ts2.name = ? AND tw.user = (SELECT ta.user FROM tbl_apitoken AS ta WHERE ta.id = ?)
    ) AS watched,
    (SELECT COUNT(*) FROM tbl_episode AS te2
        INNER JOIN tbl_season s ON te2.season = s.id
        LEFT JOIN tbl_watched tw ON te2.id = tw.episode
        INNER JOIN tbl_series ts3 ON s.series = ts3.id
        WHERE ts3.name = ? AND s.season = tse.season
    ) AS possible              
    from tbl_season as tse                           
inner join tbl_series t on tse.series = t.id
where t.name = ?
order by tse.season');
$stmt->bind_param('ssss',  $series_name, $token, $series_name, $series_name);

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
    te.episode, (select count(*)  from tbl_episode as te2
                        inner join tbl_season ts2 on te2.season = ts2.id
                        inner join tbl_series ts3 on ts2.series = ts3.id
                        inner join tbl_watched w on te2.id = w.episode
                        where ts2.season = ? and ts3.name = ? and w.user = (select user from tbl_apitoken where id = ?)) as watched, te.name
FROM tbl_episode AS te
INNER JOIN tbl_season ts ON te.season = ts.id
INNER JOIN tbl_series t ON ts.series = t.id
LEFT JOIN tbl_watched tw ON te.id = tw.episode
WHERE ts.season = ? AND t.name = ? and tw.user = (SELECT tap.user FROM tbl_apitoken AS tap WHERE tap.id = ?)
order by te.episode
');
//    $stmt->bind_param('sis', $series_name, $season_num, $series_name);
    $stmt->bind_param('sississ', $series_name, $season_num, $series_name, $token, $season_num, $series_name, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    $ResultsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $ResultsArray[] = $row;
    }
    $finalResultArray[] = $ResultsArray;

    echo json_encode($finalResultArray);

}







