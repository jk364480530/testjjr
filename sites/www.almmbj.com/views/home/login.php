<?php $this->load->view('public/header');?>
    <div class="layui-main user reg" style="height: 874px;background:url('<?=config_item('domain_static')?>home/images/home/reg_bg.jpg');"">
    <div class="layui-clear main">
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
					<span style="float: left;">
					没有账号？ <a href="/home/reg">点击注册</a>
					</span>
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
<script src="<?=config_item('domain_static')?>home/js/login.js"></script>
<?php $this->load->view('public/footer')?>