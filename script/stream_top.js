$(function () {

    let seriesName
    let statusNth = 0
    let JSONData = [];

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
                const url = window.location.href
                const seriesSelect = url.split("stream/")[1].split("/")[0]
                const seasonSelect = url.split("stream/")[1].split("/")[1]
                const episodeSelect = url.split("stream/")[1].split("/")[2]
                let episodeNum
                let seasonNum
                let index = true
                let episodeIndex = true
                if (url.includes("episode-")) {
                    const regex = /episode-(\d+)/;
                    const match = url.match(regex);
                    if (match) {
                        episodeNum = match[1];
                        episodeIndex = false
                    }
                }
                if (url.includes("season-")) {
                    const regex = /season-(\d+)/;
                    const match = url.match(regex);
                    if (match) {
                        seasonNum = match[1];
                    }
                } else {
                    seasonNum = 1;
                    index = false
                }


                function setLocation() {
                    let location = "<a href='/' class='location-el'>Home</a><strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/pages/allseries' class='location-el'>Stream</a> "
                    if (seriesSelect !== undefined) {
                        location += "<strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/stream/" + seriesSelect + "' class='location-el'>" + JSONData.showName + "</a>"
                        if (seasonSelect !== undefined && index) {
                            location += "<strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/stream/" + seriesSelect + "/" + seasonSelect + "' class='location-el'>Season " + seasonNum + "</a>"
                            if (episodeSelect !== undefined) {
                                location += "<strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/stream/" + seriesSelect + "/" + seasonSelect + "/" + episodeSelect + "' class='location-el'> Episode " + episodeNum + "</a>"
                                $("#series-title").text(JSONData.showName)
                            }
                        }
                    }
                    $("#location").append(location)

                }

                setLocation()

                let JSONData2 = [];
                let JSONData3 = [];
                let episodeName

                async function getSelect() {


                    let myObj = {token: token, series: seriesSelect, season: seasonNum, episode: episodeNum, index: 2};
                    await $.ajax({
                        type: "POST",
                        url: "/api/episode_select.php",
                        data: {myData: JSON.stringify(myObj)},
                        success: function (res) {
                            // console.log(res)
                            let ResJSON = JSON.parse(res);
                            console.log(ResJSON)
                            if (ResJSON[0][0].index == 1) {
                                for (let i = 0; i < ResJSON[0].length; i++) {
                                    JSONData2.push({
                                        season: ResJSON[0][i].season,
                                        watched: ResJSON[0][i].watched,
                                        possible: ResJSON[0][i].possible,
                                    });
                                    // console.log(ResJSON[0][i].index)
                                    let allSeasons = "<a href=\"/stream/" + seriesSelect + "/season-" + ResJSON[0][i].season + "\"class=\"select-el select-season select-select "
                                    if ((ResJSON[0][i].possible - ResJSON[0][i].watched) === 0) {
                                        allSeasons += "watched "
                                    }
                                    if (ResJSON[0][i].season == seasonNum) {
                                        allSeasons += "current"
                                    }
                                    allSeasons += "\">" + ResJSON[0][i].season + "</a>"
                                    $("#seasons").append(allSeasons)
                                }
                            }
                            if (ResJSON[1].length > 0) {
                                for (let i = 0; i < ResJSON[1].length; i++) {
                                    JSONData3.push({
                                        season: ResJSON[1][i].season,
                                        name: ResJSON[1][i].name,
                                        episode: ResJSON[1][i].episode,
                                        watched: ResJSON[1][i].watched
                                    });
                                    if (ResJSON[1][i].episode == episodeNum) {
                                        episodeName = ResJSON[1][i].name
                                        $("#episode-title").text(episodeName)
                                    }
                                    let allEpisodes = "<a href=\"/stream/" + seriesSelect + "/season-" + ResJSON[1][i].season + "/episode-" + ResJSON[1][i].episode + "\"class=\"select-el select-episode select-select "
                                    if (ResJSON[1][i].watched > 1) {
                                        allEpisodes += "watched "
                                    }
                                    if (episodeNum != undefined) {
                                        if (ResJSON[1][i].episode == episodeNum) {
                                            allEpisodes += "current"
                                        }
                                    }
                                    allEpisodes += "\">" + ResJSON[1][i].episode + "</a>"
                                    $("#episodes").append(allEpisodes)

                                    if ($("#stream-season").length > 0) {

                                        episodeName = ResJSON[1][i].name
                                        let SeasonAllEpisodes = "<a href='/stream/" + seriesSelect + "/season-" + seasonNum + "/episode-" + ResJSON[1][i].episode + "' class='"
                                        if (ResJSON[1][i].watched > 1) {
                                            SeasonAllEpisodes += "watched-episode"
                                        }
                                        SeasonAllEpisodes += "'><span>Episode " + ResJSON[1][i].episode + "</span><span><i class=\"gg-eye-alt\"></i></span><span>" + ResJSON[1][i].name +
                                            "</span><span>" + JSONData.showName + "</span><span>" + ResJSON[1][i].season + "</span></a>"
                                        $("#stream-season").append(SeasonAllEpisodes)

                                    }
                                }
                            }


                            console.log(JSONData2)
                            console.log(JSONData3)
                        }
                    });
                }

                getSelect().then(
                    function () {

                    }
                )
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
