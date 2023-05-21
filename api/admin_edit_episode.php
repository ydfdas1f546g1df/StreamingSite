<?php
/**
 * @var mysqli $mysqli
 */


$data = json_decode($_POST['myData']);
//echo json_encode($data);
$id = $data->id;
$token = $data->token;
$name = $data->name;
$series = $data->series;
$showName = $data->showName;
$episode = $data->episode;
$season = $data->season;
$old_season = $data->oldSeason;
$old_episode = $data->oldEpisode;
$old_path = explode('StreamingSite', __DIR__)[0] . 'StreamingSite/data/' . $showName . '/season-' . $old_season . '/';
$old_file = $showName . '_season-' . $old_season . '_episode-' . $old_episode . '.mp4';
$old_file_path = $old_path . $old_file;
$new_path = explode('StreamingSite', __DIR__)[0] . 'StreamingSite/data/' . $showName . '/season-' . $season . '/';
$new_file = $showName . '_season-' . $season . '_episode-' . $episode . '.mp4';
$new_file_path = $new_path . $new_file;
if (!is_dir($new_path)) {
    mkdir($new_path, 0777);
}
//echo $old_file_path;
//echo $new_file_path;

include_once(explode('StreamingSite', __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($token) == 30) {

    if ($id > 0 && is_numeric($season) && is_numeric($episode)) {
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
            $stmt = $mysqli->prepare('select * from tbl_season as tse 
            inner join tbl_series ts on tse.series = ts.id where season = ? and showName = ?');
            $stmt->bind_param('is', $season, $series);
            $stmt->execute();
            $result = $stmt->get_result();

            $resultsArray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $resultsArray[] = $row;
            }
            if (!isset($resultsArray[0])) {
                $stmt = $mysqli->prepare('insert into tbl_season (season, series) values (?,(select id from tbl_series where showName = ?))');
                $stmt->bind_param('is', $season, $series);
                $stmt->execute();
                $result = $stmt->get_result();
//                echo json_encode($result);
            }
            $stmt = $mysqli->prepare('update tbl_episode as te set name = ?, te.episode = ?, te.season = (select ts.id from tbl_season as ts 
                                                                  inner join tbl_series t on ts.series = t.id
                                                                  where t.showName = ? and ts.season = ?) where id = ?');
            $stmt->bind_param('sisii', $name, $episode, $series, $season, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            rename($old_file_path, $new_file_path);
            if (json_encode($result) != true) {
                echo 400;
            } else {
                echo 200;
            }
//                http_response_code(200);
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
