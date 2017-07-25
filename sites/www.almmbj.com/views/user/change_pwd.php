<?php $this->load->view('user/user_header')?>
        <div class="site-content">
            <h1 class="site-h1">修改密码</h1>
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">原密码:</label>
                        <div class="layui-input-inline">
                            <input type="password" name="old_pwd" lay-verify="required" value=""  placeholder="请输入原密码" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">新密码:</label>
                        <div class="layui-input-inline">
                            <input type="password" name="new_pwd" lay-verify="required|new" value="" placeholder="请输入新密码" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">重复新密码:</label>
                        <div class="layui-input-inline">
                            <input type="password" name="renew_pwd" lay-verify="required|renew" value="" placeholder="请重复新密码" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="change_pwd">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
<script src="<?=config_item('domain_static')?>home/js/user/change_pwd.js"></script>
<?php $this->load->view('user/user_footer')?>