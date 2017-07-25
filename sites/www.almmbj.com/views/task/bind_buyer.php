
<htlm>
    <title></title>
    <head>
        <link rel="stylesheet" type="text/css" href="<?=config_item('domain_static')?>common/layui/css/layui.css">
        <script src="<?=config_item('domain_static')?>common/layui/layui.js"></script>
    </head>
    <body>

<form class="layui-form" action="">
    <div style="margin-top:20px;">
        <?php if(!empty($list)):?>
            <div class="layui-form-item">
                <label class="layui-form-label">选择买号</label>
                <? foreach ($list as $key=>$val):?>
                    <div class="layui-input-block">
                        <input type="radio" name="buy_account_id" value="<?=$val['id']?>" title="<?=$val['account']?>" checked="">
                    </div>
                <?php endforeach;?>
            </div>
            <input type="hidden" name="task_id" value="<?=$task_id?>">
            <input type="hidden" name="is_verify" value="<?=$is_verify?>">
            <input type="hidden" name="is_origin" value="<?=$is_origin?>">
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="bind">立即绑定</button>
                </div>
            </div>
        <?php else :?>
            <div class="layui-form-item" style="text-align: center">
                <a style="color:red;" href="javascript:void(0)" onclick="bind_account();">您还没有添加买号现在就去绑定</a>
                <script>
                    function bind_account(){
                       layer.closeAll();
                       parent.window.location.href='/user/bind_account';
                    }
                </script>
            </div>
        <?php endif;?>
    </div>
</form>
<script>

    layui.use(['form','jquery'],function(){
        var form = layui.form()
            ,layer = layui.layer,
            $ =layui.jquery;

        form.on('submit(bind)', function(data){
            var field=data.field;
            console.log(field);
            $.ajax({
                url:'/task/bind_buyer',
                data:field,
                type:'post',
                dataType:'json',
                success:function(msg){
                    if(msg.code==201){
                        layer.open({
                            type:0,
                            title:'消息提示',
                            icon:1,
                            end: function () {
                                //关闭父layer
                                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                if (index === undefined){
                                    window.location.reload();
                                }else{
                                    parent.layer.close(index); //再执行关闭
                                    parent.window.location.reload();
                                }
                            },
                            content:msg.msg
                        })
                    }else{
                        layer.open({
                            type:0,
                            title:"消息提示",
                            icon:5,
                            content:msg.msg
                        })
                    }
                },
                error:function(msg){
                    layer.open({
                        type:0,
                        title:"错误提示",
                        icon:5,
                        content:'网络超时！'
                    })
                }

            });
            return false;
        });
    });
</script>
</body>
</htlm>