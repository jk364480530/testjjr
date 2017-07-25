<?php $this->load->view('user/user_header')?>
  <div class="site-content">
            <div class="layui-tab" lay-filter="account">
                <ul class="layui-tab-title">
                    <li class="layui-this" lay-id="222">绑定账号</li>
                    <li lay-id="333">任务号</li>
                    <li lay-id="444">掌柜号</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <form class="layui-form" action="">
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">区域选择</label>
                                    <div class="layui-input-inline">
                                        <select name="area_id" lay-varify="required">
                                            <?php if(!empty($area_list)):?>
                                                <?php foreach ($area_list as $key=>$val):?>
                                                    <option value="<?=$val['id']?>"><?=$val['area_name']?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">账号类型</label>
                                    <div class="layui-input-inline">
                                        <select name="type" lay-varify="required">
                                            <option value="2">普通账号</option>
                                            <option value="1">掌柜号</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">账号</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="account" lay-verify="required" value=""  placeholder="请输入账号" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                            </div>

                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit="" lay-filter="bind">立即绑定</button>
                                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="layui-tab-item">
                        <div class="layui-form">
                            <table class="layui-table">
                                <colgroup>
                                    <col width="100">
                                    <col width="180">
                                    <col width="150">
                                    <col width="200">
                                    <col>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>账号区域</th>
                                    <th>账号</th>
                                    <th>账号类型</th>
                                    <th>账号状态</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody id="buy_account">
                                <?php if(!empty($buy_account)):?>
                                    <?php foreach ($buy_account as $key=>$val):?>
                                        <tr>
                                            <td><?=$val['area_name']?></td>
                                            <td><?=$val['account']?></td>
                                            <td>
                                                <?php if($val['type']==2):?>
                                                    任务号
                                                <?php elseif($val['type']==1):?>
                                                    掌柜号
                                                <?php endif;?>
                                            </td>
                                            <td>
                                                <?php if($val['account_status']==1):?>
                                                    正常
                                                <?php elseif($val['account_status']==2):?>
                                                   <span style="color:red">任务进行中</span>
                                                <?php endif;?>
                                            </td>
                                            <td><?=date('Y-m-d h:i',$val['add_time'])?></td>
                                            <td>
                                                <a href="javascript:void(0)" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del_account(this,<?=$val['id']?>);">
                                                <i class="layui-icon">&#xe640;</i>
                                                删除
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="layui-tab-item">
                        <div class="layui-form">
                            <table class="layui-table">
                                <colgroup>
                                    <col width="100">
                                    <col width="180">
                                    <col width="150">
                                    <col width="200">
                                    <col>
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>账号区域</th>
                                    <th>账号</th>
                                    <th>账号类型</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody id="release_account">
                                <?php if(!empty($release_account)):?>
                                    <?php foreach ($release_account as $k=>$v):?>
                                        <tr>
                                            <td><?=$v['area_name']?></td>
                                            <td><?=$v['account']?></td>
                                            <td>
                                                <?php if($v['type']==2):?>
                                                    任务号
                                                <?php elseif($v['type']==1):?>
                                                    掌柜号
                                                <?php endif;?>
                                            </td>
                                            <td><?=date('Y-m-d h:i',$v['add_time'])?></td>
                                            <td>
                                                <a href="javascript:void(0)" class="layui-btn layui-btn-danger layui-btn-mini" onclick="del_account(this,<?=$v['id']?>);">
                                                <i class="layui-icon">&#xe640;</i>
                                                删除
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
  </div>
<script src="<?=config_item('domain_static')?>home/js/user/bind_account.js"></script>
<?php $this->load->view('user/user_footer')?>

