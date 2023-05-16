
<?php
$streamTopMain = '
<script src="/script/stream_top.js"></script>
<main id="stream-main">
<div class="stream-banner" id="stream-banner">
    <div class="cover-column">
        <img :src="\'/data/\' + series.name + \'/\' + series.name + \'.jpg\'" alt="cover">
    </div>
    <div class="info-column">
        <strong class="series-title" id="SeriesName">{{ series.showName }}</strong>
        <span class="series-desc">{{ series.desc }}</span>
        <span class="series-info"><strong>Regisseur: </strong><span>{{ series.reg }}</span></span>
        <span class="series-info"><strong>Language: </strong><span>{{ series.lang }}</span></span>
        <span class="series-info"><strong>Watchlist: </strong><span id="top-watchlist">{{ series.watchlist }}</span></span>
        <span class="series-info"><strong>Watched: </strong><span id="top-watched">{{ series.watched }}</span></span>
    </div>
    <div class="watchlist-column">
        <div>
            <a id="watchNow" :href="\'/stream/\' + series.name + \'/season-1/episode-1\'">Watch now</a>
            <span :class="\'watchlist-add \' + series.OW" :title="\'Add \' + series.showName + \' to your your watchlist, now.\'" :status="onWatchlist" id="watchlist" @click="watchlist"><i class="fa-solid fa-list-ul"></i> Watchlist</span>
            <span class="share"><i class="fa-solid fa-share-from-square"></i> Share</span>
        </div>
    </div>
    <div class="background"  :style="\'background: url(/data/\' + series.name + \'/\' + series.name + \'.jpg); background-size: cover; background-position: center; filter: blur(8px);\'"></div>
    <div class="background"  :style="\'background: url(/data/\' + series.name + \'/\' + series.name + \'.jpg); background-size: cover; background-position: center; filter: blur(300px);\'"></div>
</div>
';

$streamSelect = '
<div class="stream-select">
    <div id="location"></div>
    <div class="select">
        <div class="season" id="seasons">
            <span class="select-el select-title">Season:</span>
        </div>
    <div class="episode" id="episodes">
        <span class="select-el select-title">Episode:</span>
    </div>
    </div>
<i id="watch-now"></i>
    <div id="series-title"></div>
    <div id="episode-title"></div>
</div>
</div>
';




