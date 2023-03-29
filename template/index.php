<?php

$header_1 = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Template</title>
    <link href="/dist/css/main.css" rel="stylesheet" type="text/css">
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"
    />
    <script src="/jsLibs/vue.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<header>
    <div class="logo">
        <a href="/" class="logo-1" title="StreamingSite">Streaming</a>
        <a href="/" class="logo-2" title="StreamingSite">Site</a>
        <nav>
            <a href="#" title="All series and films on this website"><i class="gg-play-button-o"></i>&nbsp;Series</a>
            <a href="#" title="This is popular right now"><i class="gg-align-bottom"></i>&nbsp;Popular</a>
            <a href="#" title="Search for series and films"><i class="gg-search"></i>&nbsp;Search</a>
`;
$admin_1 = `
            <span class="nav-more tooltip" title="Admin Stuff">admin
             <div class="tooltiptext">
                 <a href="https://github.com/ydfdas1f546g1df/StreamingSite" target="_blank">
                <div class="more-dd-icon"><i class="gg-git-fork"></i></div>
                GitHub</a>
                 <a href="/admin/media/">
                <div class="more-dd-icon"><i class="gg-software-upload"></i></div>
                Upload</a>
               <a href="/admin/user/">
                <div class="more-dd-icon"><i class="gg-terminal"></i></div>
                Admin</a>
            </div>
            </span>`;
$header_2 = `
        </nav>
    </div>`;

$notLoggedIn = `
<div class="login-div">
        <a href="#" class="nl-btn l-btn" >LOGIN</a>
        <a href="#" class="nl-btn r-btn" >REGISTER</a>
    </div>`;

$loggedIn = `
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
            </a><a class="user-dd-el" href="#">
                <div class="user-dd-icon">
                    <i class="gg-log-in"></i>
                </div>
                <span class="user-dd-name">Logout</span>
            </a>

            </div>
        </div>
    </div>
    <section class="top-nav">
        <input id="menu-toggle" type="checkbox"/>
        <label class='menu-button-container' for="menu-toggle">
            <div class='menu-button'></div>
        </label>
        <ul class="menu">
            <li><a href="/pages/all.html"><i class="gg-play-button-o"></i>&nbsp;Series</a></li>
            <li><a href="/pages/popular.html"><i class="gg-align-bottom"></i>&nbsp;Popular</a></li>
            <li><a href="/pages/Search.html"><i class="gg-search"></i>&nbsp;Search</a></li>
            `;
$admin_2 = `<li class="more-dd">more</li>
            <li class="more-dd-el"><a href="https://github.com/ydfdas1f546g1df/StreamingSite" target="_blank">
                <div class="more-dd-icon"><i class="gg-git-fork"></i></div>
                GitHub</a></li>
            <li class="more-dd-el"><a href="/admin/media/">
                <div class="more-dd-icon"><i class="gg-software-upload"></i></div>
                Upload</a></li>
            <li class="more-dd-el more-dd-el-last"><a href="/admin/">
                <div class="more-dd-icon"><i class="gg-terminal"></i></div>
                Admin</a></li>
`;
$header_3 = `
            <li class="second-dd-el"></li>
            <li class="second-dd-el"><a href="#">Account</a></li>
            <li class="second-dd-el"><a href="#">Profile</a></li>
            <li class="second-dd-el"><a href="#">Watchlist</a></li>
            <li class="second-dd-el"><a href="#">Settings</a></li>
            <li class="second-dd-el"><a href="#">Logout</a></li>
            <li class="second-dd-el"></li>
        </ul>
    </section>`;

$HomePageBody = `
</header>
<main>
    <div class="quick-search" id="quick-search">
        <div class="quick-search-el" v-for="quick in quicks"><a href="#">{{ quick }}</a></div>
    </div>
    <div class="eye-catcher" id="eye-catcher">
        <div class="eye-wr">

            <div class="eye-wrapper">
                <div class="eye-el-1x2 eye-catcher-el">
                    <span>Vinland Saga</span>
                </div>
                <div class="eye-el-1x2 eye-catcher-el">
                    <span>Vinland Saga</span>

                </div>
            </div>
            <div class="eye-wrapper">

                <div class="eye-el-2x2 eye-catcher-el">
                    <span>Vinland Saga</span>

                </div>
            </div>
        </div>
        <div class="eye-wr">

            <div class="eye-wrapper">

                <div class="eye-wrapper-wrapper">
                    <div class="eye-el-1x1 eye-catcher-el">
                        <span>Vinland Saga</span>

                    </div>
                    <div class="eye-el-1x1 eye-catcher-el">
                        <span>Vinland Saga</span>

                    </div>
                </div>
                <div class="eye-wrapper-wrapper">
                    <div class="eye-el-1x1 eye-catcher-el">
                        <span>Vinland Saga</span>

                    </div>
                    <div class="eye-el-1x1 eye-catcher-el">
                        <span>Vinland Saga</span>

                    </div>
                </div>
            </div>

            <div class="eye-wrapper">
                <div class="eye-el-1x2 eye-catcher-el">
                    <span>Vinland Saga</span>

                </div>
                <div class="eye-el-1x2 eye-catcher-el">
                    <span>Vinland Saga</span>

                </div>
            </div>
        </div>
    </div>

    <div class="home-cat-parent">
        <span class="home-el-title">Popular
            <a href="#" class="home-el-all">View all</a>
        </span>
        <div id="home-cat-1" class="wrapper home-cat">
<!--            <span id="hello" style="color: white; cursor: pointer">Hello</span>-->

            <a href="#" class="home-el" v-for="media in Media" :title="media.name + ', watch it now for free and in full length.'">
                <img v-bind:src="media.coverSrc" alt="cover" class="cover">
                <span class="cover-title">{{ media.name }}<span class="fi fi-de"></span></span>
            </a>
        </div>
    </div>
    <div class="home-cat-parent">
        <span class="home-el-title">Recent watched
            <a href="#" class="home-el-all">View all</a>
        </span>
        <div id="home-cat-2" class="wrapper home-cat">
            <a href="#" class="home-el" v-for="media in Media" :title="media.name + ', watch it now for free and in full length.'">
                <img v-bind:src="media.coverSrc" alt="cover" class="cover">
                <span class="cover-title">{{ media.name }}<span class="fi fi-de"></span></span>
            </a>
        </div>
    </div>
    <div class="home-cat-parent">
        <span class="home-el-title" id="latest">Latest uploads
            <a href="#" class="home-el-all">View all</a>
        </span>
        <div id="home-cat-3" class="wrapper home-cat">
            <a href="#" class="home-el" v-for="media in Media" :title="media.name + ', watch it now for free and in full length.'">
                <img v-bind:src="media.coverSrc" alt="cover" class="cover">
                <span class="cover-title">{{ media.name }}<span class="fi fi-de"></span></span>
            </a>
        </div>
    </div>

</main>
`;
$footer = `
<footer>
    <div class="wrapper">
        <div class="footer-el">
            <span class="footer-el-title">Series</span>
            <a class="footer-el-item" href="/pages/all.html">All</a>
            <a class="footer-el-item" href="#latest">New</a>
            <a class="footer-el-item" href="/pages/popular.html">Popular</a>
        </div>
        <div class="footer-el">
            <span class="footer-el-title">About</span>
            <a class="footer-el-item" href="/pages/contact.html">Contact</a>
            <a class="footer-el-item" href="#">AGBs</a>
            <a class="footer-el-item" href="#">Imprint</a>
        </div>
        <div class="footer-el">
            <span class="footer-el-title">Discover</span>
            <a class="footer-el-item">Random</a>
            <a class="footer-el-item" href="/pages/Search.html">Search</a>
        </div>
    </div>
    <span class="copyright">&copy; Copyright 2023. All Rights Reserved. <a href="/">StreamingSite</a></span>
</footer>
<script src="/script/main.js"></script>
</body>
</html>`;
$login = true;
$cookie = true;
$IsAdmin = true;

$Page = $header_1;

if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $Page . $admin_1 . $header_2 . $admin_2 . $loggedIn . $header_3;
        } else {
            $Page = $Page . $header_2 . $loggedIn . $header_3;
        }
    }
} else {
    $Page = $Page . $header_2 . $notLoggedIn . $header_3;
}
$Page = $Page . $HomePageBody . $footer;
echo $Page;
echo `hallo`;