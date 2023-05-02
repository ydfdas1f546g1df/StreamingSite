

<?php

include '../../api/req_user_data.php';

$mainContent = '
<main class="profile-main">
    <article class="banner">
        <div class="info">
            <span class="location"><div class="icon"><i></i></div>Swasiland</span>
            <span class="link"><div class="icon"><i></i></div><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley">StreamingSite</a></span>
            <span class="Created"><div class="icon"><i></i></div>'. $user_created .'</span>
            <span class="Watchlist"><div class="icon"><i></i></div>'. $user_wl .'</span>
        </div>
        <div class="p-picture"><img src="/dist/img/testpp.jpg" alt="pp">
            <span class="name">'. $user_name .'<span class="admin">'. $user_admin .'</span></span>
            <span class="watched"><span>'. $user_wd .'</span> Episodes</span></div>
        <div class=""></div>
    </article>
    <article class="watchlist">

    </article>
    <article class="watched">

    </article>
</main>
';

include '../.././template/index.php';

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
$Page = $Page . $mainContent . $footer;
echo $Page;


