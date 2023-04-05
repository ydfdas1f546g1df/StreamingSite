<?php
if (isset($_GET["email"])) {

    $error = 200;
    $email = htmlspecialchars($_GET["email"]);
    $username = strtolower(str_replace(" ", "", htmlspecialchars($_GET["username"])));
    $name = htmlspecialchars($_GET["name"]);
    $pass1 = hash('sha256', htmlspecialchars($_GET["password"]));
    $pass2 = hash('sha256', htmlspecialchars($_GET["rpassword"]));
    $admin = false;
    $token = substr(hash('sha256', $username), 1, 30);
    $expire = new DateTime();
    $expire->add(new DateInterval('P6M')); // add 6 months
    $expire = $expire->format('Y-m-d');

    include explode("StreamingSite", __DIR__)[0] . 'StreamingSite\api\register.php';

    if ($error == 200) {
        $errorText = "Mail verification";
        $errorMessage = "We have sent you a mail, please verify";
        $error_link = "href='/login'";
        $error_link_text = "Go to Login";
    } elseif ($error == 400) {
        $errorText = "400";
        $errorMessage = "Bad Request";
        $error_link = "onclick='history.back()'";
        $error_link_text = "Try again";
    } elseif ($error == 409) {
        $errorText = "409";
        $errorMessage = "User with this email or Password already exist";
        $error_link = "onclick='history.back()'";
        $error_link_text = "Try again";
    }

} else {
    $errorText = "Bad Request 400";
    $errorMessage = "Some thing went completely wrong";
    $error_link = "onclick='history.back()'";
    $error_link_text = "Back";
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

include '.././template/index.php';

$login = false;
if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            $Page = $loggedInHeader;
        }
    } else {
        $Page = $loggedInHeader;
    }
} else {
    $Page = $notLoggedInHeader;
}
$Page = $Page . $homeContent . $footer;
echo $Page;
