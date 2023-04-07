$(function () {

        var JSONData = []
        const base_url = window.location.origin;

        const getUser = async (api) => {
            const response = await fetch(base_url + '/api/' + api + '.php', {
                method: 'POST',
                body: JSON.stringify({
                    reqId: 1,
                }),
                headers: {
                    'Content-Type': 'application/json'
                },

            });
            const ResJSON = await response.json()
            // console.log(response);
            // console.log(JSON);

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
                methods: {
                    removeUser(e) {

                        // console.log($(e.target).parent().parent().find(".user-list-el-username").text())

                        if (confirm("Are you sure you want to delete the user: " + $(e.target).parent().parent().find(".user-list-el-username").text())) {
                            $(e.target).parent().parent().remove()
                        }
                    },
                    editUser(e) {

                        var target = $(e.target)
                        var el = $(e.target).parent().parent()
                        if (el.find(".user-list-el-username").attr("contenteditable") === "false" || el.find(".user-list-el-username").attr("contenteditable") == undefined) {
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
                },
                computed: {
                    filteredUsers() {
                        return this.users.filter(p => {
                            return p.username.toLowerCase().indexOf(this.search.toLowerCase()) != -1;
                        });
                    }
                }
            }).mount("#all-users");
        }

        getUser('admin_req_user')

    }
);
