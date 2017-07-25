<?php $this->load->view('user/user_header')?>
    <style>
        .layui-form-item .layui-input-inline{
            width:250px;
        }
    </style>
        <div class="site-content">
            <h3 class="site-h1" style="color:red;">充值</h3>
            <div class="layui-tab" lay-filter="recharge">
                <ul class="layui-tab-title">
                    <li class="layui-this" lay-id="444">支付宝充值</li>
                    <li lay-id="555">充值记录</li>

                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <form class="layui-form" action="">
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label"></label>
                                    <div class="layui-input-inline" style="color:red">
                                         付款第一步:支付宝转账
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">支付宝账号</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="alipay"  autocomplete="off" value="18074900075" class="layui-input" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">姓名</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="alipay"  autocomplete="off" value="蒋季容" class="layui-input" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">付款备注</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="alipay"  autocomplete="off" value="biaoju8888" class="layui-input" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">支付二维码</label>
                                    <div class="layui-input-inline">
                                        <img style="width:200px;"src="<?=config_item('domain_static')?>home/images/user/aplipay.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label"></label>
                                    <div class="layui-input-inline" style="color:red">
                                        付款第二步:填写订单号提交充值
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">订单号</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="title" lay-verify="required" autocomplete="off" placeholder="请输入订单号" class="layui-input">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit="" lay-filter="recharge">立即充值</button>
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
                                    <th>编号</th>
                                    <th>充值金额</th>
                                    <th>充值时间</th>
                                    <th>充值状态</th>
                                </tr>
                                </thead>
                                <tbody id="buy_account">
                                <?php if(!empty($buy_account)):?>
                                    <?php foreach ($buy_account as $key=>$val):?>
                                        <tr>
                                            <td><?=$val['area_name']?></td>
                                            <td><?=$val['account']?></td>
                                            <td><?=date('Y-m-d h:i',$val['add_time'])?></td>
                                            <td></td>
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
<script src="<?=config_item('domain_static')?>home/js/user/recharge.js"></script>
<?php $this->load->view('user/user_footer')?>