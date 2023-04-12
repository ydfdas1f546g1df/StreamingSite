<?php
$homeContent = '
<main>
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
            <!--            <span id="hello" style="color: white; cursor: pointer">Hello</span>-->

            <a v-for="media in Media" :href="\'/stream/\' + media.medianame" class="home-el"
               :title="media.name + \', watch it now for free and in full length.\'">
                <img :src="media.coverSrc" alt="cover" class="cover">
                <span class="cover-title"><span>{{ media.name }}</span><i class="fi fi-de"></i></span>
            </a>
        </div>
    </div>
    <div class="home-cat-parent">
        <span class="home-el-title">Recent watched
            <a href="#" class="home-el-all">View all</a>
        </span>
        <div id="home-cat-2" class="wrapper home-cat">
            <a v-for="media in Media" :href="\'/stream/\' + media.medianame" class="home-el"
               :title="media.name + \', watch it now for free and in full length.\'">
                <img v-bind:src="media.coverSrc" alt="cover" class="cover">
                <span class="cover-title"><span>{{ media.name }}</span><i class="fi fi-de"></i></span>
            </a>
        </div>
    </div>
    <div class="home-cat-parent">
        <span class="home-el-title" id="latest">Latest uploads
            <a href="#" class="home-el-all">View all</a>
        </span>
        <div id="home-cat-3" class="wrapper home-cat">
            <a v-for="media in Media" :href="\'/stream/\' + media.medianame" class="home-el"
               :title="media.name + \', watch it now for free and in full length.\'">
                <img v-bind:src="media.coverSrc" alt="cover" class="cover">
                <span class="cover-title"><span>{{ media.name }}</span><i class="fi fi-de"></i></span>
            </a>
        </div>
    </div>

</main>';

include './template/index.php';



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

