<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;

if (isset($_GET["s"])) {
    $series_name = $_GET["s"];
    $index = true;
//    echo 3;
} else {
    $series_name = "";
}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');

$series_name = "%" . $series_name . "%";
$stmt = $mysqli->prepare('SELECT ts.showName, ts.name, ts.description as "desc",
       (SELECT count(*) from tbl_watchlist as tw
           inner join tbl_series ts2 on ts2.id = tw.series where ts2.showName = ts.showName) as watchlist, 
       (select count(twd.user) from tbl_watched as twd
            inner join tbl_episode te on twd.episode = te.id
            inner join tbl_season t on te.season = t.id
            inner join tbl_series s on t.series = s.id where s.showName = ts.showName) as watched
       FROM tbl_series as ts where ts.showName like ? group by ts.showName');
$stmt->bind_param('s', $series_name);

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
}

echo json_encode($ResultsArray);





