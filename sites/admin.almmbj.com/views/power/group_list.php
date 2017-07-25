<?php $this->load->view('public/header')?>
<div class="layui-tab" lay-filter="group">
    <ul class="layui-tab-title">
        <li class="layui-this"  lay-id="111">分组列表</li>
        <li class="" lay-id="222">添加分组</li>
    </ul>
    <div class="layui-tab-content">
        <!-- 导航列表 -->
        <div class="layui-tab-item layui-show">
            <form class="layui-form layui-form-pane" action="/power/group_list" method="get">
                <div class="layui-form-item">
                    <label class="layui-form-label">分组名称:</label>
                    <div class="layui-input-inline">
                        <input type="text" value="" name="group_name" placeholder="根据分组名称过滤" class="layui-input">
                    </div>
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-inline">
                        <input type="radio" name="status" value="1" title="启用"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>启用</span></div>
                        <input type="radio" name="status" value="0" title="禁用"><div class="layui-unselect layui-form-radio"><i class="layui-anim layui-icon"></i><span>禁用</span></div>
                    </div>
                    <button class="layui-btn" lay-submit="">查询</button>
                </div>
            </form>
            <table class="layui-table" lay-even="" lay-skin="row">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>分组名称</th>
                    <th>添加时间</th>
                    <th style="width:220px;">操作</th>
                </tr>
                </thead>
                <tbody>

                <?php if(!empty($list)):?>
                    <?php foreach ($list as $key=>$val):?>
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['group_name']?></td>
                            <td><?=date('Y-m-d H:i',$val['add_time'])?></td>
                            <td>
                                <button class="layui-btn layui-btn-warm layui-btn-mini" type="button" onclick="add_user(<?=$val['id']?>)" >
                                    <i class="layui-icon">&#xe642;</i>
                                    设置用户
                                </button>
                                <button class="layui-btn layui-btn-warm layui-btn-mini" type="button" onclick="set_power(<?=$val['id']?>)" >
                                    <i class="layui-icon">&#xe620;</i>
                                    设置权限
                                </button>
                                <button class="layui-btn layui-btn-danger layui-btn-mini" type="button" onclick="del(<?=$val['id']?>);">
                                    <i class="layui-icon">&#xe640;</i>
                                    删除
                                </button>
                            </td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
                </tbody>
            </table>
            <div id="demo7" style="text-align:right;">
                <?php if(isset($page)){ echo $page;}?>
            </div>
        </div>
        <!-- 添加导航 -->
        <div class="layui-tab-item edit-form-box">
            <form class="layui-form site-block" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">分组名称：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="group_name" value="" lay-verify="required" autocomplete="off" class="layui-input" placeholder="请输入分组名称">
                    </div>
                    <div class="layui-form-mid layui-word-aux">必须</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"></label>
                    <div class="layui-input-inline">
                        <button class="layui-btn" lay-submit="" lay-filter="add_group">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= config_item('domain_static') ?>admin/js/power/group_list.js"></script>
<?php $this->load->view('public/footer')?>
