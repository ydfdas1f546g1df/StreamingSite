<?php

$admin_user = '

<main class="admin-main">
    <div id="admin-main-div">

    <aside>
        <a href="/admin/" >
            <div class="icon-container"><i class="gg-terminal"></i></div>
            Dashboard</a>
            <a href="/admin/settings/" >
            <div class="icon-container"><i class="fa-solid fa-sliders"></i></div>
            Settings</a>
        <a href="/admin/media" class="current-admin">
            <div class="icon-container"><i class="fa-solid fa-photo-film"></i></div>
            Episode
        </a>
        <a href="/admin/series">
            <div class="icon-container"><i class="fa-solid fa-server"></i></div>
            Series
        </a>
        <a href="/admin/upload/">
            <div class="icon-container"><i class="gg-software-upload"></i></div>
            upload</a>
        <a href="/admin/user">
            <div class="icon-container"><i class="gg-user"></i></div>
            User</a>
    </aside>
    <article class="user-article">
        <div class="user" id="all-users">
            <div class="btns">
                <span class="add-btn user-btn" ><i class="gg-software-upload"></i></span>
                <span class="save-btn user-btn" onclick="location.reload()" title="Changes are only displayed correctly after reloading"><i class="fa-solid fa-rotate"></i></span>
            </div>
            <label for="search-user">
                Search Episode
                <input type="text" name="search-user" placeholder="name" v-model="search">
            </label>

            <div class="user-list">
                <div class="user-list-el-header">
                    <span class="user-list-el-id">ID</span>
                    <span class="user-list-el-username">Series</span>
                    <span class="user-list-el-name">Season</span>
                    <span class="user-list-el-email">Name</span>
                    <span class="user-list-el-admin">Episode</span>
                    <span class="user-list-btn-placeholder"></span>
                    <span class="user-list-btn-placeholder"></span>
                </div>

                <div class="user-list-el" v-for="episode in filteredEpisodes" :id="episode.id" :key="episode.id">
                    <span class="user-list-el-id">{{ episode.id }}</span>
                    <span class="user-list-el-username" :name="episode.series"><a :href="\'/stream/\'+ episode.series">{{ episode.showName }}</a></span>
                    <span class="user-list-el-name"><a :href="\'/stream/\'+ episode.series +\'/season-\' + episode.season">{{ episode.season }}</a></span>
                    <span class="user-list-el-email"><a :href="\'/stream/\'+ episode.series +\'/season-\' + episode.season + \'/episode-\' + episode.episode">{{ episode.name }}</a></span>
                    <span class="user-list-el-admin" ><a :href="\'/stream/\'+ episode.series +\'/season-\' + episode.season + \'/episode-\' + episode.episode">{{ episode.episode }}</a></span>
                    <span class="user-list-btn-placeholder">
                        <i class="fa-solid fa-pen-to-square edit-btn user-list-btn" @click="editEpisode"></i>
                        </span>
                    <span class="user-list-btn-placeholder">
                        <i class="fa-solid fa-trash del-btn user-list-btn" @click="removeEpisode"></i>
                        </span>
                </div>
            </div>
        </div>

    </article>
    <div id="error-messages">
    </div>
    </div>
    <script src="/script/admin_episode.js"></script>
</main>';


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
$Page .=  $admin_user . $footer;
echo $Page;
