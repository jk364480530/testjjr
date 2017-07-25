/**
 * Created by Administrator on 2017/4/21.
 */

layui.use(['form','layer','jquery','element'],function(){
    var form=layui.form(),
        layer=layui.layer,
        $ =layui.jquery,
        element=layui.element();

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
    });

    //提交表单
    form.on('submit(add_nav)',function(data){
        var field=data.field;
        $.ajax({
            url:'/navigate/add_nav',
            data:field,
            type:'post',
            dataType:'json',
            success:function(data){
                if(data.code==201){
                    layer.confirm('继续添加导航？', {
                        btn: ['继续','返回列表页'] //按钮
                    }, function(){
                       layer.closeAll();
                    }, function(){
                        element.tabChange('nav', 111);
                        window.location.reload();
                    });
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

//编辑导航
function edit_nav(nav_id){
    var url ='/navigate/edit_nav?nav_id='+nav_id;
    var width= (document.body.offsetWidth);
    if(width<1000){
        width =width*0.8
    }else{
        width =width*0.5
    }
    layer.open({
        type: 2,
        title:"添加导航",
        area: [width+'px', '530px'],
        fixed: false, //不固定
        maxmin: true,
        content: url
    });

}
//删除nav
function del(id){
    layer.confirm('你确定要删除该导航吗？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        $.ajax({
            url:'/navigate/del',
            type:'post',
            data:{nav_id:id},
            dataType:'json',
            success:function(data){
                if(data.code==201){
                    layer.open({
                        type:0,
                        title:'成功提示',
                        icon:1,
                        end:function(){
                            //关闭父layer
                            layer.closeAll();
                            window.location.reload();
                        },
                        content:data.msg
                    });
                }else{
                    layer.open({
                        type:0,
                        title:'失败提示',
                        icon:5,
                        content:data.msg
                    });
                }
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
    }, function(){
        layer.closeAll();
    });

}