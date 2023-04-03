let TestResult = {
    showName: "Vinland Saga",
    name: "vinlandsage",
    desc: "Das ist die Beschreibung einer Serie oder einses Films, die ungefähr beschreibt was sin dieser Serie/Film passiert.",
    watched: 356223,
    watchlist: 567889
}

Vue.createApp({
    data() {
        return {
            results: [
                TestResult,
                TestResult,
                TestResult,
                TestResult,
                TestResult,
                TestResult,
                TestResult,
                TestResult,
                TestResult
            ],
        };
    },
    methods: {
        addToWatchlist (e){
            e.preventDefault()
            console.log($(e.target).parent().attr("name"))
            console.log($(e.target).parent().attr("showName"))
            // $(e).find("span").text("added")
            $(e.target).find("span").text("added")
        }
    }
}).mount("#search-result");


