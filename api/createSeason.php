<?php
/**
 * @var mysqli $mysqli
 */


$data = json_decode($_POST['myData']);
$showName = $data->showName;
$token = $data->token;
//if (!isset($desc)) {
//$desc
//}

$name = strtolower(str_replace($showName, " ", "-"));

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($token) == 30) {

    if (strlen($token) == 30) {
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
            $stmt = $mysqli->prepare('insert into tbl_series (name, showname) value (?,?)');
            $stmt->bind_param('ss', $name, $showName);
            $stmt->execute();
            $result = $stmt->get_result();

            if (json_encode($result) != true) {
                $error = true;
            }

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

