<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;
if (isset($_POST["u"])) {
    $username = $_POST["u"];
}elseif (isset($_GET["u"])) {
    $username = $_GET["u"];
} elseif (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
} else {
    http_response_code(400);
}


include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($username) > 1) {
    $stmt = $mysqli->prepare('SELECT tu.admin, tu.email, tu.bio, tu.created, tu.name, tu.username, 
    (select count(user) from tbl_watched inner join tbl_users t on tbl_watched.user = t.id) as watched, 
    (select count(user) from tbl_watchlist inner join tbl_users t on tbl_watchlist.user = t.id) as watchlist
    FROM tbl_users as tu 
    where tu.username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $ResultsArray = array();





    while ($row = mysqli_fetch_assoc($result)) {
        $ResultsArray[] = $row;
    }
    echo "<pre>";
    echo print_r($ResultsArray);
    echo "</pre>";
    if (isset($_POST["u"])) {
        echo $ResultsArray;
//        echo "<pre>";
//        echo print_r($ResultsArray);
//        echo "</pre>";
    } else {
        $user_name = $ResultsArray[0]["name"];
        $user_admin = $ResultsArray[0]["admin"];
        $user_username = $ResultsArray[0]["username"];
        $user_bio = $ResultsArray[0]["bio"];
        $user_created = $ResultsArray[0]["created"];
        $user_wd = $ResultsArray[0]["watched"];
        $user_wl = $ResultsArray[0]["watchlist"];
        if ($user_admin == 1) {
            $user_admin = " <i class=\"fa-sharp fa-solid fa-screwdriver-wrench\" title='This user is a Adminitrator'></i>";
        } else {
            $user_admin = "";
        }
        $user_created = explode("-", $user_created)[2] . "." . explode("-", $user_created)[1] . "." . explode("-", $user_created)[0];
    }
} else {
    http_response_code(400);
}



