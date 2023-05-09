<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $series_name = $_POST['series_name'] ?? '';
    $season_number = $_POST['season_number'] ?? '';
    $episode_number = $_POST['episode_number'] ?? '';
    $episode_name = $_POST['episode_name'] ?? '';
}
// Make sure the captured data exists
if (isset($_FILES['files']) && !empty($_FILES['files'])) {
    // Upload destination directory
    $upload_destination = explode("StreamingSite", __DIR__)[0] . 'StreamingSite/data/media/';
    // Iterate all the files and move the temporary file to the new directory

    // Add your validation here
    $filename = $_FILES['files']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $newFilename = $series_name . "_season-" . $season_number . "_episode-" . $episode_number . "." . $extension; // Change this line to set the new filename
    $file = $upload_destination . $newFilename;
    // Move temporary files to new specified location
    move_uploaded_file($_FILES['files']['tmp_name'], $file);
    // Output response
    echo 'Upload Complete!';
}
////TODO: make this
//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    $series_name = $_POST['series_name'] ?? '';
//    $season_number = $_POST['season_number'] ?? '';
//    $episode_number = $_POST['episode_number'] ?? '';
//    $episode_name = $_POST['episode_name'] ?? '';
//
//    // do something with the data, for example:
//    echo "Series name: $series_name<br>";
//    echo "Season number: $season_number<br>";
//    echo "Episode number: $episode_number<br>";
//    echo "Episode name: $episode_name<br>";
//}

//if (!empty($_FILES)) {
//    // Loop through each uploaded file
//    foreach ($_FILES['fileInput']['tmp_name'] as $index => $tmpName) {
//        // Get the name and extension of the file
//        $fileName = $_FILES['fileInput']['name'][$index];
//        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
//
//        // Generate a unique file name
//        $uniqueName = uniqid() . '.' . $fileExtension;
//
//        // Move the file to the upload directory with the new unique name
//        if (move_uploaded_file($tmpName, $uploadDirectory . $uniqueName)) {
//            echo 'File ' . $fileName . ' uploaded successfully.<br>';
//        } else {
//            echo 'Error uploading ' . $fileName . '.<br>';
//        }
//    }
//}
