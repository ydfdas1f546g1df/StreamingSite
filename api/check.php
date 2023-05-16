<?php
/**
 * @var mysqli $mysqli
 */

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
//echo explode("StreamingSite", __DIR__)[0] . 'StreamingSite\api\db_connect.php';
//if (isset($_COOKIE["LoginUser"])) {
//    $token = $_COOKIE["LoginUser"];
//if (isset($_POST['token'])) {
//    $token = $_POST['token'];
if (isset($token)) {
    if (strlen($token) == 30) {

        $stmt = $mysqli->prepare('SELECT tu.id as id, tu.username, tu.admin, tu.name, ap.id as token from tbl_apitoken as ap
        INNER JOIN tbl_users tu on ap.user = tu.id
        WHERE ap.id = ?');
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = mysqli_fetch_assoc($result)) {
            $resultsArray[] = $row;
        }

//        echo '<pre>'; print_r($resultsArray); echo '</pre>';
        if (isset($resultsArray[0]["token"])) {
            $login = true;
            $resultArray = array();


            if ($resultsArray[0]['admin'] == 1) {
                $IsAdmin = true;
            } else {
                $IsAdmin = false;
            }
            $name = $resultsArray[0]['name'];
            $username = $resultsArray[0]['username'];
//            setcookie("token", $resultsArray[0]['token'], time() + (86400 * 180), "/");
//            setcookie("name", $resultsArray[0]['name'], time() + (86400 * 180), "/");
//            setcookie("username", $resultsArray[0]['username'], time() + (86400 * 180), "/");
        } else {
            $login = false;

//            http_response_code(404);
//            echo 'user not found';
            $name = "name1";
            $username = "Username";
        }
        $cookie = true;
    } else {
        $name = "name2";
        $username = "Username";
//        http_response_code(418);
//        echo "I'm a Teapot";
    }
} else {
    $name = "name3";
    $username = "Username";
//    http_response_code(401);
}
include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/get_admin_settings.php');