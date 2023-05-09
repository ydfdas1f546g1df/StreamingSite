<?php
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    // Get the file name and temporary file location
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
//}
//
//

$mainContent = '
<main id="upload-main">
    <form class="upload-form" method="post" enctype="multipart/form-data" action="/api/uploadFile.php">
        <h1>Upload Form</h1>
        <label for="files"><i class="fa-solid fa-image fa-2x"></i>Select Cover ...</label>
        <input id="files" type="file" name="files">
        <label for="series_name"><span>Series Name</span>
        <input type="text" name="series_name" id="series_name" required autocomplete="off" autofocus ><br><br>
        </label>
        <label for="series_name"><span>Description</span>
        <textarea name="series_name" id="series_name" style="resize:none" cols="30" rows="10"  required autocomplete="off"></textarea><br><br>
        </label>
        <div class="progress"></div>
        <button type="submit">Create Series</button>
        <div class="result"></div>
    </form>
    <script src="/script/createSeries.js"></script>
</main>
';

include '../.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");


if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            header("location: /error/403.php");
        }
    } else {
        header("location: /error/403.php");
    }
}else {
    header("Location: /error/403.php");
}
$Page = $Page . $mainContent . $footer;
echo $Page;

