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
    $expire->add(new DateInterval('P6M'));
    $expire = $expire->format('Y-m-d');

    include explode("StreamingSite", __DIR__)[0] . 'StreamingSite\api\register.php';

    if ($error == 200) {
        $errorText = "Mail verification";
        $errorMessage = "We have sent you a mail, please verify";
        $error_link = "href='/login'";
        $error_link_text = "After that, Go to Login";
    } elseif ($error == 400) {
        $errorText = "400";
        $errorMessage = "Bad Request";
        $error_link = "onclick='history.back()'";
        $error_link_text = "Try again";
    } elseif ($error == 409) {
        $errorText = "409";
        $errorMessage = "User with this email, name or username already exist";
        $error_link = "onclick='history.back()'";
        $error_link_text = "Try again";
    }

} else {
    $errorText = "Bad Request 400";
    $errorMessage = "Something went completely wrong";
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

$verifyContent = '
<main class="loginRegster-main">
    <div class="login-wrapper">
        <div class="login-info">
            <img src="/dist/img/logo.png" alt="logo">
            <span class="login-info-title">Verify Email</span>
            <span class="login-info-text">Enter the code we have sent to your email</span>
            <form action="verify.php" method="post" class="verify-form">
                <div class="verify-code">
                    <input type="number" name="num1" maxlength="1" id="first" required>
                    <input type="number" name="num2" maxlength="1" required>
                    <input type="number" name="num3" maxlength="1" required>
                    <input type="number" name="num4" maxlength="1" required>
                    <input type="number" name="num5" maxlength="1" required>
                    <input type="number" name="num6" maxlength="1" required>
                </div>
                <input type="email" value="" style="display: none">
                <input type="submit" value="Verify">
            </form>
        </div>
    </div>
    <script src="/script/verify.js"></script>
</main>
';

include '.././template/index.php';

setcookie("token", "", time() - 1000, "/");
setcookie("name", "", time() - 1000, "/");
setcookie("username", "", time() - 1000, "/");

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
if (isset($error)) {
    if ($error == 200) {
        $Page = $Page . $verifyContent . $footer;
    } else {
        $Page = $Page . $homeContent . $footer;
    }
} else {
    $Page = $Page . $homeContent . $footer;
}

echo $Page;
