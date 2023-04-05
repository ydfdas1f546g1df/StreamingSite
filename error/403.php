

<?php
$homeContent = '
</header>
<main class="errorpage">
    <article>
        <span class="error-text">Sorry! Your not alowed do go here.</span>
        <span class="error-num">403</span>
        <span class="error-btns">
            <span class="error-btn" onclick="history.back()">Back</span>
            <a class="error-btn" href="/">Home</a>
        </span>
        <span class="error-text">If you believe this to be an error, please contact an administrator</span>
    </article>
    <script>
        document.title = "403  StreamingSite"
    </script>
</main>
';

include '.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");
$login = true;
$cookie = true;
$IsAdmin = true;

$Page = $header_1;

if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $Page . $admin_1 . $header_2 . $loggedIn;
        } else {
            $Page = $Page . $header_2 . $loggedIn;
        }
    } else {
        $Page = $Page . $header_2 . $notLoggedIn;
    }
}
$Page = $Page . $homeContent . $footer;
echo $Page;

