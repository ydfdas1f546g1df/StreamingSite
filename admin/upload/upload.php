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
        <label for="files" class="drop-area"><i class="fa-solid fa-folder-open fa-2x"></i>Select files ...</label>
        <input id="files" type="file" name="files">
        <label for="series_name" id="series">
        <span>Series Name</span>
        <input list="series-list" name="series_name" id="series_name" required>
            <datalist id="series-list">
                <option v-for="s in series" :value="s.name">{{s.showName}}</option>
            </datalist>
        </label>
        <label for="episode_name"> <span>Episode Name</span>
        <input type="text" name="episode_name" id="episode_name" required autocomplete="off"><br><br>
        </label>
        <label for="season_number"> <span>Season</span>
        <input type="number" name="season_number" id="season_number" required autocomplete="off"  min="0"><br><br>
        </label>
        <label for="episode_number"> <span>Episode</span>
        <input type="number" name="episode_number" id="episode_number" required autocomplete="off" min="0"><br><br>
        </label>
        <div class="progress"></div>
        <button type="submit">Upload</button>
        <span class="cancel" onclick="history.back()">cancel</span>
        <div class="result"></div>
    </form>
    <script src="/script/upload.js"></script>
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

