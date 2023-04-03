let TestResult = {showName: "Vinland Saga",name: "vinlandsage", desc: "Das ist die Beschreibung einer Serie oder einses Films, die ungefähr beschreibt was sin dieser Serie/Film passiert.", watched: 356223, watchlist: 567889}

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
    }
}).mount("#search-result");