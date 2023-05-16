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
<main id="uploads-main">
  <div class="page-title">Latest uploads<a href="\'/pages/allseries/"><div class="icon"></div>More</a></div>
    <div class="home-cat-parent">
        <div id="home-cat-1" class="wrapper home-cat">
            <a v-for="up in uploads" :href="\'/stream/\' + up.name + \'/season-\' + up.season + \'/episode-\' + up.episode" class="home-el"
               :title="up.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/data/\' + up.name + \'/\' + up.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ up.showName }} &nbsp;<span class="episode-nth">S{{ up.season }} &nbsp;E{{ up.episode }}</span></span></span>
            </a>
        </div>
    </div>
</main>
<script src="/script/latest_uploads.js"></script>
';

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
$Page = $Page . $homeContent . $footer;
echo $Page;
