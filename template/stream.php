
<?php
$streamTopMain = '
<main id="stream-main">
<script src="/script/stream_top.js"></script>
<div class="stream-banner" id="stream-banner">
    <div class="cover-column">
        <img :src="\'/data/cover/\' + series.name + \'.jpg\'" alt="cover">
    </div>
    <div class="info-column">
        <strong class="series-title" id="SeriesName">{{ series.showName }}</strong>
        <span class="series-desc">{{ series.desc }}</span>
        <span class="series-info"><strong>Regisseur: </strong>{{ series.reg }}</span> 
        <span class="series-info"><strong>Language: </strong>{{ series.lang }}</span>
        <span class="series-info"><strong>Watchlist: </strong>{{ series.watchlist }}</span>
        <span class="series-info"><strong>Watched: </strong>{{ series.watched }}</span>
    </div>
    <div class="watchlist-column">
        <div>
            <a href="#watch-now">Watch now</a>
            <span :class="\'watchlist-add \' + series.OW" :title="\'Add \' + series.showName + \' to your your watchlist, now.\'" :status="onWatchlist" id="watchlist" @click="watchlist"><i class="fa-solid fa-list-ul"></i> Watchlist</span>
            <span class="share"><i class="fa-solid fa-share-from-square"></i> Share</span>
        </div>
    </div>
</div>
';

$streamSelect = '
<script src="/script/stream_select.js"></script>

<div class="stream-select">
    <div id="location"></div>
    <div class="select">
        <div class="season">
            <span class="select-el select-title">Season:</span>
            <a href="/" class="select-el select-episode select-select">1</a>
        </div>
    <div class="episode">
        <span class="select-el select-title">Episode:</span>
        <a href="/" class="select-el select-season select-select">1</a>
    </div>
    </div>
    <div id="series-title"></div>
    <div id="episode-title"></div>
</div>
</div>
';




