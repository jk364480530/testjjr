/**
 * Created by Administrator on 2017/4/21.
 */

layui.use(['form','layer','jquery','element'],function() {
    var form = layui.form(),
        layer = layui.layer,
        $ = layui.jquery,
        element = layui.element();

    //添加分组
    form.on('submit(add_group)',function(data){
        var field =data.field;
        $.ajax({
            url:'/power/add_group',
            data:field,
            type:'post',
            dataType:'json',
            success:function(data){
                if(data.code==201){

                    layer.confirm('继续添加分组？', {
                        btn: ['继续','返回列表页'] //按钮
                    }, function(){
                        layer.closeAll();
                    }, function(){
                        element.tabChange('group', 111);
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
//设置权限
function set_power(id){
    var url ='/power/set_power?group_id='+id;
    var width= (document.body.offsetWidth);
    if(width<1000){
        width =width*0.8
    }else{
        width =width*0.5
    }
    layer.open({
        type: 2,
        title:"设置权限",
        area: [width+'px', '530px'],
        fixed: false, //不固定
        maxmin: true,
        content: url
    });

}

//删除分组
function del(id){

    layer.confirm('你确定要删除该分组吗？', {
        btn: ['确定','取消'] //按钮
    }, function(){
        $.ajax({
            url:'/power/del_group',
            type:'post',
            data:{group_id:id},
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
//设置用户
function add_user(id){
    var url ='/power/add_user?group_id='+id;
    var width= (document.body.offsetWidth);
    if(width<1000){
        width =width*0.8
    }else{
        width =width*0.5
    }
    layer.open({
        type: 2,
        title:"设置用户",
        area: [width+'px', '530px'],
        fixed: false, //不固定
        maxmin: true,
        content: url
    });
}
