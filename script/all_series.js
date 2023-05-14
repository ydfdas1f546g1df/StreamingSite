$(function () {

    var JSONData = [];

    async function getSeries() {

        let token;

        const cookies = document.cookie.split(';');

        function getCookie() {
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i].split('=');
                if (cookie[0].includes("token")) {
                    token = cookie[1];
                }
            }
        }

        getCookie();
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
                    });
                }
                JSONData.sort((a, b) => a.showName.localeCompare(b.showName)); // Sort alphabetically
                // console.log(JSONData)
            }
        });
    }

    getSeries().then(
        function () {
            const letters = new Set(JSONData.map(item => item.showName[0].toUpperCase())); // Get the first letter of each showName and remove duplicates
            console.log(letters)
            Vue.createApp({
                data() {
                    return {
                        results: JSONData,
                        search: "",
                        letters: Array.from(letters).sort(),
                    };
                },
                computed: {
                    filteredSeries() {
                        const filtered = this.results.filter(result => {
                            return result.showName.toLowerCase().includes(this.search.toLowerCase());
                        });
                        return filtered;
                    },
                    seriesByLetter() {
                        const series = {};
                        this.letters.forEach(letter => {
                            series[letter] = this.filteredSeries.filter(result => result.showName[0].toUpperCase() === letter);
                        });
                        return series;
                    },
                },
            }).mount("#all-series-main");
        }
    );
});
