<?php $this->load->view('public/header')?>
<form class="layui-form site-block" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">原密码：</label>
        <div class="layui-input-inline">
            <input type="password" name="old_pwd" value="" lay-verify="required" autocomplete="off" class="layui-input" placeholder="请输入原密码">
        </div>
        <div class="layui-form-mid layui-word-aux">必须</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">新密码：</label>
        <div class="layui-input-inline">
            <input name="new_pwd" type="password" lay-verify="required|is_change" value="" autocomplete="off" class="layui-input" placeholder="请输入新密码">
        </div>
        <div class="layui-form-mid layui-word-aux">必须</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">重复密码：</label>
        <div class="layui-input-inline">
            <input name="renew_pwd" type="password" value="" lay-verify="required|is_same" autocomplete="off" class="layui-input" placeholder="请重复新密码">
        </div>
        <div class="layui-form-mid layui-word-aux">必须</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-inline">
            <button class="layui-btn" lay-submit="" lay-filter="change_pwd">立即修改</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    layui.use(['layer','form','jquery'],function(){
        var form=layui.form();
            layer=layui.layer,
            $ =layui.jquery;

        //自定义验证规则
        form.verify({
            is_change:function(value){
                var old_pwd=$('input[name=old_pwd]').val();
                if(value==old_pwd){
                    return '密码没有修改';
                }
            },
            is_same: function(value){
                var new_pwd =$('input[name=new_pwd]').val();
                if(value!=new_pwd){
                    return '两次输入的密码不一致';
                }
            }
        });

        //提交修改密码
            form.on('submit(change_pwd)',function(data){
                var field= data.field;
                var old_pwd = hex_md5(data.field.old_pwd);
                var new_pwd = hex_md5(data.field.new_pwd);
                var renew_pwd = hex_md5(data.field.renew_pwd);
                $.ajax({
                    url:'/user/change_pwd',
                    data:{old_pwd:old_pwd,new_pwd:new_pwd,renew_pwd:renew_pwd},
                    type:'post',
                    dataType:'json',
                    success:function(msg){
                        if(msg.code==201){
                            layer.open({
                                type:0,
                                title:'成功提示',
                                icon:1,
                                end:function(){
                                    parent.window.location.href="/home/admin_exit";
                                },
                                content:msg.msg
                            });

                        }else{
                            layer.open({
                                type:0,
                                title:'失败提示',
                                icon:5,
                                content:msg.msg
                            });
                        }
                    },
                    error:function(msg){
                        layer.open({
                            type:0,
                            title:'网络错误',
                            icon:5,
                            content:'网络超时！'
                        })
                    }
                });
                return false;
            });

    });
</script>
<?php $this->load->view('public/footer')?>
