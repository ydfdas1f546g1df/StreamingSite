<?php
/**
 * @var mysqli $mysqli
 */


$data = json_decode($_POST['myData']);
$id = $data->setting;
$token = $data->token;
$state = $data->state;

//echo $state;
//echo "<br>";
//echo $id;
//echo "<br>";
//echo $token;
//echo "<br>";

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($token) == 30) {

    if ($id > 0) {
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

//echo $id;
            $stmt = $mysqli->prepare('update tbl_admin_settings set state = ? where id = ?');
            $stmt->bind_param('ii', $state, $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if (json_encode($result) != true) {
                $error = true;
            }
//            echo json_encode($result);

            if (!isset($error)) {
                echo 200;
            } else {
                echo 400;
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
