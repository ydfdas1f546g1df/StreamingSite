<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;


if (isset($_POST['myData'])) {
    $data = json_decode($_POST['myData']);
    $series_name = $data->series;
    $token = $data->token;
}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');

$stmt = $mysqli->prepare('SELECT tw.user as user, showName as name from tbl_apitoken as api
    inner join tbl_users tu on api.user = tu.id
    inner join tbl_watchlist tw on tu.id = tw.user
    inner join tbl_series ts on tw.series = ts.id
    where api.id = ? and ts.name = ?');
$stmt->bind_param('ss', $token, $series_name);

$stmt->execute();
$result = $stmt->get_result();

$ResultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $ResultsArray[] = $row;
}
if (isset($ResultsArray[0]["name"]) && isset($ResultsArray[0]["user"])) {
    $stmt = $mysqli->prepare('
    INSERT INTO tbl_watchlist ("user", "series") 
    values 
    (
        (select user from tbl_apitoken where id = ? LIMIT 1)
        ,(select id from tbl_series where name = ? LIMIT 1)
    )
');
    $stmt->bind_param('ss', $token, $series_name);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = mysqli_fetch_assoc($result)) {
        $ResultsArray[] = $row;
    }
    echo json_encode($ResultsArray);
} else {
    echo 400;
}

echo json_encode($ResultsArray);





