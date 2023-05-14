const url = window.location.href
const series = url.split("stream/")[1].split("/")[0]
const season = url.split("stream/")[1].split("/")[1]
const episode = url.split("stream/")[1].split("/")[2]
const media = "/data/media/" + series + "_" + season + "_" + episode + ".mp4"

const seasonNum = url.split("stream/")[1].split("/")[1].split("-")[1]
const episodeNum = url.split("stream/")[1].split("/")[2].split("-")[1]
// console.log(media)

// let token = ""
// const cookies = document.cookie.split(';');
// let tokenIndex = true

// function getCookie() {
//     for (let i = 0; i < cookies.length; i++) {
//         const cookie = cookies[i].split('=');
//         if (cookie[0].includes("token")) {
//             token = cookie[1];
//         }
//     }
// }

getCookie()

if (token.length < 1) {
    tokenIndex = false
}

$("#media-player").append("<source src=" + media + " type=\"video/mp4\">")

if (tokenIndex) {

setTimeout(function() {

    let JSONData = [];
    let seriesName


    async function addToWatched() {

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

        getCookie()

        let myObj = {series: series, token: token, season: seasonNum, episode: episodeNum, what: 1};
        // console.log(myObj)
        await $.ajax({
            type: "POST",
            url: "/api/add_watched.php",
            data: {myData: JSON.stringify(myObj)},
            success: function (res) {
                // console.log(res)
                if (res == 200) {
                    console.log("added")
                } else if (res == 400) {
                    console.log("ok")
                }
                // let ResJSON = JSON.parse(res);
                // console.log(ResJSON)
                // console.log(JSONData)
            }
        });
    }
    addToWatched()
}, 3 * 60 * 1000);
}
