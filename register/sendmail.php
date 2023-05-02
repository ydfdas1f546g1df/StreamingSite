<?php
$verifyNum = rand(100000, 999999);
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
    } elseif (explode("-", $error)[0] = 418) {
        $errorText = "418";
        $errorMessage = "Sorry! This password is already used by <strong>" . explode("-", $error)[1] . "</strong><br> with the username <strong> " . explode("-", $error)[2] . "</strong>";
        $error_link = "onclick='history.back()'";
        $error_link_text = "I'm a teapot";
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

if (isset($_GET["verifyEmail"])) {
    $email = $_GET["verifyEmail"];
    $error = 200;
}

$num1 = "";
$num2 = "";
$num3 = "";
$num4 = "";
$num5 = "";
$num6 = "";

if (isset($_GET["num1"]) && isset($_GET["num2"]) && isset($_GET["num3"]) && isset($_GET["num4"]) && isset($_GET["num5"]) && isset($_GET["num6"])) {
    $num1 = 'value="' . $_GET["num1"] . '" class="ok"';
    $num2 = 'value="' . $_GET["num2"] . '" class="ok"';
    $num3 = 'value="' . $_GET["num3"] . '" class="ok"';
    $num4 = 'value="' . $_GET["num4"] . '" class="ok"';
    $num5 = 'value="' . $_GET["num5"] . '" class="ok"';
    $num6 = 'value="' . $_GET["num6"] . '" class="ok"';
}

//For testing --

$num1 = 'value="' . substr($verifyNum, 0, 1) . '" class="ok"';
$num2 = 'value="' . substr($verifyNum, 1, 1) . '" class="ok"';
$num3 = 'value="' . substr($verifyNum, 2, 1) . '" class="ok"';
$num4 = 'value="' . substr($verifyNum, 3, 1) . '" class="ok"';
$num5 = 'value="' . substr($verifyNum, 4, 1) . '" class="ok"';
$num6 = 'value="' . substr($verifyNum, 5, 1) . '" class="ok"';

//--

$verifyContent = '
<main class="loginRegster-main">
    <div class="login-wrapper">
        <div class="login-info">
            <img src="/dist/img/logo.png" alt="logo">
            <span class="login-info-title">Verify Email</span>
            <span class="login-info-text">Enter the code we have sent to your email</span>
            <form action="verify.php" method="post" class="verify-form">
                <div class="verify-code">
                    <input type="number" name="num1" maxlength="1" required ' . $num1 . '>
                    <input type="number" name="num2" maxlength="1" required ' . $num2 . '>
                    <input type="number" name="num3" maxlength="1" required ' . $num3 . '>
                    <input type="number" name="num4" maxlength="1" required ' . $num4 . '>
                    <input type="number" name="num5" maxlength="1" required ' . $num5 . '>
                    <input type="number" name="num6" maxlength="1" required ' . $num6 . '>
                </div>
                <input name="email" type="email" value="' . $email . '" style="display: none">
                <input type="submit" value="Verify">
            </form>
        </div>
    </div>
    <script src="/script/verify.js"></script>
        <script>
        document.title = "Verify Email | StreamingSite"
        if ($("input[type=\'number\']").length == 6) {
//            $("form").submit()
        }
        
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
            header("location: /error/403.php");
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