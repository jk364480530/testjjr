$(".show-list .show-box .list").mouseenter(function () {
    $(this).find('.list-but').eq(0).stop().animate({'top': '6px'}, 200);
});
$(".show-list .show-box .list").mouseleave(function () {
    $(this).find('.list-but').eq(0).stop().animate({'top': '-50px'}, 200);
});

$(".link-li").live("click", function () {
    $(".linkBox_div").hide();
    $("#linkBox_" + $(this).attr("for")).show();
    $(".linkBox-nav span").attr("class", "link-li");
    $(this).attr("class", "current-link-li");
});

$(window).load(function () {
    jQuery(".slideTxtBox").slide({
        autoPlay: true, effect: "fold", delayTime: 500, interTime: 3500, startFun: function (i, c) {
            var li = $('.slideTxtBox .bd ul li').eq(i);
            if ($(li).find("a").attr('show') == 0) {
                $(li).find("a").css({
                    'background': 'url(' + $(li).find("a").attr("url") + ') no-repeat center'
                });
                $(li).find("a").attr('show', 1);
            }
        }
    });
    $('.slideTxtBox .bd, .slideTxtBox .bd ul').css({
        'position': 'absolute',
        'width': '100%',
        'height': '400px'
    });
    PVTJ();
});

