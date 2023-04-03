
<?php
$HomePageBody = '
<div class="quick-search" id="quick-search"> 
        <a v-for="quick in quicks" :href="\'/pages/?search=\' + quick"  class="quick-search-el"><div>{{ quick }}</div></a>
    </div>
    <div id="search-input">
    </div>
    <div id="search-result">
    </div>
</main>
<script src="/script/search.js"></script>
';

include '../.././template/index.php';

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
$Page = $Page . $HomePageBody . $footer;
echo $Page;
