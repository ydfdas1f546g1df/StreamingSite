<?php
/**
 * @var mysqli $mysqli
 */

$data = json_decode($_POST['myData']);
$token = $data->token;

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

        $stmt = $mysqli->prepare('SELECT ep.id, ep.episode, ep.name, ts.season, t.showName FROM tbl_episode as ep
        inner join tbl_season ts on ep.season = ts.id
        inner join tbl_series t on ts.series = t.id');
        $stmt->execute();
        $result = $stmt->get_result();

        $resultsArray = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $resultsArray[] = $row;
        }
        echo json_encode($resultsArray);
    } else {
        http_response_code(401);
    }
} else {
    echo $token;
    http_response_code(400);
}


