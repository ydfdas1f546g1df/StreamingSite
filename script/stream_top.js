$(function () {

    let JSONData = [];
    let seriesName
    let statusNth = 0


    async function getInfo() {

        let token;

        const cookies = document.cookie.split(';');

        const base_url = window.location.href;

        function getSeriesName() {
            seriesName = base_url.split("stream/")[1].split("/")[0]
            return seriesName
        }

        function getCookie() {
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].split('=');
                if (cookie[0].includes("token")) {
                    token = cookie[1];
                }
            }
        }

        getCookie()

        getSeriesName();
        let myObj = {s: seriesName, u: token};
        await $.ajax({
            type: "POST",
            url: "/api/series_info.php",
            data: {myData: JSON.stringify(myObj)},
            success: function (res) {
                // console.log(res)
                let ResJSON = JSON.parse(res);
                console.log(ResJSON)
                JSONData = {
                    name: ResJSON[0].name,
                    showName: ResJSON[0].showName,
                    desc: ResJSON[0].description,
                    watchlist: ResJSON[0].watchlist,
                    OW: ResJSON[0].onWatchlist,
                    watched: ResJSON[0].watched,
                    reg: ResJSON[0].regisseur,
                    lang: ResJSON[0].language,
                }
                if (JSONData.OW == 1) {
                    JSONData.OW = "isInWatchlist"
                    $("#watchlit").attr("status", 1)
                    statusNth = 1
                }

                // console.log(JSONData)
                function setLocation() {
                    const url = window.location.href
                    const seriesSelect = url.split("stream/")[1].split("/")[0]
                    const seasonSelect = url.split("stream/")[1].split("/")[1]
                    const episodeSelect = url.split("stream/")[1].split("/")[2]
                    let seriesShowName = $("#SeriesName").text()
                    let location = "<a href='/' class='location-el'>Home</a><strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/pages/allseries' class='location-el'>Stream</a> "

                    if (seriesSelect !== undefined) {
                        location += "<strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/stream/" + seriesSelect + "' class='location-el'>" + JSONData.showName + "</a>"
                        if (seasonSelect !== undefined) {
                            location += "<strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/stream/" + seriesSelect + "/" + seasonSelect + "' class='location-el'>Season " + seasonSelect.split("-")[1] + "</a>"
                            if (episodeSelect !== undefined) {
                                location += "<strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/stream/" + seriesSelect + "/" + seasonSelect + "/" + episodeSelect + "' class='location-el'> Episode " + episodeSelect.split("-")[1] + "</a>"
                                    $("#series-title").text(JSONData.showName)
                            }
                        }
                    }
                    $("#location").append(location)
                }

                setLocation()
            }

        });
    }

    getInfo().then(
        function () {
            Vue.createApp({
                data() {
                    return {
                        series: JSONData,
                        onWatchlist: statusNth,
                    };
                },
                methods: {
                    watchlist() {

                        let el = $("#watchlist")
                        let status = el.attr("status")
                        let file
                        if (status == 1) {
                            file = "/api/remove_watchlist.php"
                            el.attr("class", "watchlist-add").attr("status", 0)
                            // console.log("to 0")
                        } else {
                            file = "/api/add_watchlist.php"
                            el.attr("class", "watchlist-add isInWatchlist").attr("status", 1)
                            // console.log("to 1")
                        }

                        async function toWatchlist() {

                            let token;

                            const cookies = document.cookie.split(';');

                            const base_url = window.location.href;

                            function getSeriesName() {
                                seriesName = base_url.split("stream/")[1].split("/")[0]
                                return seriesName
                            }

                            function getCookie() {
                                for (let i = 0; i < cookies.length; i++) {
                                    const cookie = cookies[i].split('=');
                                    if (cookie[0].includes("token")) {
                                        token = cookie[1];
                                        return token
                                    }
                                }
                            }

                            getSeriesName();
                            getCookie()
                            if (token == undefined) {
                                let origin = window.location.origin
                                window.location.href = origin + "/login/"
                            }
                            // console.log(seriesName, token)
                            let myObj = {series: seriesName, token: token};
                            await $.ajax({
                                type: "POST",
                                url: file,
                                data: {myData: JSON.stringify(myObj)},
                                success: function (res) {
                                    // console.log(res)
                                    let ResJSON = JSON.parse(res);
                                    // console.log(ResJSON)

                                    // console.log(JSONData)
                                }
                            });
                        }

                        toWatchlist()
                    },
                    share() {

                    }
                }
            }).mount("#stream-banner");
        }
    );
});
