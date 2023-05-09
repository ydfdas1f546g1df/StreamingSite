let TestMedia = {name: "Vinland Saga", coverSrc: "/dist/img/testcover.jpg", medianame: "vinland-saga"}

Vue.createApp({
    data() {
        return {
            quicks: ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "#"],
        };
    }
}).mount("#quick-search");

$(function () {

        const cookies = document.cookie.split(';');
        let JSONData_po = [];
        let JSONData_wd = [];
        let JSONData_up = [];
        let username

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

        async function getWatched() {

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
                    // console.log(ResJSON)
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

        async function getWatchUpload() {


            getCookie()
            let myObj = {u: username};
            await $.ajax({
                type: "POST",
                url: "/api/latest_upload.php",
                data: {myData: JSON.stringify(myObj)},
                success: function (res) {
                    // console.log(res)

                    let ResJSON = JSON.parse(res);
                    // console.log(ResJSON)
                    let length
                    if (ResJSON.length > 14) {
                        length = 14
                    } else {
                        length = ResJSON.length
                    }
                    for (let i = 0; i < length; i++) {
                        JSONData_up.push({
                            showName: ResJSON[i].showName,
                            name: ResJSON[i].name,
                            season: ResJSON[i].season,
                            episode: ResJSON[i].episode,
                            upload: ResJSON[i].upload,
                        })
                    }
                    console.log(JSONData_up)
                    return JSONData_up
                }
            });
        }
        async function getWatchPopular() {


            getCookie()
            let myObj = {u: username};
            await $.ajax({
                type: "POST",
                url: "/api/popular_series.php",
                data: {myData: JSON.stringify(myObj)},
                success: function (res) {
                    // console.log(res)

                    let ResJSON = JSON.parse(res);
                    // console.log(ResJSON)
                    let length
                    if (ResJSON.length > 14) {
                        length = 14
                    } else {

                        length = ResJSON.length
                    }
                    for (let i = 0; i < length; i++) {
                        JSONData_po.push({
                            showName: ResJSON[i].showName,
                            name: ResJSON[i].name,
                            watched : ResJSON[i].watched,
                        })
                    }
                    console.log(JSONData_po)
                    return JSONData_po
                }
            });
        }

        getWatched().then(r => getWatchUpload().then(r => getWatchPopular().then(
            function () {
                // console.log(JSONData)

                Vue.createApp({
                    data() {
                        return {
                            uploads: JSONData_up,
                            watched: JSONData_wd,
                            pupular: JSONData_po,
                        };
                    },
                }).mount("#home-main");
            })))
    }
);


