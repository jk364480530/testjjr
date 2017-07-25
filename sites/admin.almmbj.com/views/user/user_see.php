<?php $this->load->view('public/header')?>
    <link href="<?=config_item('domain_static')?>common/layui/css/layui.css" rel="stylesheet">
    <link href="<?=config_item('domain_static')?>common/layer/skin/default/layer.css" rel="stylesheet">
<div style="width: 300px;margin-left: 20px;margin-top: 10px;">
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">用户编号：</label>
            <div class="layui-input-block">
                <input type="text" value="<?php echo isset($list['uid']) ? $list['uid'] : ''?>" readonly="readonly" name="title"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号码：</label>
            <div class="layui-input-block">
                <input type="text" value="<?php echo isset($list['phone']) ? $list['phone'] :''?>" readonly="readonly" name="title" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">注册时间：</label>
            <div class="layui-input-block">
                <input type="text" value="<?php echo isset($list['reg_time']) ? $list['reg_time'] : ''?>" readonly="readonly" name="title"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">账号状态：</label>
            <div class="layui-input-block">
                <?php if($list['is_lock']==0):?>
                <input type="text" value="开通" readonly="readonly" name="title" class="layui-input">
                <?php else :?>
                    <input type="text" value="封号" readonly="readonly" name="title" class="layui-input">
                <?php endif;?>
            </div>
        </div>
    </form>
</div>
<?php $this->load->view('public/footer')?>
