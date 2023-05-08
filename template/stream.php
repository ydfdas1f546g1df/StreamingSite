
<?php
$streamTopMain = '
<main id="stream-main">
<script src="/script/stream_top.js"></script>
<div class="stream-banner" id="stream-banner">
    <div class="cover-column">
        <img :src="\'/data/cover/\' + series.name + \'.jpg\'" alt="cover">
    </div>
    <div class="info-column">
        <strong class="series-title">{{ series.showName }}</strong>
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
</main>
';

$streamTopMainTest = '
<main id="stream-main">
<div class="stream-banner">
    <div class="cover-column">
        <img src="/dist/img/vinland-saga.jpg" alt="cover">
    </div>
    <div class="info-column">
        <strong class="series-title">Vinland Saga</strong>
        <span class="series-desc">Das ist die Beschreibung einer Serie die etw so aussehen wird  wef wefwefw wefwergbsd werger wecw e ehe qwecwe erg wq ce rberbwecve ertbervbwec erger verfer fgerf erfe rg erger gergerg ergergerrh rsv sdv sfv erg .</span>
        <span class="series-info"><strong>Regisseur: </strong>Name Nachname</span>
        <span class="series-info"><strong>Language: </strong>Deutsch</span>
        <span class="series-info"><strong>Watchlist: </strong>2342</span>
        <span class="series-info"><strong>Watched: </strong>123123</span>
    </div>
    <div class="watchlist-column">
        <div>
            <a href="#watch-now">Watch now</a>
            <span class="watchlist-add" @click="addToWatchlist"><i class="fa-solid fa-list-ul"></i> Watchlist</span>
            <span class="share"><i class="fa-solid fa-share-from-square"></i> Share</span>
        </div>
    </div>
</div>
</main>
';




