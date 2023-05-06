<?php
include './template/index.php';
$homeContent = '
<main id="home-main">
    <div class="quick-search" id="quick-search">
        <a :href="\'/pages/search/?search=\' + quick"  class="quick-search-el" v-for="quick in quicks">{{ quick }}</a>
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
            <a href="/pages/popular.php" class="home-el-all">View all</a>
        </span>
        <div id="home-cat-1" class="wrapper home-cat">
            <a v-for="po in pupular" :href="\'/stream/\' + po.name" class="home-el"
               :title="po.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/dist/img/\' + po.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ po.showName }} &nbsp;<span class="episode-nth">Views&nbsp;{{ po.watched }}</span></span></span>
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
                <img :src="\'/dist/img/\' + wd.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ wd.showName }} &nbsp;<span class="episode-nth">S{{ wd.season }} &nbsp;E{{ wd.episode }}</span></span></span>
            </a>
        </div>
    </div>
    <div class="home-cat-parent">
        <span class="home-el-title">Latest Uploads
            <a href="/user/watched/" class="home-el-all">View all</a>
        </span>
        <div class="wrapper home-cat">
            <a v-for="up in uploads" :href="\'/stream/\' + up.name + \'/season-\' + up.season + \'/episode-\' + up.episode" class="home-el"
               :title="up.showName + \', watch it now for free and in full length.\'">
                <img :src="\'/dist/img/\' + up.name + \'.jpg\'" alt="cover" class="cover">
                <span class="cover-title"><span>{{ up.showName }} &nbsp;<span class="episode-nth">S{{ up.season }} &nbsp;E{{ up.episode }}</span></span></span>
            </a>
        </div>
    </div>
</main>';

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

