<?php $this->load->view('user/user_header')?>
   <div class="site-content">
       <style>
          .cz-icon{
               background:url(<?=config_item('domain_static')?>home/images/user/cz.png)no-repeat;
              width:50px;
              height:50px;
               background-size:cover;
               display: block;
              margin: 20px auto;
          }
          .tx-icon{
              background:url(<?=config_item('domain_static')?>home/images/user/tx.png)no-repeat;
              width:50px;
              height:50px;
              background-size:cover;
              display: block;
              margin: 20px auto;
          }
          .fb-icon{
              background:url(<?=config_item('domain_static')?>home/images/user/fb.png)no-repeat;
              width:50px;
              height:50px;
              background-size:cover;
              display: block;
              margin: 20px auto;
          }
          .hs-icon{
              background:url(<?=config_item('domain_static')?>home/images/user/hs.png)no-repeat;
              width:50px;
              height:50px;
              background-size:cover;
              display: block;
              margin: 20px auto;
          }
          .vip-icon{
              background:url(<?=config_item('domain_static')?>home/images/user/vip.png)no-repeat;
              width:50px;
              height:50px;
              background-size:cover;
              display: block;
              margin: 20px auto;
          }
          .tg-icon{
              background:url(<?=config_item('domain_static')?>home/images/user/tg.png)no-repeat;
              width:50px;
              height:50px;
              background-size:cover;
              display: block;
              margin: 20px auto;
          }
          .header_img{
              background:url(<?=config_item('domain_static')?>home/images/user/header_img.jpg)no-repeat;
              width:50px;
              height:50px;
              background-size:cover;
              display: block;
              margin: 20px auto;
              border-radius: 100px;
          }
           .header-left{
               float: left;
               width: 100px;
               height: 100%;
           }
          .header-mid{
              float: left;
              width: 200px;
              height: 100%;
          }
          .header-right{
              float: left;
              width: 200px;
              height: 100%;
          }
       </style>
            <h1 class="site-h1">个人中心</h1>
            <div style="margin: 10px 10px;height:100px;background-color:rgba(189, 242, 242, 0.26);">
                <div class="header-left">
                    <div class="header_img"></div>
                </div>
                <div class="header-mid">
                    <p style="margin-top:15px;height: 10px;"><span style="font-weight: bold">昵称:</span><?php if(!empty($user_info)):?><?=$user_info['nikename']?><?php endif;?></p>
                    <p style="margin-top:15px;height: 10px;"><span style="font-weight: bold">余额:</span><?php if(!empty($user_info)):?><?=$user_info['balance']?><?php endif;?></p>
                    <p style="margin-top:15px;height: 10px;"><span style="font-weight: bold">镖局币:</span><?php if(!empty($user_info)):?><?=$user_info['gold']?><?php endif;?></p>
                </div>
                <div class="header-right">
                    <a href="/task/add_task">
                    <button class="layui-btn  layui-btn-danger layui-btn-mini" style="margin-top: 50px;">
                        <i class="layui-icon">&#xe638;</i>
                       发布任务
                    </button>
                    </a>
                </div>

            </div>
            <div style="margin: 10px 10px; background-color:rgba(189, 242, 242, 0.26);">
                <ins class="adsbygoogle" style="display:inline-block;width:100%;height:150px" data-ad-client="ca-pub-6111334333458862" data-ad-slot="9841027833">
                    <a href="/user/recharge">
                        <div style="width: 16%;height: 90px;float: left;">
                            <icon class="cz-icon" style=""></icon>
                            <span style="width: 100%;text-align: center;display: block;font-size: 15px;font-weight: bold">充值</span>
                        </div>
                    </a>
                    <a href="/user/withdraw_cash">
                    <div style="width: 16%;height: 90px;float: left;">
                        <icon class="tx-icon"></icon>
                        <span style="width: 100%;text-align: center;display: block;font-size: 15px;font-weight: bold">提现</span>
                    </div>
                    </a>
                    <a href="/user/buy_gold">
                    <div style="width: 16%;height: 90px;float: left;">
                        <icon class="fb-icon"></icon>
                        <span style="width: 100%;text-align: center;display: block;font-size: 15px;font-weight: bold">购买镖局币</span>
                    </div>
                    </a>
                    <a href="/user/cash">
                    <div style="width: 16%;height: 90px;float: left;">
                        <icon class="hs-icon"></icon>
                        <span style="width: 100%;text-align: center;display: block;font-size: 15px;font-weight: bold">镖局币兑现</span>
                    </div>
                    </a>
                    <a href="/user/recharge">
                    <div style="width: 16%;height: 90px;float: left;">
                        <icon class="vip-icon"></icon>
                        <span style="width: 100%;text-align: center;display: block;font-size: 15px;font-weight: bold">开通VIP</span>
                    </div>
                    </a>
                    <a href="/user/recharge">
                    <div style="width: 16%;height: 90px;float: left;">
                        <icon class="tg-icon"></icon>
                        <span style="width: 100%;text-align: center;display: block;font-size: 15px;font-weight: bold">推广</span>
                    </div>
                    </a>
                </ins>
            </div>


            <fieldset class="layui-elem-field layui-field-title site-title">
                <legend><a name="get">登录信息</a></legend>
            </fieldset>

           <div style="margin: 10px 10px;height:100px;background-color:rgba(189, 242, 242, 0.26);">


           </div>

            <fieldset class="layui-elem-field layui-field-title site-title">
                <legend><a name="classical">任务信息</a></legend>
            </fieldset>
           <div style="margin: 10px 10px;height:100px;background-color:rgba(189, 242, 242, 0.26);">


           </div>

        </div>
<?php $this->load->view('user/user_footer')?>