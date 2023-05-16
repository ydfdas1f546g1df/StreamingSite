<?php
//global $setting_popular;
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;

if (isset($_GET["s"])) {
    $index = true;
}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/get_admin_settings.php');

if ($setting_popular["state"] == 1) {
    $stmt = $mysqli->prepare('SELECT ts.showName,
       ts.name,
       COUNT(twd.episode) AS watched,
       ROUND(COUNT(twd.episode) / COUNT(te.id) / COUNT(DISTINCT twd.user), 4) AS view
FROM tbl_series AS ts
INNER JOIN tbl_season t ON t.series = ts.id
INNER JOIN tbl_episode te ON te.season = t.id
LEFT JOIN tbl_watched twd ON twd.episode = te.id
GROUP BY ts.showName, ts.name
ORDER BY watched DESC, view DESC');
} else {
    $stmt = $mysqli->prepare('SELECT ts.showName,
       ts.name,
       COUNT(twd.episode) AS watched,
       ROUND(COUNT(twd.episode) / COUNT(te.id) / COUNT(DISTINCT twd.user), 4) AS view
FROM tbl_series AS ts
INNER JOIN tbl_season t ON t.series = ts.id
INNER JOIN tbl_episode te ON te.season = t.id
LEFT JOIN tbl_watched twd ON twd.episode = te.id
GROUP BY ts.showName, ts.name
ORDER BY view DESC, watched DESC
');
}
//echo $sort_series;

//$stmt->bind_param('s', $sort_series);
$stmt->execute();
$result = $stmt->get_result();

$ResultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $ResultsArray[] = $row;
}

//if (isset($index)) {
//    echo "<script>
//            document.title='Popular'
//          </script>";
//    echo "<pre>";
//    echo print_r($ResultsArray);
//    echo "</pre>";
//} else {
echo json_encode($ResultsArray);
//}






