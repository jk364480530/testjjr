/**
 * Created by Administrator on 2017/4/21.
 */
function nav_level(obj){
    var nav_id = $(obj).val();
    var current_nav =$(obj).parent().parent();
    $.ajax({
        url:'/navigate/get_child',
        data:{nav_id:nav_id},
        type:'post',
        dataType:'json',
        success:function(data){
            if(data.data!=''){
                var str="";
//                   console.log(data);
                str+='<div class="control-group">';
                str+='<label class="control-label" for="inputPassword"></label>';
                str+='<div class="controls">';
                str+='<select name="top_nav" id="" onchange="nav_level(this);">';
                str+='<option value="'+nav_id+'"></option>';
                $.each(data.data,function(i,item){
                    str+='<option value="'+item.id+'">'+item.nav_name+'</option>';
                });
                str+='</select>';
                str+='</div>';
                str+='</div>';
                current_nav.after(str);
            }
            $('#nav_pid').val(nav_id);
        },
        error:function(data){
            layer.open({
                type:0,
                title:'网络错误',
                icon:5,
                content:'网络超时！'
            });
        }

    });
}
//提交导航
function add_nav(){
    var field =$('#nav_form').serialize();
    console.log(field);
    $.ajax({
        url:'/navigate/add_nav',
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
}