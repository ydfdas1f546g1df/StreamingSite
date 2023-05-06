

<?php
if (strpos($_SERVER['REQUEST_URI'], "=")) {
    $quick = 'value="' . explode("=", $_SERVER['REQUEST_URI'])[1] . '"';
} else {
    $quick = "";
};


$searchContent = '
<main class="search-main" id="all-series-main">
  <div class="page-title">All Series <a href="/pages/search/"><div class="icon"><i class="gg-search"></i></div>Search</a></div>
  <label class="search">
      <input type="text" v-model="search" id="search-input" placeholder="Search for series...">
  </label>
  <div id="all-series-list">
    <template v-for="letter in letters">
      <div v-if="seriesByLetter[letter].length > 0" :key="letter" class="letter">
        <h2>{{ letter }}</h2>
        <div>
        <a v-for="result in seriesByLetter[letter]" :key="result.name" class="result-item" :href="`/stream/${result.name}`">{{ result.showName }}</a>
</div>
      </div>
    </template>
  </div>
</main>
<script src="/script/all_series.js"></script>
<script>
    document.title="All Series | StreamingSite"
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
