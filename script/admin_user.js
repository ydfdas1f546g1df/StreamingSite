$(function () {

        var JSONData = []
        const base_url = window.location.origin;

        const getUser = async (api) => {
            const response = await fetch(base_url + '/api/' + api + '.php', {
                method: 'POST',
                body: JSON.stringify({
                    request: 1,
                }),
                headers: {
                    'Content-Type': 'application/json'
                },
            });
            const ResJSON = await response.json()
            // console.log(response);
            // console.log(JSON);
            return ResJSON
        }
        getUser('admin_req_user').then(function (ResJSON) {


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
                                    success: function (response) {

                                        if (response == 409) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">409</span><span class="error-msg">You can\'t delete your own account</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close this error message" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(100)
                                        } else if (response == 400) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">400</span><span class="error-msg">Bad Request</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(100)
                                        } else if (response == 401) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">401</span><span class="error-msg">Unauthorized</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(100)
                                        } else if (response == 200) {
                                            $("#error-messages").append('<div class="error-msg-el"><div>' +
                                                '<span class="error-code">200</span><span class="error-msg">Deleted user: ' + name + '</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(100)
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
            }
        )
    }
);

function rmError(e) {
    $(e).parent().fadeOut()
}

