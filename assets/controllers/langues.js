$('.flag').on("click",function () {
    var langue = $(this).attr("value");
    console.log(langue);
     $.ajax({
        type: 'POST',
        url: 'changeLocale',
        data: {langue: langue},
        success: function (data) {location.reload();}
            });
})
