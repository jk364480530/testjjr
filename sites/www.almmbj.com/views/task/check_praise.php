
<htlm>
    <title></title>
    <head>
        <link rel="stylesheet" type="text/css" href="<?=config_item('domain_static')?>common/layui/css/layui.css">
        <script src="<?=config_item('domain_static')?>common/javascript/jquery-3.2.1.min.js"></script>
        <script src="<?=config_item('domain_static')?>common/layui/layui.js"></script>
    </head>
    <body>
<form class="layui-form" action="">
    <div style="margin-top:20px;">
            <input type="hidden" name="task_id" value="<?=$task_id?>">

            <div class="layui-form-item" pane="">
                <label class="layui-form-label">好评凭证</label>
                <div class="layui-input-block">
                  <?php if(!empty($praise_img)):?>
                      <?php foreach ($praise_img as $key=>$val):?>
                          <img src="<?=config_item('domain_img')?><?=$val['url']?>" alt="" style="width:100px;">
                      <?php endforeach;?>
                  <?php endif;?>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit="" lay-filter="loan">确定放款</button>
                </div>
            </div>
    </div>
</form>
<script>

    layui.use(['form','jquery'],function(){
        var form = layui.form()
            ,layer = layui.layer,
            $ =layui.jquery;

        form.on('submit(loan)', function(data){
            var field=data.field;
//            console.log(field);
            $.ajax({
                url:'/task/check_praise',
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