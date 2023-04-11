<?php
/**
 * @var mysqli $mysqli
 */

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite\api\db_connect.php');
if (strlen($VerifyToken) == 6) {

    if (isset($email)) {
        $stmt = $mysqli->prepare('SELECT us.id from tbl_users as us WHERE us.email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $resultsArray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $resultsArray[] = $row;
        }
//        echo '<pre>'; print_r($resultsArray); echo '</pre>';
        if (isset($resultsArray[0])) {
            $stmt = $mysqli->prepare('SELECT * from tbl_apitoken WHERE user = (select id from tbl_users where email = ?)');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $APIarray = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $APIarray[0] = $row;
            }
            if (!isset($APIarray[0])) {
                $stmt = $mysqli->prepare('INSERT INTO tbl_apitoken (id, user, expire) VALUE ((SELECT SUBSTR(MD5(rand()), 1, 30)), (select id from tbl_users where email = ?), ?);');
                $stmt->bind_param('ss',  $email, $expire);
                $stmt->execute();

                $stmt = $mysqli->prepare('delete from tbl_verified where token = ?');
                $stmt->bind_param('s', $VerifyToken);
                $stmt->execute();

                http_response_code(200);
                $error = 200;
            } else {
                $error = 400;
                http_response_code(400);
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
