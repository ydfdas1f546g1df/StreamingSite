
<?php
$homeContent = '
<main class="loginRegster-main">
<div class="login-wrapper">

    <form action="./sendmail.php" method="get">
        <span class="Login-title">Register</span>
        <label>
            <span>Name</span>
            <input type="text" name="name" id="name" placeholder="other people will see this name" required autocomplete="off" maxlength="30">
        </label>
        <label>
            <span>Username</span>
            <input type="text" name="username" id="username" placeholder="max_muster" required autocomplete="off" maxlength="30">
        </label>
        <label>
            <span>Email</span>
            <input type="email" name="email" id="email" placeholder="example@gmail.com" required autocomplete="off">
        </label>
        <label>
            <span>Password</span>
            <i class="fa-sharp fa-solid fa-eye-slash showPw"></i>
            <input type=password class="pw" name="password" id="password" minlength="10" maxlength="128" placeholder="password"
                   required autocomplete="off">   
        </label>
        <label>
            <span>Password</span>
            <input type=password name="rpassword" class="pw" id="rpassword" minlength="10" maxlength="128" placeholder="password"
                   required autocomplete="off">
        </label>
        <input type="submit" value="Register">
        <a href="/login">I already have an account</a>
        <span class="agree">By registering, you agree to our <a href="/pages/about/agb.php">terms of use and privacy policy</a>.</span>
        <span id="error-field"></span>
    </form>
    <div class="login-info register-info">
        <img src="/dist/img/logo.png" alt="logo">
        <span class="login-info-title">Advantages with an account?</span>
            <span class="login-info-text regi"><div><i class="fa-solid fa-xmark ads"></i></div> No StreamingSite ads</span>
            <span class="login-info-text"><div><i class="gg-eye-alt watched"></i></div> Remember episodes you \'ve watched</span>
            <span class="login-info-text"><div><i class="fa-solid fa-list watchlist"></i></div>Create Watchlist</span>
            <span class="login-info-subtitle">And all this for free!</span>
    </div>
</div>
</main>
<script src="/script/register.js"></script>
<script src="/script/loginregister.js"></script>
';

include '.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");


if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            header("location: /error/403.php");
        }
    } else {
        $Page = $notLoggedInHeader;
    }
} else {
    $Page = $notLoggedInHeader;
}
$Page = $Page . $homeContent . $footer;
echo $Page;

