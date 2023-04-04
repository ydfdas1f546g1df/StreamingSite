var blurIndex = []
var submitIndex = 0
$("input").on("blur", function (e) {
    $(this).attr("class", "touched")
    $(this).attr("id")


});

$("input[type='password']").on("blur", function (e) {
    e.preventDefault()
    // console.log("blur")
    if (!blurIndex.includes($(this).attr("id"))) {
        blurIndex.push($(this).attr("id"))
    }
    if (blurIndex.length == 2) {
        checkPw(e)
    }
});

$("input[type='submit']").on("keyup", function () {
    e.preventDefault()
    checkPw(e)
})

$("input[type='submit']").on("click", function (e) {
    e.preventDefault()
    submitIndex++
    checkPw(e)
});

function checkPw(e) {
    let pw1 = $("#password")
    let pw2 = $("#rpassword")
    // console.log(pw1.val(), pw2.val())
    if (pw1.val() != pw2.val() && blurIndex.length == 2) {
        e.preventDefault()
        $("#error-field").text("The passwords don't match")
        $("#error-field").css("display", "flex")
        pw1.css("border-color", "transparent transparent red transparent")
        pw1.css("color", "red")
        pw2.css("border-color", "transparent transparent red transparent")
        pw2.css("color", "red")
    } else {
        $("#error-field").css("display", "none")
        // console.log("password match")
        // console.log(pw1.val().length, pw2.val().length)
        // console.log(blurIndex.length == 2)
        if (pw1.val().length > 9 && pw2.val().length > 9) {
            $("#error-field").text("")
            $("#error-field").css("display", "none")
            pw1.css("border-color", "transparent transparent #0084d0 transparent")
            pw1.css("color", "#0084d0")
            pw2.css("border-color", "transparent transparent #0084d0 transparent")
            pw2.css("color", "#0084d0")
            // console.log($("input:invalid").length == 0)
            if ($("input:invalid").length == 0 && submitIndex == 1) {
                $("form").submit()
            }
        } else {
            $("#error-field").text("Password to short")
            $("#error-field").css("display", "flex")
            pw1.css("border-color", "transparent transparent red transparent")
            pw1.css("color", "red")
            pw2.css("border-color", "transparent transparent red transparent")
            pw2.css("color", "red")
        }
    }
    submitIndex = 0
}


var showPw = $("i.showPw")
showPw.mousedown(
    function () {
        showPw.attr("class", "fa-solid fa-eye showPw")
        $("input#password, input#rpassword").each(
            function () {
                $(this).attr("type", "text")
            }
        )
    }
)
showPw.mouseup(
    function () {
        showPw.attr("class", "fa-sharp fa-solid fa-eye-slash showPw")
        $("input#password, input#rpassword").each(
            function () {
                $(this).attr("type", "password")
            }
        )
    }
)


// Requiered sternchen
$("input[required], textarea[required], select").each(function () {
    $(this).parent().find("span").append("<span style='color: rgb(255, 100, 16);'>*</span>");
});



