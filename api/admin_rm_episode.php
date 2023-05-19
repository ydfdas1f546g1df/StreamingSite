<?php
/**
 * @var mysqli $mysqli
 */


$data = json_decode($_POST['myData']);
$rm_id = $data->rm_id;
$token = $data->token;
$name = $data->name;
$series = $data->series;
$episode = $data->episode;
$season = $data->season;
$file = explode("StreamingSite", __DIR__)[0] . "StreamingSite/data/" . $series . "/season-" . $season . "/" . $series . "_season-" . $season . "_episode-" . $episode . ".mp4";
include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($token) == 30) {

    if ($rm_id > 0) {
        $stmt = $mysqli->prepare('SELECT * from tbl_users as us inner join tbl_apitoken ta on us.id = ta.user WHERE ta.id = ? and us.admin = 1');
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        $resultsArray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $resultsArray[] = $row;
        }
//        echo '<pre>'; print_r($resultsArray); echo '</pre>';
        if (isset($resultsArray[0])) {
            if ($resultsArray[0]["admin"] == 1) {

                $stmt = $mysqli->prepare('delete from tbl_watched where episode = ?');
                $stmt->bind_param('i', $rm_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if (json_encode($result) != true) {
                    $error = true;
                }

                $stmt = $mysqli->prepare('delete from tbl_episode where id = ?');
                $stmt->bind_param('i', $rm_id);
                $stmt->execute();
                $result = $stmt->get_result();
                if (json_encode($result) != true) {
                    $error = true;
                }
                if (file_exists($file)) {
                    if (!unlink($file)) {
                        echo 500;
                    }

                } else {
                    $error = true;
                }

                if (!isset($error)) {
                    echo 200;
                } else {
                    echo 400;
                }
//                http_response_code(200);
            } else {
                echo 409;
//                http_response_code(409);
            }
        } else {
            echo 401;
//            http_response_code(401);
        }
    } else {
        echo 400;
//        http_response_code(400);
    }
} else {
    echo 400;
//    http_response_code(400);
}
