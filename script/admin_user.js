$(function () {

        var JSONData = []
        const base_url = window.location.origin;

        const getUser = async (api) => {
            const response = await fetch(base_url + '/api/' + api + '.php', {
                method: 'POST', body: {
                    "x": 5
                }, headers: {
                    'Content-Type': 'application/json'
                }
            });
            const JSON = await response.json()
            // console.log(response);
            // console.log(JSON);

            for (let i = 0; i < JSON.length; i++) {
                if (JSON[i].admin == 1) {
                    JSON[i].admin = "fa-solid fa-check IsAdmin"
                } else {
                    JSON[i].admin = "fa-solid fa-xmark IsNotAdmin"
                }

                JSONData.push({
                    id: JSON[i].id,
                    admin: JSON[i].admin,
                    name: JSON[i].name,
                    username: JSON[i].name,
                    email: JSON[i].email,
                    passwordHash: JSON[i].passwordHash,
                    bio: JSON[i].bio,
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
