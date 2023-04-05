

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

$("input").on("blur", function (e) {
    $(this).attr("class", "touched")
    $(this).attr("id")
});