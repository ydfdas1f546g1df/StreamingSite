<?php
/**
 * @var mysqli $mysqli
 */

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite\api\db_connect.php');
if ($pass1 == $pass2) {

    if (isset($email)) {
        $stmt = $mysqli->prepare('SELECT * from tbl_users WHERE email = ? or username = ? or name = ?');
        $stmt->bind_param('sss', $email, $username, $name);
        $stmt->execute();
        $result = $stmt->get_result();

        $resultsArray = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $resultsArray[] = $row;
        }
        if (!isset($resultsArray[0])) {
            $stmt = $mysqli->prepare('INSERT INTO tbl_users (name, username, email, passwordHash, admin) VALUE (?, ?, ?, ?, ?)');
            $stmt->bind_param('ssssi', $name, $username, $email, $pass1, $admin);
            $stmt->execute();

            $stmt = $mysqli->prepare('INSERT INTO tbl_apitoken (id, user, expire) VALUE (?, (select id from tbl_users where email = ?), ?);');
            $stmt->bind_param('sss', $token, $email, $expire);
            $stmt->execute();

        } else {
            http_response_code(404);
            $error = 404;
        }
    } else {
        $error = 409;
    }
} else {
    $error = 400;
}
