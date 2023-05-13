$(function () {

        const cookies = document.cookie.split(';');
        var JSONData = []
        const base_url = window.location.origin;

        async function getSettings() {

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
                url: "/api/get_admin_settings.php",
                data: {mySettings: JSON.stringify(myObj)},
                success: function (res) {
                    let ResJSON = JSON.parse(res);
                    console.log(ResJSON)
                    for (let i = 0; i < ResJSON.length; i++) {
                        if (ResJSON[i].state == 1) {
                            ResJSON[i].state = true

                        } else {
                            ResJSON[i].state = false
                        }

                        JSONData.push({
                            id: ResJSON[i].id,
                            state: ResJSON[i].state,
                            name: ResJSON[i].name,
                            showName: ResJSON[i].showName,
                            desc: ResJSON[i].description,
                            sel1: ResJSON[i].sel1,
                            sel2: ResJSON[i].sel2,
                        })
                        // JSONData.push({
                        //     id: ResJSON[i].id,
                        //     state: ResJSON[i].state,
                        //     name: ResJSON[i].name,
                        //     showName: ResJSON[i].showName,
                        //     desc: ResJSON[i].description,
                        // })
                    }
                    return JSONData
                }
            });
        }

        getSettings().then(
            function () {
                // console.log(JSONData)

                Vue.createApp({
                    data() {
                        return {
                            settings: JSONData,
                        };
                    },
                    methods: {
                        changeSetting(e, event) {
                            // console.log(e.state)
                            let token
                            // event = $(event.target).parent().parent()
                            // if (!e.state) {
                            //     event.find(".sel1")
                            // }


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

                            async function editSetting() {

                                let myObj = {setting: e.id, token: token, state: !e.state};
                                $.ajax({
                                    type: "POST",
                                    url: "/api/admin_edit_setting.php",
                                    data: {myData: JSON.stringify(myObj)},
                                    success: function (res) {
                                        console.log(res)
                                        if (res == 400) {
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
                                                '<span class="error-code">200</span><span class="error-msg">Edited Setting: ' + e.showName + ' successfully</span>' +
                                                '</div><i class="fa-solid fa-xmark IsNotAdmin" title="close" onclick="rmError(this)"></i></div>')
                                                .children().delay(5000).fadeOut(500)
                                            $(e.target).parent().parent().remove()
                                        }
                                    }
                                });
                            }

                            editSetting()
                        }
                    }
                }).mount("#settings-article");
            })
    }
);

function rmError(e) {
    $(e).parent().remove()
}

