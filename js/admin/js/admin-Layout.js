
// Change width space Work
$(document).ready(function () {
    $(".change_Width").click(function () {
        $("#menuLeft").toggle();
        if ($("#menuLeft").is(":visible") == false) {
            $("#Content_Change").find(".contentAdmin").removeClass('col-sm-10');
            $("#Content_Change").find(".contentAdmin").addClass('col-sm-12');
        }
        else {
            $("#Content_Change").find(".contentAdmin").addClass('col-sm-10');
            $("#Content_Change").find(".contentAdmin").removeClass('col-sm-12');
        }
    });
});