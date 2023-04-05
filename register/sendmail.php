
<?php
$homeContent = '
<main class="loginRegster-main">
    <div class="login-wrapper">
        <div class="login-info">
            <img src="/dist/img/logo.png" alt="logo">
            <span class="login-info-title">Mail verification</span>
            <span class="login-info-text">We have sent you a mail, please verify. </span>
            <a href="/login">Go to Login</a>
        </div>
    </div>
</main>
';

include '.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");


if (isset($cookie)) {
    if ($login) {
        header("Location: /");
    } else {
        $Page = $notLoggedInHeader;
    }
}  else {
    $Page = $notLoggedInHeader;
}
$Page = $Page . $homeContent . $footer;
echo $Page;

