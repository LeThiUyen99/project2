
// script dùng chung cho admin
$(document).ready(function () {
    $("#tabBanthe24h a").click(function () {
        $("#noiDungBanThe24h").hide();
        $("#huongDanSuDungBanThe24h").hide();
        $(this).closest("#tabBanthe24h").find("a").removeClass("activeTab");
        $(this).addClass("activeTab");
        var tab = $(this).attr('data-value');
        $("#" + tab).show();
    });
});