<?php
if (strpos($_SERVER['REQUEST_URI'], "=")) {
   $quick = explode("=", $_SERVER['REQUEST_URI'])[1];
} else {
    $quick = "";
};

$searchContent = '
<main class="search-main">
    <div class="quick-search" id="quick-search">
        <a v-for="quick in quicks" :href="\'/pages/search/?search=\' + quick" class="quick-search-el">
            <div>{{ quick }}</div>
        </a>
    </div>
    <label class="search">
        Search
        <div id="search-input">
            <input type="text" value="'. $quick .'">
        </div>
    </label>
    <div id="search-result">
        <a class="result-item" v-for="result in results" :href="\'/stream/\' + result.name">
            <div class="result-head" :name="result.name" :showName="result.showName">
                <span class="result-title">{{ result.showName }}</span>
                <span class="result-info result-watched" :title="result.watched + \' people have watched this show.\'">{{ result.watched }}
                <i class="gg-eye-alt"></i>
                </span>
                <span class="result-info result-watchlist" :title="result.watched + \' people have it on there watchlist.\'">{{ result.watchlist }}
                    <i class="fa-solid fa-list-ul">
                    </i>
                </span>
                <i class="fa-solid fa-folder-plus tooltip" id="add-wl-btn" @click="addToWatchlist">
                <span class="tooltiptext">Add to Watchlist</span>
</i>
            </div>
            <span class="result-description">{{ result.desc }}</span>
        </a>
    </div>
</main>
<script src="/script/search.js"></script>
';

include '../.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");

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
$Page = $Page . $searchContent . $footer;
echo $Page;
