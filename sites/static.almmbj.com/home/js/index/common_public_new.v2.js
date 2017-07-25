/***********jquery.lazyload.min.js begin************/

(function($,window,document,undefined){var $window=$(window);$.fn.lazyload=function(options){var elements=this;var $container;var settings={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:window,data_attribute:"original",skip_invisible:true,appear:null,load:null,placeholder:"http://icon.90sheji.com/images/lz.gif"};function update(){var counter=0;elements.each(function(){var $this=$(this);if(settings.skip_invisible&&!$this.is(":visible")){return}if($.abovethetop(this,settings)||$.leftofbegin(this,settings)){}else{if(!$.belowthefold(this,settings)&&!$.rightoffold(this,settings)){$this.trigger("appear");counter=0}else{if(++counter>settings.failure_limit){return false}}}})}if(options){if(undefined!==options.failurelimit){options.failure_limit=options.failurelimit;delete options.failurelimit}if(undefined!==options.effectspeed){options.effect_speed=options.effectspeed;delete options.effectspeed}$.extend(settings,options)}$container=(settings.container===undefined||settings.container===window)?$window:$(settings.container);if(0===settings.event.indexOf("scroll")){$container.bind(settings.event,function(){return update()})}this.each(function(){var self=this;var $self=$(self);self.loaded=false;if($self.attr("src")===undefined||$self.attr("src")===false){if($self.is("img")){$self.attr("src",settings.placeholder)}}$self.one("appear",function(){if(!this.loaded){if(settings.appear){var elements_left=elements.length;settings.appear.call(self,elements_left,settings)}$("<img />").bind("load",function(){var original=$self.attr("data-"+settings.data_attribute);$self.hide();if($self.is("img")){$self.attr("src",original)}else{$self.css("background-image","url('"+original+"')")}$self[settings.effect](settings.effect_speed);self.loaded=true;var temp=$.grep(elements,function(element){return !element.loaded});elements=$(temp);if(settings.load){var elements_left=elements.length;settings.load.call(self,elements_left,settings)}}).attr("src",$self.attr("data-"+settings.data_attribute))}});if(0!==settings.event.indexOf("scroll")){$self.bind(settings.event,function(){if(!self.loaded){$self.trigger("appear")}})}});$window.bind("resize",function(){update()});if((/(?:iphone|ipod|ipad).*os 5/gi).test(navigator.appVersion)){$window.bind("pageshow",function(event){if(event.originalEvent&&event.originalEvent.persisted){elements.each(function(){$(this).trigger("appear")})}})}$(document).ready(function(){update()});return this};$.belowthefold=function(element,settings){var fold;if(settings.container===undefined||settings.container===window){fold=(window.innerHeight?window.innerHeight:$window.height())+$window.scrollTop()}else{fold=$(settings.container).offset().top+$(settings.container).height()}return fold<=$(element).offset().top-settings.threshold};$.rightoffold=function(element,settings){var fold;if(settings.container===undefined||settings.container===window){fold=$window.width()+$window.scrollLeft()}else{fold=$(settings.container).offset().left+$(settings.container).width()}return fold<=$(element).offset().left-settings.threshold};$.abovethetop=function(element,settings){var fold;if(settings.container===undefined||settings.container===window){fold=$window.scrollTop()}else{fold=$(settings.container).offset().top}return fold>=$(element).offset().top+settings.threshold+$(element).height()};$.leftofbegin=function(element,settings){var fold;if(settings.container===undefined||settings.container===window){fold=$window.scrollLeft()}else{fold=$(settings.container).offset().left}return fold>=$(element).offset().left+settings.threshold+$(element).width()};$.inviewport=function(element,settings){return !$.rightoffold(element,settings)&&!$.leftofbegin(element,settings)&&!$.belowthefold(element,settings)&&!$.abovethetop(element,settings)};$.extend($.expr[":"],{"below-the-fold":function(a){return $.belowthefold(a,{threshold:0})},"above-the-top":function(a){return !$.belowthefold(a,{threshold:0})},"right-of-screen":function(a){return $.rightoffold(a,{threshold:0})},"left-of-screen":function(a){return !$.rightoffold(a,{threshold:0})},"in-viewport":function(a){return $.inviewport(a,{threshold:0})},"above-the-fold":function(a){return !$.belowthefold(a,{threshold:0})},"right-of-fold":function(a){return $.rightoffold(a,{threshold:0})},"left-of-fold":function(a){return !$.rightoffold(a,{threshold:0})}})})(jQuery,window,document);

/***********jquery.lazyload.min.js end************/


$(window).load(function(){
    $("img.lazy").lazyload({
        effect: "show",
        threshold : 300, 
        placeholder : "//js.wotucdn.com/2015/image/lz.gif"
    });
});

/*����or�ղ�*/
$(function(){
    //���������л�
    $(".secord-nav-box .secord-nav-a").hover(function(){
        $(this).addClass("current").parent(".secord-nav-box").siblings().children(".secord-nav-a").removeClass("current");
        $(this).siblings(".thrid-nav").show().parent(".secord-nav-box").siblings().children(".thrid-nav").hide();

    });
    $(".secord-nav-box,.thrid-nav").mouseleave(function(){
        $('.thrid-nav').hide();
        $(".secord-nav-box").children(".secord-nav-a").removeClass("current");
    });


    //ͷ���̶�
    var animateFlag = 1;
    $(document).scroll(function () {
        var scrollTop = $(document).scrollTop();
        if (scrollTop > 200) {
            $("#fixed-head").css('display', 'block');
            if (animateFlag) {
                animateFlag = 0;
                $("#fixed-head").stop();
                $("#fixed-head").animate({
                    'top': '0px'
                }, 500);
            }
        } else {
            $("#fixed-head").css('display', 'none');
            if (animateFlag == 0) {
                animateFlag = 1;
                $("#fixed-head").stop();
                $("#fixed-head").animate({
                    'display': 'none',
                    'top': '-60px'
                }, 500);
            }
        }
    });


    pageLoad();
    //����ղ�
    $('.list-but .collect').live('click',function(){
        var _this = $(this);
        var h = $(this);
        var f = h.offset().left;
        var d = h.offset().top;
        var picid = $(this).attr('picid');
        var is58pic = $(this).attr('isfrom');
        if ($(this).hasClass('cancle-collect')) {//ȡ���ղ�
            $("#coll-prompt").css({
                top: d + "px",
                left: f - 5 + "px",
                position: "absolute"
            }).show().animate({
                top: "-=80px"
            }, 200);
            $("#coll-prompt").css('z-index',10);
            $("#coll-prompt .sure").attr('data-id', $(this).attr('picid'));
            $("#coll-prompt .sure").attr('picid', picid);
        } else { //�ղ�

            if (!(picid > 0)) {
                alert('�ղ�ʧ��');
                return false;
            }
            $.ajax({
                type: 'get',
                jsonp: 'callback',
                dataType: 'jsonp',
                url: '//tj.ooopic.com/api/api.2013.php?action=sc&picid=' + picid+'&classid='+is58pic,
                success: function (data) {
                    if (data.data == 1) {
                        $('.addjian[picid='+picid+']').html(parseInt($('.addjian[picid='+picid+']').html())+1);
                        $(".coll-success").css({
                            top: d + "px",
                            left: f - 5 + "px",
                            position: "absolute"
                        }).show().animate({
                            top: "-=65px"
                        }, 200);
                        setTimeout(function () {
                            $(".coll-success").hide();
                        }, 1000);
                        _this.addClass('cancle-collect').text('ȡ���ղ�');

                    } else if (data.data == -1) {
                        $(".coll-login").css({
                            top: d + "px",
                            left: f - 5 + "px",
                            position: "absolute"
                        }).show().animate({
                            top: "-=65px"
                        }, 200);
                        //��ʾ�°��¼
                        //newLogin();
                        setTimeout(function () {
                            $(".coll-login").hide();
                        }, 1000);
                    }
                }
            });

        }

    });

    //ȷ��ȡ���ղ�
    $('#coll-prompt').on('click', '.sure', function () {
        $('#coll-prompt').hide();
        //var picid = $('#coll-prompt').attr('picid');
        var picid = $(this).attr('picid');
        var h = $('.collect[picid="' + picid + '"]');
        var f = h.offset().left;
        var d = h.offset().top;

        h.text('�ղ�').removeClass('cancle-collect');
        $(".coll-cancel").css({
            top: d + "px",
            left: f - 5 + "px",
            position: "absolute"
        }).show().animate({
            top: "-=5px"
        }, 200);
        setTimeout(function () {
            $(".coll-cancel").hide();
        }, 1000);
        cancleScPic(picid);
    });

    function cancleScPic(picid) {
        if (!(picid > 0)) {
            alert('ȡ���ղ�ʧ��');
        }
        $.ajax({
            type: 'get',
            jsonp: 'callback',
            dataType: 'jsonp',
            url: '//tj.ooopic.com/api/api.2013.php?action=canclesc&picid=' + picid,
            success: function (data) {
                $('.addjian[picid='+picid+']').html(parseInt($('.addjian[picid='+picid+']').html())-1);
            }
        });
    }

    //ȡ��
    $('#coll-prompt').on('click', '.cancle', function () {
        $('#coll-prompt').hide();
    });


    $(".header input").on('click', function (e) {
        if($(this).val() != ''){
            $(".searchHistory").hide();
        }
        else{
            $(".searchHistory").show();
        }
        return false;
    });

    $('.header .search_btn').click(function(){
        goSearch(0,$('.header .search-input'));
    });
    $('.fixed-header .search_btn').click(function(){
        goSearch(0,$('.fixed-header .search-input'));
    });

    $(".fixed-header input").on('click', function (e) {
        if($(this).val() != ''){
            $(".searchRe").hide();
        }
        else{
            $(".searchHistory").hide();
            $(".searchRe").css('display', 'block');
        }
        return false;
    });

    $(document).on('click', function (e) {
        e.stopPropagation();
        $('.hot_list').hide();
        $(".searchHistory").hide();
        $(".searchRe").hide();
    });

    $(".header input").focus(function (e) {
        var hot_list = $(this).parents('.searchInput').eq(0).nextAll('.hot_list').eq(0);
        e.stopPropagation();
        var timeout;
        var nowplace = -1;
        var nowplace1 = -1;
        var _this = $(this);
        $(this).on('keyup', function (e) {
            e.stopPropagation();
            clearTimeout(timeout);
            if ((e.keyCode == "38" || e.keyCode == "40") && ($(this).val() == '' || nowplace1 >=0)) {
                var nowplaceLimit1 = $('.a_list').size() - 1;
                if (e.keyCode == "38" || e.keyCode == "40") {
                    if (e.keyCode == "38") {
                        if (nowplace1 == "-1" || nowplace1 == "0") {
                            nowplace1 = nowplaceLimit1;
                        } else {
                            nowplace1 = nowplace1 - 1;
                        }
                    } else {
                        if (nowplace1 == nowplaceLimit1) {
                            nowplace1 = 0;
                        } else {
                            nowplace1 = nowplace1 + 1;
                        }
                    }
                    _this.val($('.a_list').eq(nowplace1).html());
                    $('.a_list').eq(nowplace1).parents('.sokeyup_1').eq(0).css('background', 'rgb(235, 235, 235)').siblings().css('background', 'rgb(255, 255, 255)');
                }else if (e.keyCode == "13") {
                    goSearch(0, _this);
                }
            } else {
                if(_this.val() == ''){
                    hot_list.hide();
                    $(".searchHistory").show();
                }else {
                    $(".searchHistory").hide();
                    var nowplaceLimit = hot_list.children('.sokeyup_1').size() - 1;
                    if (e.keyCode == "38" || e.keyCode == "40") {
                        if (e.keyCode == "38") {
                            if (nowplace == "-1" || nowplace == "0") {
                                nowplace = nowplaceLimit;
                            } else {
                                nowplace = nowplace - 1;
                            }
                        } else {
                            if (nowplace == nowplaceLimit) {
                                nowplace = 0;
                            } else {
                                nowplace = nowplace + 1;
                            }
                        }
                        $(this).val(hot_list.children('.sokeyup_1').eq(nowplace).find('.sokeyup_2').eq(0).html());
                        hot_list.children('.sokeyup_1').eq(nowplace).css('background', 'rgb(235, 235, 235)').siblings().css('background', 'rgb(255, 255, 255)');
                        return false;
                    } else if (e.keyCode == "13") {
                        goSearch(0, _this);
                    }
                }

                timeout = setTimeout(function () {
                    var val = _this.val();
                    $.ajax({
                        url: '//so.ooopic.com/cueWord.php',
                        type: 'GET',
                        jsonp: 'callback',
                        dataType: 'jsonp',
                        data: {kw: val},
                        success: function (data) {
                            if (data == "") {
                                hot_list.hide();
                            } else {
                                hot_list.show().html(data);
                                $(".searchHistory").hide();
                                nowplace = -1;
                            }
                        }
                    });
                }, 100);
            }
        });
        timeout2 = setTimeout(function () {
            var val = _this.val();
            $.ajax({
                url: '//so.ooopic.com/cueWord.php',
                type: 'GET',
                jsonp: 'callback',
                dataType: 'jsonp',
                data: {kw: val},
                success: function (data) {
                    if (data == "") {
                        hot_list.hide();
                    } else {
                        hot_list.show().html(data);
                        $(".searchHistory").hide();
                        nowplace = -1;
                    }
                }
            });
        }, 100);

    });

    $(".fixed-header input").focus(function (e) {
        var hot_list = $(this).parents('.searchInput').eq(0).nextAll('.hot_list').eq(0);
        e.stopPropagation();
        var timeout;
        var nowplace = -1;
        var nowplace1 = -1;
        $(this).on('keyup', function (e) {
            var _this = $(this);
            e.stopPropagation();
            clearTimeout(timeout);
            if ((e.keyCode == "38" || e.keyCode == "40") && ($(this).val() == '' || nowplace1 >=0)) {
                var nowplaceLimit1 = $('.aa_list').size() - 1;
                if (e.keyCode == "38" || e.keyCode == "40") {
                    if (e.keyCode == "38") {
                        if (nowplace1 == "-1" || nowplace1 == "0") {
                            nowplace1 = nowplaceLimit1;
                        } else {
                            nowplace1 = nowplace1 - 1;
                        }
                    } else {
                        if (nowplace1 == nowplaceLimit1) {
                            nowplace1 = 0;
                        } else {
                            nowplace1 = nowplace1 + 1;
                        }
                    }
                    _this.val($('.aa_list').eq(nowplace1).html());
                    $('.aa_list').eq(nowplace1).parents('.sokeyup_1').eq(0).css('background', 'rgb(235, 235, 235)').siblings().css('background', 'rgb(255, 255, 255)');
                }else if (e.keyCode == "13") {
                    goSearch(0, _this);
                }
            }else{
                if(_this.val() == ''){
                    hot_list.hide();
                    $(".searchRe").show();
                }else {
                    var nowplaceLimit = hot_list.children('.sokeyup_1').size() - 1;
                    if (e.keyCode == "38" || e.keyCode == "40") {
                        if (e.keyCode == "38") {
                            if (nowplace == "-1" || nowplace == "0") {
                                nowplace = nowplaceLimit;
                            } else {
                                nowplace = nowplace - 1;
                            }
                        } else {
                            if (nowplace == nowplaceLimit) {
                                nowplace = 0;
                            } else {
                                nowplace = nowplace + 1;
                            }
                        }
                        $(this).val(hot_list.children('.sokeyup_1').eq(nowplace).find('.sokeyup_2').eq(0).html());
                        hot_list.children('.sokeyup_1').eq(nowplace).css('background', 'rgb(235, 235, 235)').siblings().css('background', 'rgb(255, 255, 255)');
                        return false;
                    } else if (e.keyCode == "13") {
                        goSearch(0, _this);
                    }
                }
                timeout = setTimeout(function () {
                    var val = _this.val();
                    $.ajax({
                        url: '//so.ooopic.com/cueWord.php',
                        type: 'GET',
                        jsonp: 'callback',
                        dataType: 'jsonp',
                        data: {kw: val},
                        success: function (data) {
                            // console.log(data);
                            if (data == "") {
                                hot_list.hide();
                            } else {
                                hot_list.show().html(data);
                                $(".searchRe").hide();
                                nowplace = -1;
                            }
                        }
                    });
                }, 100);
            }
        })
    });


        $(".search-input").on('blur',function(e) {
             $(this).css('color','#b2b2b2');
        })
        //���ʶ���
        $("#back-ToTop").bind("click", function(){
            var _this = $(this);
            $('html,body').animate({ scrollTop: 0 }, 500 ,function(){});
            return false;
        });

    //===========================�ж��====================================
    $(".top-ad  .close-icon").click(function(){
        $(".top-ad").slideUp(400);
    });
    //========================================================================

})

////////////////////////////////////������js
function fromTop(enter,page){
    var url = 'http://www.ooopic.com/active/ThankActive.php?enter='+enter+'&page='+page;
    $('.top-ad a').attr('href',url);
}
function fromRight(enter,page){
    var url = 'http://www.ooopic.com/active/ThankActive.php?enter='+enter+'&page='+page;
    $('.sidebar .active-gif a').attr('href',url);
}
////////////////////////////////////////

function hideDiv() {
    $(".searchHistory").hide();
    $(".hot_list").hide();
}
function goSearch(type, kwID) {

    var from = arguments[0];

    var kw;

    kw = kwID.val();

    defaultkw = kwID.attr('defaultv');

    if (kw == '') {
        alert("������Ҫ���ҵĹؼ���");
        kwID.focus();
        return false;
    } else {
        /*
         var pattern = /���/;
         if(pattern.test(kw)){
         kw = encodeURI(kw);
         location.href = "//so.ooopic.com/search-"+kw+"-0-_____37_oo__.html";
         return false;
         }
         */

        kw = encodeURI(kw);
        var r = new Date();
        r = r.getTime();
        var url = "//so.ooopic.com/jumpkid.php?kw=" + kw + "&r=" + r + "&lx=keywordid&callback=?";
        $.getJSON(url, function (date) {
            date = date.split('|');
            if (date[0] > 0) {

                if (date[1] == -15 || date[1] > 0) {
                    location.href = "//so.ooopic.com/sousuo/" + date[0] + "/";
                } else {
                    location.href = "//so.ooopic.com/search-" + date[2] + "-" + date[1] + "-0_0____0_ooo_0_1_0.html";
                    //location.href = "//so.ooopic.com/search-" + date[2] + "-" + date[1] + "-0_0____0_ooo_0_1_0.html?tt="+date[0];
                }
            } else {
                location.href = "//so.ooopic.com/search-" + kw + "-" + type + "-______oo__.html";
            }
        });

    }
}
/*�ײ�*/
function pageLoad(){
    var endT=new Date();
    var endTime=endT.getTime();
    obj.loadTime=(endTime-beginTime)/1000;
    $("#opentime").html(" " + obj.loadTime + "");
}

function PVTJ(){
    $.getJSON("//tj.ooopic.com/index.php?m=pagePVTJ&picid="+obj.picid+"&exeCode="+obj.exeCode+"&exeTime="+obj.exeTime+"&loadCode="+obj.loadCode+"&loadTime="+obj.loadTime+"&kid="+obj.kid+"&bigclassid="+obj.bigclassid+"&smallclassid="+obj.smallclassid+"&page="+obj.page+"&callback=?&time="+(new Date()).getTime());

    if(isHasParam()){
       return false;
    }
    // �ٶ�ͳ��
    var hm = document.createElement("script");
    hm.src = "https://hm.baidu.com/hm.js?6260fe7b21d72d3521d999c79fe01fc7";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(hm, s);
    $("img[src='http://eiv.baidu.com/hmt/icon/21.gif']").hide();

    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?5b1cb8ea5bd686369a321f1c5e6408b6";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    var countshu = $('#wrap').attr('count');
    if(countshu!=0){
        (function(){
            var bp = document.createElement('script');
            var curProtocol = window.location.protocol.split(':')[0];
            if (curProtocol === 'https') {
                bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
            }
            else {
                bp.src = 'http://push.zhanzhang.baidu.com/push.js';
            }
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(bp, s);
        })();
    }
    ////360�����Զ���¼JS����
    //var code360 = document.createElement("script");
    //code360.src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?"+obj.code360:"https://jspassport.ssl.qhimg.com/11.0.1.js?"+obj.code360;
    //var d360 = document.getElementsByTagName("script")[0];
    //d360.parentNode.insertBefore(code360, d360);
    //var _t360 = _t360 || [];
    //(function() {
    //    var code360 = document.createElement("script");
    //    code360.src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?"+obj.code360:"https://jspassport.ssl.qhimg.com/11.0.1.js?"+obj.code360;
    //    var d360 = document.getElementsByTagName("script")[0];
    //    d360.parentNode.insertBefore(code360, d360);
    //})();

    //360�����Զ���¼JS����
    var code360 = document.createElement("script");
    code360.setAttribute("id","sozz");
    code360.src = (document.location.protocol == "http:") ? "http://s2.qhimg.com/static/ab77b6ea7f3fbf79.js?"+obj.code360:"//s.ssl.qhres.com/ssl/ab77b6ea7f3fbf79.js?"+obj.code360;
    var d360 = document.getElementsByTagName("script")[0];
    d360.parentNode.insertBefore(code360, d360);

}

function CateLoadTJ(exeCode,loadCode){
    $.getJSON("//tj.ooopic.com/index.php?m=pagePVTJ&picid="+obj.picid+"&exeCode="+exeCode+"&exeTime="+obj.exeTime+"&loadCode="+loadCode+"&loadTime="+obj.loadTime+"&kid="+obj.kid+"&bigclassid="+obj.bigclassid+"&smallclassid="+obj.smallclassid+"&page="+obj.page+"&callback=?&time="+(new Date()).getTime());
}
function PageLoadTJ(exeCode,loadCode,page){
    $.getJSON("//tj.ooopic.com/index.php?m=pagePVTJ&picid="+obj.picid+"&exeCode="+exeCode+"&exeTime="+obj.exeTime+"&loadCode="+loadCode+"&loadTime="+obj.loadTime+"&kid="+obj.kid+"&bigclassid="+obj.bigclassid+"&smallclassid="+obj.smallclassid+"&page="+page+"&callback=?&time="+(new Date()).getTime());
}

function isHasParam()    {
    var href = window.location.href;
    if(href.indexOf("Track")>0){
        return false;
    }else if(href.indexOf("?")>0){
        return true;
    }else{
        return false;
    }
}
