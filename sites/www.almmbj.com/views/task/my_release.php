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
                    <th>任务详情</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($list) && is_array($list)):?>
                    <?php foreach ($list as $key=>$val):?>
                        <tr>
                            <td>
                                <p><?=$val['task_sn']?></p>
                                <p>
                                    <?php if($val['area_id']==1):?>
                                        <img src="<?=config_item('domain_static')?>home/images/task/taobao.ico" alt="">
                                    <?php endif;?>
                                    <span style="color:#009e94">
                                           <?=$val['type_name']?>
                                        </span>
                                </p>
                                <p><?php echo date('m-d H:i',$val['add_time']);?></p>
                            </td>
                            <td><?=$val['deposit']?></td>
                            <td><?=$val['gold']?></td>
                            <td><p style="margin-bottom: 6px;">
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
                            <td style="color:#009e94;text-align: center">
                                <?php if($val['is_origin']==1):?>
                                    [<a href="javascript:void(0);" onclick="lailu_detail(<?=$val['id']?>);" style="color:#009e94;">搜索详情</a>]
                                    <br><br>
                                <?php endif;?>
                                    [<a href="javascript:void(0);" onclick="task_detail(<?=$val['id']?>);" style="color:#009e94;">任务详情</a>]
                            </td>
                            <td>
                                <?php if($val['status']==2):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini layui-btn-disabled">等待绑定</button>
                                    <br>
                                    <a href="javascript:void(0);" id="cancel_task<?=$val['id']?>" buy_account_id="<?=$val['buy_account_id']?>" onclick="cancel_task(<?=$val['id']?>);" style="color:#009688">取消任务</a>
                                    <script>
                                        var js<?=$val['id']?>=setInterval("timer(<?=$val['count_down']?>,<?=$val['id']?>,js<?=$val['id']?>)",1000);
                                    </script>
                                    <p id="countdown<?=$val['id']?>" class="countdown" style="">
                                        <span style="margin-top:1px;float:left;width:16px;height:16px;background:url(<?=config_item('domain_static')?>home/images/task/clock.png);"></span>
                                        <span id="less_hour<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_minutes<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_seconds<?=$val['id']?>" class="tihuan">00</span>
                                    </p>
                                <?php elseif($val['status']==3):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini" onclick="change_status(<?=$val['id']?>,4)">确认审核</button>
                                    <br>
                                    <a href="javascript:void(0);" id="cancel_task<?=$val['id']?>" buy_account_id="<?=$val['buy_account_id']?>" onclick="cancel_task(<?=$val['id']?>);" style="color:#009688">取消任务</a>
                                    <script>
                                        var js<?=$val['id']?>=setInterval("timer(<?=$val['count_down']?>,<?=$val['id']?>,js<?=$val['id']?>)",1000);
                                    </script>
                                    <p id="countdown<?=$val['id']?>" class="countdown">
                                        <span style="margin-top:1px;float:left;width:16px;height:16px;background:url(<?=config_item('domain_static')?>home/images/task/clock.png);"></span>
                                        <span id="less_hour<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_minutes<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_seconds<?=$val['id']?>" class="tihuan">00</span>
                                    </p>
                                <?php elseif($val['status']==4):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini layui-btn-disabled">等待验证</button>
                                    <br>
                                    <a href="javascript:void(0);" id="cancel_task<?=$val['id']?>" buy_account_id="<?=$val['buy_account_id']?>" onclick="cancel_task(<?=$val['id']?>);" style="color:#009688">取消任务</a>
                                    <script>
                                        var js<?=$val['id']?>=setInterval("timer(<?=$val['count_down']?>,<?=$val['id']?>,js<?=$val['id']?>)",1000);
                                    </script>
                                    <p id="countdown<?=$val['id']?>" class="countdown">
                                        <span style="margin-top:1px;float:left;width:16px;height:16px;background:url(<?=config_item('domain_static')?>home/images/task/clock.png);"></span>
                                        <span id="less_hour<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_minutes<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_seconds<?=$val['id']?>" class="tihuan">00</span>
                                    </p>
                                <?php elseif($val['status']==5):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini layui-btn-disabled">等待支付</button>
                                    <br>
                                    <a href="javascript:void(0);" id="cancel_task<?=$val['id']?>" buy_account_id="<?=$val['buy_account_id']?>" onclick="cancel_task(<?=$val['id']?>);" style="color:#009688">取消任务</a>
                                    <script>
                                        var js<?=$val['id']?>=setInterval("timer(<?=$val['count_down']?>,<?=$val['id']?>,js<?=$val['id']?>)",1000);
                                    </script>
                                    <p id="countdown<?=$val['id']?>" class="countdown">
                                        <span style="margin-top:1px;float:left;width:16px;height:16px;background:url(<?=config_item('domain_static')?>home/images/task/clock.png);"></span>
                                        <span id="less_hour<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_minutes<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_seconds<?=$val['id']?>" class="tihuan">00</span>
                                    </p>
                                <?php elseif($val['status']==6):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini" onclick="change_status(<?=$val['id']?>,8)">确认发货</button>
                                    <script>
                                        var js<?=$val['id']?>=setInterval("timer1(<?=$val['count_down']?>,<?=$val['id']?>,js<?=$val['id']?>,'deliver_goods')",1000);
                                    </script>
                                    <p id="countdown<?=$val['id']?>" class="countdown">
                                        <span style="margin-top:1px;float:left;width:16px;height:16px;background:url(<?=config_item('domain_static')?>home/images/task/clock.png);"></span>
                                        <span id="less_hour<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_minutes<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_seconds<?=$val['id']?>" class="tihuan">00</span>
                                    </p>
                                <?php elseif($val['status']==7):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini layui-btn-disabled">等待物流</button>
                                    <script>
                                        var js<?=$val['id']?>=setInterval("timer1(<?=$val['count_down']?>,<?=$val['id']?>,js<?=$val['id']?>,'waite_logistics')",1000);
                                    </script>
                                    <p id="countdown<?=$val['id']?>" class="countdown">
                                        <span style="margin-top:1px;float:left;width:16px;height:16px;background:url(<?=config_item('domain_static')?>home/images/task/clock.png);"></span>
                                        <span id="less_day<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_hour<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_minutes<?=$val['id']?>" class="tihuan">00</span><span>:</span>
                                        <span id="less_seconds<?=$val['id']?>" class="tihuan">00</span>
                                    </p>
                                <?php elseif($val['status']==8):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini layui-btn-disabled">等待好评</button>
                                <?php elseif($val['status']==9):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini" onclick="loan(<?=$val['id']?>)">审核放款</button>
                                    <?php if($val['pt_Loan']==1):?>
                                        <button class="layui-btn layui-btn-warm layui-btn-mini layui-btn-disabled">平台放款</button>
                                    <?php endif;?>
                                <?php elseif($val['status']==10):?>
                                    <button class="layui-btn layui-btn-warm layui-btn-mini layui-btn-disabled">任务完成</button>
                                <?php endif;?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <img src="<?=config_item('domain_static')?>home/images/task/buy_bg.png" alt="">&nbsp;&nbsp;<span style="font-weight: bold;">详情:</span>
                                <?=$val['accept_username']?>
                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?=$val['accept_qq']?>&site=qq&menu=yes">
                                    <img src="<?=config_item('domain_static')?>home/images/task/qq_bg_1.gif" >
                                </a>
                                <?=$val['accept_qq']?>
                                <p style="float: right">
                                    <span>掌柜:<?=$val['release_account']?></span>
                                    &nbsp;&nbsp;
                                    <span>接手:
                                        <?php if(!empty($val['buy_account'])):?>
                                        <?=$val['buy_account']?>
                                        <?php else:?>
                                        待绑定
                                        <?php endif;?>
                                    </span>
                                </p>

                            </td>
                        </tr>
                    <?php endforeach;?>
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
<script src="<?=config_item('domain_static')?>home/js/my_release.js"></script>

<?php $this->load->view('public/footer')?>