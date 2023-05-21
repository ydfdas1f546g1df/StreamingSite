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
                url: "/api/admin_req_episode.php",
                data: {myData: JSON.stringify(myObj)},
                success: function (res) {
                    let ResJSON = JSON.parse(res);
                    console.log(ResJSON)
                    for (let i = 0; i < ResJSON.length; i++) {
                        JSONData.push({
                            id: ResJSON[i].id,
                            showName: ResJSON[i].showName,
                            season: ResJSON[i].season,
                            name: ResJSON[i].name,
                            episode: ResJSON[i].episode,
                            series: ResJSON[i].seriesname,
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
                            episodes: JSONData,
                            search: "",
                        };
                    },
                    computed: {
                        filteredEpisodes() {
                            return this.episodes.filter(p => {
                                return p.name.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
                            });
                        }
                    },
                    methods: {
                        removeEpisode(e) {
                            let id = $(e.target).parent().parent().find(".user-list-el-id").text()
                            // console.log($(e.target).parent().parent().find(".user-list-el-username").text())
                            let name = $(e.target).parent().parent().find(".user-list-el-username").text()
                            if (confirm("Are you sure you want to delete the episode with the name: " + name)) {
                                let token;
                                let target = $(e.target);
                                let el = target.parent().parent();
                                // console.log(el.find(".user-list-el-admin").find("i").attr("admin"))
                                let series = el.find(".user-list-el-username").attr("name")
                                let season = el.find(".user-list-el-name").text()
                                let name = el.find(".user-list-el-email").text()
                                let episode = el.find(".user-list-el-admin").text()

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
                                    token: token,
                                    series: series,
                                    name: name,
                                    episode: episode,
                                    season: season,
                                    rm_id: id,

                                };
                                // console.log(myObj)
                                $.ajax({
                                    type: "POST",
                                    url: "/api/admin_rm_episode.php",
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
                                                '<span class="error-code">200</span><span class="error-msg">Deleted Episode: ' + name + ' successfully</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                            $(e.target).parent().parent().remove()
                                        }
                                    }
                                });
                            }
                        },
                        editEpisode(e) {
                            // console.log(e)
                            let target = $(e.target);
                            let el = target.parent().parent();
                            // console.log(el.find(".user-list-el-admin").find("i").attr("admin"))
                            let username_el = el.find(".user-list-el-username")
                            let name_el = el.find(".user-list-el-name")
                            let email_el = el.find(".user-list-el-email")
                            let admin_el = el.find(".user-list-el-admin")
                            let id_el = el.find(".user-list-el-id")
                            if (el.find(".user-list-el-email").attr("contenteditable") === "false" || el.find(".user-list-el-email").attr("contenteditable") === undefined) {
                                target.attr("class", "fas fa-save edit-btn user-list-btn")
                                admin_el.attr("contenteditable", "true")
                                name_el.attr("contenteditable", "true")
                                email_el.attr("contenteditable", "true")
                                // admin_el.css("cursor", "pointer").attr("status", "1")
                                // console.log(1)
                            } else {
                                // console.log(2)
                                target.attr("class", "fa-solid fa-pen-to-square edit-btn user-list-btn")
                                admin_el.attr("contenteditable", "false")
                                name_el.attr("contenteditable", "false")
                                email_el.attr("contenteditable", "false")
                                // admin_el.css("cursor", "default").attr("status", "0")
                                let token;
                                let series = username_el.text()
                                let season = name_el.text()
                                let name = email_el.text()
                                let id = id_el.text()
                                let episode = admin_el.text()
                                let oldSeason = el.find(".user-list-el-name").attr("oldSeason")
                                let oldEpisode = el.find(".user-list-el-admin").attr("oldEpisode")
                                let showName = el.find(".user-list-el-username").attr("name")


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
                                    series: series,
                                    name: name,
                                    episode: episode,
                                    season: season,
                                    oldSeason: oldSeason,
                                    oldEpisode: oldEpisode,
                                    showName: showName,
                                };
                                console.log(myObj)
                                $.ajax({
                                    type: "POST",
                                    url: "/api/admin_edit_episode.php",
                                    data: {myData: JSON.stringify(myObj)},
                                    success: function (res) {
                                        console.log(res)
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
                                                '<span class="error-code">200</span><span class="error-msg">Episode: ' + name + ' was successfully edited</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                            el.find(".user-list-el-name").attr("oldSeason", season)
                                            el.find(".user-list-el-admin").attr("oldEpisode", episode)
                                        }
                                    }
                                });
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

