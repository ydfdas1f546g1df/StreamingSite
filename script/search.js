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
                            return this.results.filter(result => {
                                console.log(result.showName.toLowerCase())
                                console.log(this.search.toLowerCase())
                                return result.showName.toLowerCase().indexOf(this.search.toLowerCase()) !== -1;
                            });
                        }
                    },
                    methods: {
                        addToWatchlist(e) {
                            e.preventDefault()
                            // console.log($(e.target))
                            console.log($(e.target).parent().attr("name"))
                            console.log($(e.target).parent().attr("showName"))
                            $(e.target).find("span").text("added to Watchlist")
                        }
                    }
                }).mount("#search-main");
            })
    }
);





