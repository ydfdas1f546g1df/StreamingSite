var blurIndex = 0
var submitIndex = 0
passIndex = 0
$("input").on("blur", function (e) {
    e.preventDefault()
    checkPw(e)
});

$("input[type='password']").on("blur", function (e) {
    e.preventDefault()
    passIndex = 1
    checkPw(e)
});


$("input[type='submit']").on("click", function (e) {
    e.preventDefault()
    submitIndex++
    checkPw(e)
});

function checkPw(e) {
    let pw = $("#password")
    let email = $("input[type='email']")

    $("#error-field").css("display", "none")
    if (pw.val().length > 9) {


        $("#error-field").text("")
        $("#error-field").css("display", "none")
        pw.css("border-color", "transparent transparent #0084d0 transparent")
        pw.css("color", "#0084d0")
        if ($("input[type='email']:invalid").length < 1) {
            email.css("border-color", "transparent transparent #0084d0 transparent")
            email.css("color", "#0084d0")
        } else if ($("input[type='email']:invalid").length > 0) {

            $("#error-field").text("No valid email")
            $("#error-field").css("display", "flex")
            email.css("border-color", "transparent transparent red transparent")
            email.css("color", "red")
        }
        if ($("input:invalid").length == 0 && submitIndex == 1) {
            $("form").submit()

        }
    } else if ($("input[type='email']:invalid").length > 0) {

        $("#error-field").text("No valid email")
        $("#error-field").css("display", "flex")
        email.css("border-color", "transparent transparent red transparent")
        email.css("color", "red")
    } else if (passIndex == 1) {

        $("#error-field").text("Password to short")
        $("#error-field").css("display", "flex")
        pw.css("border-color", "transparent transparent red transparent")
        pw.css("color", "red")
        email.css("border-color", "transparent transparent #0084d0 transparent")
        email.css("color", "#0084d0")
    }
    submitIndex = 0
}



