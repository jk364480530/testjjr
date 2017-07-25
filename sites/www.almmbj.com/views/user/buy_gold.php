<?php $this->load->view('user/user_header')?>
        <div class="site-content">
            <h1 class="site-h1">购买镖局币</h1>
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <div class="layui-block">
                        <label class="layui-form-label">镖局币额度</label>
                        <div class="layui-input-inline" style="width: 50%;">
                            <input type="number" name="gold" lay-verify="required" step="0.1" min="0" onchange="max_b(this,<?=$user_info['balance']?>);" autocomplete="off" placeholder="请输入购买的镖局币,0.5/镖局币" class="layui-input">
                            <div class="layui-form-mid layui-word-aux">余额<?php if(!empty($user_info['balance'])):?><span style="color: red;"><?=$user_info['balance']?></span><?php endif;?></div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="buy_gold">立即购买</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
<script src="<?=config_item('domain_static')?>home/js/user/buy_gold.js"></script>
<?php $this->load->view('user/user_footer')?>