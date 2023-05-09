<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo $_POST["series"];
    // Get the file name and temporary file location
//    $file_name = $_FILES["file"]["name"];
//    $file_tmp = $_FILES["file"]["tmp_name"];
//
//    // Set the directory to save the file in
//    $upload_dir = explode("StreamingSite", __DIR__)[0] . 'StreamingSite/data/media/';
//
//    // Get the series name, season number, and episode number entered by the user
//    if (isset($_POST["series_name"])) {
//        $series_name = $_POST["series_name"];
//    } else {
//        $error = true;
//    }
//
//    if (isset($_POST["season_number"])) {
//        $season_number = $_POST["season_number"];
//    } else {
//        $error = true;
//    }
//
//    if (isset($_POST["episode_number"])) {
//        $episode_number = $_POST["episode_number"];
//    } else {
//        $error = true;
//    }
//    if (!isset($error)) {
//        // Generate a unique file name to avoid overwriting existing files
//        $file_new_name = $series_name . "_season-" . $season_number . "_episode-" . $episode_number;
//
//        // Move the uploaded file to the specified directory with the new name
//        move_uploaded_file($file_tmp, $upload_dir . $file_new_name);
//
//        echo "File uploaded successfully!";
//    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload a file</title>
</head>
<body>
<h1>Upload a file</h1>
<form method="post" enctype="multipart/form-data">
    <input list="series-list" placeholder="series" name="series">
    <datalist id="series-list">
        <option value="vinland-saga">Vinland Saga</option>
        <option value="demon-slayer">Demon Slayer</option>
    </datalist>
    <input type="submit">
</form>
</body>
</html>
