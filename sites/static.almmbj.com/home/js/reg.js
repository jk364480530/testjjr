/**
 * Created by John on 2017/3/26.
 */
layui.use(['form','jquery','layer'],function(){
    var form = layui.form(),
        layer = layui.layer,
        $ =layui.jquery

   //表单验证
    form.verify({
        pass: [/(.+){6,12}$/, '密码必须6到12位'],
        repass: function(value){
        var pass =$('#pass').val();
        if(value!=pass){
            return '前后密码不一致';
        }

    },
        terms:function (value) {
        if(!value ){
            return '服务款项必须选择';
        }
         },
        QQ:[/^\d{5,10}$/, '请输入正确的QQ号码']
    });

    //提交表单
    form.on('submit(reg)',function(data){
        var field =data.field;
        field.pass=hex_md5(field.pass);
        field.re_pass=hex_md5(field.re_pass);
        $.ajax({
            type:'post',
            url:'/home/reg',
            data:field,
            dataType:'json',
            success: function(msg){
                if(msg.code == 201){
                    layer.msg(msg.msg,{icon: 1,time:1000,offset: '30%'},function(){
                        window.location.href=msg.data.url;
                    })

                }else{
                    layer.alert(msg.msg,{icon: 2});
                }
            },
            error:function(msg){
                layer.open({
                    type:0,
                    title:"错误提示",
                    icon:5,
                    content:'网络错误'

                })
            }
        })
        return false;
    })

})
