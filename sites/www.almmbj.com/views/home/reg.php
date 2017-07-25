<?php $this->load->view('public/header');?>
    <div class="layui-main user reg" style="height: 874px;background:url('<?=config_item('domain_static')?>home/images/home/reg_bg.jpg');">
    <div class="layui-clear main">
        <h2 class="page-title">用户注册</h2>
        <div class="layui-form layui-form-pane">
            <form class="layui-form" action="" method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">手机</label>
                    <div class="layui-input-block">
                        <input class="layui-input" id="tel" name="tel" placeholder="手机号码" type="text" required="" lay-verify="phone" autocomplete="off" value="">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                        <input class="layui-input" id="pass" name="pass" placeholder="登陆密码" type="password" required="" lay-verify="required|pass" autocomplete="off">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">确认密码</label>
                    <div class="layui-input-block">
                        <input class="layui-input" id="re_pass" name="re_pass" placeholder="确认密码" type="password" required="" lay-verify="required|pass|repass" autocomplete="off">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">QQ</label>
                    <div class="layui-input-block">
                        <input class="layui-input" id="qq" name="tx_qq" placeholder="QQ号" type="text" required="" lay-verify="QQ|required" autocomplete="off">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-block">
                        <input class="layui-input" id="email" name="email" placeholder="电子邮箱" type="email" required="" lay-verify="email" autocomplete="off">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">验证码</label>
                    <div class="layui-input-block">
                        <input class="layui-input" style="width:150px;display:inline-block;" id="code" name="code" placeholder="验证码" type="text" required="" lay-verify="required" value="">
<!--                        <button type="button" class="layui-btn layui-btn-normal tel-btn" action="/user/reg/code">获取验证码</button>-->
                            <img src="/home/code"  style="height:38px;" onclick="change_code(this);" alt="验证码" id="code_img">
                            <input type="hidden" name="code_id" value="" id="code_id">
                        <script>
                            // 点击切换验证码
                            function change_code(obj){
                                 var num =Math.random();
                                 $(obj).attr('src','/home/code?id='+num);
                                 $('#code_id').val(num);
                            }
                        </script>
                    </div>
                </div>
                <div class="layui-form-item">
				    <span class="tk" style="float: left;">
					<label>
                        <input name="tk" type="checkbox" value="ok" checked="" lay-verify="terms">
                        <div class="layui-unselect layui-form-checkbox layui-form-checked">
                            <span>勾选</span>
                            <i class="layui-icon"></i>
                        </div>
                        我已阅读并同意<a style="font-size: 14px; color: #2196f3;" target="_blank" href="/opt/index/3">《阿里妈妈镖局服务条款》</a></label>
				    </span>
                    <span style="float: right;">
					已有账号？ <a href="/home/login">点击登录</a>
				    </span>
                </div>
                <div class="layui-form-item">
                    <button id="mm_reg" class="layui-btn layui-btn-big" style="width: 100%" lay-filter="reg" lay-submit="">立即注册</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?=config_item('domain_static')?>home/js/reg.js"></script>
<?php $this->load->view('public/footer');?>