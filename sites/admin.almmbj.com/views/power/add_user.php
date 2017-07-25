<?php $this->load->view('public/header')?>
<div class="layui-tab-content ite-demo site-demo-body">
    <blockquote class="layui-elem-quote">分组名称：<?=$info['group_name']?></blockquote>
   <span>用户列表</span>
    <hr>
    <form class="layui-form" action="">
        <input type="hidden" name="group_id" value="<?=$info['id']?>">
        <div class="layui-form-item">
            <div class="layui-input-inline">
                <input type="checkbox"  lay-skin="primary" lay-filter="check_all" title="全选">
                <input type="checkbox"  lay-skin="primary" lay-filter="select_invert" title="反选">
            </div>
        </div>
        <div class="layui-form-item" id="user_list">
            <?php if(!empty($user_list)):?>
            <?php foreach ($user_list as $key=>$val):?>
            <div class="layui-input-inline">
               <input type="checkbox" name="user_id" value="<?=$val['uid']?>" lay-skin="primary" title="<?=$val['username']?>" <?php if(in_array($val['uid'],$group_user)):?>checked="checked"<?php endif;?>>
            </div>
            <?php endforeach;?>
            <?php endif;?>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-inline">
                <button class="layui-btn" lay-submit="" lay-filter="add_user">立即添加</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= config_item('domain_static') ?>admin/js/power/add_user.js"></script>
<?php $this->load->view('public/footer')?>
