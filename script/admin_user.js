$(function () {

        const cookies = document.cookie.split(';');
        var JSONData = []
        const base_url = window.location.origin;

        async function getUser() {

            let token


            function getCookie() {
                // console.log(cookies)
                for (let i = 0; i < cookies.length; i++) {
                    const cookie = cookies[i].split('=');
                    if (cookie[0] === "token") {
                        token = cookie[1];
                        // console.log(token)
                    }
                }
            }

            getCookie()
            let myObj = {token: token};
            await $.ajax({
                type: "POST",
                url: "/api/admin_req_user.php",
                data: {myData: JSON.stringify(myObj)},
                success: function (res) {
                    let ResJSON = JSON.parse(res);
                    console.log(ResJSON)
                    for (let i = 0; i < ResJSON.length; i++) {
                        if (ResJSON[i].admin == 1) {
                            ResJSON[i].admin = "fa-solid fa-check IsAdmin"
                            var isAdmin = 1;

                        } else {
                            ResJSON[i].admin = "fa-solid fa-xmark IsNotAdmin"
                            var isAdmin = 0;
                        }

                        JSONData.push({
                            id: ResJSON[i].id,
                            admin: ResJSON[i].admin,
                            IsAdmin: isAdmin,
                            name: ResJSON[i].name,
                            username: ResJSON[i].username,
                            email: ResJSON[i].email,
                            passwordHash: ResJSON[i].passwordHash,
                            bio: ResJSON[i].bio,
                            search: "",
                        })
                    }
                    return JSONData
                }
            });
        }

        getUser().then(
            function () {
                // console.log(JSONData)

                Vue.createApp({
                    data() {
                        return {
                            users: JSONData,
                            search: "",
                        };
                    },
                    computed: {
                        filteredUsers() {
                            return this.users.filter(p => {
                                return p.name.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
                            });
                        }
                    },
                    methods: {
                        removeUser(e) {
                            let id = $(e.target).parent().parent().find(".user-list-el-id").text()
                            // console.log($(e.target).parent().parent().find(".user-list-el-username").text())
                            let name = $(e.target).parent().parent().find(".user-list-el-name").text()
                            if (confirm("Are you sure you want to delete the user with the name: " + name)) {
                                let token;

                                function getCookie() {
                                    // console.log(cookies)
                                    for (let i = 0; i < cookies.length; i++) {
                                        const cookie = cookies[i].split('=');
                                        if (cookie[0] === "token") {
                                            token = cookie[1];
                                            // console.log(token)
                                        }
                                    }
                                }
                                getCookie()
                                let myObj = {rm_id: id, token: token};
                                $.ajax({
                                    type: "POST",
                                    url: "/api/admin_rm_user.php",
                                    data: {myData: JSON.stringify(myObj)},
                                    success: function (res) {
                                        console.log(res)
                                        if (res == 409) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">409</span><span class="error-msg">You can\'t delete your own account</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close this error message" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                        } else if (res == 400) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">400</span><span class="error-msg">Bad Request</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                        } else if (res == 401) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">401</span><span class="error-msg">Unauthorized</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                        } else if (res == 200) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">200</span><span class="error-msg">Deleted user: ' + name + ' successfully</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                            $(e.target).parent().parent().remove()
                                        }
                                    }
                                });
                            }
                        },
                        editUser(e) {
                            // console.log(e)
                            let target = $(e.target);
                            let el = target.parent().parent();
                            // console.log(el.find(".user-list-el-admin").find("i").attr("admin"))
                            let username_el = el.find(".user-list-el-username")
                            let name_el = el.find(".user-list-el-name")
                            let email_el = el.find(".user-list-el-email")
                            let admin_el = el.find(".user-list-el-admin").find("i")
                            let id_el = el.find(".user-list-el-id")
                            if (el.find(".user-list-el-username").attr("contenteditable") === "false" || el.find(".user-list-el-username").attr("contenteditable") === undefined) {
                                target.attr("class", "fas fa-save edit-btn user-list-btn")
                                username_el.attr("contenteditable", "true")
                                name_el.attr("contenteditable", "true")
                                email_el.attr("contenteditable", "true")
                                admin_el.css("cursor", "pointer").attr("status", "1")
                                // console.log(1)
                            } else {
                                // console.log(2)
                                target.attr("class", "fa-solid fa-pen-to-square edit-btn user-list-btn")
                                username_el.attr("contenteditable", "false")
                                name_el.attr("contenteditable", "false")
                                email_el.attr("contenteditable", "false")
                                admin_el.css("cursor", "default").attr("status", "0")
                                let token;
                                let username = username_el.text()
                                let name = name_el.text()
                                let email = email_el.text()
                                let id = id_el.text()
                                let admin = admin_el.attr("admin")
                                // console.log(admin_el)


                                function getCookie() {
                                    // console.log(cookies)
                                    for (let i = 0; i < cookies.length; i++) {
                                        const cookie = cookies[i].split('=');
                                        if (cookie[0] === "token") {
                                            token = cookie[1];
                                            // console.log(token)
                                        }
                                    }
                                }

                                getCookie()
                                let myObj = {
                                    id: id,
                                    token: token,
                                    username: username,
                                    name: name,
                                    admin: admin,
                                    email: email
                                };
                                // console.log(myObj)
                                $.ajax({
                                    type: "POST",
                                    url: "/api/admin_edit_user.php",
                                    data: {myData: JSON.stringify(myObj)},
                                    success: function (res) {
                                        // console.log(res)
                                        if (res == 409) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">409</span><span class="error-msg">You can\'t edit your own account</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close this error message" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                        } else if (res == 400) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">400</span><span class="error-msg">Bad Request</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                        } else if (res == 401) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">401</span><span class="error-msg">Unauthorized</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                        } else if (res == 200) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">200</span><span class="error-msg">User: ' + name + ' was successfully edited</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)

                                        }
                                    }
                                });
                            }
                        },
                        editAdmin(e) {
                            // console.log(e)
                            let target = $(e.target);
                            let el = target.parent();
                            let status = target.attr("status")
                            // console.log("status: " + status)
                            let admin = target.attr("admin")
                            if (status == 1) {
                                // console.log("admin: " + admin)
                                if (admin == 1) {
                                    console.log("to " + 0)
                                    target.attr("admin", "0")
                                    target.attr("class", "fa-solid fa-xmark IsNotAdmin")
                                } else {
                                    console.log("to " + 1)
                                    target.attr("admin", "1")
                                    target.attr("class", "fa-solid fa-check IsAdmin")
                                }

                            }
                        }
                    }
                }).mount("#all-users");
            })
    }
);

function rmError(e) {
    $(e).parent().remove()
}

