$("#logout").on("click", function () {
    console.log(document.cookie)
    document.cookie = "LoginUser=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT";
})
