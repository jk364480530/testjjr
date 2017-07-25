<?php $this->load->view('public/header')?>
<div class="content">
    <div class="w1200" style="background-color: white;margin-bottom: 20px;">
        <div class="layui-tab-content ite-demo site-demo-body">
        <?php $this->load->view('task/task_nav')?>
        <div class="layui-form">
            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="90">
                    <col width="90">
                    <col width="500">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>编号</th>
                    <th>担保金额</th>
                    <th>可赚金币</th>
                    <th>任务要求</th>
                    <th>发布人</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($list) && is_array($list)):?>
                    <?php foreach ($list as $key=>$val):?>
                        <tr>
                            <td>
                                <p style="font-size: 12px;">单号:<?=$val['task_sn']?></p>
                                <p>
                                    <?php if($val['area_id']==1):?>
                                        <img src="<?=config_item('domain_static')?>home/images/task/taobao.ico" alt="">
                                    <?php endif;?>
                                    <span style="color:#009e94;">
                                           <?=$val['type_name']?>
                                        </span>
                                </p>
                                <p><?php echo date('m-d H:i',$val['add_time']);?></p>
                            </td>
                            <td><?=$val['deposit']?></td>
                            <td><?=$val['gold']?></td>
                            <td>
                                <p style="margin-bottom: 6px;">
                                    <?php if($val['act_score']==1):?>
                                        <img src="<?=config_item('domain_static')?>home/images/task/hp.png" alt="带字好评">
                                    <?php endif;?>
                                    <span class="layui-btn layui-btn-mini" style="background-color: #5fb878;">
                                        <?php if($val['limit_time']==1):?>
                                            物流到后评价
                                        <?php elseif($val['limit_time']==2):?>
                                            立刻好评
                                        <?php elseif($val['limit_time']==3):?>
                                            30分钟后好评
                                        <?php elseif($val['limit_time']==4):?>
                                            1天后好评
                                        <?php elseif($val['limit_time']==5):?>
                                            2天后好评
                                        <?php elseif($val['limit_time']==6):?>
                                            3天后好评
                                        <?php elseif($val['limit_time']==7):?>
                                            4天后好评
                                        <?php elseif($val['limit_time']==8):?>
                                            5天后好评
                                        <?php elseif($val['limit_time']==9):?>
                                            6天后好评
                                        <?php elseif($val['limit_time']==10):?>
                                            7天后好评
                                        <?php endif;?>
                                      </span>
                                    <?php if($val['pt_Loan']==1):?>
                                        <span class="layui-btn layui-btn-mini" style="background-color: #FF5722;">平台放款</span>
                                    <?php endif;?>
                                </p>
                                <p>
                                    <?php if(is_array($val['require'])):?>
                                        <?php foreach ($val['require'] as $k=>$v):?>
                                            <a class="layui-btn layui-btn-mini"  content="<?=$v['content']?>" onmouseout="close_tip();" onmouseenter="alert_tip(this);" style="background-color: #1E9FFF;"><?=$v['name']?></a>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </p>
                                <p style="margin-top:5px;">
                                    <img src="<?=config_item('domain_static')?>home/images/task/buy_bg.png" alt="">&nbsp;&nbsp;<span style="font-weight: bold;">买家信誉等级要求:</span>
                                    <?php if($val['tb_grade']==0):?>
                                        无限
                                    <?php elseif($val['tb_grade']==1):?>
                                        <img src="<?=config_item('domain_static')?>home/images/task/b_red_1.gif" alt="">
                                    <?php elseif($val['tb_grade']==2):?>
                                        <img src="<?=config_item('domain_static')?>home/images/task/b_red_3.gif" alt="">
                                    <?php elseif($val['tb_grade']==3):?>
                                        <img src="<?=config_item('domain_static')?>home/images/task/s_blue_1.gif" alt="">
                                    <?php endif;?>
                                </p>
                            </td>
                            <td><p>昵称：</p>
                                <?=$val['nikename']?>
                            </td>
                            <td>
                                <?php if($this->uid!=$val['release_id']):?>
                                    <a href="javascript:viod(0)" class="layui-btn layui-btn-warm layui-btn-mini" onclick="accept_task(<?=$val['id']?>);">
                                        <i class="layui-icon">&#xe608;</i>
                                        接受任务
                                    </a>
                                <?php else:?>
                                    <a href="javascript:viod(0)" class="layui-btn layui-btn-warm layui-btn-mini  layui-btn-disabled">
                                        <i class="layui-icon">&#xe608;</i>
                                        等待接镖
                                    </a>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif;?>
                </tbody>
            </table>
        </div>
        <div class="text-right" id="page">
            <?php if(isset($page)){ echo $page;}?>
        </div>
    </div>
    </div>
</div>
<script src="<?=config_item('domain_static')?>home/js/common.js"></script>
<script src="<?=config_item('domain_static')?>home/js/task_list.js"></script>

<?php $this->load->view('public/footer')?>