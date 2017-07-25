/**
 * Created by John on 2017/3/26.
 */

layui.use(['form','jquery','layer'],function(){
    var form = layui.form(),
        layer = layui.layer,
        $ =layui.jquery

    //表单验证
    form.verify({
        // terms:function (value) {
        //     if(!value ){
        //         return '服务款项必须选择';
        //     }
        // }
    });

    //提交表单
    form.on('submit(login)',function(data){
        var field =data.field;
        field.pass=hex_md5(field.pass);
        // console.log(field);
        $.ajax({
            type:'post',
            url:'/home/login',
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