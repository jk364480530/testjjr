/**
 * Created by John on 2017/4/9.
 */
//来路详情
function lailu_detail(id){
    var url='/task/accept_lailu_info?id='+id;
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
//确认支付
function payment(id){
    var url='/task/payment?task_id='+id;
    layer.open({
        type: 2 //Page层类型
        ,area: ['600px', '700px']
        ,title: '上传支付凭证'
        ,shade: 0.6 //遮罩透明度
        ,maxmin: true //允许全屏最小化
        ,anim: 1 //0-6的动画形式，-1不开启
        ,content: url
    });
}

//绑定买号
function bind_buyer(id,is_verify){
    var url='/task/bind_buyer?task_id='+id+'&is_verify='+is_verify;
    layer.open({
        type: 2 //Page层类型
        ,area: ['600px', '700px']
        ,title: '绑定买号'
        ,shade: 0.6 //遮罩透明度
        ,maxmin: true //允许全屏最小化
        ,anim: 1 //0-6的动画形式，-1不开启
        ,content: url
    });
}

//上传好评凭证
function praise(id){
    var url='/task/praise?task_id='+id;
    layer.open({
        type: 2 //Page层类型
        ,area: ['600px', '700px']
        ,title: '上传好评凭据'
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