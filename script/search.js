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
                    console.log(ResJSON)
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
                            if (filtered.length === 0) {
                                filtered.push({
                                    name: "",
                                    showName: "No match",
                                    desc: "If that's all you see, we don't have what you're looking for. But if you want to see something else, we have many other great series, movies or anime.",
                                    watchlist: "",
                                    watched: "",
                                });
                            }
                            return filtered;
                        },
                    },
                    methods: {
                        addToWatchlist(e) {
                            console.log($(e.target).parent().attr("showName"))
                            let name = $(e.target).parent().attr("name")
                            console.log(name)

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
                                        if (res == 200) {
                                            $(e.target).find("span").text("added to Watchlist")
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





