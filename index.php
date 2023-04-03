<?php
$homeContent = '</header>
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

            <a href="#" class="home-el" v-for="media in Media"
               :title="media.name + \', watch it now for free and in full length.\'">
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
            <a href="#" class="home-el" v-for="media in Media"
               :title="media.name + \', watch it now for free and in full length.\'">
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
            <a href="#" class="home-el" v-for="media in Media"
               :title="media.name + \', watch it now for free and in full length.\'">
                <img v-bind:src="media.coverSrc" alt="cover" class="cover">
                <span class="cover-title">{{ media.name }}<span class="fi fi-de"></span></span>
            </a>
        </div>
    </div>

</main>';

include './template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");
$login = true;
$cookie = true;
$IsAdmin = true;

$Page = $header_1;

if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $Page . $admin_1 . $header_2 . $loggedIn;
        } else {
            $Page = $Page . $header_2 . $loggedIn;
        }
    } else {
        $Page = $Page . $header_2 . $notLoggedIn;
    }
}
$Page = $Page . $homeContent . $footer;
echo $Page;

