<?php

$wname = "";
if (isset($_COOKIE["name"])) {
    $wname = $_COOKIE["name"];
} elseif (isset($_GET["U"])) {
    $wname = $_GET["u"];
} else {
    header("Location: /error/404.php");
}

include '../.././template/index.php';
$homeContent = '
<main id="watchlist-main">
  <div class="page-title">{{ uname }}\'s Watchlist<a :href="\'/user/profile/?u=\' + usname"><div class="icon"></div>Profile</a></div>
    <div class="home-cat-parent">
        <div id="home-cat-1" class="wrapper home-cat">
            <a v-for="wl in watchlist" :href="\'/stream/\' + wl.name" class="home-el"
               :title="wl.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/data/cover/\' + wl.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ wl.showName }}</span></span>
            </a>
        </div>
    </div>
</main>
<script src="/script/watchlist.js"></script>
';

if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            $Page = $loggedInHeader;
        }
    } else {
        if (isset($_GET["u"])){
            $Page = $notLoggedInHeader;
        } else {
            header("Location: /login/");
        }
    }
} else {
    echo 1;
    if (isset($_GET["u"])){
        $Page = $notLoggedInHeader;
    } else {
        header("Location: /login/");
    }
}
$Page = $Page . $homeContent . $footer;
echo $Page;
