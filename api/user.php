<?php
/**
 * @var mysqli $mysqli
 */


include_once("db_connect.php");

$stmt = $mysqli->prepare('SELECT * FROM tbl_users');
$stmt->execute();
$result = $stmt->get_result();

$resultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $resultsArray[] = $row;
}

echo json_encode($resultsArray);