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
            <label class="layui-form-label">掌柜号:</label>
            <div class="layui-form-mid">
                <span id="code1"><?=$info['release_account']?></span>
            </div>
        </div>
        <hr>
        <div class="layui-form-item">
            <label class="layui-form-label">搜索关键词:</label>
            <div class="layui-form-mid">
                <span id="code1"><?=$info['lailu']['search_keyword']?></span>
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
            <div class="layui-input-block">
                <?=$info['lailu']['check_url']?>
            </div>
        </div>
    </div>
</form>

</body>
</htlm>