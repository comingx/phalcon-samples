$(".events").on("click", ".content-wrapper", function (evt) {
    var eventEle = $(this).parent().parent();
    $(".event").removeClass("active");
    $(eventEle).addClass("active");
    //textarea focus 移动光标到最后
    var ta = $(eventEle).find("textarea");
    var text = $(ta).val();
    $(ta).val("").focus().val(text);
});

$(".events").on("click", ".cancel-btn", function (evt) {
    $(this).parent().parent().parent().removeClass("active");
});

$(".events").on("click", ".save-btn", function (evt) {
    var eventEle = $(this).parent().parent().parent();
    var id = parseInt($(eventEle).attr("data-id"));
    var content = $(this).siblings("textarea").val();
    var ele = $(this);
    $.post(
        "/index/save",
        {"id": id, "content": content},
        function (data, status) {
            if (!data.hasOwnProperty("errcode")) {
                $(".active").removeClass("active");
                $(eventEle).find(".content-text").html(content);
            }
        }
    );
});

$(".events").on('click', '.done-btn', function (evt) {
    var eventEle = $(this).parent().parent().parent().parent();
    $(eventEle).addClass("done");
    evt.stopPropagation();
    $.post(
        '/index/status',
        {"id": parseInt($(eventEle).attr("data-id")), "status": 1},
        function () {
        }
    );
});

$(".events").on("click", ".undone-btn", function (evt) {
    var eventEle = $(this).parent().parent().parent().parent();
    $(eventEle).removeClass("done");
    evt.stopPropagation();
    $.post(
        '/index/status',
        {"id": parseInt($(eventEle).attr("data-id")), "status": 0},
        function () {
        }
    );
});

$(".events").on("click", ".delete-btn", function (evt) {
    var eventEle = $(this).parent().parent().parent();
    $(eventEle).fadeOut();
    $.post(
        '/index/delete',
        {"id": parseInt($(eventEle).attr("data-id"))},
        function () {
        }
    );

});

$("#addEventBtn").click(function (evt) {
    $(".active").removeClass("active");
    var content = $(this).siblings("textarea").val();
    $.post(
        "/index/save",
        {"id": 0, "content": content},
        function (data, status) {
            if (data.hasOwnProperty("errcode")) {
                alert(data.message);
                return false;
            }
            id = data.id;
            var template =
                '<div class="event" data-id="' + id + '">' +
                '<div class="event-details">' +
                '<div class="content-wrapper">' +
                '<a class="content-text">' + content + '</a>' +
                '<div class="operation-wrapper">' +
                '<a id="done-btn" class="btn btn-success btn-xs done-btn"><span class="glyphicon glyphicon-ok"></span></a>' +
                '<a id="undone-btn" class="btn btn-info btn-xs undone-btn"><span class="glyphicon glyphicon-repeat"></span></a>' +
                '</div>' +
                '</div>' +
                '<div class="content-textarea">' +
                '<textarea>' + content + '</textarea>' +
                '<a class="btn btn-success save-btn">保存</a>' +
                '<a id="cancel" class="btn btn-default btn-xs cancel-btn"><span class="glyphicon glyphicon-remove"></a>' +
                '<a class="btn btn-danger btn-xs pull-right delete-btn"><span class="glyphicon glyphicon-trash"></a>' +
                '</div>' +
                '</div>' +
                '</div>';
            $(".events > div:nth-child(1)").after(template);
            $(".add-event textarea").val("");
        }
    );
});