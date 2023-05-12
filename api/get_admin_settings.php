<?php
/**
 * @var mysqli $mysqli
 */
$index = false;
if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    $index = true;
}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');


$stmt = $mysqli->prepare('SELECT * from tbl_admin_settings');
$stmt->execute();
$settings = $stmt->get_result();

$SettingsArray = array();

while ($row = mysqli_fetch_assoc($settings)) {
    $SettingsArray[] = $row;
}

if ($index) {
    echo json_encode($SettingsArray);
}

$setting_macos = 'macos';
$setting_safari = 'safari';
$setting_verify = 'verify';
$setting_main = 'maintenance';

$filteredObjects = array_filter($SettingsArray, function ($obj) use ($setting_macos) {
    return $obj['name'] === $setting_macos;
});

if (!empty($filteredObjects)) {
    $setting_macos = reset($filteredObjects);
//    echo "<pre>";
//    echo print_r($foundObject["state"]);
//    echo "</pre>";
}

$filteredObjects = array_filter($SettingsArray, function ($obj) use ($setting_safari) {
    return $obj['name'] === $setting_safari;
});

if (!empty($filteredObjects)) {
    $setting_safari = reset($filteredObjects);
//    echo "<pre>";
//    echo print_r($foundObject["state"]);
//    echo "</pre>";
}

$filteredObjects = array_filter($SettingsArray, function ($obj) use ($setting_verify) {
    return $obj['name'] === $setting_verify;
});

if (!empty($filteredObjects)) {
    $setting_verify = reset($filteredObjects);
//    echo "<pre>";
//    echo print_r($foundObject["state"]);
//    echo "</pre>";
}

$filteredObjects = array_filter($SettingsArray, function ($obj) use ($setting_main) {
    return $obj['name'] === $setting_main;
});

if (!empty($filteredObjects)) {
    $setting_main = reset($filteredObjects);
}

//echo $SettingsArray[1]["name"];


//,
//(select count(te2.name) from tbl_episode as te2
//                    inner join tbl_season s on te2.season = s.id
//                    inner join tbl_series ts2 on s.series = ts2.id) as episodes,
//                (select count(distinct s2.season) from tbl_episode as te2
//                    inner join tbl_season s2 on te2.season = s2.id
//                    inner join tbl_series ts2 on s2.series = ts2.id) as seasons



