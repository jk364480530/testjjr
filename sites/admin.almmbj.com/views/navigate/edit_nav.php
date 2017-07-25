<?php $this->load->view('public/header')?>
<form class="layui-form site-block" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">导航名称：</label>
        <div class="layui-input-inline">
            <input type="text" name="nav_name" value="<?=$nav_info['nav_name']?>" lay-verify="required" autocomplete="off" class="layui-input" placeholder="请输入导航名称">
        </div>
        <div class="layui-form-mid layui-word-aux">必须</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">控制器名：</label>
        <div class="layui-input-inline">
            <input name="controller_name" type="text" lay-verify="required" value="<?=$nav_info['controller_name']?>" autocomplete="off" class="layui-input" placeholder="请输入控制器名称">
        </div>
        <div class="layui-form-mid layui-word-aux">必须</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">方法名：</label>
        <div class="layui-input-inline">
            <input name="action_name" type="text" value="<?=$nav_info['action_name']?>" lay-verify="" autocomplete="off" class="layui-input" placeholder="请输入方法名">
        </div>
        <div class="layui-form-mid layui-word-aux">非必填</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">导航图标：</label>
        <div class="layui-input-inline">
            <input type="text" name="icon" value="<?=$nav_info['icon']?>" lay-verify="required" autocomplete="off" class="layui-input" placeholder="请输入图标">
        </div>
        <div class="layui-form-mid layui-word-aux">非必填  例如: <span class="code">&amp;#xe614; 请在图标库中查找</span></div>
    </div>
    <input type="hidden" name="pid" value="0" id="nav_pid">
    <input type="hidden" name="nav_id" value="<?=$nav_info['id']?>" >
    <div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属导航:</label>
            <div class="layui-input-inline">
                <select name="nav_select" lay-verify="required" lay-filter="nav_pid" >
                    <option value='0' class="now_nav">顶级导航</option>
                    <?php if(!empty($top_nav)):?>
                        <?php foreach ($top_nav as $key=>$v):?>
                            <option value="<?=$v['id']?>"><?=$v['nav_name']?></option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label"></label>
        <div class="layui-input-inline">
            <button class="layui-btn" lay-submit="" lay-filter="edit_nav">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="<?= config_item('domain_static') ?>admin/js/nav/edit_nav.js"></script>
<?php $this->load->view('public/footer')?>
