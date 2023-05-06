<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;

if (isset($_GET["s"])) {
    $index = true;
}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');

$stmt = $mysqli->prepare('SELECT  t.showName, t.name, te.episode, ts.season,  te.upload
FROM tbl_episode AS te
inner join tbl_season ts on te.season = ts.id
inner join tbl_series t on ts.series = t.id
order by upload
');
//$stmt->bind_param('s', $series_name);

$stmt->execute();
$result = $stmt->get_result();

$ResultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $ResultsArray[] = $row;
}

if (isset($index)) {
    echo "<pre>";
    echo print_r($ResultsArray);
    echo "</pre>";
} else {
    echo json_encode($ResultsArray);
}






