<?php $this->load->view('public/header')?>
<div class="container-fluid" style="margin-top: 20px;">
    <div class="row-fluid">
        <div class="span12">
            <form class="form-horizontal" id="nav_form" onsubmit="return add_nav();">
                <div class="control-group">
                    <label class="control-label" for="inputNav">导航名称</label>
                    <div class="controls">
                        <input id="inputNav" type="text" name="nav_name" value=""/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputController">控制器名</label>
                    <div class="controls">
                        <input id="inputController" type="text" name="controller_name"  value=""/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputFunction">方法名</label>
                    <div class="controls">
                        <input id="inputFunction" type="text" name="action_name" value=""/>
                    </div>
                </div>
                <div class="control-group" id="top_nav">
                    <label class="control-label">所属导航</label>
                    <div class="controls">
                        <select name="nav_select" id="" onchange="nav_level(this);">
                            <option value='0'>一级导航</option>
                            <?php if(!empty($top_nav)):?>
                                <?php foreach ($top_nav as $key=>$v):?>
                                    <option value="<?=$v['id']?>"><?=$v['nav_name']?></option>
                                 <?php endforeach;?>
                            <?php endif;?>

                        </select>
                    </div>
                </div>
                <input type="hidden" name="pid" value="0" id="nav_pid">
                <div class="control-group">
                    <div class="controls">
                        <button  type="submit" class="btn btn-success" >确认添加</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?= config_item('domain_static') ?>admin/js/power/edit_group.js"></script>
<?php $this->load->view('public/footer')?>
