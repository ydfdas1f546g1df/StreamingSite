<?php
/**
 * @var mysqli $mysqli
 */
print_r($_REQUEST);
if (isset($_POST["rm_id"]) && isset($_POST["token"])) {
    http_response_code(419);
    $rm_id = $_POST["rm_id"];
    $token = $_POST["token"];
} else {
    http_response_code(400);
};
    $rm_id = $_POST["rm_id"];
    $token = $_POST["token"];
include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite\api\db_connect.php');
if ($token == 30) {

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
            if ($resultsArray[0]["id"] != $rm_id) {

                $stmt = $mysqli->prepare('delete from tbl_apitoken where id = ?');
                $stmt->bind_param('s', $rm_id);
                $stmt->execute();
                $result = $stmt->get_result();

                $stmt = $mysqli->prepare('delete from tbl_users where id = ?');
                $stmt->bind_param('s', $rm_id);
                $stmt->execute();
                $result = $stmt->get_result();

            }
        } else {
            http_response_code(409);
            $error = 409;
        }
    } else {
        $error = 400;
        http_response_code(400);
    }
} else {
    $error = 400;
    http_response_code(400);
}
