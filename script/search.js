$(function () {

        var JSONData = []

        async function getSeries() {

            let token

            const cookies = document.cookie.split(';');

            function getCookie() {
                // console.log(cookies)
                for (let i = 0; i < cookies.length; i++) {
                    const cookie = cookies[i].split('=');
                    if (cookie[0].includes("token")) {
                        token = cookie[1];
                        // console.log(token)
                    }
                }
            }

            getCookie()
            let myObj = {token: token};
            await $.ajax({
                type: "POST",
                url: "/api/all_series.php",
                data: {myData: JSON.stringify(myObj)},
                success: function (res) {
                    let ResJSON = JSON.parse(res);
                    // console.log(ResJSON)
                    for (let i = 0; i < ResJSON.length; i++) {

                        JSONData.push({
                            name: ResJSON[i].name,
                            showName: ResJSON[i].showName,
                            desc: ResJSON[i].desc,
                            watchlist: ResJSON[i].watchlist,
                            watched: ResJSON[i].watched,
                        })
                    }
                    return JSONData
                }
            });
        }

        getSeries().then(
            function () {
                if (window.location.href.includes("?search=")) {
                    let qSearch = window.location.href.split("?search=")[1]
                    let value = $("#search-input").val()
                    // console.log($("#search-input"))
                    console.log(value)
                }
                // console.log(JSONData)
                Vue.createApp({
                    data() {
                        return {
                            results: JSONData,
                            search: "",
                        };
                    },
                    computed: {
                        filteredSeries() {
                            const filtered = this.results.filter(result => {
                                return result.showName.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
                            });
                            if (this.search.length == 0) {
                                $("#search-for span").css("display", "none")
                                return
                            } else {
                                $("#search-for span").css('display', 'flex')
                            }
                            if (filtered.length == 0) {
                                $("#nothing").css('display', 'flex')
                            } else {
                                $("#nothing").css("display", "none")
                            }
                            return filtered;
                        },
                    },
                    methods: {
                        addToWatchlist(e) {
                            let name = $(e.target).parent().attr("name")
                            // console.log($(e.target).parent().attr("showName"))
                            // console.log(name)

                            async function sendAddToWatchlist() {

                                let token

                                const cookies = document.cookie.split(';');

                                function getCookie() {
                                    // console.log(cookies)
                                    for (let i = 0; i < cookies.length; i++) {
                                        const cookie = cookies[i].split('=');
                                        if (cookie[0].includes("token")) {
                                            token = cookie[1];
                                            // console.log(token)
                                        }
                                    }
                                }

                                getCookie()
                                let myObj = {token: token, series: name};
                                await $.ajax({
                                    type: "POST",
                                    url: "/api/add_watchlist.php",
                                    data: {myData: JSON.stringify(myObj)},
                                    success: function (res) {
                                        console.log(res)
                                        if (res == true) {
                                            $(e.target).find("span").text("added to Watchlist")
                                        } else {
                                            $(e.target).find("span").text("Alreay in your Watchlist")
                                        }
                                    }
                                });
                            }

                            sendAddToWatchlist()
                        }
                    }
                }).mount("#search-main");
            })
    }
);





