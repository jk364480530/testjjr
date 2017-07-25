/**
 * Created by John on 2017/4/9.
 */
//接任务
function accept_task(id){
    $.ajax({
        url:'/task/accept_task',
        data:{'task_id':id},
        type:'post',
        dataType:'json',
        success:function(data){
            if(data.code==201){
                layer.confirm('任务接受成功', {
                    btn: ['留在本页','去我的任务大厅'] //按钮
                }, function(){
                    layer.close();
                    window.location.reload();
                }, function(){
                    window.location.href="/task/my_accept"
                });
            }else{
                layer.open({
                    type:0,
                    title:'失败提示',
                    icon:5,
                    content:data.msg,
                })
            }
        },
        error:function(data){
            layer.open({
                type:0,
                title:'错误提示',
                icon:5,
                content:"网络超时！",
            })
        }
    })
}