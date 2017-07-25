/**
 * Created by John on 2017/4/9.
 */


//来路详情
function lailu_detail(id){
    var url='/task/release_lailu_info?id='+id;
    layer.open({
        type: 2 //Page层类型
        ,area: ['600px', '700px']
        ,title: '搜索详情'
        ,shade: 0.6 //遮罩透明度
        ,maxmin: true //允许全屏最小化
        ,anim: 1 //0-6的动画形式，-1不开启
        ,content: url
    });

}

//任务详情
function task_detail(id){
    var url='/task/task_info?id='+id;
    layer.open({
        type: 2 //Page层类型
        ,area: ['600px', '700px']
        ,title: '任务详情'
        ,shade: 0.6 //遮罩透明度
        ,maxmin: true //允许全屏最小化
        ,anim: 1 //0-6的动画形式，-1不开启
        ,content: url
    });

}

//审核放款
function loan(id){

    var url='/task/check_praise?task_id='+id;
    layer.open({
        type: 2 //Page层类型
        ,area: ['600px', '700px']
        ,title: '审核放款'
        ,shade: 0.6 //遮罩透明度
        ,maxmin: true //允许全屏最小化
        ,anim: 1 //0-6的动画形式，-1不开启
        ,content: url
    });
}
