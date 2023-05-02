<?php
/**
 * @var mysqli $mysqli
 */

//$data = json_decode($_POST['myData']);
//$username = $data->u;
$username = $_GET["u"];

include_once(explode("StreamingSite", __DIR__)[0] . 'StreamingSite/api/db_connect.php');
if (strlen($username) > 1) {
// TODO: fertig machen
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
    echo "<script>
            document.title='Profil Data'
          </script>";
    echo "<pre>"; echo print_r($ResultsArray); echo "</pre>";

} else {
    http_response_code(400);
}


