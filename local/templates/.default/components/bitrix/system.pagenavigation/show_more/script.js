function showMoreHandler(sender){
    var url = $(sender).data("url");

    var arUrl = url.split("?");
    url =  arUrl[0] +  "?";

    var arParams = arUrl[1].split("&");
    arParams.forEach(function(el, n, ar){
        if (el.indexOf("bxajaxid") == -1) {
            url += el + "&";
        }
    });

    $.ajax({
        url: url  + "action=showMore",
        dataType: 'json',
        success: function (data) {
            console.log(data);

            if (typeof data === 'undefined') {
                console.log("error");
                return;
            }

            if (data.items !== undefined) {
                $(".js-items-container").append(data.items);
                console.log(data.items);
            }

            $("#js-pagination-container").html(data.pagination);
        }
    });
}