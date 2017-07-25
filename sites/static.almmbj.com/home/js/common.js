/**
 * Created by John on 2017/4/9.
 */
layui.use(['form','jquery','layer','laytpl','element','laydate','util'],function() {
    var form = layui.form(),
        layer = layui.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        element = layui.element(),
        laydate = layui.laydate,
        util =layui.util;

        util.fixbar({
            bar1: true,
            click: function(type){
                // console.log(type);
                if(type === 'bar1'){
                    // $(document).scrollTo(0,500);
                    alert(22);
                }
            }
        })

    //监听Tab切换，以改变地址hash值
    element.on('tab(nav)', function(){
        // console.log(this.getAttribute('url'));
        var url=this.getAttribute('url');
        window.location.href=url;
    });
});
    //改变任务状态
    function change_status(task_id,status){

        layer.confirm('您确定要进行此操作吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            change_status_ajax(task_id,status);
        }, function(){
          layer.closeAll();
        });


    }
    //更改状态ajax
    function change_status_ajax(task_id,status){
        $.ajax({
            url:'/task/change_status',
            data:{task_id:task_id,status:status},
            type:'post',
            dataType:'json',
            success:function(data){
                if(data.code==201){
                    layer.msg(data.msg,{time:2000,icon:6,end:function(){
                        window.location.reload();
                    }})

                }else{
                    layer.msg(data.msg,{time:2000,icon:5});
                }
            },
            error:function(data){
                layer.msg('网络错误！');
            }
        });
    }
    //鼠标经过任务要求显示提示
    function alert_tip(obj){
        var content =$(obj).attr('content');
        var s =$(obj);
        layer.tips(content,s,{
            tips: [1, '#2F4056'],
            time: 4000
        });
    }
    //鼠标离开关闭所有提示
    function close_tip(obj){
        layer.closeAll();
    }

    //倒计时
    function timer(time1,task_id,jis){
        var times = Date.parse(new Date()).toString();
        var lasttime = times.substr(0,10);
        var ts = time1 - lasttime; //设置目标时间，并计算剩余的毫秒数
        if (ts<0) {
            //停止定时器
            clearInterval(jis);
            $('#countdown'+task_id).css('display','none');

                var buy_account_id =$('#cancel_task'+task_id).attr('buy_account_id');
                $.ajax({
                    url:'/task/cancel_task',
                    data:{task_id:task_id,buy_account_id:buy_account_id},
                    type:'post',
                    dataType:'json',
                    success:function(data){
                        if(data.code==201){
                            window.location.reload();
                        }else{
                            layer.msg(data.msg);
                        }
                    },
                    error:function(data){
                        layer.msg('网络错误！');
                    }
                })

        }else{
            // console.log(ts);
            create_daojishi(ts,task_id,'');
        }
    }

    //确认发货跟物流倒计时以天计算
    function timer1(time1,task_id,jis,type){
        var times = Date.parse(new Date()).toString();
        // var lengths = times.length-3;
        var lasttime = times.substr(0,10);
        var ts = time1 - lasttime; //设置目标时间，并计算剩余的毫秒数
        if (ts<0) {
            //停止定时器
            clearInterval(jis);
            $('#countdown'+task_id).css('display','none');
            if(type=='deliver_goods'){
                change_status_ajax(task_id,8);//切换到发货状态
            }else if(type=='waite_logistics'){
                change_status_ajax(task_id,9);
            }

        }else{
            create_daojishi(ts,task_id,type);
        }
}
    //生成倒计时
    function  create_daojishi(ts,task_id,type){

        var dd = parseInt(ts/1000 / 60 / 60 / 24, 10);  //计算剩余天数
        var hh = parseInt(ts / 60 / 60 % 24, 10);  //计算剩余小时
        var mm = parseInt(ts / 60 % 60, 10);       //计算剩余分钟
        var ss = parseInt(ts % 60 , 10);        //秒数
        //var ms = parseInt(ts %100, 10);        //秒数
        //为了美观，在剩余时间的数字小于10时转换为0X
        dd = checkTime(dd);
        hh = checkTime(hh);
        mm = checkTime(mm);
        ss = checkTime(ss);
        //ms = checkTime(ms);
        //重写数字
        if(type=='praise'){
            $("#less_day"+task_id).html(dd);
        }
        $("#less_hour"+task_id).html(hh);
        $("#less_minutes"+task_id).html(mm);
        $("#less_seconds"+task_id).html(ss);
        //$("#millisecond"+task_id).html(ms);
    }
    //为了美观，在剩余时间的数字小于10时转换为0X
    function checkTime(i){
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    //取消任务
    function cancel_task(id){
        var buy_account_id =$('#cancel_task'+id).attr('buy_account_id');
        layer.confirm('您确定要取消任务？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.ajax({
                url:'/task/cancel_task',
                data:{task_id:id,buy_account_id:buy_account_id},
                type:'post',
                dataType:'json',
                success:function(data){
                    if(data.code==201){
                       layer.open({
                           type:0,
                           title:'成功提示',
                           icon:1,
                           end:function(){
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
                    layer.msg('网络错误！');
                }
            })
        }, function(){
          layer.closeAll();
        });
    }