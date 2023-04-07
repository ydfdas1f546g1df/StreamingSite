var numberIndex = 0

$("input[type='number']").keyup(function (e) {
    if (e.keyCode === 13 || e.keyCode !== 8 && $(e.target).val().length === Number($(e.target).attr("maxlength"))) {
        if (this.value.length == this.maxLength) {
            $(this).next("input[type='number']").focus();
        }
    } else if (e.keyCode == 8) {
        $(e.target).val("")
        if ($(e.target).prev() != null) {
            $(e.target).prev().focus()
            e.preventDefault()
        }
    }

});

$("input[type='number']").keyup(function () {
    $(this).each(function () {
        if ($(this).val().length >= Number($(this).attr("maxlength"))) {
            $(this).attr("class", "ok")
            numberIndex++
        } else {
            $(this).attr("class", "")
            numberIndex--
        }
        if ($(this).val().length > Number($(this).attr("maxlength"))) {
            $(this).val($(this).val().substr(0,1))
            $(this).next("input[type='number']").focus();
        }

    })
})
$("input:first").focus()

$("form").on("submit", function (e){
    if (numberIndex != 6) {
    e.preventDefault()
    }
})