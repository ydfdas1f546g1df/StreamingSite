<?php
/**
 * @var mysqli $mysqli
 */

include_once("db_connect.php");


if (isset($_POST['token'])) {
    $token = $_POST['token'];
    if (strlen($token) == 30) {

        $stmt = $mysqli->prepare('SELECT tu.id, tu.username, tu.admin, tu.name, tu.bio, tu.created from tbl_apitoken as ap
    INNER JOIN tbl_users tu on ap.user = tu.id
    WHERE ap.id = ?');
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        if(is_null($result)) {
            $resultArray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $resultsArray[] = $row;
            }

            echo json_encode($resultsArray);
        }
        http_response_code(404);
        echo 'user not found';
    }
    http_response_code(418);
    echo "I'm a Teapot";
} else {
    http_response_code(401);
}