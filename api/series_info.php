<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;
$series_name = 'vinland-saga';
if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    $series_name = $data->s;
}
$index = true;
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
        WHERE s.name = ?) AS watchlist
FROM tbl_series AS ts where name = ?');
$stmt->bind_param('sss', $series_name, $series_name, $series_name);

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






