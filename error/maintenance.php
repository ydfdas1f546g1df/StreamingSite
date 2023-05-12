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


$verifyContent = '
<main class="loginRegster-main">
    <div class="login-wrapper">
        <div class="login-info">
            <img src="/dist/img/logo.png" alt="logo">
            <span class="login-info-title">Maintenance mode</span>
            <span class="login-info-text">StreamingSite is undergoing maintenance, this may take some time.</span>
            <a href="/login/">login</a>
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

if (!$setting_main) {
    header("location: /error/404.php");

}

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
        $Page = $Page . $verifyContent . $footer;
    }
} else {
    $Page = $Page . $verifyContent . $footer;
}

echo $Page;
