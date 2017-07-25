<?php $this->load->view('/public/header')?>
<div class="content">
   <div class="w1200" style="background-color: white;margin-bottom: 20px;">
        <style>
        .layui-form-item .layui-form-checkbox[lay-skin=primary] {
            float: left;
        }
        .ping_tai span{
            color:red !important;
        }
        .counter-body {
            position: fixed;
            box-shadow: none;
            border: 1px solid #d2d2d2;
            z-index: 10000;
            margin-top:50px;
            margin-left: 900px;
            width:180px;
            height:200px;

        }
        .counter-title {
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0 80px 0 20px;
            height: 42px;
            line-height: 42px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #333;
            overflow: hidden;
            background-color: #F8F8F8;
            border-radius: 2px 2px 0 0;
        }
        .site-dir li{
            line-height: 30px;
            margin-left: 10px;
            overflow: visible;
        }
        .img-box {
            display: inline-block;
            width: 80px;
            height: 55px;
            border: 1px solid #e6e6e6;
            margin-top: 5px;
            margin-bottom: 5px;
            background-size: 80px 55px;
            line-height: 85px;
            text-align: center;
        }
    </style>
        <div class="layui-tab-content ite-demo site-demo-body">

    <a href="/user/person_center" class="layui-btn">个人中心</a>
    <a href="/task/task_list" class="layui-btn">任务大厅</a>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>发布任务</legend>
    </fieldset>
    <form class="layui-form" action="">
    <!--计算器start-->
    <div class="counter-body"  type="page">
       <div class="counter-title">计算器</div>
       <div id="" class="counter-content">
          <ul class="site-dir" style="display: block;">
             <li>合计镖局币:<span id="total-gold" style="color:red;font-size: 15px;font-family: 方正大黑简体">1.0</span></li>
              <input type="hidden" name="gold" value="1">
             <li>剩余镖局币:<?php if(!empty($user_info['gold'])):?><?=$user_info['gold']?><?php endif;?></li>
             <li>保证金:<span id="jsq_deposit" style="color:red;font-size: 15px;font-family: 方正大黑简体">0.00</span></li>
             <li>余额:<?php if(!empty($user_info['balance'])):?><?=$user_info['balance']?><?php endif;?>&nbsp;&nbsp;<a  href="/user/recharge" class="layui-btn  layui-btn-danger layui-btn-mini"><i class="layui-icon"></i>充值</a></li>
          </ul>
       </div>
    </div>
    <!--计算器end-->
    <div class="layui-form-item">
        <label class="layui-form-label">选择模板</label>
        <div class="layui-input-inline">
            <select name="">
                <option value="">模板选择</option>
                <option value="">暂时还没有模板哦</option>
            </select>
        </div>
        <div class="layui-form-mid layui-word-aux">选择自己的模板，快速建立任务！</div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">押镖区域</label>
        <div class="layui-input-inline">
            <select name="area_id" lay-verify="required" lay-filter="area">
                <option value="">选择区域</option>
                <?php if(!empty($area_list)):?>
                    <?php foreach ($area_list as $key=>$val):?>
                    <option <?php if($val['id']==1)echo 'selected="selected"'?>value="<?=$val['id']?>"><?=$val['area_name']?></option>
                    <?php endforeach;?>
                <?php endif?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">选择掌柜号</label>
        <div class="layui-input-block user_account">
            <?php if(!empty($user_account_list)):?>
                <?php foreach ($user_account_list as $key=>$val):?>
                    <input type="radio" name="account_id" value="<?=$val['id']?>" title="<?=$val['account']?>" <?php if($key==0) echo 'checked=""'?>>
                <?php endforeach;?>
            <?php else:?>
                <a class="layui-btn" href="/user/bind_account">还没有添加淘宝账号</a>
            <?php endif;?>

        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">任务类型</label>
        <input type="hidden" name="last_type"  gold-data="0">
        <div class="layui-input-block task_type">
            <?php if(!empty($task_type_list)):?>
                <?php foreach ($task_type_list as $key=>$val):?>
                    <input type="radio" name="task_type" value="<?=$val['id']?>" lay-filter="task_type"  gold-data="<?=$val['gold']?>" title="<?=$val['type_name']?>(<?=$val['gold']?>)" <?php if($key==0) echo 'checked=""'?>>
                <?php endforeach;?>
            <?php else:?>
                <a class="layui-btn">淘宝还没有添加任务类型</a>
            <?php endif;?>
        </div>
    </div>
    <div id="task_type">
        <div class="layui-form-item">
            <label class="layui-form-label goods_url">商品地址</label>
            <div class="layui-input-block">
                <input type="text" name="goods_url" lay-verify="url|required" placeholder="请输入商品地址" autocomplete="off" id="goods_url" onchange="get_title(this.value);" class="layui-input" style="width:50%;">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label goods_title">商品标题</label>
            <div class="layui-input-block">
                <input type="text" name="goods_title" id="goods_title" lay-verify="title|required" placeholder="请输入商品标题" value="" autocomplete="off" class="layui-input" style="width:50%;">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">任务标题</label>
        <div class="layui-input-block">
            <input type="text" name="task_title" id="task_title" lay-verify="title|required" placeholder="请输入任务标题" value="" autocomplete="off" class="layui-input" style="width:50%;">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">担保金额</label>
        <div class="layui-input-inline">
            <input type="number" name="deposit" min="0" step="0.01" onchange="top_deposit(this,<?=$user_info['balance']?>);" lay-verify="decimal|required" placeholder="请输入担保金额" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid layui-word-aux">单位：元&nbsp;&nbsp;<span style="color:red">余额:<?php if(!empty($user_info['balance'])):?><?=$user_info['balance']?><?php endif;?></span></div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">好评时限</label>
        <div class="layui-input-inline">
            <input type="hidden" name="last_logistics" gold-data="0">
            <select name="limit_time" lay-verify="required" lay-filter="logistics">
                <option value="1" gold-data="3">物流到后确认好评(3.0)</option>
                <option value="2" gold-data="0" >立刻确认好评(免费)</option>
                <option value="3" gold-data="0" >30分钟后确认好评(免费)</option>
                <option value="4" gold-data="1" >1天后确认好评(1.0)</option>
                <option value="5" gold-data="2">2天后确认好评(2.0)</option>
                <option value="6" gold-data="3">3天后确认好评(3.0)</option>
                <option value="7" gold-data="4">4天后确认好评(4.0)</option>
                <option value="8" gold-data="5">5天后确认好评(5.0)</option>
                <option value="9" gold-data="6">6天后确认好评(6.0)</option>
                <option value="10"gold-data="7">7天后确认好评(7.0)</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item" pane="">
        <label class="layui-form-label">搜索来路</label>
        <div class="layui-input-block">
            <input type="checkbox" name="is_origin" lay-skin="primary" gold-data="1" value="1" lay-filter="source" title="使用搜索来路，模拟真实交易">
            <div class="layui-form-mid layui-word-aux">悬赏1.0金币</div>
        </div>
    </div>
    <div class="layui-form-item" pane="" id="source" style="display: none;">
        <label class="layui-form-label"></label>
        <div class="layui-input-block" style="width:50%;background-color: #fbfbfb;padding-bottom: 20px;border-radius: 5px;">
            <div class="layui-form-item">
                <label class="layui-form-label">搜索方式</label>
                <div class="layui-input-block">
                    <input type="radio" name="search_mode" value="1" title="搜索宝贝" checked="">
                    <input type="radio" name="search_mode" value="2" title="搜索店铺">
                    <input type="radio" name="search_mode" value="3" title="搜索直通车">
                    <input type="radio" name="search_mode" value="4" title="其他来路">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">搜索提示</label>
                <div class="layui-input-block">
                    <input type="text" name="search_hint" lay-verify="" placeholder="请输入搜索提示" autocomplete="off" class="layui-input" style="width:50%;">
                </div>
                <label class="layui-form-label"></label>
                <div class="layui-form-mid layui-word-aux" style="color: #ff5722;">例如：宝贝在搜索的第几页</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">搜索关键词</label>
                <div class="layui-input-block">
                    <input type="text" name="search_keyword" lay-verify="" placeholder="请输入搜索关键词" autocomplete="off" class="layui-input" style="width:50%;">
                </div>
                <label class="layui-form-label"></label>
                <div class="layui-form-mid layui-word-aux" style="color: #ff5722;">输入您的宝贝名或者店铺名，引导接手人搜索到你</div>
            </div>

            <div class="layui-form-item">

                <label class="layui-form-label">截图事列</label>
                <div class="layui-input-block">
                    <div class="layui-tab layui-tab-card">
                        <ul class="layui-tab-title">
                            <li class="layui-this">选择默认模板</li>
                            <li>从新上传</li>
                        </ul>
                        <div class="layui-tab-content" style="height: 100px;">
                            <div class="layui-tab-item layui-show">1</div>
                            <div class="layui-tab-item">
                                <div id="lailu_img"></div>
                                <a class="layui-btn" href="javascript:void(0);" onclick="upload_img('origin_img');">
                                    <i class="layui-icon">&#xe62f;</i> 上传图片
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">校验地址</label>
                <div class="layui-input-block">
                    <input type="text" name="check_url" lay-verify="" placeholder="请输入" autocomplete="off" class="layui-input" style="width:50%;">
                </div>
                <label class="layui-form-label"></label>
                <div class="layui-form-mid layui-word-aux" style="color: #ff5722;">输入您的宝贝名或者店铺名，引导接手人搜索到你</div>
            </div>
        </div>
    </div>
    <div class="layui-form-item" pane="">
        <label class="layui-form-label">动态评分</label>
        <div class="layui-input-block">
            <input type="checkbox" name="act_score" checked="" gold-data="0" value="1" lay-skin="primary" title="动态评分全部5分，如不勾选则不用评分">
            <div class="layui-form-mid layui-word-aux">免费</div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">带字好评</label>
        <div class="layui-input-block">
           <input type="radio" name="praise" value="1" title='<img src="<?=config_item("domain_static")?>home/images/task/hp.png" alt="">&nbsp;&nbsp;带字好评' checked="">
           <input type="radio" name="praise" value="0" title='<img src="<?=config_item("domain_static")?>home/images/task/no_hp.png" alt="">&nbsp;&nbsp;不带字好评'>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">淘宝等级</label>
         <div class="layui-input-block">
                <input type="hidden" name="last_grade"  gold-data="0">
                <input type="radio" name="tb_grade" value="0" lay-filter="tb_grade" gold-data="0" title="无限制" checked="">
                <input type="radio" name="tb_grade" value="1" lay-filter="tb_grade" gold-data="0.2" title='<img src="<?=config_item("domain_static")?>home/images/task/b_red_1.gif" alt="">(悬赏0.2)'>
                <input type="radio" name="tb_grade" value="2" lay-filter="tb_grade" gold-data="0.5" title='<img src="<?=config_item("domain_static")?>home/images/task/b_red_3.gif" alt="">(悬赏0.5)' >
                <input type="radio" name="tb_grade" value="3" lay-filter="tb_grade" gold-data="2.0" title='<img src="<?=config_item("domain_static")?>home/images/task/s_blue_1.gif" alt="">砖石(悬赏2.0)'>
         </div>
    </div>
    <div class="layui-form-item" pane="">
       <label class="layui-form-label">平台放款</label>
       <div class="layui-input-block ping_tai">
            <input type="checkbox" name="pt_Loan" lay-skin="primary"  gold-data="0" value="1" title="任务结束后由平台进行审核放款（此功能免费）" checked="">
            <div class="layui-form-mid layui-word-aux">该功能免费</div>
       </div>
    </div>
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>指定要求</legend>
    </fieldset>
    <div class="layui-form-item" pane="">
        <label class="layui-form-label">指定评语</label>
        <div class="layui-input-block">
            <input type="checkbox" name="is_evaluate"  gold-data="0.5" value="1" gold-data="0.5" lay-skin="primary" lay-filter="evaluate" title="需要接手人根据我的要求填写好评">
            <div class="layui-form-mid layui-word-aux">悬赏0.5金币</div>
        </div>
    </div>
    <div class="layui-form-item evaluate" pane="" style="display:none">
        <div class="layui-input-block">
            <input type="text" name="evaluate" lay-verify="" placeholder="请输入指定评语" autocomplete="off" class="layui-input" style="width:50%;">
        </div>
     </div>
     <div class="layui-form-item" pane="">
            <label class="layui-form-label">图片评价</label>
            <div class="layui-input-block">
                <input type="checkbox" name="is_com_img"  gold-data="0.5" value="1" lay-filter="comment_img" lay-skin="primary" title="任务结束后需要追加评价卖家提供的宝贝截图">
                <div class="layui-form-mid layui-word-aux">悬赏0.5金币</div>
            </div>
    </div>
        <div class="layui-form-item com_img" pane="" style="display:none">
            <div class="layui-input-block">
                <div id="com_img"></div>
                <a class="layui-btn" href="javascript:void(0);"  onclick="upload_img('comment_img');">
                    <i class="layui-icon">&#xe62f;</i> 上传图片
                </a>
            </div>
        </div>
    <div class="layui-form-item" pane="">
        <label class="layui-form-label">指定地址</label>
        <div class="layui-input-block">
            <input type="checkbox" name="is_address"  gold-data="0.5" lay-skin="primary" value="1" lay-filter="address" title="要求接手方按指定的收货地址填写" >
            <div class="layui-form-mid layui-word-aux">悬赏0.5金币</div>
        </div>
    </div>
        <div class="layui-form-item address" pane="" style="display:none">
            <div class="layui-input-block">
                <input type="text" name="address" lay-verify="" value="" placeholder="请输入指定收货地址" autocomplete="off" class="layui-input" style="width:50%;">
            </div>
            <div class="layui-input-block" style="line-height: 36px;">
                <span>列如:广东省广州市越秀区362号 联系人：张三 电话：130013888</span>
            </div>
        </div>
    <div class="layui-form-item" pane="">
       <label class="layui-form-label">指定地区</label>
       <div class="layui-input-block">
                <input type="checkbox" name="is_area" value="1" gold-data="0.5" lay-skin="primary" title="指定某些地区用户才可以接手，可避免重复用户交易">
                <div class="layui-form-mid layui-word-aux">悬赏0.5金币</div>
       </div>
    </div>
    <div class="layui-form-item" pane="">
       <label class="layui-form-label">发布时间</label>
        <div class="layui-input-block">
            <input type="checkbox" name="is_release_time" value="1" gold-data="0" lay-filter="release_time" lay-skin="primary" title="设定的时间显示在任务大厅">
            <div class="layui-form-mid layui-word-aux">免费</div>
        </div>
    </div>
    <div class="layui-form-item release_time" pane="" style="display:none;">
        <label class="layui-form-label"></label>
        <div class="layui-input-inline">
            <input type="text" name="start_time" value="" class="layui-input" placeholder="开始时间" id="LAY_demorange_s">
        </div>
        <div class="layui-input-inline">
            <input type="text" name="end_time" value="" class="layui-input" placeholder="结束时间" id="LAY_demorange_e">
        </div>
    </div>
    <div class="layui-form-item" pane="">
       <label class="layui-form-label">批量发布</label>
        <div class="layui-input-block">
           <input type="checkbox" name="is_batch_release" gold-data="0" value="1" lay-skin="primary" title="自动发布多条任务">
            <div class="layui-form-mid layui-word-aux">免费</div>
       </div>
    </div>


    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
        <legend>流程要求</legend>
    </fieldset>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <input type="checkbox" name=""  title="全选" gold-data="0" lay-skin="primary" lay-filter="check_all" >
            <input type="checkbox" name="" title="反选" gold-data="0" lay-skin="primary" lay-filter="select_invert">
        </div>
    <div class="process_require">
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">需要审核</label>
            <div class="layui-input-block">
                <input type="checkbox" name="is_verify"  gold-data="1" value="1" lay-skin="primary" title="接手方接您任务后，要您审核后才可以继续任务" checked>
                <div class="layui-form-mid layui-word-aux">悬赏1.0金币</div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">货比三家</label>
            <div class="layui-input-block">
                    <input type="checkbox"  name="task_require[2]" gold-data="0.5" value="than" lay-skin="primary" title="需要浏览同类别的三家店铺">
                    <div class="layui-form-mid layui-word-aux">悬赏0.5金币</div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
           <label class="layui-form-label">浏览商品</label>
           <div class="layui-input-block">
                    <input type="checkbox" name="task_require[3]" gold-data="0.5" value="browse" lay-skin="primary" title="需要购买前浏览店铺内的其他商品2件">
                    <div class="layui-form-mid layui-word-aux">悬赏0.5金币</div>
           </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">页面停留</label>
            <div class="layui-input-block">
                <input type="checkbox" name="task_require[4]" value="stop" gold-data="0.3" lay-skin="primary" title="需要接手人在页面停留三分钟再拍">
                <div class="layui-form-mid layui-word-aux">悬赏0.3金币</div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">假聊</label>
            <div class="layui-input-block">
                <input type="checkbox" name="task_require[5]" value="talk" gold-data="1" lay-skin="primary" title="要求接手方先与卖家假聊几句，作为交易的依据 ">
                <div class="layui-form-mid layui-word-aux">悬赏1.0金币</div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">双收藏</label>
            <div class="layui-input-block">
                <input type="checkbox" name="task_require[6]"  gold-data="0.3" value="collect"lay-skin="primary" title="要求接手方收藏您店铺和宝贝">
                <div class="layui-form-mid layui-word-aux">悬赏0.3金币</div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">QQ截图</label>
            <div class="layui-input-block">
                <input type="checkbox" name="task_require[7]" gold-data="0.1" value="screenshot" lay-skin="primary" title="需要接手人通过QQ提供相关操作截图">
                <div class="layui-form-mid layui-word-aux">悬赏0.1金币</div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">删订单</label>
            <div class="layui-input-block">
                <input type="checkbox" name="task_require[8]" value="del_order" gold-data="0.2" lay-skin="primary" title="需要接手人在任务完成后删除购物网站购买记录">
                <div class="layui-form-mid layui-word-aux">悬赏0.2金币</div>
            </div>
        </div>
        <div class="layui-form-item" pane="">
            <label class="layui-form-label">物流签收</label>
            <div class="layui-input-block">
                <input type="checkbox" name="task_require[9]" value="sign" gold-data="1" lay-skin="primary" title="需要接手人真实签收快递包裹">
                <div class="layui-form-mid layui-word-aux">悬赏1.0金币</div>
            </div>
        </div>
    </div>

   <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
       <legend>其他</legend>
   </fieldset>
    <div class="layui-form-item">
        <label class="layui-form-label">追加金币</label>
        <div class="layui-input-inline">
            <input type="number" name="more_gold" min="0" step="0.1" lay-verify="decimal" onchange="surplus_gold(this);" placeholder="请输入金币数量" autocomplete="off" class="layui-input">
            <input type="hidden" name="last_gold" value="0" id="last_gold">
        </div>
        <div class="layui-form-mid layui-word-aux">单位：金元</div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">任务提醒</label>
        <div class="layui-input-block">
            <input type="text" name="task_warn" lay-verify="" placeholder="请输入提醒内容" autocomplete="off" class="layui-input" style="width:50%;">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="task">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>

</form>
</div>
   </div>
</div>
<script src="<?=config_item('domain_static')?>home/js/release_task.js"></script>
<?php $this->load->view('/public/footer')?>