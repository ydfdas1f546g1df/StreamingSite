<?php


include '.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");

if (isset($_COOKIE['token'])) {
    $token = $_COOKIE['token'];
    // echo $token;
} else {
    $token = "";
}

if (isset($_COOKIE['name'])) {
    $name = $_COOKIE['name'];
    // echo $token;
} else {
    $name = "";
}

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    // echo $token;
} else {
    $username = "";
}

$mainContent = '
<main class="account-main">
    <span class="page-title">Your Account</span>
    <article>
        <a href="/user/profil?u=' . $username . '">
            <div class="icon">
                <i class="gg-user"></i>
            </div>
            <div class="text">
                <span class="title">Profil</span>
                <span class="description">Your own personal profile. Here you can find statistics and other things.</span>
            </div>
        </a>
        <a href="/user/settings">
            <div class="icon">
                <i class="fa-solid fa-gear"></i>
            </div>
            <div class="text">
                <span class="title">Settings</span>
                <span class="description">Customise password, profile picture, privacy, data protection and other settings.</span>
            </div>
        </a>
        <a href="/user/watchlist/?u=' . $username . '">
            <div class="icon">
                <i class="fa-solid fa-list-ul"></i>
            </div>
            <div class="text">
                <span class="title">Watchlist</span>
                <span class="description">Bookmark interesting series & watch them later</span>
            </div>
        </a>
        <a href="/user/watched/?u=' . $username . '">
            <div class="icon">
                <i class="gg-eye-alt"></i>
            </div>
            <div class="text">
                <span class="title">Watched</span>
                <span class="description">A list where you can see what you have already watched</span>
            </div>
        </a>
        <a href="/pages/search">
            <div class="icon">
                <i class="gg-search"></i>
            </div>
            <div class="text">
                <span class="title">Suche</span>
                <span class="description">Search and find series, films or anime ...</span>
            </div>
        </a>
        <a href="/login" class="logout-btn">
            <div class="icon">
                <i class="gg-log-in"></i>
            </div>
            <div class="text">
                <span class="title">Logout</span>
                <span class="description">If you would like to register with another account or if you would like to log out completely, you can do so here.</span>
            </div>
        </a>
    </article>
    <script>
            document.title="' . $name . '\'s Account | StreamingSite"
          </script>
</main>
';

if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            $Page = $loggedInHeader;
        }
    } else {
        header("location: /login/");
    }
} else {
    header("Location: /login/");
}
$Page = $Page . $mainContent . $footer;
echo $Page;