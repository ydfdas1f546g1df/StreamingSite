<?php
$error = 200;
$email = htmlspecialchars($_POST["email"]);
$pass = htmlspecialchars($_POST["password"]);
//echo $pass = hash('sha256', $pass) . "<br>";
$pass = hash('sha256', htmlspecialchars($pass));
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
    $errorMessage = "No verified user with this email or password";
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
            <a ' . $error_link . '>' . $error_link_text . '</a>
        </div>
    </div>
</main>
';
$should = true;
include '.././template/index.php';

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

