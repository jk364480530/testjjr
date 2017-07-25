<?php $this->load->view('public/header')?>
<div class="layui-tab" lay-filter="nav">
    <ul class="layui-tab-title">
        <li class="layui-this"  lay-id="111">导航列表</li>
        <li class="" lay-id="222">添加导航</li>
    </ul>
    <div class="layui-tab-content">
        <!-- 导航列表 -->
        <div class="layui-tab-item layui-show">
            <form class="layui-form layui-form-pane" action="/navigate/nav_list" method="get">
                <div class="layui-form-item">
                    <label class="layui-form-label">导航名称:</label>
                    <div class="layui-input-inline">
                        <input type="text" value="" name="nav_name" placeholder="根据导航名过滤" class="layui-input">
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
                    <th>导航名称</th>
                    <th>控制器名称</th>
                    <th>方法名</th>
                    <th>导航图标</th>
                    <th style="width:200px;">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($list)):?>
                    <?php foreach ($list as $key=>$val):?>
                        <tr>
                            <td><?=$val['id']?></td>
                            <td><?=$val['nav_name']?></td>
                            <td><?=$val['controller_name']?></td>
                            <td><?=$val['action_name']?></td>
                            <td><i class="layui-icon"><?=$val['icon']?></i></td>
                            <td class="span3">
                                <button class="layui-btn layui-btn-warm layui-btn-mini" type="button" onclick="edit_nav(<?=$val['id']?>)" >
                                    <i class="layui-icon">&#xe642;</i>
                                    编辑
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
                    <label class="layui-form-label">导航名称：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="nav_name" value="" lay-verify="required" autocomplete="off" class="layui-input" placeholder="请输入导航名称">
                    </div>
                    <div class="layui-form-mid layui-word-aux">必须</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">控制器名：</label>
                    <div class="layui-input-inline">
                        <input name="controller_name" type="text" lay-verify="required" value="" autocomplete="off" class="layui-input" placeholder="请输入控制器名称">
                    </div>
                    <div class="layui-form-mid layui-word-aux">必须</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">方法名：</label>
                    <div class="layui-input-inline">
                        <input name="action_name" type="text" value="" lay-verify="" autocomplete="off" class="layui-input" placeholder="请输入方法名">
                    </div>
                    <div class="layui-form-mid layui-word-aux">非必填</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">导航图标：</label>
                    <div class="layui-input-inline">
                        <input type="text" name="icon" value="" lay-verify="required" autocomplete="off" class="layui-input" placeholder="请输入图标">
                    </div>
                    <div class="layui-form-mid layui-word-aux">非必填  例如: <span class="code">&amp;#xe614; 请在图标库中查找</span></div>
                </div>
                <input type="hidden" name="pid" value="0" id="nav_pid">
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
                        <button class="layui-btn" lay-submit="" lay-filter="add_nav">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?= config_item('domain_static') ?>admin/js/nav/nav_list.js"></script>
<?php $this->load->view('public/footer')?>
