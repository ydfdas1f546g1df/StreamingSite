<?php

$mainContent = '
</header>
<main class="admin-main">
    <div id="admin-main-div">


    <aside>
        <a href="/admin">
            <div class="icon-container"><i class="gg-terminal"></i></div>
            Dashboard</a>
        <a href="/admin/media">
            <div class="icon-container"><i class="fa-solid fa-photo-film"></i></div>
            Media
        </a>
        <a href="/admin/upload" class="current-admin">
            <div class="icon-container"><i class="gg-software-upload"></i></div>
            upload</a>
        <a href="/admin/user">
            <div class="icon-container"><i class="gg-user"></i></div>
            User</a>
    </aside>
    <article class="dash-article">


    </article>
    </div>
</main>';

include '../.././template/index.php';

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
            header("location: /error/403.php");
        }
    } else {
        header("location: /error/403.php");
    }
}
$Page = $Page . $mainContent . $footer;
echo $Page;