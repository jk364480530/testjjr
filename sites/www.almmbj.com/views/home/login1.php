<html xmlns="//www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>阿里妈妈镖局登录页面</title>
    <script type="text/javascript" src="<?=config_item('domain_static')?>common/javascript/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=config_item('domain_static')?>home/css/login/public.v1.css">
    <link rel="stylesheet" type="text/css" href="<?=config_item('domain_static')?>home/css/login/reg_login.v12.css">
    <link rel="stylesheet" type="text/css" href="<?=config_item('domain_static')?>common/layui/css/layui.css">
    <script src="<?=config_item('domain_static')?>common/layui/layui.js"></script>
    <script src="<?=config_item('domain_static')?>common/javascript/md5.js"></script>
    <style type="text/css">
        .box .layui-clear {
            width: 450px;
            min-height: 200px;
            padding: 1rem 3.25rem 1.2rem;
            background: #fff;
            margin: 0 auto;
            max-width: 450px;
            position: relative;
            top: 60px;
            width: 100%;
            z-index: 5;
            -moz-transition-property: all;
            -o-transition-property: all;
            -webkit-transition-property: all;
            transition-property: all;
            -moz-transition-duration: .3s;
            -o-transition-duration: .3s;
            -webkit-transition-duration: .3s;
            transition-duration: .3s;
        }
        .box .page-title {
            position: relative;
            font-size: 18px;
            margin: 0 0 30px;
            padding: 10px 15px;
            line-height: 30px;
            border-bottom: 1px solid #DFDFDF;
        }
    </style>
</head>
<body>
<div class="box header">
    <div class="box-1000">
        <div class="fl header-logo"><a title="镖局网" href="http://www.almmbj.com">刷拉</a></div>
        <div class="header-reg">还没有账号？&nbsp;<a href="/home/reg">立即注册</a></div>
    </div>
</div>
<div class="box main">
    <div class="box-1000" id="user-reg-mainBox">
        <div class="layui-clear">
            <h2 class="page-title">用户登陆</h2>
            <div class="layui-form">
                <form class="layui-form" action="" method="">
                    <div class="layui-form-item">
                        <label class="layui-form-label">手机：</label>
                        <div class="layui-input-block">
                            <input class="layui-input" id="tel" name="tel" placeholder="手机号码" value="18074900075" type="text" required="" lay-verify="phone" autocomplete="off" value="">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">密码：</label>
                        <div class="layui-input-block">
                            <input class="layui-input" id="pass" name="pass" placeholder="登陆密码"  type="password" value="123456"required="" lay-verify="required" autocomplete="off">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label"></label>
                        <div class="layui-input-block">
                            <input type="checkbox" name="remember" title="是否记住密码" checked="" value="ok">
                            <!--                        <input type="checkbox" name="" value="ok" title="是否为原CSCMS用户"><div class="layui-unselect layui-form-checkbox"><span>是否为原CSCMS用户</span><i class="layui-icon"></i></div>-->
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <span style="float: right;">
					忘记密码？ <a href="/user/pass">点击找回</a>
					</span>
                    </div>
                    <div class="layui-form-item">
                        <button type="submit" class="layui-btn layui-btn-big" style="width: 100%" lay-filter="login" lay-submit="">立即登陆</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?=config_item('domain_static')?>home/js/login.js"></script>
</body></html>