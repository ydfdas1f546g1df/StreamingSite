<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;


if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    $series_name = $data->series;
    $season_num = $data->season;
    $episode_num = $data->episode;
    $what = $data->what;
//    $episode_id = $data->episode_id;
    $token = $data->token;

//    echo $series_name;
//    echo $season_num;
//    echo $episode_num;
//    echo $token;
}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');


$stmt = $mysqli->prepare('SELECT td.user as user from tbl_apitoken as api
    inner join tbl_users tu on api.user = tu.id
    inner join tbl_watched td on tu.id = td.user
    inner join tbl_episode te on td.episode = te.id
    inner join tbl_season ts on te.season = ts.id
    inner join tbl_series t on ts.series = t.id
    where api.id = ? and t.name = ? and ts.season = ? and te.episode = ?');
$stmt->bind_param('ssii', $token, $series_name, $season_num, $episode_num);

$stmt->execute();
$result = $stmt->get_result();

$ResultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $ResultsArray[] = $row;
}
//echo json_encode($ResultsArray);

if (!isset($ResultsArray[0]["user"]) && $what == 1) {

    $stmt = $mysqli->prepare('
    INSERT INTO tbl_watched (user, episode)
    values 
    (
        (select user from tbl_apitoken as api where id = ? LIMIT 1)
        ,(select te.id from tbl_series as ts
                  inner join tbl_season t on ts.id = t.series
                  inner join tbl_episode te on t.id = te.season
                  where te.episode = ? and t.season = ? and ts.name = ? limit 1)
    )
');
    $stmt->bind_param('siis', $token, $episode_num, $season_num, $series_name);
    $stmt->execute();
    $result = $stmt->get_result();
//    echo $result;
//    while ($row = mysqli_fetch_assoc($result)) {
//        $ResultsArray[] = $row;
//    }
    echo 200;
//    echo json_encode($result);
} else if(isset($ResultsArray[0]["user"]) && $what == 0) {
    $stmt = $mysqli->prepare('
    delete from tbl_watched where episode = (select user from tbl_apitoken where id = ?) and user = (select te.id from tbl_series as ts
                  inner join tbl_season t on ts.id = t.series
                  inner join tbl_episode te on t.id = te.season
                  where te.episode = ? and t.season = ? and ts.name = ? limit 1)');
    $stmt->bind_param('siis', $token, $episode_num, $season_num, $series_name);
    $stmt->execute();
    $result = $stmt->get_result();
//    echo $result;
//    while ($row = mysqli_fetch_assoc($result)) {
//        $ResultsArray[] = $row;
//    }
    echo 200;
//    echo json_encode($result);
} else {
    echo 400;

}

//echo json_encode($ResultsArray);





