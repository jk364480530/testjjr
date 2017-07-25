<?php $this->load->view('user/user_header')?>
        <div class="site-content">
            <h1 class="site-h1">镖局币兑现</h1>
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <div class="layui-block">
                        <label class="layui-form-label">兑现镖局币</label>
                        <div class="layui-input-inline" style="width: 50%;">
                            <input type="number" name="cash_gold" lay-verify="required|gold" min="1.0" step="0.1" onchange="max_gold(this,<?=$user_info['gold']?>);" autocomplete="off" placeholder="请输入兑现的镖局币" class="layui-input">
                            <div class="layui-form-mid layui-word-aux">镖局币余额<?php if(!empty($user_info['gold'])):?><span style="color: red;"><?=$user_info['gold']?></span><?php endif;?></div>
                        </div>
                        <a style="margin-top: 10px;"class="layui-btn layui-btn-mini layui-btn-danger" onclick="all_cash(this,<?=$user_info['gold']?>);">全部兑换</a>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="cash">立即兑换</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
<script src="<?=config_item('domain_static')?>home/js/user/cash.js"></script>
<?php $this->load->view('user/user_footer')?>