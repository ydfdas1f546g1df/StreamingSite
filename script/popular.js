

$(function () {

        const cookies = document.cookie.split(';');
        let JSONData = [];
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
                    if (ResJSON.length > 77) {
                        length = 77
                    } else {

                        length = ResJSON.length
                    }
                    for (let i = 0; i < length; i++) {
                        JSONData.push({
                            showName: ResJSON[i].showName,
                            name: ResJSON[i].name,
                            watched : ResJSON[i].watched,
                        })
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
                            pupular: JSONData,
                        };
                    },
                }).mount("#popular-main");
            })
    }
);


