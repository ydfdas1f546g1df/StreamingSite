<?php
/**
 * @var mysqli $mysqli
 */

include_once("db_connect.php");


if(isset($_GET['search'])){
    $search = $_GET['search'];
    $regemail = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,5})$/im';
    $reguser = '/^@.*$/';

    if(preg_match($regemail, $search)){
        $stmt = $mysqli->prepare('SELECT id, username, admin, name, bio, created FROM tbl_users WHERE email LIKE (?)');
        $search = '%'.$search.'%';
        $stmt->bind_param('s', $search);
    }elseif (preg_match($reguser, $search)){
        $stmt = $mysqli->prepare('SELECT id, username, admin, name, bio, created FROM tbl_users WHERE username LIKE (?)');
        $search = ltrim($search, '@');
        $search = '%'.$search.'%';
        $stmt->bind_param('s', $search);
    }else{
        $stmt = $mysqli->prepare('SELECT id, username, admin, name, bio, created FROM tbl_users WHERE name LIKE (?)');
        $search = '%'.$search.'%';
        $stmt->bind_param('s', $search);
    }
}else {

    $stmt = $mysqli->prepare('SELECT id, username, admin, name, bio, created FROM tbl_users');

}

$stmt->execute();
$result = $stmt->get_result();

$resultsArray = array();

while ($row = mysqli_fetch_assoc($result)) {
    $resultsArray[] = $row;
}

echo json_encode($resultsArray);