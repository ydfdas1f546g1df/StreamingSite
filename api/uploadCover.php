<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $series_name = $_POST['series_name'] ?? '';
    $season_number = $_POST['season_number'] ?? '';
    $episode_number = $_POST['episode_number'] ?? '';
    $episode_name = $_POST['episode_name'] ?? '';
}


$upload_destination = explode("StreamingSite", __DIR__)[0] . 'StreamingSite/data/media/';
$allowedExts = array("mp4");
$extension = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
$newFilename = $series_name . "_season-" . $season_number . "_episode-" . $episode_number . "." . $extension; // Change this line to set the new filename
$file = $upload_destination . $newFilename;

if (($_FILES["files"]["type"] == "video/mp4") && in_array($extension, $allowedExts)) {

    if ($_FILES["files"]["error"] > 0) {
        echo "Return Code: " . $_FILES["files"]["error"] . "<br />";
    } else {
        echo "Size: " . round(($_FILES["files"]["size"] / 1024 / 1024), 2) . " MB<br />";
        move_uploaded_file($_FILES["files"]["tmp_name"], $file);
    }
} else {
    echo "Invalid file";
}
