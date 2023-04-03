<?php
$mysqli = null;
include_once 'db_connect.php';


if (isset($_GET['search'])) {
    echo $_GET['search'];
    $search = $_GET['search'];
    $emailRegex = '/^[[:ascii:],0-9]{1,20}\@[[:ascii:],0-9]{1,10}\.[[:ascii:]]{0,4}$/';
    $userRegex = '/^@.*$/';
    if (preg_match($emailRegex, $search)) {
        $stmt = $mysqli->prepare('SELECT * FROM tbl_users WHERE email LIKE (?)');
    } elseif (preg_match($userRegex, $search)) {
        $stmt = $mysqli->prepare('SELECT * FROM tbl_users WHERE username LIKE (?)');
        $search = ltrim($search, '@');
    } else {
        $stmt = $mysqli->prepare('SELECT * FROM tbl_users WHERE name LIKE (?)');
    }
    $search = '%'.$search.'%';
    $stmt->bind_param('s', $search);

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