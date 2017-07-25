<?php $this->load->view('user/user_header')?>
        <div class="site-content">
            <h3 class="site-h1" style="color:red;">提现</h3>
            <div class="layui-tab" lay-filter="recharge">
                <ul class="layui-tab-title">
                    <li class="layui-this" lay-id="444">支付宝提现</li>
                    <li lay-id="555">提现记录</li>

                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <form class="layui-form" action="">
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">提现账号</label>
                                    <div class="layui-input-inline">
                                        <select name="zf_type" lay-filter="zf_type">
                                            <option value="1" selected="">支付宝</option>
                                            <option value="2">中国工商银行</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-inline">
                                    <label class="layui-form-label">提现金额</label>
                                    <div class="layui-input-inline">
                                        <input type="text" name="withdraw_amount" lay-verify="required" autocomplete="off" placeholder="请输入提现金额" class="layui-input">
                                    </div>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <div class="layui-input-block">
                                    <button class="layui-btn" lay-submit="" lay-filter="withdraw">立即提现</button>
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
                                    <th>提现金额</th>
                                    <th>提现时间</th>
                                    <th>提现状态</th>
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
<script src="<?=config_item('domain_static')?>home/js/user/withdraw_cash.js"></script>
<?php $this->load->view('user/user_footer')?>