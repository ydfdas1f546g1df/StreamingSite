
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
        <div class="series-info-parent">
        
        <span class="series-info"><strong>Regisseur: </strong><span>{{ series.reg }}</span></span>
        <span class="series-info"><strong>Language: </strong><span>{{ series.lang }}</span></span>
        <span class="series-info"><strong>Watchlist: </strong><span id="top-watchlist">{{ series.watchlist }}</span></span>
        <span class="series-info"><strong>Watched: </strong><span id="top-watched">{{ series.watched }}</span></span>
</div>
    </div>
    <div class="watchlist-column">
        <div>
            <a id="watchNow" :href="\'/stream/\' + series.name + \'/season-1/episode-1\'">Watch now</a>
            <span :class="\'watchlist-add \' + series.OW" :title="\'Add \' + series.showName + \' to your your watchlist, now.\'" :status="onWatchlist" id="watchlist" @click="watchlist"><i class="fa-solid fa-list-ul"></i> Watchlist</span>
            <a class="share" :href="\'https://twitter.com/intent/tweet?hashtags=stream%2Cseries&original_referer=https%3A%2F%2Fstreamingsite.com&text=\' + series.showName + \', watch it now on the best StreamingSite in the world! https://stramingsite/stream/\' + series.name + \'\'"><i class="fa-solid fa-share-from-square"></i> Share</a>
        </div>
    </div>
    <div class="background first"   :style="\'background-image: url(/data/\' + series.name + \'/\' + series.name + \'.jpg);\'"></div>
    <div class="background"  :style="\'background-image: url(/data/\' + series.name + \'/\' + series.name + \'.jpg);\'"></div>
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




