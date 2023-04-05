<?php
$error = 200;
$email = $_POST["email"];
$pass = $_POST["password"];
$pass = hash('sha256', $pass);
//echo $email . "<br>";
//echo $pass . "<br>";
//echo $pass;

include explode("StreamingSite", __DIR__)[0] . 'StreamingSite\api\login.php';
if ($error == 200) {
    $errorText = "Logged in";
    $errorMessage = "You have been successfully logged in";
    $error_link = "href='/user'";
    $error_link_text = "To Your Account";
} elseif ($error == 404) {
    $errorText = "404";
    $errorMessage = "No user with this email or password";
    $error_link = "onclick='history.back()'";
    $error_link_text = "Try again";
} elseif ($error == 400) {
    $errorText = "400";
    $errorMessage = "Bad Request";
    $error_link = "onclick='history.back()'";
    $error_link_text = "Try again";
}


$homeContent = '
<main class="loginRegster-main">
    <div class="login-wrapper">
        <div class="login-info">
            <img src="/dist/img/logo.png" alt="logo">
            <span class="login-info-title">' . $errorText . ' </span>
            <span class="login-info-text">' . $errorMessage . '</span>
            <a '. $error_link .'>To your Account</a>
        </div>
    </div>
</main>
';

include '.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");


if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            $Page = $loggedInHeader;
        }
    } else {
        $Page = $notLoggedInHeader;
    }
} else {
    $Page = $notLoggedInHeader;
}
$Page = $Page . $homeContent . $footer;
echo $Page;

