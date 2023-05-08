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
//    echo $token . "   " . $series_name;
}

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');

$stmt = $mysqli->prepare('delete from tbl_watchlist
where series = (select id from tbl_series as se where se.name = ?)
  and user = (select tu.id from tbl_apitoken as ap
inner join tbl_users tu on ap.user = tu.id where ap.id = ?)
        ');
$stmt->bind_param('ss',  $series_name, $token);

$stmt->execute();
$result = $stmt->get_result();

//$ResultsArray = array();

//while ($row = mysqli_fetch_assoc($result)) {
//    $ResultsArray[] = $row;
//}
//echo json_encode($ResultsArray);
echo json_encode($result);


//echo json_encode($ResultsArray);





