<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>登录</title>
        <link rel="stylesheet" href="<?= config_item('domain_static') ?>common/layui/css/layui.css" media="all" />
        <link rel="stylesheet" href="<?= config_item('domain_static') ?>admin/css/login.css" />
    </head>
    <body class="beg-login-bg" style="background: url('<?=config_item('domain_static')?>admin/images/login_bg.jpg') no-repeat center center fixed;">
        <div class="beg-login-box">
            <header>
                <img src="<?=config_item('domain_static')?>admin/images/logo.png" alt="">
<!--                <h1>麻麻镖局后台</h1>-->
            </header>
            <div class="beg-login-main">
                <form action="" method="post">
                    <div class="layui-form-item">
                        <label class="beg-login-icon">
                            <i class="layui-icon">&#xe612;</i>
                        </label>
                        <input type="text" name="phone" autocomplete="off" placeholder="输入登录名" class="layui-input" value="18074900075">
                    </div>
                    <div class="layui-form-item">
                        <label class="beg-login-icon">
                            <i class="layui-icon">&#xe642;</i>
                        </label>
                        <input type="password" name="passwd" autocomplete="off" placeholder="输入密码" class="layui-input" value="12345678">
                    </div>
                    <div class="layui-form-item">
                        <div class="beg-pull-right">
                            <button id="login_post" class="layui-btn layui-btn-primary" lay-submit lay-filter="login">
                                <i class="layui-icon">&#xe650;</i> 登录
                            </button>
                        </div>
                        <div class="beg-clear"></div>
                    </div>
                </form>
            </div>
            <footer>
                <p>copyright © www.almmbj.com</p>
            </footer>
        </div>
        <script type="text/javascript" src="<?= config_item('domain_static') ?>common/javascript/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?= config_item('domain_static') ?>common/layui/layui.js"></script>
        <script type="text/javascript" src="<?= config_item('domain_static') ?>admin/js/login.js"></script>
        <script type="text/javascript" src="<?= config_item('domain_static') ?>common/javascript/md5.js"></script>

    </body>

</html>