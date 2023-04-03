<?php

$header_1 = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StreamingSite</title>
    <link href="/dist/css/main.css" rel="stylesheet" type="text/css">
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"
    />
    <script src="/jsLibs/vue.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/script/logout.js"></script>
</head>
<body>
<header>
    <div class="logo">
        <a href="/" class="logo-1" title="StreamingSite">Streaming</a>
        <a href="/" class="logo-2" title="StreamingSite">Site</a>
        <nav>
            <a href="/pages/all.php"All series and films on this website"><i class="gg-play-button-o"></i>&nbsp;Series</a>
            <a href="/pages/popular.php" title="This is popular right now"><i class="gg-align-bottom"></i>&nbsp;Popular</a>
            <a href="#" title="Search for series and films"><i class="gg-search"></i>&nbsp;Search</a>
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
        <a href="#" class="nl-btn l-btn" >LOGIN</a>
        <a href="#" class="nl-btn r-btn" >REGISTER</a>
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
            <li><a href="/pages/all.php"><i class="gg-play-button-o"></i>&nbsp;Series</a></li>
            <li><a href="/pages/popular.php"><i class="gg-align-bottom"></i>&nbsp;Popular</a></li>
            <li><a href="/pages/Search.php"><i class="gg-search"></i>&nbsp;Search</a></li>
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
   </header>';

$HomePageBody = '
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

            <a href="#" class="home-el" v-for="media in Media" :title="media.name + \', watch it now for free and in full length.\'">
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
            <a href="#" class="home-el" v-for="media in Media" :title="media.name + \', watch it now for free and in full length.\'">
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
            <a href="#" class="home-el" v-for="media in Media" :title="media.name + \', watch it now for free and in full length.\'">
                <img v-bind:src="media.coverSrc" alt="cover" class="cover">
                <span class="cover-title">{{ media.name }}<span class="fi fi-de"></span></span>
            </a>
        </div>
    </div>

</main>
';
$footer = '
<footer>
    <div class="wrapper">
        <div class="footer-el">
            <span class="footer-el-title">Series</span>
            <a class="footer-el-item" href="/pages/all.php">All</a>
            <a class="footer-el-item" href="#latest">New</a>
            <a class="footer-el-item" href="/pages/popular.php>Popular</a>
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
            <a class="footer-el-item" href="/pages/Search.php">Search</a>
        </div>
    </div>
    <span class="copyright">&copy; Copyright 2023. All Rights Reserved. <a href="/">StreamingSite</a></span>
</footer>
<script>
    $("#logout").on("click", function () {
        console.log(document.cookie)
        document.cookie = "LoginUser=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT";
    })
</script>
<script src="/script/main.js"></script>
</body>
</html>';

$admin_user = '<main class="admin-main">
    <div id="admin-main-div">

    <aside>
        <a href="/admin/">
            <div class="icon-container"><i class="gg-terminal"></i></div>
            Dashboard</a>
        <a href="/admin/media/">
            <div class="icon-container"><i class="fa-solid fa-photo-film"></i></div>
            Media
        </a>
        <a href="/admin/upload/">
            <div class="icon-container"><i class="gg-software-upload"></i></div>
            upload</a>
        <a href="/admin/user" class="current-admin">
            <div class="icon-container"><i class="gg-user"></i></div>
            User</a>
    </aside>
    <article class="user-article">
<!--        <div id="mydiv">-->
<!--            &lt;!&ndash; Include a header DIV with the same name as the draggable DIV, followed by "header" &ndash;&gt;-->
<!--            <div id="mydivheader">Click here to move</div>-->
<!--            <p>Move</p>-->
<!--            <p>this</p>-->
<!--            <p>DIV</p>-->
<!--        </div>-->
        <div class="user" id="all-users">
            <div class="btns">
                <span class="add-btn user-btn" onclick="dragElement()"><i class="gg-user-add"></i></span>
                <span class="save-btn user-btn"><i class="fas fa-save"></i></span>
            </div>
            <label for="">
                Search User
                <input type="text" name="search-user" placeholder="username" v-model="search">
            </label>

            <div class="user-list">
                <div class="user-list-el-header">
                    <span class="user-list-el-id">ID</span>
                    <span class="user-list-el-username">username</span>
                    <span class="user-list-el-name">name</span>
                    <span class="user-list-el-email">email</span>
                    <span class="user-list-el-admin">admin</span>
                    <span class="user-list-btn-placeholder"></span>
                    <span class="user-list-btn-placeholder"></span>
                </div>

                <div class="user-list-el" v-for="user in filteredUsers" id="{{ user.id }}" :key="user.id">
                    <span class="user-list-el-id">{{ user.id }}</span>
                    <span class="user-list-el-username">{{ user.username }}</span>
                    <span class="user-list-el-name">{{ user.name }}</span>
                    <span class="user-list-el-email">{{ user.email }}</span>
                    <span class="user-list-el-admin"><i :class="user.admin"></i></span>
                    <span class="user-list-btn-placeholder">
                        <span class="edit-btn user-list-btn"><i class="fa-solid fa-pen-to-square"></i></span>
                        </span>
                    <span class="user-list-btn-placeholder">
                        <span class="del-btn user-list-btn"><i class="fa-solid fa-trash"></i></span>
                        </span>
                </div>
            </div>
        </div>

    </article>
    </div>
    <script src="/script/admin_user.js"></script>
</main>';

$admin_dashboard = '<main class="admin-main">
    <div id="admin-main-div">


    <aside>
        <a href="/admin" class="current-admin">
            <div class="icon-container"><i class="gg-terminal"></i></div>
            Dashboard</a>
        <a href="/admin/media">
            <div class="icon-container"><i class="fa-solid fa-photo-film"></i></div>
            Media
        </a>
        <a href="/admin/upload">
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
