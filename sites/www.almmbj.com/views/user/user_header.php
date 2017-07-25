
<?php $this->load->view('public/header')?>
<link rel="stylesheet" type="text/css" href="<?=config_item('domain_static')?>home/css/user/user_public.css">
<div class="layui-main site-inline">
<div class="site-tree">
  <ul class="layui-tree">
      <li class="site-tree-noicon <?php if(!empty($curt) && $curt==1):?>layui-this<?php endif;?>">
          <a href="/user/person_center">
              <i class="layui-icon">&#xe612;</i>
              <cite>个人中心</cite>
          </a>
      </li>
      <li><h2>资金管理</h2></li>
      <li class="site-tree-noicon <?php if(!empty($curt) && $curt==2):?>layui-this<?php endif;?>">
          <a href="/user/recharge">
              <i class="layui-icon" style="top: 1px;color:red"></i>
              <cite>充值</cite>
          </a>
      </li>
      <li class="site-tree-noicon <?php if(!empty($curt) && $curt==3):?>layui-this<?php endif;?>">
          <a href="/user/withdraw_cash">
              <i class="layui-icon" style="top: 3px;"></i>
              <cite>提现</cite>
          </a>
      </li>
      <li class="site-tree-noicon <?php if(!empty($curt) && $curt==4):?>layui-this<?php endif;?>">
          <a href="/user/buy_gold">
              <i class="layui-icon" style="top: 2px;"></i>
              <cite>购买镖局币</cite>
          </a>
      </li>
      <li class="site-tree-noicon <?php if(!empty($curt) && $curt==5):?>layui-this<?php endif;?>">
          <a href="/user/cash">
              <i class="layui-icon" style="top: 2px;"></i>
              <cite>镖局币兑现</cite>
          </a>
      </li>
      <li><h2>个人信息</h2></li>
      <li class="site-tree-noicon <?php if(!empty($curt) && $curt==6):?>layui-this<?php endif;?>">
          <a href="/user/edit_profile">
              <i class="layui-icon">&#xe642;</i>
              <cite>修改资料</cite>
          </a>
      </li>
      <li class="site-tree-noicon <?php if(!empty($curt)&& $curt==7):?>layui-this<?php endif;?>">
          <a href="/user/change_pwd" >
              <i class="layui-icon">&#xe639;</i>
              <cite>修改密码</cite>
          </a>
      </li>
      <li class="site-tree-noicon <?php if(!empty($curt) && $curt==8):?>layui-this<?php endif;?>">
          <a href="/user/change_safe_pwd">
              <i class="layui-icon">&#xe628;</i>
              <cite>修改安全密码</cite>

          </a>
      </li>
      <li class="site-tree-noicon <?php if(!empty($curt) && $curt==9):?>layui-this<?php endif;?>">
          <a href="/user/set_bank ">
              <i class="layui-icon">&#xe620;</i>
              <cite>设置提现账号</cite>
              <em>预留</em>
          </a>
      </li>

      <li><h2>账号管理</h2></li>
      <li class="site-tree-noicon <?php if(!empty($curt)&& $curt==10):?>layui-this<?php endif;?>">
          <a href="/user/bind_account">
              <i class="layui-icon">&#xe61f;</i>
              <cite>绑定淘宝号</cite>
          </a>
      </li>
      <li><h2>任务管理</h2></li>
      <li class="site-tree-noicon">
          <a href="/task/task_list">
              <i class="layui-icon">&#xe60a;</i>
              <cite>任务大厅</cite>
          </a>
      </li>
      <li class="site-tree-noicon">
          <a href="/task/add_task">
              <i class="layui-icon">&#xe60a;</i>
              <cite>发布任务</cite>
          </a>
      </li>
      <li class="site-tree-noicon">
          <a href="/task/my_release">
              <i class="layui-icon">&#xe60a;</i>
              <cite>我发布的任务</cite>
          </a>
      </li>
      <li class="site-tree-noicon">
          <a href="/task/my_accept">
              <i class="layui-icon">&#xe60a;</i>
              <cite>我接受的任务</cite>
          </a>
      </li>
  </ul>
</div>
