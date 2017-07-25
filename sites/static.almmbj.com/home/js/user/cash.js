/**
 * Created by John on 2017/5/15.
 */
layui.use(['form','jquery','layer'],function() {
    var form = layui.form(),
        layer = layui.layer,
        $ = layui.jquery;

    //表单验证
    form.verify({
        gold:function(value){
           if(value<1){
               return '提现的镖局币不能小于1';
           }
        }
    });
    form.on('submit(cash)',function(data){
        var field=data.field;
        $.ajax({
            url:'/user/cash',
            data:field,
            type:'post',
            dataType:'json',
            success:function(msg){
                if(msg.code==201){
                  layer.msg(msg.msg,{
                      time:1000,
                      end:function(){
                        window.location.reload();
                      },
                      icon:6
                  })
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
function all_cash(obj,gold){
   $('input[name=cash_gold]').val(gold);
}
//最多不超过的镖局币
function max_gold(obj,gold){
    var cash_gold=$(obj).val();

    if(gold<cash_gold){
        $(obj).val(gold);
    }
}