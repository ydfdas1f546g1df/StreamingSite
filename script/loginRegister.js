var index = 0

//blur


$("input").on("blur", function (e) {
    $(this).attr("class", "touched")
});

//Invalide Felder

// $("input[type='submit']").on("click", function (e) {
    // e.preventDefault()

    // var invalids = "The field*s "

    // $("form input:invalid").each(function () {
    //     // console.log(234)
    //     invalids += $(this).attr("name") + ", "
    //     $("#error-field").css("background", "rgba(255, 0, 0, 0.313)")
    //     $("#error-field").css("color", "rgb(188, 1, 1)")
    // });
    // if (invalids == "The field*s ") {
    //     if ($("select[name='schaden']").val() == "Auswahl") {
    //         e.preventDefault()
    //         invalids = "Wähle aus wie der Schaden entststanden ist."
    //         $("#error-field").css("background", "rgba(255, 0, 0, 0.313)")
    //         $("#error-field").css("color", "rgb(188, 1, 1)")
    //     } else {
    //         if (index < 1) {
    //             e.preventDefault()
    //             invalids = "Akzeptieren sie Die Datenschutzrichtlinien."
    //             $("#error-field").css("background", "rgba(255, 0, 0, 0.313)")
    //             $("#error-field").css("color", "rgb(188, 1, 1)")
    //         }
    //     }
    //
    // } else {
    //     invalids += " not valid."
    // }
//
//
//     $("#error-field").css("display", "flex")
//     $("#error-field").text(invalids)
// });



// Requiered sternchen
$("input[required], textarea[required], select").each(function () {
    $(this).parent().find("span").append("<span style='color: rgb(255, 100, 16);'>*</span>");
});



