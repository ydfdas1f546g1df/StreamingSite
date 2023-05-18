<?php
/**
 * @var mysqli $mysqli
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $series_name = $_POST['series_name'] ?? '';
    $token = $_POST['token'] ?? '';
    $desc = $_POST['desc'] ?? '';
    $series_showName = $series_name;
    $series_name = strtolower(preg_replace('/[^a-zA-Z0-9\s]+/', '', str_replace(' ', '-', $series_showName)));
}


include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($token) == 30) {

    $stmt = $mysqli->prepare('SELECT admin FROM tbl_users as tu inner join tbl_apitoken at on tu.id = at.user where at.id = ?');
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    $verifyResultsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $verifyResultsArray[] = $row;
    }
    if ($verifyResultsArray[0]["admin"] == 1) {

        if (!file_exists(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/data/' . $series_name)) {
            mkdir(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/data/' . $series_name, 0777, true);
        }
        $upload_destination = explode("StreamingSite", __DIR__)[0] . 'StreamingSite/data/' . $series_name . "/";
        $allowedExts = array("jpg", "png");
        $extension = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
        $newFilename = $series_name . "." . "jpg"; // Change this line to set the new filename
        $file = $upload_destination . $newFilename;
        if ((($_FILES["files"]["type"] == "image/jpeg") || ($_FILES["files"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {

            $stmt = $mysqli->prepare('SELECT * FROM tbl_series ts where name = ?');
            $stmt->bind_param('s', $series_name);
            $stmt->execute();
            $result = $stmt->get_result();

            $resultsArray = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $resultsArray[] = $row;
            }

            if (!isset($resultsArray[0]["name"])) {

                $stmt = $mysqli->prepare('insert into tbl_series (name, showName, description) VALUE (?,?,?)');
                $stmt->bind_param('sss', $series_name, $series_showName, $desc);
                $stmt->execute();

                if ($_FILES["files"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["files"]["error"] . "<br />";
                } else {
                    echo "Upload Completed! <br> Size: " . round(($_FILES["files"]["size"] / 1024 / 1024), 2) . " MB<br />";
                    move_uploaded_file($_FILES["files"]["tmp_name"], $file);
                }
            } else {
                echo "Serverside Error 503";
            }

        } else {
            echo "Invalid file, only jpg/png";
        }
    } else {
        http_response_code(401);
    }
} else {
    echo "Not Authorized";
    http_response_code(400);
}