$(function () {

        const cookies = document.cookie.split(';');
        let JSONData = [];
        let username
        let uname
        let usname

        function getCookie() {
            if (window.location.href.includes("?u=")) {
                username = window.location.href.split("?u=")[1].split("&")[0]
                // console.log(username)
            } else {
                for (let i = 0; i < cookies.length; i++) {
                    let cookie = cookies[i].split('=');
                    if (cookie[0].includes("username")) {
                        username = cookie[1];
                    }
                }
            }
            // console.log(cookies)
            if (username == undefined) {
                let origin = window.location.origin
                window.location.href = origin + "/login/"
            }
        }

        async function getWatchPopular() {


            getCookie()
            let myObj = {u: username};
            await $.ajax({
                type: "POST",
                url: "/api/req_user_wl.php",
                data: {myData: JSON.stringify(myObj)},
                success: function (res) {
                    // console.log(res)

                    let ResJSON = JSON.parse(res);
                    // console.log(ResJSON)

                    for (let i = 0; i < ResJSON.length; i++) {
                        JSONData.push({
                            showName: ResJSON[i].showName,
                            name: ResJSON[i].name,
                        })
                        uname = ResJSON[i].uname
                        usname = ResJSON[i].usname
                    }
                    console.log(JSONData)
                    return JSONData
                }
            });
        }

        getWatchPopular().then(
            function () {
                // console.log(JSONData)

                Vue.createApp({
                    data() {
                        return {
                            watchlist: JSONData,
                            uname: uname,
                            usname: usname,
                        };
                    },
                }).mount("#watchlist-main");
            })
    }
);


