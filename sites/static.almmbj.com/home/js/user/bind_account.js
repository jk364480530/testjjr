/**
 * Created by John on 2017/4/27.
 */
layui.use(['form','jquery','layer','element'],function() {
    var form = layui.form(),
        layer = layui.layer,
        element = layui.element(),
        $ = layui.jquery;
    //表单验证
    form.verify({

    });
    form.on('submit(bind)',function(data){
        var field=data.field;
        $.ajax({
            url:'/user/bind_account',
            data:field,
            type:'post',
            dataType:'json',
            success:function(msg){
            if(msg.code==201){
                var str="";
                var lay_id='';
                var account_type='';
                str+='<tr>';
                str+='<td>'+msg.data.area_name+'</td>';
                str+='<td>'+msg.data.account+'</td>';

                if(msg.data.type==2){
                    str+='<td>任务号</td>';
                    layid=333;
                    account_type=$('#buy_account');
                    if(msg.data.account_status==1){
                        str+='<td>正常</td>';
                    }else{
                        str+='<td>任务进行中</td>';
                    }

                }else{
                    str+='<td>掌柜号</td>';
                    layid=444;
                    account_type=$('#release_account');
                }

                str+='<td>'+msg.data.add_time+'</td>';
                str+='<td><a href="javascript:void(0)" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del_account(this,'+msg.data.id+');"> <i class="layui-icon">&#xe640;</i> 删除 </a> </td>';
                str+='</tr>';
                account_type.append(str);
                layer.confirm('绑定成功继续绑定吗？', {
                    btn: ['继续','去账号列表'] //按钮
                }, function(){
                    layer.closeAll();
                    window.location.reload();
                }, function(){
                    element.tabChange('account', layid);
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
//删除账号
function del_account(obj,id){
    layer.confirm('您确定要删除账号吗？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        $.ajax({
            url:'/user/del_account',
            data:{account_id:id},
            type:'post',
            dataType:'json',
            success:function(data){
                if(data.code==201){
                    layer.msg(data.msg,{
                        time:2000,
                        icon:6,
                        end:function(){
                            $(obj).parent().parent().remove();
                        }
                    })
                }else{
                    layer.msg(data.msg,{time:2000,icon:5})
                }
            },error:function(data){
                layer.msg('网络超时！',{time:3000,icon:5});
            }
        });
    }, function(){
       layer.closeAll();
    });
}