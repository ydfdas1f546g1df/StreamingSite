<?php

//$to = "colin.heggli@gmail.com";
//$subject = "Hello ma friend";
//
//
//$headrs = array(
//    "MINE-Version" => "1.0",
//    "Content-Type" => "text/html;charset=UFT-8",
//    "From" => "colin.heggli@gmail.com",
//    "Reply-To"=> "colin.heggli@gmail.com"
//);
//$message = "memo mail";
//
//$send = mail($to, $subject, $message, $headrs);
//
//echo ($send ? "Mail is Send" : "Error");


$email = "";
if (isset($_POST["email"]) && isset($_POST["num1"]) && isset($_POST["num2"]) && isset($_POST["num3"]) && isset($_POST["num4"]) && isset($_POST["num5"]) && isset($_POST["num6"])) {
    $error = 200;
    $email = htmlspecialchars($_REQUEST["email"]);
    $expire = new DateTime();
    $expire->add(new DateInterval('P6M'));
    $expire = $expire->format('Y-m-d');

    $VerifyToken = $_REQUEST["num1"] . $_REQUEST["num2"] . $_REQUEST["num3"] . $_REQUEST["num4"] . $_REQUEST["num5"] . $_REQUEST["num6"];

    include explode("StreamingSite", __DIR__)[0] . 'StreamingSite\api\verify.php';

    if ($error == 200) {
        $errorText = "Verified";
        $errorMessage = "Your Email is now Verified";
        $error_link = "href='/login'";
        $error_link_text = "Login";
    } elseif ($error == 400) {
        $errorText = "400";
        $errorMessage = "Bad Request";
        $error_link = "onclick='history.back()'";
        $error_link_text = "Back";
    } elseif ($error == 409) {
        $errorText = "409";
        $errorMessage = "This user is already verified";
        $error_link = "href='/login'";
        $error_link_text = "Login";
    }

} else {
    $errorText = "404";
    $errorMessage = "Sorry! We couldn't find that page.";
    $error_link = "onclick='history.back()'";
    $error_link_text = "Back";
}

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




$verifyContent = '
<main class="loginRegster-main">
    <div class="login-wrapper">
        <div class="login-info">
            <img src="/dist/img/logo.png" alt="logo">
            <span class="login-info-title">' . $errorText . ' </span>
            <span class="login-info-text">' . $errorMessage . '</span>
            <a ' . $error_link . '>' . $error_link_text . '</a>
        </div>
    </div>
</main>';
//<main class="loginRegster-main">
//    <div class="login-wrapper">
//        <div class="login-info">
//            <img src="/dist/img/logo.png" alt="logo">
//            <span class="login-info-title">Verified</span>
//            <span class="login-info-text">Your Email is now Verified</span>
//            <a href="/login">Login</a>
//            </form>
//        </div>
//    </div>
//    <script src="/script/verify.js"></script>
//        <script>
//        document.title = "Verify Email | StreamingSite"
//        if ($("input[type=\'number\']").length == 6) {
////            $("form").submit()
//        }
//
//    </script>
//</main>


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
