<?php
$email = "";
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
        $errorMessage = "Your passwords probably do not match";
        $error_link = "onclick='history.back()'";
        $error_link_text = "Back";
    } elseif ($error == 409) {
        $errorText = "409";
        $errorMessage = "User with this email, name or username already exist";
        $error_link = "onclick='history.back()'";
        $error_link_text = "Back";
    }

} else {
    $errorText = "404";
    $errorMessage = "Sorry! We couldn't find that page.";
    $error_link = "onclick='history.back()'";
    $error_link_text = "Back";
}



//<main class="loginRegster-main">
//    <div class="login-wrapper">
//        <div class="login-info">
//            <img src="/dist/img/logo.png" alt="logo">
//            <span class="login-info-title">' . $errorText . ' </span>
//            <span class="login-info-text">' . $errorMessage . '</span>
//            <a ' . $error_link . '>' . $error_link_text . '</a>
//        </div>
//    </div>
//</main>
$homeContent = '
<main class="errorpage">
    <article>
        <span class="error-text">' . $errorMessage . '</span>
        <span class="error-num">' . $errorText . '</span>
        <span class="error-btns">
            <span class="error-btn" ' . $error_link . '>' . $error_link_text . '</span>
            <a class="error-btn" href="/">Home</a>
        </span>
        <span class="error-text">If you believe this to be an error, please <a href="/pages/about/contact.php">contact</a>  an administrator</span>
    </article>
    <script>
        document.title = "Error ' . $errorText . ' | StreamingSite"
    </script>
</main>
';

if (isset($_GET["verifyEmail"]) && !str_contains($_SERVER['REQUEST_URI'], "&")) {
    $email = $_GET["verifyEmail"];
    $error = 200;
}

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
                    <input type="number" name="num6" maxlength="1" required>-
                </div>
                <input type="email" value="' . $email . '" style="display: none">
                <input type="submit" value="Verify">
            </form>
        </div>
    </div>
    <script src="/script/verify.js"></script>
        <script>
        document.title = "Verify Email | StreamingSite"
    </script>
</main>
';

include '.././template/index.php';

//setcookie("token", "", time() - 1000, "/");
//setcookie("name", "", time() - 1000, "/");
//setcookie("username", "", time() - 1000, "/");

if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            $Page = $notLoggedInHeader;
        }
    } else {
        $Page = $notLoggedInHeader;
    }
} else {
    $Page = $notLoggedInHeader;
}

if (isset($error) || filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if ($error == 200) {
        $Page = $Page . $verifyContent . $footer;
    } else {
        $Page = $Page . $homeContent . $footer;
    }
} else {
    $Page = $Page . $homeContent . $footer;
}

echo $Page;
