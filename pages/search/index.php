

<?php
if (strpos($_SERVER['REQUEST_URI'], "=")) {
   $quick = 'value="' . explode("=", $_SERVER['REQUEST_URI'])[1] . '"';
} else {
    $quick = "";
};
$search = "";
if (isset($_GET["search"])) {
    $search = "value='".$_GET["search"] . "'";
}


$searchContent = '
<main class="search-main" id="search-main">
    <label class="search">
        Search
        <input type="text" v-model="search" id="search-input" ref="name" ' . $search . '>
    </label>
    <div id="search-result">
        <div id="search-for"><span>Search results for &bdquo;{{ search }}&rdquo;</span></div>
        <div id="nothing"><div><i class="fa-solid fa-mug-hot"></i></div>
            Sorry, there is nothing like that.</div>
        <a class="result-item" v-for="result in filteredSeries" :href="\'/stream/\' + result.name" target="_blank">
            <div class="result-head">
                <div class="result-hd">
                    <span class="result-title">{{ result.showName }}</span>
                    <span class="result-info result-watched" :title="result.watched + \' episodes of this series have been watched in total. \'">{{ result.watched }}
                <i class="gg-eye-alt"></i>
                </span>
                    <span class="result-info result-watchlist" :title="result.watched + \' people have it on there watchlist.\'">{{ result.watchlist }}
                    <i class="fa-solid fa-list-ul">
                    </i>
                </span>
                </div>

                <i class="fa-solid fa-folder-plus tooltip" id="add-wl-btn" @click.prevent="addToWatchlist">
                    <span class="tooltiptext">Add to Watchlist</span></i>
            </div>
            <span class="result-description">{{ result.desc }}</span><br>
            <span class="result-link">/stream/{{ result.name }}/</span>
        </a>
    </div>
</main>
<script src="/script/search.js"></script>
<script>
    document.title="Serach | StreamingSite"
</script>
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
