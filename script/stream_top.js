$(function () {

        let seriesName
        let statusNth = 0
        let JSONData = [];
        let JSONData2 = [];
        let JSONData3 = [];

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
                    if (ResJSON.length > 0) {

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
                    } else {
                        window.location.replace(window.location.origin + "/error/404.php")
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
                        let location = "<a href='/' class='location-el'>Home</a><strong>&nbsp;<i class=\"fa-solid fa-chevron-right\"></i>&nbsp;</strong><a href='/pages/allseries' class='location-el'>Series</a> "
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
                                console.log("to 0")
                            } else {
                                file = "/api/add_watchlist.php"
                                el.attr("class", "watchlist-add isInWatchlist").attr("status", 1)
                                console.log("to 1")
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
                    }
                }).mount("#stream-banner");
            }
        );

        let episodeName
        const cookies = document.cookie.split(';');
        const url = window.location.href
        const seriesSelect = url.split("stream/")[1].split("/")[0]
        const seasonSelect = url.split("stream/")[1].split("/")[1]
        const episodeSelect = url.split("stream/")[1].split("/")[2]
        let seasonNum
        let episodeNum
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
        console.log(url)


        async function getSelect() {

            function getCookie() {
                for (let i = 0; i < cookies.length; i++) {
                    const cookie = cookies[i].split('=');
                    if (cookie[0].includes("token")) {
                        token = cookie[1];
                    }
                }
            }

            getCookie()
            let myObj = {token: token, series: seriesSelect, season: seasonNum, episode: episodeNum, index: 2};
            // console.log(myObj)
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
                    } else {

                    }
                    if (ResJSON[1].length > 0) {
                        for (let i = 0; i < ResJSON[1].length; i++) {
                            if (ResJSON[1][i].episode == episodeNum) {
                                episodeName = ResJSON[1][i].name
                                $("#episode-title").text(episodeName)
                            }
                            let allEpisodes = "<a href=\"/stream/" + seriesSelect + "/season-" + ResJSON[1][i].season + "/episode-" + ResJSON[1][i].episode + "\"class=\"select-el select-episode select-select "
                            if (ResJSON[1][i].watched > 0) {
                                allEpisodes += "watched "
                            }
                            let isCurrent = ""
                            if (episodeNum != undefined) {
                                if (ResJSON[1][i].episode == episodeNum) {
                                    allEpisodes += "current"
                                }
                            }
                            allEpisodes += "\">" + ResJSON[1][i].episode + "</a>"
                            $("#episodes").append(allEpisodes)
                            let status
                            let watched
                            if (ResJSON[1][i].watched > 0) {
                                watched = "watched-episode"
                                status = 1
                            } else {
                                status = 0
                            }

                            JSONData3.push({
                                season: ResJSON[1][i].season,
                                name: ResJSON[1][i].name,
                                episode: ResJSON[1][i].episode,
                                watched: watched,
                                series: seriesSelect,
                                showName: JSONData.showName,
                                status: status,
                            });
                        }

                    }

                    console.log(JSONData2)
                    console.log(JSONData3)
                }
            });
        }

        getSelect().then(function () {
            Vue.createApp({
                data() {
                    return {
                        episodes: JSONData3,
                    };
                },
                methods: {
                    addToWatched(e) {
                        let parent = $(e.target).parent().parent()
                        let toWDStatus = parent.attr("status")
                        let toWDEpisode = parent.find(".episode").attr("episode")
                        let toWDSeason = parent.find(".season").attr("season")
                        let toWDSeries = parent.find(".series").attr("series")
                        if (toWDStatus == 1) {
                            toWDStatus = 2
                            parent.toggleClass("watched-episode")
                            parent.attr("status", 2)
                        } else {
                            toWDStatus = 1
                            parent.toggleClass("watched-episode")
                            parent.attr("status", 1)
                        }
                        $(".select-episode").each(
                            function (e) {
                                let el = $(this)
                                // console.log(el)
                                if (el.text() == toWDEpisode) {
                                    el.toggleClass("watched")
                                }
                            }
                        )

                        async function sendToWatched() {
                            let myObj = {
                                series: toWDSeries,
                                token: token,
                                season: toWDSeason,
                                what: toWDStatus,
                                episode: toWDEpisode
                            };
                            // console.log(myObj)
                            await $.ajax({
                                type: "POST",
                                url: "/api/add_watched.php",
                                data: {myData: JSON.stringify(myObj)},
                                success: function (res) {
                                    console.log(res)
                                    // let ResJSON = JSON.parse(res);
                                    // console.log(ResJSON)

                                    // console.log(JSONData)
                                }
                            });
                        }

                        sendToWatched()
                    }
                }
            }).mount("#stream-season")
        })
        // $("#watchNow").on("click", function (e) {
        //     console.log(1)
        //     if (this.hash !== "") {
        //         // Prevent default anchor click behavior
        //         e.preventDefault();
        //
        //         // Store hash
        //         let hash = "watch-now";
        //
        //         // Using jQuery's animate() method to add smooth page scroll
        //         // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
        //         $('html, body').animate({
        //             scrollTop: $(hash).offset().top
        //         }, 800, function () {
        //
        //         });
        //     }
        // });
    }
)


// function addToWatched(e) {
//     e.preventDefault()
//     console.log(1)
//     let Base_url = window.location.href
//     let parent = $(e.target).parent().parent()
//     let toWatchedSeries = Base_url.split("stream/")[1].split("/")[0]
//     let toWatchedSeason = parent.find(".season").text()
//     let toWatchedEpisode = parent.find(".episode").attr("episode")
//     console.log(toWatchedEpisode)
//     console.log(toWatchedSeason)
//     console.log(toWatchedSeason)
// }
// $("*").on("click", function (e) {
//     e.preventDefault()
//
// })
//
// $(".add-to-watched").on("click", function (e) {
//     console.log(1)
//     if (e) {
//         e.preventDefault()
//
//     }
//     e.preventDefault()
//     console.log($(e).target())
//     console.log($(e.target)[0])
//     console.log($(e.target).parent().parent().find(".episode").attr("episode"))
//     let Base_url = window.location.href
//     let parent = $(e.target).parent().parent()
//     let toWatchedSeries = Base_url.split("stream/")[1].split("/")[0]
//     let toWatchedSeason = parent.find(".season").text()
//     let toWatchedEpisode = parent.find(".episode").attr("episode")
//     console.log(toWatchedEpisode)
//     console.log(toWatchedSeason)
//     console.log(toWatchedSeason)
// })
// $(function () {
//     setTimeout(addToWatched, 1000)
// })
// $('.add-to-watched').on("click", function (e) {
//     e.preventDefault()
//     let Base_url = window.location.href
//     let parent = $(e.target).parent().parent()
//     let toWatchedSeries = Base_url.split("stream/")[1].split("/")[0]
//     let toWatchedSeason = parent.find(".season").text()
//     let toWatchedEpisode = parent.find(".episode").attr("episode")
//     console.log(toWatchedEpisode)
//     console.log(toWatchedSeason)
//     console.log(toWatchedSeason)
// })
