

<?php
$homeContent = '
</header>
<main class="errorpage">
    <article>
        <span class="error-text">Sorry! We couldn\'t find that page.</span>
        <span class="error-num">404</span>
        <span class="error-btns">
            <span class="error-btn" onclick="history.back()">Back</span>
            <a class="error-btn" href="/">Home</a>
        </span>
        <span class="error-text">If you believe this to be an error, please contact an administrator</span>
    </article>
    <script>
        document.title = "Error 404 | StreamingSite"
    </script>
</main>
';

include '.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");
if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            $Page = $loggedInHeader;
        }
    } else {
        $Page = $notLoggedInHeader;
    }
} else {
    $Page = $notLoggedInHeader;
}
$Page = $Page . $homeContent . $footer;
echo $Page;

