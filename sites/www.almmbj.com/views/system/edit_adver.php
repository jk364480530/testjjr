<link href="<?= config_item('domain_static')?>common/bootstrap/css/green-theme-bootstrap.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" href="<?=config_item('domain_static')?>common/amaze/css/amazeui.css"/>
<script src="<?= config_item('domain_static')?>common/bootstrap/js/bootstrap.min.js"></script>
<style>
    .mydata-title {
        padding: 0 0 10px 0;
        font-size: 18px;
        color: #00a3ec;
    }
    .fz{color: #00a3ec}
    .rw{width: 80px;text-align: right}
</style>
<div class="page-mian">
    <div class="panel panel-default">
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="" method="post" role="form">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="mydata-title">
                                                <b><a href="javascript:update_image(<?php echo isset($app_ad['id']) ? $app_ad['id'] : '' ?>);"><span class=""></span>更改广告</a></b>
                                            </div>
                                            <div class="thumbnail">
                                                <img src="<?php echo isset($app_ad['img_url']) && !empty($app_ad['img_url']) ? get_thumb_img($app_ad['img_url'],'300x300') : ''?>" alt="暂无图片">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="rw">状态:</label>
                                            <span style="margin-left: 10px;" class="fz">
                                                <input type="radio" value="1" name="state" <?php if($app_ad['state']==1) echo 'checked';?>>显示
                                            </span>
                                            <span style="margin-left: 10px;" class="fz">
                                                <input type="radio" value="0" name="state" <?php if($app_ad['state']==0) echo 'checked';?>>隐藏
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a class="btn btn-primary btn-block" style="width: 80px;margin-left: 40%" onclick="pass(<?php echo isset($app_ad['id']) ? $app_ad['id'] : '' ?>)">提 交</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <script src="<?=config_item('domain_static')?>common/jquery/jquery.min.js"></script>
    <script src="<?=config_item('domain_static')?>common/layer/layer.js"></script>