$(function () {

        var JSONData = []
        const base_url = window.location.origin;

        async function getUser() {

            let token

            const cookies = document.cookie.split(';');

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
                                return p.name.toLowerCase().indexOf(this.search.toLowerCase()) != -1;
                            });
                        }
                    },
                    methods: {
                        removeUser(e) {
                            let id = $(e.target).parent().parent().find(".user-list-el-id").text()
                            // console.log($(e.target).parent().parent().find(".user-list-el-username").text())
                            let name = $(e.target).parent().parent().find(".user-list-el-name").text()
                            if (confirm("Are you sure you want to delete the user with the name: " + name)) {
                                let token = document.cookie.split(";")[0].split("=")[1]
                                let myObj = {rm_id: id, token: token};
                                $.ajax({
                                    type: "POST",
                                    url: "/api/admin_rm_user.php",
                                    data: {myData: JSON.stringify(myObj)},
                                    success: function (res) {

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

                            var target = $(e.target)
                            var el = $(e.target).parent().parent()
                            if (el.find(".user-list-el-username").attr("contenteditable") === "false" || el.find(".user-list-el-username").attr("contenteditable") === undefined) {
                                target.attr("class", "fas fa-save edit-btn user-list-btn")
                                el.find(".user-list-el-username").attr("contenteditable", "true")
                                el.find(".user-list-el-name").attr("contenteditable", "true")
                                el.find(".user-list-el-email").attr("contenteditable", "true")
                                el.find(".user-list-el-admin").find("i").css("cursor", "pointer").attr("status", "1")
                            } else {
                                target.attr("class", "fa-solid fa-pen-to-square edit-btn user-list-btn")
                                el.find(".user-list-el-username").attr("contenteditable", "false")
                                el.find(".user-list-el-name").attr("contenteditable", "false")
                                el.find(".user-list-el-email").attr("contenteditable", "false")
                                el.find(".user-list-el-admin").find("i").css("cursor", "default").attr("status", "0")
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

