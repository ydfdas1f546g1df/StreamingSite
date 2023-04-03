<?php
include './../template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");
$login = true;
$cookie = true;
$IsAdmin = true;

$Page = $header_1;

if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $Page . $admin_1 . $header_2 . $loggedIn . $header_3;
        } else {
            header("location: /");
        }
    }
} else {
    $Page = $Page . $header_2 . $notLoggedIn . $header_3;
}
$Page = $Page . $admin_dashboard . $footer;
echo $Page;





