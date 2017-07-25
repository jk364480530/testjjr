/**
 * Created by Administrator on 2017/4/21.
 */

layui.use(['form','layer','jquery','element'],function() {
    var form = layui.form(),
        layer = layui.layer,
        $ = layui.jquery,
        element = layui.element();

    // 监听全选事件
    form.on('checkbox(check_all)', function(data){
        var child = $('#user_list').find('input[type=checkbox]');
        child.each(function(index, item){
            item.checked = data.elem.checked
        });
        form.render('checkbox');
    });
    // 监听反选事件
    form.on('checkbox(select_invert)', function(data){
        var child = $('#user_list').find('input[type=checkbox]');
        child.each(function(index, item){
            if(item.checked==false){
                item.checked=true;
            }else{
                item.checked=false;
            }
        });
        form.render('checkbox');
    });
    //分组添加用户
    form.on('submit(add_user)',function(data){
        var group_id =data.field.group_id;
        var child = $('#user_list').find('input[name="user_id"]');
        var str ="";
        child.each(function(index, item){
            if(item.checked){
                str+= $(item).val()+',';
            }
        });
        $.ajax({
            url:'/power/add_user',
            data:{group_id:group_id,user_id:str},
            type:'post',
            dataType:'json',
            success:function(data){
                if(data.code==201){
                    layer.open({
                        type:0,
                        title:'成功提示',
                        icon:1,
                        end:function(){
                            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                            if (index === undefined){
                                window.location.reload();
                            }else{
                                parent.layer.close(index); //再执行关闭
                                parent.window.location.reload();
                            }
                        },
                        content:data.msg
                    })
                }else{
                    layer.open({
                        type:0,
                        title:'失败提示',
                        icon:5,
                        content:data.msg
                    })
                }
            },
            error:function(data){
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
