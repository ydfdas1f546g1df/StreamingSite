<?php
include '.././template/index.php';
include '.././template/stream.php';

$streamSeasonMainTest = '
<div class="stream-season" id="stream-season">
<a><span>Episode</span><span></span><span>Name / Title</span><span>Series</span><span>Season</span></a>
</div>
</main>
';

$streamSeasonMain = '
<div class="stream-season" id="stream-season">
<a><span>Episode</span><span></span><span>Name / Title</span><span>Series</span><span>Season</span></a>
<a v-for="ep in episodes" :status="ep.status" :class="ep.watched" :href="\'/stream/\' + ep.series + \'/season-\' + ep.season +\'/episode-\' + ep.episode">
    <span class="episode" :episode="ep.episode">Episode {{ ep.episode }}</span>
    <span><i class="gg-eye-alt add-to-watched" @click.prevent="addToWatched"></i></span>
    <span>{{ ep.name }}</span>
    <span class="series" :series="ep.series">{{ ep.showName }}</span>
    <span class="season" :season="ep.season">{{ ep.season }}</span>
</a>
</div>
</main>
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
$Page = $Page . $streamTopMain . $streamSelect . $streamSeasonMain . $footer;
echo $Page;
