<?php $this->load->view('public/header') ?>
    <div class="seller_index">
        <div class="left">
            <div class="welcome">
                <h3>感谢您使用好样的购商家后台管理系统</h3>
                <p>设置短信提醒,可即时接收、查看订单信息哟 <a href="">立即去设置 >></a></p>
            </div>
            <table class="layui-table">
                <caption>当前订单动态</caption>

                <tr>
                    <td>今日订单数：
                        <span class="blue">300</span>
                    </td>
                    <td>待发货订单：
                        <span class="red">300</span></td>
                </tr>
                <tr>
                    <td>本周订单数：
                        <span class="blue">300</span>
                    </td>
                    <td>配送中订单：
                        <span class="purple">300</span></td>
                </tr>
                <tr>
                    <td>本月订单数：
                        <span class="blue">300</span>
                    </td>
                    <td>待确认订单：
                        <span class="green">300</span></td>
                </tr>
            </table>
            <table class="layui-table table-tac">
                <caption>累计消费top10</caption>
                <tr>
                    <th>名次</th>
                    <th>用户</th>
                    <th>累计消费</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>13844221113</td>
                    <td>333</td>
                </tr>
            </table>

        </div>
        <div class="right">
            <table class="layui-table table-tac">
                <caption>商品销售top10</caption>
                <tr>
                    <th>名次</th>
                    <th>商品名称</th>
                    <th>累计销量</th>
                    <th>库存剩余</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>煎鸡蛋</td>
                    <td>333</td>
                    <td>333</td>
                </tr>
            </table>
        </div>



    </div>


<script language="JavaScript" src="<?php echo config_item('domain_static')?>seller/resources/js/jquery.js"></script>
<!-- 新订单提醒-s -->
<style type="text/css">
    .fl{ float:left; margin-left:10px; margin-top:4px;}
    .fr{ float:right; margin-right:10px; margin-top:3px; width: 20px; height: 20px; background: rgba(0,0,0,0.2); line-height: 20px; text-align: center; border-radius: 100%;}
    .orderfoods{ width:350px; position:fixed; bottom:0; z-index:999; right:10px; background-color:#00A65A; border-radius: 10px;}
    .dor_head{ border-bottom:1px solid #dedede; height:28px; color:#FFF; font-size:12px}
    .dor_head:after{ content:""; clear:both; display:block}
    .dor_foot{ color:#000; height: 97px; padding-top: 30px; background: #fff; font-size: 14px; border: 1px solid #00A65A; border-bottom-left-radius:10px; border-bottom-right-radius:10px;}
    .dor_foot p{ padding:0 90px; margin-bottom: 5px;}
    .te-in{ text-indent:2em;}
    .dor_foot p span{ color:red}
    .te-al-ce{ text-align:center}
</style>
<div id="ordfoo" class="orderfoods" style="display: none">
    <div class="dor_head">
        <p class="fl">订单通知</p>
        <p onClick="closes();" id="close" class="fr" style="cursor:pointer">x</p>
    </div>
    <!--audiostart-->
    <audio id="audio" src="" autoplay="autoplay">您使用的浏览器不支持音频播放</audio>
    <!--audio End-->
    <div class="dor_foot">
        <p class="te-in">您有<span id="orderAmount"></span>笔订单待送货</p>
        <p class="te-al-ce"><a href="<?php echo site_url('/order/order_list')?>" target="_self"><span>点击查看</span></a></p>
    </div>
</div>
<!-- 新订单提醒-e -->

<script type="text/javascript">
    window.setInterval(function() {
        ajaxOrderNotice();
    },5000)
    var now_num = 0; //现在的数量
    var is_close=0;
    var k=0;
    var $ordfoo=document.getElementById('ordfoo');
    function ajaxOrderNotice(){
        var url = '/order/ajaxOrderNotice';
        if(is_close > 0)
            return;
        $.ajax({
            url: url,
            type: "get",
            cache:false,
            dataType: 'json',
            success: function(data){
                //有新订单且数量不跟上次相等 弹出提示
                if(data.output > 0 && data.output != now_num){
                    var str1='';
                    if(data.output > now_num){
                        str1='<audio src="<?php echo config_item('domain_static')?>seller/audio/order_warm.mp3?>" autoplay="autoplay">您使用的浏览器不支持音频播放</audio>';

                    }
                    now_num = data.output;
                    if(k==0 && $ordfoo.style.display == 'none') {
                        $('#orderAmount').text(data.output);
                        getSong();
                        $('#ordfoo').show();
                        k=1;
                    }else{
                        var str='<div class="dor_head">'+
                            '<p class="fl">订单通知</p>'+
                            '<p onClick="closes();" id="close" class="fr" style="cursor:pointer">x</p>'+
                            '</div>'+str1+
                            '<div class="dor_foot">'+
                            '<p class="te-in">您有<span id="orderAmount">'+data.output+'</span>笔订单待送货</p>'+
                            '<p class="te-al-ce"><a href="<?php echo site_url('/order/order_list')?>" target="_self"><span>点击查看</span></a></p>'+
                            '</div>';
                        $ordfoo.innerHTML = str;
                        $ordfoo.style.display ='';
                    }
                }
            }
        })
    }
    function closes(){
        is_close = 1;
        document.getElementById('ordfoo').style.display = 'none';
    }

    function getSong(){
        var audio = document.getElementById("audio");
        audio.src = "<?php echo config_item('domain_static')?>seller/audio/order_warm.mp3?>";
    }
</script>
<?php $this->load->view('public/footer') ?>