<?php $this->load->view('public/header')?>
<div class="layui-tab-content ite-demo site-demo-body" id="nav_list">
    <form class="layui-form" action="">
        <input type="hidden" name="group_id" value="<?=$info['id']?>">
        <div class="layui-form-item">
            <div class="layui-input-inline">
                <input type="checkbox"  lay-skin="primary" lay-filter="check_all" title="全选">
                <input type="checkbox"  lay-skin="primary" lay-filter="select_invert" title="反选">
            </div>
        </div>
            <?php if(!empty($list)):?>
                <?php foreach ($list as $key=>$val):?>
                <div class="layui-form-item">
                    <blockquote class="layui-elem-quote">
                       <input type="checkbox" name="nav_id" lay-filter="nav_lv1" value="<?=$val['id']?>" lay-skin="primary" title="<?=$val['title']?>" <?php if(in_array($val['id'],$info['group_power'])):?>checked="checked"<?php endif;?>>
                    </blockquote>
                           <?php if(!empty($val['children'])):?>
                                <div class="layui-input-block" style="margin-left: 5px;">
                                    <?php foreach ($val['children'] as $k=>$v):?>

                                     <input type="checkbox" name="nav_id" lay-filter="nav_lv2" value="<?=$v['id']?>" lay-skin="primary" title="<?=$v['title']?>" <?php if(in_array($v['id'],$info['group_power'])):?>checked="checked"<?php endif;?>>
                                     <hr>
                                        <?php if(!empty($v['children'])):?>
                                        <div class="layui-input-block" style="margin-left: 10px;">
                                            <?php foreach ($v['children'] as $ke=>$va):?>
                                                    <input type="checkbox" name="nav_id" lay-filter="nav_lv3" value="<?=$va['id']?>" lay-skin="primary" title="<?=$va['title']?>" <?php if(in_array($va['id'],$info['group_power'])):?>checked="checked"<?php endif;?>>
                                            <?php endforeach;?>
                                        </div>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                </div>
                            <?php endif;?>
                </div>
                <?php endforeach;?>
              <?php endif;?>
        <div class="layui-form-item">
            <div class="layui-input-inline">
                <button class="layui-btn" lay-submit="" lay-filter="set_power">立即添加</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="<?= config_item('domain_static') ?>admin/js/power/set_power.js"></script>
<?php $this->load->view('public/footer')?>
