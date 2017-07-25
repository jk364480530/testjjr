/**
 * Created by John on 2017/5/16.
 */
layui.use(['form','jquery','layer'],function() {
    var form = layui.form(),
        layer = layui.layer,
        $ = layui.jquery;
    //表单验证
    form.verify({
        new:function(value){
            var old_pwd=$('input[name=old_pwd]').val();
            if(old_pwd==value){
                return '没有做任何修改';
            }

            if(!/^\d{6}$/.test(value)){
                return '请输入6位数字的安全密码';
            }
        },
        renew:function (value) {
            var new_pwd =$('input[name=new_pwd]').val();
            if(value!=new_pwd){
                return '两次输入的密码不一致';
            }
        }
    });
    form.on('submit(change_safe_pwd)',function(data){
        var old_pwd =hex_md5(data.field.old_pwd),
            new_pwd= hex_md5(data.field.new_pwd),
            renew_pwd= hex_md5(data.field.renew_pwd);
        $.ajax({
            url:'/user/change_safe_pwd',
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
                            window.location.href="/home/login";
                        },
                        content:msg.msg
                    });
                }else{
                    layer.msg(msg.msg,{time:3000,icon:5})
                }
            },
            error:function(msg){
                layer.msg('网络超时！',{time:3000,icon:5})
            }
        });
        return false;
    });
});