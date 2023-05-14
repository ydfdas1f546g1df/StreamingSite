<?php
include '.././template/index.php';
include '.././template/stream.php';

$streamMediaMain = '
<div class="stream-media">
    <video id="media-player" controls>
    </video>
    <div><span>The episode is marked as watched after 3 min</span></div>
</div>
</main>
<script src="/script/stream_media.js"></script>
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
$Page = $Page . $streamTopMain . $streamSelect . $streamMediaMain . $footer;
echo $Page;
