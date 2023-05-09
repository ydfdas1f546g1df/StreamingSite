<?php
/**
 * @var mysqli $mysqli
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $series_name = $_POST['series_name'] ?? '';
    $season_number = $_POST['season_number'] ?? '';
    $episode_number = $_POST['episode_number'] ?? '';
    $episode_name = $_POST['episode_name'] ?? '';
    $token = $_POST['token'] ?? '';
    $lang = "de";
    $genre = 1;
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


        $upload_destination = explode("StreamingSite", __DIR__)[0] . 'StreamingSite/data/media/';
        $allowedExts = array("mp4");
        $extension = pathinfo($_FILES['files']['name'], PATHINFO_EXTENSION);
        $newFilename = $series_name . "_season-" . $season_number . "_episode-" . $episode_number . "." . $extension; // Change this line to set the new filename
        $file = $upload_destination . $newFilename;

        if (($_FILES["files"]["type"] == "video/mp4") && in_array($extension, $allowedExts)) {

            $stmt = $mysqli->prepare('SELECT * FROM tbl_episode te
                    inner  join tbl_season ts on te.season = ts.id
                    inner join tbl_series t on ts.series = t.id
                where t.name = ? and ts.season = ? and te.episode = ?;
                ');
            $stmt->bind_param('sii', $series_name, $season_number, $episode_number);
            $stmt->execute();
            $result = $stmt->get_result();

            $resultsArray = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $resultsArray[] = $row;
            }
            if (!isset($resultsArray[0])) {

                $stmt = $mysqli->prepare('SELECT * from tbl_series as ts2
                inner join tbl_season t on ts2.id = t.series
                                           where ts2.name = ? and t.season = ?
                ');
                $stmt->bind_param('si', $series_name, $season_number);
                $stmt->execute();
                $result = $stmt->get_result();

                $resultsArray = array();

                while ($row = mysqli_fetch_assoc($result)) {
                    $resultsArray[] = $row;
                }

                if (!isset($resultsArray[0])) {
                    $stmt = $mysqli->prepare('insert into tbl_season (series, season) 
                        value ((SELECT ts2.id from tbl_series as ts2 where ts2.name = ?),
                               ?)
                               ');
                    $stmt->bind_param('si', $series_name, $season_number);
                    $stmt->execute();
                    $result = $stmt->get_result();
                }
//                echo json_encode($result);
//                $resultsArray = array();

//                while ($row = mysqli_fetch_assoc($result)) {
//                    $resultsArray[] = $row;
//                }

                $stmt = $mysqli->prepare('insert into tbl_episode (episode, name, language, genre, season) 
                        value (?,?,?,?,(Select tbl_season.id from tbl_season
                                                  inner join tbl_series ts on tbl_season.series = ts.id
                                                             where ts.name = ? and tbl_season.season = ?))
                               ');
                $stmt->bind_param('issisi', $episode_number, $episode_name, $lang, $genre, $series_name, $season_number);
                $stmt->execute();
                $result = $stmt->get_result();
                if (!$result) {
                    if ($_FILES["files"]["error"] > 0) {
                        echo "Return Code: " . $_FILES["files"]["error"] . "<br />";
                    } else {
                        echo "Upload Completed! <br> Size: " . round(($_FILES["files"]["size"] / 1024 / 1024), 2) . " MB<br />";
                        move_uploaded_file($_FILES["files"]["tmp_name"], $file);
                    }
                } else {
                    echo "Serverside Error 503";
                }
            }
        } else {
            echo "Invalid file, only mp4";
        }

    } else {
        http_response_code(401);
    }
} else {
    echo $token;
    http_response_code(400);
}