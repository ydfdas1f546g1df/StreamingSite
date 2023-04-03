<?php

$admin_user = '
</header>
<main class="admin-main">
    <div id="admin-main-div">

    <aside>
        <a href="/admin/">
            <div class="icon-container"><i class="gg-terminal"></i></div>
            Dashboard</a>
        <a href="/admin/media/">
            <div class="icon-container"><i class="fa-solid fa-photo-film"></i></div>
            Media
        </a>
        <a href="/admin/upload/">
            <div class="icon-container"><i class="gg-software-upload"></i></div>
            upload</a>
        <a href="/admin/user" class="current-admin">
            <div class="icon-container"><i class="gg-user"></i></div>
            User</a>
    </aside>
    <article class="user-article">
        <div class="user" id="all-users">
            <div class="btns">
                <span class="add-btn user-btn" onclick="dragElement()"><i class="gg-user-add"></i></span>
                <span class="save-btn user-btn"><i class="fas fa-save"></i></span>
            </div>
            <label for="">
                Search User
                <input type="text" name="search-user" placeholder="username" v-model="search">
            </label>

            <div class="user-list">
                <div class="user-list-el-header">
                    <span class="user-list-el-id">ID</span>
                    <span class="user-list-el-username">username</span>
                    <span class="user-list-el-name">name</span>
                    <span class="user-list-el-email">email</span>
                    <span class="user-list-el-admin">admin</span>
                    <span class="user-list-btn-placeholder"></span>
                    <span class="user-list-btn-placeholder"></span>
                </div>

                <div class="user-list-el" v-for="user in filteredUsers" id="{{ user.id }}" :key="user.id">
                    <span class="user-list-el-id">{{ user.id }}</span>
                    <span class="user-list-el-username">{{ user.username }}</span>
                    <span class="user-list-el-name">{{ user.name }}</span>
                    <span class="user-list-el-email">{{ user.email }}</span>
                    <span class="user-list-el-admin"><i :class="user.admin"></i></span>
                    <span class="user-list-btn-placeholder">
                        <span class="edit-btn user-list-btn"><i class="fa-solid fa-pen-to-square"></i></span>
                        </span>
                    <span class="user-list-btn-placeholder">
                        <span class="del-btn user-list-btn"><i class="fa-solid fa-trash"></i></span>
                        </span>
                </div>
            </div>
        </div>

    </article>
    </div>
    <script src="/script/admin_user.js"></script>
</main>';


include '../.././template/index.php';

//$content = file_get_contents("https://127.69.69.69/api/check_user");
$login = true;
$cookie = true;
$IsAdmin = true;

$Page = $header_1;

if (isset($cookie)) {
    if ($login) {
        if ($IsAdmin) {
            $Page = $Page . $admin_1 . $header_2 . $loggedIn;
        } else {
            header("location: /");
        }
    } else {
        header("location: /");
    }
}
$Page = $Page . $admin_user . $footer;
echo $Page;
