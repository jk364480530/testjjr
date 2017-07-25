<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>妈妈镖局后台</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="<?= config_item('domain_static') ?>common/layui/css/layui.css" media="all" />
        <link rel="stylesheet" href="<?= config_item('domain_static') ?>admin/css/global.css" media="all">
        <link rel="stylesheet" href="<?= config_item('domain_static') ?>admin/font-awesome/css/font-awesome.css">
    </head>
    <body>
        <div class="layui-layout layui-layout-admin" style="border-bottom: solid 5px #1aa094;">
            <div class="layui-header header header-demo">
                <div class="layui-main">
                    <div class="admin-login-box">
                        <a class="logo" style="left: 0;">
                            <img src="<?= config_item('domain_static') ?>admin/images/logo.png">
                        </a>
                        <div class="admin-side-toggle">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                    </div>
                    <ul class="layui-nav admin-header-item">
                        <li class="layui-nav-item">
                            <a href="<?= config_item('domain_www') ?>">麻麻镖局首页</a>
                        </li>
                        <li class="layui-nav-item">
                            <a href="javascript:;" class="admin-header-user">
                                <img src="<?= config_item('domain_static') ?>admin/images/logo.jpg" />
                                <span>JJR</span>
                            </a>
                            <dl class="layui-nav-child">
                                <dd>
                                    <a href=""><i class="fa fa-user-circle" aria-hidden="true"></i> 个人信息</a>
                                </dd>
                                <dd>
                                    <a href="javascript:void(0);" class="set_pwd" data-url="/user/change_pwd" title="修改密码"><i class="fa fa-gear" aria-hidden="true"></i>修改密码</a>
                                </dd>
                                <dd>
                                    <a href="/home/admin_exit"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销账号</a>
                                </dd>
                            </dl>
                        </li>
                    </ul>
                    <ul class="layui-nav admin-header-item-mobile">
                        <li class="layui-nav-item">
                            <a href="/home/admin_exit"><i class="fa fa-sign-out" aria-hidden="true"></i> 注销</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="layui-side layui-bg-black" id="admin-side">
                <div class="layui-side-scroll" id="admin-navbar-side" lay-filter="side"></div>
            </div>
            <div class="layui-body" style="bottom: 0;border-left: solid 2px #1AA094;" id="admin-body">
                <div class="layui-tab admin-nav-card layui-tab-brief" lay-filter="admin-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">
                            <i class="fa fa-dashboard" aria-hidden="true"></i>
                            <cite>后台首页</cite>
                        </li>
                    </ul>
                    <div class="layui-tab-content" style="min-height: 150px;">
                        <div class="layui-tab-item layui-show">
                            <iframe src=" " id="main_iframe"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-footer footer footer-demo" id="admin-footer">
                <div class="layui-main">
                    <p>2017-2020 &copy;<a href="<?= config_item('domain_www') ?>">didi.com</a> copyright didi.com
                    </p>
                </div>
            </div>
            <div class="site-tree-mobile layui-hide">
                <i class="layui-icon">&#xe602;</i>
            </div>
            <div class="site-mobile-shade"></div>
            <script type="text/javascript" src="<?= config_item('domain_static') ?>common/javascript/jquery-3.2.1.min.js"></script>
            <script type="text/javascript" src="<?= config_item('domain_static') ?>common/layui/layui.js"></script>
            <script>
                var tab;
                layui.config({
                    base: "<?= config_item('domain_static') ?>admin/js/",
                    version: new Date().getTime()
                }).use(['element', 'layer', 'navbar', 'tab'], function() {
                    var element = layui.element(),
                            $ = layui.jquery,
                            layer = layui.layer,
                            navbar = layui.navbar();
                    tab = layui.tab({
                        elem: '.admin-nav-card' //设置选项卡容器
                        ,
                        contextMenu: true,
                        onSwitch: function(data) {
                            console.log(data.id); //当前Tab的Id
                            console.log(data.index); //得到当前Tab的所在下标
                            console.log(data.elem); //得到当前的Tab大容器
                            console.log(tab.getCurrentTabId());
                        }
                    });
                    //iframe自适应
                    $(window).on('resize', function() {
                        var $content = $('.admin-nav-card .layui-tab-content');
                        $content.height($(this).height() - 147);
                        $content.find('iframe').each(function() {
                            $(this).height($content.height());
                        });
                    }).resize();

                    //获取导航列表
                    var navs="";
                    $.ajax('/main/menu',{
                        dataType: 'json',
                        error: function () {
                            return false;
                        },
                        success: function (data) {
                        //console.log(data);
                            set_navbar(data);
                        }
                    });

                    function set_navbar(navs){
                        //设置navbar
                        navbar.set({
                            spreadOne: true,
                            elem: '#admin-navbar-side',
                            cached: true,
                            data: navs
                        });
                        //渲染navbar
                        navbar.render();
                        //监听点击事件
                        navbar.on('click(side)', function(data) {
                            tab.tabAdd(data.field);
                        });
                    }

                    //设置密码
                    $('.set_pwd').on('click',function(){
                        var url=$(this).attr('data-url');
                        var title=$(this).attr('title');
                        var data ={href:url,title:title,icon:"fa-cubes"};
                        tab.tabAdd(data);
                    });

                    $('.admin-side-toggle').on('click', function() {
                        var sideWidth = $('#admin-side').width();
                        if (sideWidth === 200) {
                            $('#admin-body').animate({
                                left: '0'
                            });
                            $('#admin-footer').animate({
                                left: '0'
                            });
                            $('#admin-side').animate({
                                width: '0'
                            });
                        } else {
                            $('#admin-body').animate({
                                left: '200px'
                            });
                            $('#admin-footer').animate({
                                left: '200px'
                            });
                            $('#admin-side').animate({
                                width: '200px'
                            });
                        }
                    });
                    //手机设备的简单适配
                    var treeMobile = $('.site-tree-mobile'),
                        shadeMobile = $('.site-mobile-shade');
                    treeMobile.on('click', function() {
                        $('body').addClass('site-mobile');
                    });
                    shadeMobile.on('click', function() {
                        $('body').removeClass('site-mobile');
                    });
                });
            </script>
        </div>
    </body>

</html>