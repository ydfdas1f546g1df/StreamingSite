<?php
include '.././template/index.php';
include '.././template/stream.php';

$streamSeasonMain = '
<div class="stream-season" id="stream-season">
<a><span>Episode</span><span></span><span>Name / Title</span><span>Series</span><span>Season</span></a>
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
