/**
 * Created by Administrator on 2017/4/21.
 */
layui.use(['form','layer','jquery'],function(){
   var form =layui.form(),
       layer=layui.layer,
       $ =layui.jquery;

    form.on('select(nav_pid)',function(data){
        var nav_id = data.value;
        var first_id=data.elem[0].value;
        var current_nav =data.othis.parent().parent();
        console.log(current_nav);
        if(nav_id==first_id){
            current_nav.nextAll().remove();
            $('#nav_pid').val(first_id);
        }else{
            $.ajax({
                url:'/navigate/get_child',
                data:{nav_id:nav_id},
                type:'post',
                dataType:'json',
                success:function(data){
                    // console.log(data);
                    var str="";
                    //console.log(data);
                    str+='<div class="layui-form-item">';
                    str+='<label class="layui-form-label"></label>';
                    str+='<div class="layui-input-inline">';
                    str+=' <select name="nav_select" lay-verify="required" lay-filter="nav_pid" >';
                    str+='<option value="'+nav_id+'">该级子导航</option>';
                    $.each(data.data,function(i,item){
                        str+='<option value="'+item.id+'">'+item.nav_name+'</option>';
                    });
                    str+='</select>';
                    str+='</div>';
                    str+='</div>';
                    // console.log(str);
                    current_nav.nextAll().remove();
                    current_nav.after(str);
                    $('#nav_pid').val(nav_id);
                    form.render('select');
                },
                error:function(){
                    layer.open({
                        type:0,
                        title:'网络错误',
                        icon:5,
                        content:'网络超时！'
                    });
                }

            });
        }
    });
    //修改导航
    form.on('submit(edit_nav)',function(data){
        var field =data.field;
        console.log(field);
        $.ajax({
            url:'/navigate/edit_nav',
            data:field,
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
