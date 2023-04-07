<?php
/**
 * @var mysqli $mysqli
 */

include_once("db_connect.php");

if (isset($_COOKIE["token"])) {
    $token = $_COOKIE["token"];
    if (strlen($token) == 30) {

        $stmt = $mysqli->prepare('SELECT admin FROM tbl_users as tu inner join tbl_apitoken at on tu.id = at.user where at.id = ?');
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();

        $resultsArray = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $resultsArray[] = $row;
        }
        if ($resultsArray[0]["admin"] == 1) {
            if ($_POST["regID"] == 1) {
            $stmt = $mysqli->prepare('SELECT * FROM tbl_users');
            $stmt->execute();
            $result = $stmt->get_result();

            $resultsArray = array();

            while ($row = mysqli_fetch_assoc($result)) {
                $resultsArray[] = $row;
            }
            echo json_encode($resultsArray);
            }


        } else {
            http_response_code(401);
        }
    } else {
        http_response_code(400);

    }
} else {
    http_response_code(400);
}


