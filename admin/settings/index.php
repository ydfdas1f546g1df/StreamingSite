<?php

$admin_user = '

<main class="admin-main">
    <div id="admin-main-div">

    <aside>
        <a href="/admin/" >
            <div class="icon-container"><i class="gg-terminal"></i></div>
            Dashboard</a>
            <a href="/admin/settings/"  class="current-admin">
            <div class="icon-container"><i class="fa-solid fa-sliders"></i></div>
            Settings</a>
        <a href="/admin/media">
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
    <article class="settings-article" id="settings-article">
        <div class="setting-el" v-for="set in settings">
        <span class="setting-title">{{ set.showName }}</span>
        <span class="setting-desc">{{ set.desc }}</span>
            <div class="checkbox-wrapper-64">
                <label class="switch">
                    <input type="checkbox" value="true" v-model="set.state" @click="changeSetting(set)">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </article>
    <div id="error-messages">
    </div>
    </div>
    <script src="/script/admin_settings.js"></script>
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
