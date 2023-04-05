<?php
/**
 * @var mysqli $mysqli
 */

include_once("C:\Users\Colin\PhpstormProjects\StreamingSite\api\db_connect.php");
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
        if (!is_null($result)) {
            $login = true;
            $resultArray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $resultsArray[] = $row;
            }

//            echo '<pre>'; print_r($resultsArray); echo '</pre>';


            if ($resultsArray[0]['admin'] == 1) {
            $IsAdmin = true;
            } else {
            $IsAdmin = false;
            }
            $username = $resultsArray[0]['name'];
            setcookie("token", $resultsArray[0]['token'], time() + (86400 * 180), "/"); // 86400 = 1 day
            setcookie("name", $resultsArray[0]['name'], time() + (86400 * 180), "/"); // 86400 = 1 day



        } else {
            $login = false;

            http_response_code(404);
//            echo 'user not found';
        }
        $cookie = true;
    } else {
        http_response_code(418);
//        echo "I'm a Teapot";
    }
} else {
    http_response_code(401);
}