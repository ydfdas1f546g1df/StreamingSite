let TestMedia = {name: "Vinland Saga", coverSrc: "/dist/img/testcover.jpg", medianame: "vinland-saga"}

Vue.createApp({
    data() {
        return {
            quicks: ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "#"],
        };
    }
}).mount("#quick-search");

Vue.createApp({
    data() {
        return {
            Media: [
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia
                ],
        };
    }
}).mount("#home-cat-1");

Vue.createApp({
    data() {
        return {
            Media: [
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia
            ],
        };
    }
}).mount("#home-cat-2");

Vue.createApp({
    data() {
        return {
            Media: [
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia,
                TestMedia
            ],
        };
    }
}).mount("#home-cat-3");

$("#hello").on("click", function () {
    // TestMedia = {name: "Pokemon", coverSrc: "/dist/img/testcover.jpg"}
    app.Media.name = "John Doe";

    console.log(app.Media.name)
})
