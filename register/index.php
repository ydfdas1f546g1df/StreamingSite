
<?php
$homeContent = '
<main class="loginRegster-main">
<div class="login-wrapper">

    <form action="/login" method="post">
        <span class="Login-title">Register</span>
        <label>
            <span>Username</span>
            <input type="text" name="username" id="username" placeholder="max_muster" required>
        </label>
        <label>
            <span>Name</span>
            <input type="text" name="name" id="name" placeholder="other people will see this name" required>
        </label>
        <label>
            <span>Email</span>
            <input type="email" name="email" id="email" placeholder="example@gmail.com" required>
        </label>
        <label>
            <span>Password</span>
            <input type=password name="password" id="password" minlength="10" maxlength="128" placeholder="password"
                   required>
        </label>
        <label>
            <span>repeat password</span>
            <input type=password name="rpassword" id="rpassword" minlength="10" maxlength="128" placeholder="password"
                   required>
        </label>
        <input type="submit" value="Register">
        <a href="/register">I already have an account</a>
    </form>
    <div class="login-info">
    <img src="/dist/img/logo.png" alt="logo">
    <span class="login-info-title">Advantages with one account</span>
        <span class="login-info-text">Register now for free and get access to great features that will give you an exclusive watch experience! <a
                    href="/register">Click Here</a></span>

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
$Page = $Page . $homeContent . $footer;
echo $Page;

