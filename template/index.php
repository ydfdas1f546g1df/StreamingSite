<?php
$username = "Username";
$cookie_name = "token";

if(isset($_COOKIE[$cookie_name])) {
    $token = $_COOKIE[$cookie_name];

}

include 'C:\Users\Colin\PhpstormProjects\StreamingSite\api\check.php';




$letters = range('A', 'Z');
$letter = [$letters[array_rand($letters)]];

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
        <a href="/login" class="nl-btn l-btn" >LOGIN</a>
        <a href="/register" class="nl-btn r-btn" >REGISTER</a>
    </div>
    </header>';

$loggedIn = '
    <div class="user">
        <img src="/dist/img/testpp.jpg" id="user-pp" alt="user-pp"/>
        <div id="user-name" class="tooltip">' . $username . '<i class="down-arrow"></i>
            <div class="tooltiptext">
                <a class="user-dd-el" href="/user">
                    <div class="user-dd-icon">
                        <i class="gg-format-justify"></i>
                    </div>
                    <span class="user-dd-name">Account</span>
                </a> <a class="user-dd-el" href="/user/profil/' . $username . '">
                <div class="user-dd-icon">
                    <i class="gg-user"></i>
                </div>
                <span class="user-dd-name">Profile</span>
            </a> <a class="user-dd-el" href="/user/watchlist/' . $username . '">
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
    </header>';

//    <section class="top-nav">
//        <input id="menu-toggle" type="checkbox"/>
//        <label class="menu-button-container" for="menu-toggle">
//            <div class="menu-button""></div>
//        </label>
//        <ul class="menu">
//            <li><a href="/pages/allseries/"><i class="gg-play-button-o"></i>&nbsp;Series</a></li>
//            <li><a href="/pages/popular.php"><i class="gg-align-bottom"></i>&nbsp;Popular</a></li>
//            <li><a href="/pages/search/"><i class="gg-search"></i>&nbsp;Search</a></li>
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
            <a class="footer-el-item" href="/pages/about/agb.php">AGBs</a>
            <a class="footer-el-item" href="#">Imprint</a>
        </div>
        <div class="footer-el">
            <span class="footer-el-title">Discover</span>
            <a class="footer-el-item" href="/pages/search/?search='. implode(",",$letter) .'">Random</a>
            <a class="footer-el-item" href="/pages/search/">Search</a>
            <a class="footer-el-item" href="/pages/popular.php">Popular</a>
        </div>
        <div class="footer-el">
            <span class="footer-el-title">More</span>
            <a class="footer-el-item" href="/register">Free Account</a>
        </div>
    </div>
    <span class="copyright">&copy; Copyright 2023. All Rights Reserved. <a href="/">StreamingSite</a></span>
</footer>
<script>
    $("#logout").on("click", function () {
        document.cookie = "token=aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa; path=/;";
//         expires=Thu, 01 Jan 1970 00:00:01 GMT
    })
</script>
<script src="/script/main.js"></script>
</body>
</html>';

$adminHeader  = $header_1 . $admin_1 . $header_2 . $loggedIn;
$loggedInHeader = $header_1 . $header_2 . $loggedIn;
$notLoggedInHeader = $header_1 . $header_2 . $notLoggedIn;




//$content = http_build_query (array (
//    // this is where you list all data you want to post
//    'token' => '123456789012345678901234567890'
//));
//
//$context = stream_context_create (array (
//    'http' => array (
//        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//        'method' => 'POST',
//        'content' => $content,
//    )
//));
//
//$content = file_get_contents("http://127.69.69.69/api/check.php",null, $context);


//$context  = stream_context_create(array(
//    // use key 'http' even if you send the request to https
//    'http' => array(
//        //'header' and 'content' is optional
//        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//        'method'  => 'POST',
//        'content' => http_build_query(
//            array('token' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa')
//        )
//    )
//));
//$result = file_get_contents('C:\Users\Colin\PhpstormProjects\StreamingSite\api\check.php', false, $context);
//if ($result === FALSE) {
//    echo "an error occurred during post.";
//    http_response_code(500);
//} else {
//    // success
//    var_dump($result);
//}



//
//$url = "C:\Users\Colin\PhpstormProjects\StreamingSite\api\check.php";
//
//$curl = curl_init();
//curl_setopt($curl, CURLOPT_URL, $url);
//curl_setopt($curl, CURLOPT_POST, true);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//
//$headers = array(
//    "Accept: application/json",
//    "Content-Type: application/json",
//);
//curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//
//$data = <<<DATA
//{
//  "token": "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
//}
//DATA;
//
//curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//
//$resp = curl_exec($curl);
//curl_close($curl);
//
//echo $resp;
//









//$cookie = true;
//$login = true;
////$login = false;
//$IsAdmin = true;
////$IsAdmin = false;


//echo $cookie;
//echo $login;
////$login = false;
//echo $IsAdmin;
////$IsAdmin = false;