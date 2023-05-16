<?php
include '../.././template/index.php';
$homeContent = '
<main id="popular-main">
  <div class="page-title">Most viewed Series<a href="/pages/allseries/"><div class="icon"></div>All Series</a></div>
    <div class="home-cat-parent">
        <div id="home-cat-1" class="wrapper home-cat">
            <a v-for="po in pupular" :href="\'/stream/\' + po.name" class="home-el"
               :title="po.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/data/\' + po.name + \'/\' + po.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ po.showName }}&nbsp;<span class="episode-nth">Views&nbsp;{{ po.watched }}</span><span class="episode-nth">Index&nbsp;{{ po.viewIndex }}</span></span></span>
            </a>
        </div>
    </div>
</main>
<script src="/script/popular.js"></script>
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
