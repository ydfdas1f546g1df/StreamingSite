
<?php

$mainContent = '
<main class="admin-main">
    <div id="admin-main-div">
        <aside>
            <a href="/admin">
                <div class="icon-container"><i class="gg-terminal"></i></div>
                Dashboard</a>
            <a href="/admin/media">
                <div class="icon-container"><i class="fa-solid fa-photo-film"></i></div>
                Media
            </a>
            <a href="/admin/upload" class="current-admin">
                <div class="icon-container"><i class="gg-software-upload"></i></div>
                upload</a>
            <a href="/admin/user">
                <div class="icon-container"><i class="gg-user"></i></div>
                User</a>
        </aside>
        <article class="upload-article">
            <div class="link-div">
            <div>
                <a href="/admin/upload/upload.php" class="create-btn">Upload Episode</a>
                </div>
                <div>
                    <a href="/admin/upload/createSeries.php" class="create-btn">Create Series</a>
                </div>   
                <div>
                    <label>
                        Series Name
                        <input type="text" id="series-inp" placeholder="Series Name">
                    </label>
                    <span class="create-btn">Create Series</span>
                </div>
            
            </div>
        </article>
    </div>
</main>
';

include '../.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");


if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $adminHeader;
        } else {
            header("location: /error/403.php");
        }
    } else {
        header("location: /error/403.php");
    }
}else {
    header("Location: /error/403.php");
}
$Page = $Page . $mainContent . $footer;
echo $Page;