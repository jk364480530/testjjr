/**
 * Created by John on 2017/5/15.
 */
layui.use(['form','jquery','layer'],function() {
    var form = layui.form(),
        layer = layui.layer,
        $ = layui.jquery;

    form.on('submit(buy_gold)',function(data){
        var field=data.field;
        $.ajax({
            url:'/user/buy_gold',
            data:field,
            type:'post',
            dataType:'json',
            success:function(msg){
                if(msg.code==201){
                   layer.confirm('恭喜您购买成功',{
                       btn:['继续','发布任务']
                   },function(){
                       window.location.reload();
                       },function(){
                       window.location.href='/task/add_task';
                       }
                   )
                }else{
                    layer.msg(msg.msg,{time:1000,icon:5})
                }
            },
            error:function(msg){
                layer.msg('网络超时！',{time:3000,icon:5})
            }
        });
        return false;
    });
});

//计算最大可以购买多少镖局币
function max_b(obj,balance){
    var bjb =$(obj).val();
    if(bjb*2>balance){
        layer.msg('不能超出余额',{time:1000,icon:5});
        $(obj).val(balance*2);
    }
}