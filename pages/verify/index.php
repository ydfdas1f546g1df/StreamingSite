
<?php



$homeContent = '
<main class="loginRegster-main">
    <div class="login-wrapper">
        <div class="login-info">
            <img src="/dist/img/logo.png" alt="logo">
            <span class="login-info-title">Verify Email</span>
            <span class="login-info-text">Enter the code we have sent to your email</span>
            <form action="verify.php" method="post" class="verify-form">
                <div class="verify-code">
                    <input type="number" name="num1" maxlength="1" id="first">
                    <input type="number" name="num2" maxlength="1">
                    <input type="number" name="num3" maxlength="1">
                    <input type="number" name="num4" maxlength="1">
                    <input type="number" name="num5" maxlength="1">
                    <input type="number" name="num6" maxlength="1">
                </div>
                <input type="email" value="" style="display: none">
                <input type="submit" value="Verify">
            </form>
        </div>
    </div>
    <script src="/script/verify.js"></script>
</main>
';

include '../.././template/index.php';

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

