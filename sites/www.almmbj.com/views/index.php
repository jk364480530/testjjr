<?php $this->load->view('public/header');?>
<script type="text/javascript" src="<?=config_item('domain_static')?>lunimg/js/jquery.js"></script>
<script type="text/javascript" src="<?=config_item('domain_static')?>lunimg/js/superslide.2.1.js"></script>

<style type="text/css">
    *{margin:0;padding:0;list-style:none;}
    body{background:#fff;font:normal 12px/22px 宋体;width:100%;}
    img{border:0;}
    a{text-decoration:none;color:#333;}
    a:hover{color:#1974A1;}
    /* fullSlide */
    .fullSlide{width:100%;position:relative;height:410px;background:#000;}
    .fullSlide .bd{margin:0 auto;position:relative;z-index:0;overflow:hidden;}
    .fullSlide .bd ul{width:100% !important;}
    .fullSlide .bd li{width:100% !important;height:410px;overflow:hidden;text-align:center;}
    .fullSlide .bd li a{display:block;height:410px;}
    .fullSlide .hd{width:100%;position:absolute;z-index:1;bottom:0;left:0;height:30px;line-height:30px;}
    .fullSlide .hd ul{text-align:center;}
    .fullSlide .hd ul li{cursor:pointer;display:inline-block;*display:inline;zoom:1;width:42px;height:11px;margin:1px;overflow:hidden;background:#000;filter:alpha(opacity=50);opacity:0.5;line-height:999px;}
    .fullSlide .hd ul .on{background:#f00;}
    .fullSlide .prev,.fullSlide .next{display:block;position:absolute;z-index:1;top:50%;margin-top:-30px;left:15%;z-index:1;width:40px;height:60px;background:url(<?=config_item('domain_static')?>lunimg/images/slider-arrow.png) -126px -137px #000 no-repeat;cursor:pointer;filter:alpha(opacity=50);opacity:0.5;display:none;}
    .fullSlide .next{left:auto;right:15%;background-position:-6px -137px;}
</style>
<div class="site-banner">
    <div class="fullSlide">
        <div class="bd">
            <ul>
                <li _src="url(<?=config_item('domain_static')?>lunimg/images/1.jpg)" style="background:#E2025E center 0 no-repeat;"><a href="#"></a></li>
                <li _src="url(<?=config_item('domain_static')?>lunimg/images/2.jpg)" style="background:#DED5A1 center 0 no-repeat;"><a href="#"></a></li>
                <li _src="url(<?=config_item('domain_static')?>lunimg/images/3.jpg)" style="background:#B8CED1 center 0 no-repeat;"><a href="#"></a></li>

            </ul>
        </div>
        <div class="hd"><ul></ul></div>
        <span class="prev"></span>
        <span class="next"></span>
    </div><!--fullSlide end-->

    <script type="text/javascript">
        $(".fullSlide").hover(function(){
                $(this).find(".prev,.next").stop(true, true).fadeTo("show", 0.5)
            },
            function(){
                $(this).find(".prev,.next").fadeOut()
            });
        $(".fullSlide").slide({
            titCell: ".hd ul",
            mainCell: ".bd ul",
            effect: "fold",
            autoPlay: true,
            autoPage: true,
            trigger: "click",
            startFun: function(i) {
                var curLi = jQuery(".fullSlide .bd li").eq(i);
                if ( !! curLi.attr("_src")) {
                    curLi.css("background-image", curLi.attr("_src")).removeAttr("_src")
                }
            }
        });
    </script>
</div>

<div class="layui-main">
    <div class="site-main">
        <div class="content">
            <h3>为开发者设计的订单数据管理专家，快速搞定收单与统计</h3>
            <p style="color: #535353; font-size: 16px;">支持各种后端语言  接入方法简单</p>
            <div class="item">
                <img src="/packs/skins/images/page-list-01.png">
                <div class="item-text">
                    <p>IOS</p>
                </div>
            </div>
            <div class="item">
                <img src="/packs/skins/images/page-list-02.png">
                <div class="item-text">
                    <p>Andriod</p>
                </div>
            </div>
            <div class="item">
                <img src="/packs/skins/images/page-list-03.png">
                <div class="item-text">
                    <p>移动端网页</p>
                </div>
            </div>
            <div class="item">
                <img src="/packs/skins/images/page-list-04.png">
                <div class="item-text">
                    <p>PC网页</p>
                </div>
            </div>
        </div>
    </div>
    <div class="site-main">
        <div class="content">
            <h3>每笔收入对账清晰，各支付渠道流水可统一，也可分别对账</h3>
            <div class="col-lg-12 col-md-12  col-sm-12 col-xs-12 text-center">
                <div style="width: 950px; height: 289px; margin: 50px auto 0; ">
                    <img src="/packs/skins/images/page-list-06.png" width="100%">
                </div>
            </div>
        </div>
    </div>
    <div class="site-main">
        <div class="content">
            <h3>资金由您所申请的第三方支付公司直接结算，资金安全有保障！</h3>
            <p style="color: #535353; font-size: 16px;">  同时账户余额可提现    10元即提    极速到账</p>
            <div class="text-center">
                <div style="width:561px; height:248px; margin: 50px auto 0; ">
                    <img src="/packs/skins/images/page-list-07.png" width="100%">
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('public/footer');?>
