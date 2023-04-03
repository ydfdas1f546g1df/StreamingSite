<?php

$header_1 = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StreamingSite</title>
    <link rel="shortcut icon" href="/dist/img/logo.png" type="image/x-icon">
    <link href="/dist/css/main.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"/>
    <script src="/jsLibs/vue.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<header>
    <div class="logo">
        <a href="/" class="logo-1" title="StreamingSite">Streaming</a>
        <a href="/" class="logo-2" title="StreamingSite">Site</a>
        <nav>
            <a href="/pages/allseries/" title="All series and films on this website"><i class="gg-play-button-o"></i>&nbsp;Series</a>
            <a href="/pages/popular.php" title="This is popular right now"><i class="gg-align-bottom"></i>&nbsp;Popular</a>
            <a href="/pages/search/" title="Search for series and films"><i class="gg-search"></i>&nbsp;Search</a>
';
$admin_1 = '
            <span class="nav-more tooltip" title="There is more here">admin
             <div class="tooltiptext">
                 <a href="https://github.com/ydfdas1f546g1df/StreamingSite" target="_blank">
                <div class="more-dd-icon"><i class="gg-git-fork"></i></div>
                GitHub</a>
                 <a href="/admin/Upload/">
                <div class="more-dd-icon"><i class="gg-software-upload"></i></div>
                Upload</a>
               <a href="/admin/">
                <div class="more-dd-icon"><i class="gg-terminal"></i></div>
                Admin</a>
            </div>
            </span>';
$header_2 = '
        </nav>
    </div>';

$notLoggedIn = '
<div class="login-div">
        <a href="/login/" class="nl-btn l-btn" >LOGIN</a>
        <a href="/register/" class="nl-btn r-btn" >REGISTER</a>
    </div>';

$loggedIn = '
    <div class="user">
        <img src="/dist/img/testpp.jpg" id="user-pp" alt="user-pp"/>
        <div id="user-name" class="tooltip">Username<i class="down-arrow"></i>
            <div class="tooltiptext">
                <a class="user-dd-el" href="#">
                    <div class="user-dd-icon">
                        <i class="gg-format-justify"></i>
                    </div>
                    <span class="user-dd-name">Account</span>
                </a> <a class="user-dd-el" href="#">
                <div class="user-dd-icon">
                    <i class="gg-user"></i>
                </div>
                <span class="user-dd-name">Profile</span>
            </a> <a class="user-dd-el" href="#">
                <div class="user-dd-icon">
                    <i class="gg-eye-alt"></i>
                </div>
                <span class="user-dd-name">Watchlist</span>
            </a> <a class="user-dd-el" href="#">
                <div class="user-dd-icon">
                    <i class="gg-list-tree"></i>
                </div>
                <span class="user-dd-name">Settings</span>
            </a><a class="user-dd-el" href="/">
                <div class="user-dd-icon">
                    <i class="gg-log-in"></i>
                </div>
                <span class="user-dd-name" id="logout">Logout</span>
            </a>

            </div>
        </div>
    </div>
    <section class="top-nav">
        <input id="menu-toggle" type="checkbox"/>
        <label class="menu-button-container" for="menu-toggle">
            <div class="menu-button""></div>
        </label>
        <ul class="menu">
            <li><a href="/pages/allseries/index.php"><i class="gg-play-button-o"></i>&nbsp;Series</a></li>
            <li><a href="/pages/popular.php"><i class="gg-align-bottom"></i>&nbsp;Popular</a></li>
            <li><a href="/pages/search/"><i class="gg-search"></i>&nbsp;Search</a></li>
            ';
$admin_2 = '<li class="more-dd">admin</li>
            <li class="more-dd-el"><a href="https://github.com/ydfdas1f546g1df/StreamingSite" target="_blank">
                <div class="more-dd-icon"><i class="gg-git-fork"></i></div>
                GitHub</a></li>
            <li class="more-dd-el"><a href="/admin/media/">
                <div class="more-dd-icon"><i class="gg-software-upload"></i></div>
                Upload</a></li>
            <li class="more-dd-el more-dd-el-last"><a href="/admin/">
                <div class="more-dd-icon"><i class="gg-terminal"></i></div>
                Admin</a></li>
';
$header_3 = '
            <li class="second-dd-el"></li>
            <li class="second-dd-el"><a href="#">Account</a></li>
            <li class="second-dd-el"><a href="#">Profile</a></li>
            <li class="second-dd-el"><a href="#">Watchlist</a></li>
            <li class="second-dd-el"><a href="#">Settings</a></li>
            <li class="second-dd-el"><a href="#">Logout</a></li>
            <li class="second-dd-el"></li>
        </ul>
    </section>
   ';
$footer = '
<footer>
    <div class="wrapper">
        <div class="footer-el">
            <span class="footer-el-title">Series</span>
            <a class="footer-el-item" href="/pages/allseries/">All</a>
            <a class="footer-el-item" href="/#latest">New</a>
            <a class="footer-el-item" href="/pages/popular.php">Popular</a>
        </div>
        <div class="footer-el">
            <span class="footer-el-title">About</span>
            <a class="footer-el-item" href="/pages/contact.php">Contact</a>
            <a class="footer-el-item" href="#">AGBs</a>
            <a class="footer-el-item" href="#">Imprint</a>
        </div>
        <div class="footer-el">
            <span class="footer-el-title">Discover</span>
            <a class="footer-el-item">Random</a>
            <a class="footer-el-item" href="/pages/search/">Search</a>
        </div>
    </div>
    <span class="copyright">&copy; Copyright 2023. All Rights Reserved. <a href="/">StreamingSite</a></span>
</footer>
<script>
    $("#logout").on("click", function () {
        document.cookie = "LoginUser=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT";
    })
</script>
<script src="/script/main.js"></script>
</body>
</html>';

//
//$date = time() + (86400 * 30);
//$cookie_name = "LoginUser";
//$cookie_value = "wevwev@gmail.com";
//setcookie($cookie_name, $cookie_value, $date, "/"); // 86400 = 1 day
//if(!isset($_COOKIE[$cookie_name])) {
//    echo "Cookie '" . $cookie_name . "' is not set!";
//} else {
//    echo "Cookie '" . $cookie_name . "' is set!<br>";
//    echo "Value is: " . $_COOKIE[$cookie_name];
//}