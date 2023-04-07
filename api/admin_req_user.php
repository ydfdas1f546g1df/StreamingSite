<?php
/**
 * @var mysqli $mysqli
 */

include_once("db_connect.php");
if (isset($_POST["reqID"])) {
    $stmt = $mysqli->prepare('SELECT * FROM tbl_users limit 5');
} else {

$stmt = $mysqli->prepare('SELECT * FROM tbl_users');
}
$stmt->execute();
$result = $stmt->get_result();

$resultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $resultsArray[] = $row;
}

echo json_encode($resultsArray);