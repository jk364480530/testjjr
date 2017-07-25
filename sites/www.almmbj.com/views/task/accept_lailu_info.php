<htlm>
<title></title>
<head>
    <link rel="stylesheet" type="text/css" href="<?=config_item('domain_static')?>common/layui/css/layui.css">
<!--    <script src="--><?//=config_item('domain_static')?><!--common/javascript/jquery-3.2.0.min.js"></script>-->
    <script src="<?=config_item('domain_static')?>common/layui/layui.js"></script>
</head>
<body>

<style>
    .layui-form-mid{
        margin-left: 20px;
    }
</style>
<form class="layui-form" action="">
    <div style="margin-top:20px;">
        <div class="layui-form-item">
            <label class="layui-form-label">搜索关键词:</label>
            <div class="layui-form-mid">
                <span id="code1"><?=$info['lailu']['search_keyword']?></span>
                <a  href="javascript;" onclick="copyToClipBoard('code1');">点击复制</a>

            </div>
        </div>
    <hr>
        <div class="layui-form-item">
            <label class="layui-form-label">搜索提示:</label>
            <div class="layui-form-mid">
                <?=$info['lailu']['search_hint']?>
            </div>
        </div>
    <hr>
        <?php if(!empty($info['lailu']['img'])):?>
        <div class="layui-form-item">
            <label class="layui-form-label">截图示例:</label>
            <div class="layui-form-mid">
                <?php foreach ($info['lailu']['img'] as $key=>$v):?>
                    <img src="<?=config_item('domain_img')?><?=$v['url']?>" alt="" style="width:200px;height:200px;">
                <?php endforeach;?>
            </div>
        </div>
        <?php endif;?>
        <div class="layui-form-item">
            <label class="layui-form-label">校验地址:</label>
            <div class="layui-input-block" style="width: 70%;">
                    <input type="text" name="url" value=""  lay-verify="url|required" placeholder="请输入您的校验地址" autocomplete="off" class="layui-input">
                    <input type="hidden" name="task_id" value="<?=$info['lailu']['task_id']?>" class="layui-input">
             </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="dom1">立即校验</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </div>
</form>
<script>
//    function copyToClipBoard(id){
//        var text =$('#'+id).html();
//        copyToClipboard(text);
//    }

    layui.use(['form','jquery'],function(){
        var form = layui.form()
            ,layer = layui.layer,
            $ =layui.jquery;

        //监听提交
        form.on('submit(dom1)', function(data){
           var field=data.field;
           console.log(field);
            $.ajax({
                url:'/task/url_yz',
                data:field,
                type:'post',
                dataType:'json',
                success:function(msg){
                    if(msg.code==201){
                        layer.open({
                            type:0,
                            title:'消息提示',
                            icon:1,
                            yes: function () {
                                //关闭父layer
                                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                if (index === undefined){
                                    window.location.reload();
                                }else{
                                    parent.layer.close(index); //再执行关闭
                                    parent.window.location.reload();
                                }
                            },
                            content:'恭喜您验证成功！'
                        })
                    }else{
                        layer.open({
                            type:0,
                            title:"消息提示",
                            icon:5,
                            content:'校验地址错误请从新校验'
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