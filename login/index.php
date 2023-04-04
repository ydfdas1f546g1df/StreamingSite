
<?php

$homeContent = '
<main class="loginRegster-main">
    <div class="login-wrapper">
        <form action="./checklogin.php" method="post">
            <span class="Login-title">Login</span>
            <label>
                <span>Email</span>
                <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
            </label>
            <label>
                <span>Password</span><i class="fa-sharp fa-solid fa-eye-slash showPw"></i>
                <input type=password name="password" class="pw" id="password" minlength="10" maxlength="128" placeholder="password"
                       required>
            </label>
            <label>
                <span>Stay logged in</span>
                <div class="checkbox-wrapper-55">
                    <label class="rocker rocker-small">
                        <input type="checkbox">
                        <span class="switch-left">Yes</span>
                        <span class="switch-right">No</span>
                    </label>
                </div>
            </label>
            <input type="submit" value="Login">
            <a href="/register">I do not have an account</a>
        </form>
        <div class="login-info">
            <img src="/dist/img/logo.png" alt="logo">
            <span class="login-info-title">New at StreamingSite?</span>
            <span class="login-info-text">Register now for free and get access to great features that will give you an exclusive watch experience! </span>
            <a href="/register">Click Here</a>
        </div>
    </div>
</main>
<script src="/script/loginRegister.js"></script>
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
$Page .=  $homeContent . $footer;
echo $Page;

