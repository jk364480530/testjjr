<htlm>
<title></title>
<head>
    <link rel="stylesheet" type="text/css" href="<?=config_item('domain_static')?>common/layui/css/layui.css">
<!--    <script src="--><?//=config_item('domain_static')?><!--common/javascript/jquery-3.2.0.min.js"></script>-->
    <script src="<?=config_item('domain_static')?>common/layui/layui.js"></script>
</head>
<body>
<form class="layui-form" action="">
    <div style="margin-top:20px;">
        <div class="layui-form-item" style="text-align: center;color:#009e94;">
            <span style="color:red;">(<?=$info['type_name']?>)</span><?=$info['task_title']?>
        </div>
        <hr>
        <?php if($info['task_type']==3):?>
            <?php if(!empty($info['buy_cart'])):?>
                <div class="layui-form-item">
                    <label class="layui-form-label">商品地址:</label>
                    <?php foreach ($info['buy_cart'] as $key=>$val):?>
                    <div class="layui-input-block">
                          <?=$val['goods_url']?>
                    </div><br>
                    <?php endforeach;?>
                </div>
            <?php endif;?>
        <?php else:?>
            <div class="layui-form-item">
                <label class="layui-form-label">地址:</label>
                <div class="layui-input-block">
                    <?=$info['goods_url']?>
                </div>
            </div>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">标题:</label>
                <div class="layui-form-mid">
                    <?=$info['goods_title']?>
                </div>
            </div>
        <?php endif;?>
        <hr>
        <div class="layui-form-item">
            <label class="layui-form-label">发布者
                <img src="<?=config_item('domain_static')?>home/images/task/seller_bg.png" alt="">:
            </label>
            <div class="layui-form-mid">
                <img src="<?=config_item('domain_static')?>home/images/task/qq_bg_1.gif" >
                <?=$info['release_qq']?>
                掌柜号:  <?=$info['release_account']?>
            </div>
        </div>
        <hr>
        <div class="layui-form-item">
            <label class="layui-form-label">接受者
                <img src="<?=config_item('domain_static')?>home/images/task/buy_bg.png" alt="">:
            </label>
            <div class="layui-form-mid">
                <img src="<?=config_item('domain_static')?>home/images/task/qq_bg_1.gif" >
                <?=$info['accept_qq']?>
                买号: <?=$info['buy_account']?>
            </div>
        </div>

        <?php if(!empty($info['evaluate'])):?>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">指定评论:</label>
                <div class="layui-form-mid">
                    <?=$info['evaluate']?>
                 </div>
            </div>
        <?php endif;?>
        <?php if(!empty($info['address'])):?>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">指定地址:</label>
                <div class="layui-form-mid" >
                    <?=$info['address']?>
                </div>
            </div>
        <?php endif;?>
        <?php if(!empty($info['com_img'])):?>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">评价图片:</label>
                <div class="layui-input-block" style="line-height: 38px;">
                    <?php foreach ($info['com_img'] as $key=>$val):?>
                        <img  style="width:50px;height:50px;" src="<?=config_item('domain_img')?><?=$val['url']?>" alt="">
                        <a download href="<?=config_item('domain_img')?><?=$val['url']?>">下载图片</a>
                    <?php endforeach;?>
                </div>
            </div>
        <?php endif;?>
        <?php if(!empty($info['tb_order_no'])):?>
            <hr>
            <div class="layui-form-item">
                <label class="layui-form-label">淘宝交易号:</label>
                <div class="layui-input-block" style="line-height: 38px;">
                    <?=$info['tb_order_no']?>
                </div>
            </div>
        <?php endif;?>
    </div>
</form>
</body>
</htlm>