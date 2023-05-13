<?php
include './template/index.php';
$homeContent = '
<main id="home-main">
    <div class="quick-search" id="quick-search">
        <a :href="\'/pages/search/?search=\' + quick"  class="quick-search-el" v-for="quick in quicks">{{ quick }}</a>
    </div>
    <div>
        <div class="parent">
        <a v-for="cat in catcher" :href="\'/stream/\' + cat.name">
        <div :style="\'background-image: url(/data/cover/\' + cat.name + \'.jpg);\'"></div>
        <span>{{ cat.showName }}</span></a>
</div>
    </div>
    <div class="home-cat-parent">
        <span class="home-el-title">Popular
            <a href="/pages/popular/" class="home-el-all">View all</a>
        </span>
        <div id="home-cat-1" class="wrapper home-cat">
            <a v-for="po in pupular" :href="\'/stream/\' + po.name" class="home-el"
               :title="po.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/data/cover/\' + po.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ po.showName }}&nbsp;<span class="episode-nth">Views&nbsp;{{ po.watched }}</span><span class="episode-nth">Index&nbsp;{{ po.viewIndex }}</span></span></span>
            </a>
        </div>
    </div>
    <div class="home-cat-parent">
        <span class="home-el-title">Recent Watched
            <a href="/user/watched/" class="home-el-all">View all</a>
        </span>
        <div class="wrapper home-cat">
            <a v-for="wd in watched" :href="\'/stream/\' + wd.name + \'/season-\' + wd.season + \'/episode-\' + wd.episode" class="home-el"
               :title="wd.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/data/cover/\' + wd.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ wd.showName }} &nbsp;<span class="episode-nth">S{{ wd.season }} &nbsp;E{{ wd.episode }}</span></span></span>
            </a>
        </div>
    </div>
    <div class="home-cat-parent">
        <span class="home-el-title">Latest Uploads
            <a href="/pages/uploads/" class="home-el-all">View all</a>
        </span>
        <div class="wrapper home-cat">
            <a v-for="up in uploads" :href="\'/stream/\' + up.name + \'/season-\' + up.season + \'/episode-\' + up.episode" class="home-el"
               :title="up.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/data/cover/\' + up.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ up.showName }} &nbsp;<span class="episode-nth">S{{ up.season }} &nbsp;E{{ up.episode }}</span></span></span>
            </a>
        </div>
    </div>
</main>
<script src="/script/main.js"></script>
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
