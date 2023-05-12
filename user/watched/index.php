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
<main id="watched-main">
  <div class="page-title">{{ uname }}\'s Watched Episodes<a :href="\'/user/profile/?u=\' + usname"><div class="icon"></div>Profile</a></div>
    <div class="home-cat-parent">
        <div id="home-cat-1" class="wrapper home-cat">
            <a v-for="wd in watched" :href="\'/stream/\' + wd.name + \'/season-\' + wd.season + \'/episode-\' + wd.episode" class="home-el"
               :title="wd.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/data/cover/\' + wd.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ wd.showName }} &nbsp;<span class="episode-nth">S{{ wd.season }} &nbsp;E{{ wd.episode }}</span></span></span>
            </a>
        </div>
    </div>
</main>
<script src="/script/watched.js"></script>
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
    if (isset($_GET["u"])){
        $Page = $notLoggedInHeader;
    } else {
        header("Location: /login/");
    }
}
$Page = $Page . $homeContent . $footer;
echo $Page;
