$(function () {

        const cookies = document.cookie.split(';');
        let JSONData = [];
        let JSONData_wd = [];
        let username


        async function getWatched() {


            function getCookie() {
                if (window.location.href.includes("?u=")) {
                    username = window.location.href.split("?u=")[1]
                } else {
                    for (let i = 0; i < cookies.length; i++) {
                        let cookie = cookies[i].split('=');
                        if (cookie[0].includes("username")) {
                            username = cookie[1];
                        }
                    }
                }
                // console.log(cookies)
            }

            getCookie()
            let myObj = {u: username};
            await $.ajax({
                type: "POST",
                url: "/api/req_user_wd.php",
                data: {myData: JSON.stringify(myObj)},
                success: function (res) {
                    // console.log(res)

                    let ResJSON = JSON.parse(res);
                    let length
                    if (ResJSON.length > 14) {
                        length = 14
                    } else {
                        length = ResJSON.length
                    }
                    for (let i = 0; i < length; i++) {
                        JSONData_wd.push({
                            showName: ResJSON[i].showName,
                            name: ResJSON[i].series,
                            ename: ResJSON[i].name,
                            episode: ResJSON[i].episode,
                            season: ResJSON[i].season,
                        })
                    }
                    console.log(JSONData_wd)
                    return JSONData_wd
                }
            });
        }

        async function getWatchlist() {


            function getCookie() {
                // console.log(cookies)

                if (window.location.href.includes("?u=")) {
                    username = window.location.href.split("?u=")[1]
                } else {
                    for (let i = 0; i < cookies.length; i++) {
                        let cookie = cookies[i].split('=');
                        if (cookie[0].includes("username")) {
                            username = cookie[1];
                        }
                    }
                }
            }

            getCookie()
            let myObj = {u: username};
            await $.ajax({
                type: "POST",
                url: "/api/req_user_wl.php",
                data: {myData: JSON.stringify(myObj)},
                success: function (res) {
                    // console.log(res)

                    let ResJSON = JSON.parse(res);
                    console.log(ResJSON)
                    let length
                    if (ResJSON.length > 14) {
                        length = 14
                    } else {
                        length = ResJSON.length
                    }
                    for (let i = 0; i < length; i++) {
                        JSONData.push({
                            showName: ResJSON[i].showName,
                            name: ResJSON[i].name,
                        })
                    }
                    return JSONData
                }
            });
        }

        getWatched().then(r => getWatchlist().then(
            function () {
                // console.log(JSONData)

                Vue.createApp({
                    data() {
                        return {
                            watchlist: JSONData,
                            watched: JSONData_wd,
                        };
                    },
                }).mount("#watch");
            }))

    }
);

