const url = window.location.href
const series = url.split("stream/")[1].split("/")[0]
const season = url.split("stream/")[1].split("/")[1]
const episode = url.split("stream/")[1].split("/")[2]
const media = "/data/" + series + "/" + season + "/" + series + "_" + season + "_" + episode + ".mp4"
console.log(media)

const seasonNum = url.split("stream/")[1].split("/")[1].split("-")[1]
const episodeNum = url.split("stream/")[1].split("/")[2].split("-")[1]
// console.log(media)
// mediaPlayer = $("#media-player")[0]
// // console.log($(mediaPlayer))
//
// // let token = ""
// // const cookies = document.cookie.split(';');
// // let tokenIndex = true*-
//
// // function getCookie() {
// //     for (let i = 0; i < cookies.length; i++) {
// //         const cookie = cookies[i].split('=');
// //         if (cookie[0].includes("token")) {
// //             token = cookie[1];
// //         }
// //     }
// // }
//
// $(document).keydown(function (e) {
//
//     // console.log(e.keyCode)
//     // console.log(e.key)
//     // let mediaPlayerTime = mediaPlayer.currentTime
//     // console.log(mediaPlayer)
//     let volume = mediaPlayer.prop("volume");
//     if (e.keyCode === 32) {
//         if (mediaPlayer.paused) {
//             mediaPlayer.play()
//         } else {
//             mediaPlayer.pause()
//         }
//     }
//     if (e.keyCode === 37) {
//         mediaPlayer.currentTime -= 5
//     }
//     if (e.keyCode === 39) {
//         mediaPlayer.currentTime += 5
//     }
//     if (e.keyCode === 38) {
//         volume += 0.1
//         mediaPlayer.prop("volume", volume)
//     }
//     if (e.keyCode === 40) {
//         volume -= 0.1
//         mediaPlayer.prop("volume", volume)
//     }
// })

getCookie()

if (token.length < 1) {
    tokenIndex = false
}

$("#media-player").append("<source src=" + media + " type=\"video/mp4\">")

if (tokenIndex) {

    setTimeout(function () {

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

