

<?php

include '../../api/req_user_data.php';

$mainContent = '
<main class="profile-main">
    <article class="banner">
        <div class="info">
            <span class="location"><div class="icon"><i class="fa-solid fa-location-dot"></i></div>Swasiland</span>
            <span class="link"><div class="icon"><i class="fa-solid fa-link"></i></div><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">StreamingSite</a></span>
            <span class="Created"><div class="icon"><i class="fa-solid fa-calendar-days"></i></div>Member since '. $user_created .'</span>
        </div>
        <div class="p-picture"><img src="/dist/img/testpp.jpg" alt="pp">
            <span class="name">'. $user_name .'</span>
            <div>
                <a href="/user/watchlist/?u='. $user_username .'" class="watched"><span class="watched-nth">'. $user_wl .'</span> Watchlist</a>
                <a href="/user/watched/?u='. $user_username .'" class="watched"><span class="watched-nth">'. $user_wd .'</span> Episodes</a></div>
        </div>
        <div class="bio">
            <a href="/admin/" class="admin">'. $user_admin .'</a>
            <span class="bio-text"> 
        '. $user_bio .'
        </span>
        </div>
    </article>
    <article class="watchlist">

    </article>
    <article class="watched">

    </article>
    <script>
        document.title="'. $user_name .'\'s Profile | StreamingSite"
    </script>
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


