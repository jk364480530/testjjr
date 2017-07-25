<?php /*$this->load->view('public/header')*/?>
<link href="<?=config_item('domain_static')?>common/layui/css/layui.css" rel="stylesheet">
<link href="<?=config_item('domain_static')?>common/layer/skin/default/layer.css" rel="stylesheet">
<script type="text/javascript" src="<?= config_item('domain_static')?>common/layer/layer.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12" id="user_list">
            <form action="/user/buyer_list" method="get" class="form-inline mb15">

                <select name="typeid" class="form-control">
                    <option value="">请选择</option>
                    <option value="1" <?php if (isset($typeid) && $typeid == '1') { ?> selected="selected" <?php } ?>>用户编号</option>
                    <option value="2" <?php if (isset($typeid) && $typeid == '2') { ?> selected="selected" <?php } ?>>手机号码</option>
                </select>

                <div class="form-group">
                    <input type="text"  id="keyword" name="keyword" class="form-control" placeholder="编号/手机号码" value="<?php if(isset($keyword)) echo $keyword; ?>">
                </div>

                <span>时间：</span>
                <div class="form-group">
                    <input type="text" id="start_time" name="start_time" readonly="readonly" class="form-control" value="<?php if(isset($start_time)) echo $start_time; ?>" placeholder="开始时间">
                        -
                    <input type="text" id="end_time" name="end_time" readonly="readonly" class="form-control" value="<?php if(isset($end_time)) echo $end_time; ?>"  placeholder="结束时间">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-pencil"></span>查询</button>
                    <button class="btn btn-default">数据导出</button>
                </div>
            </form>
            <table class="table table-striped table-bordered table-tac">
                <tr>
                    <th>用户编号</th>
                    <th>手机号码</th>
                    <th>注册时间</th>
                    <th>状态</th>
                    <th class="display_none_768">操作</th>
                </tr>
                <?php if(isset($list) && !empty($list)):?>
                  <?php foreach ($list as $item): ?>
                    <tr>
                        <td><?php echo $item['uid'];?></td>
                        <td><?php echo $item['phone'];?></td>
                        <td><?php echo date("Y-m-d H:i:s",$item['reg_time']);?></td>
                        <td>
                            <form class="layui-form">
                                <input type="checkbox" name="switch" <?php if($item['is_lock']==0) echo 'checked ="checked"'?> lay-skin="switch" lay-text="开通|封号"  lay-filter="switchTest" val="<?=$item['uid']?>">
                            </form>
                        </td>
                        <td class="display_none_768">
                            <button class="btn btn-primary btn-sm" onclick="check_user(<?php echo $item['uid'];?>)">查看</button></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else :?>
                    <tr><td colspan="12" align="center">没有用户数据</td></tr>
                <?php endif;?>
            </table>

                    <?php if(isset($page)) echo $page; ?>

        </div>
    </div>
</div>
<?php $this->load->view('public/footer')?>
<script src="<?= config_item('domain_static') ?>admin/laydate/laydate.js" charset="utf-8"></script>
<!--时间处理代码-->
<script>
    var start = {
        elem: '#start_time',
        format: 'YYYY-MM-DD',
        min: '1900-001-01', //设定最小日期为当前日期
        max: laydate.now(), //最大日期
        istime: true,
        istoday: false,
        choose: function(datas) {
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas; //将结束日的初始值设定为开始日
        }
    };
    var end = {
        elem: '#end_time',
        format: 'YYYY-MM-DD',
        min: '1900-001-01',
        max: laydate.now(),
        istime: true,
        istoday: false,
        choose: function(datas) {
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };
    laydate(start);
    laydate(end);
</script>
<script>
    //滑块
    layui.use('form', function(){
        var form = layui.form()
            ,layer = layui.layer
        $ = layui.jquery;
        //监听滑块
        form.on('switch(switchTest)', function(data){
            var is_lock =this.checked ? 'on' : 'off';
            var uid = $(this).attr('val');
            $.ajax({
                url : '/user/lock',
                type : 'post',
                data : {
                    "is_lock":is_lock,
                    "uid":uid
                },
                dataType:'json',
                success : function(data) {
                    if(data.success == false){
                        layer.alert(data.msg,{icon: 2});
                    }else{
                        layer.msg(data.msg, {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            window.location.reload();
                        });
                    }
                },
                error : function() {
                    layer.alert('请求错误',{icon: 2});
                }
            });

        });
    });
//查看用户信息
function check_user(uid) {
    var url ='/user/user_see?uid='+uid;
    layer.open({
        type: 2,
        title:'查看用户信息',
        area: ["400px","340px"],
        content: url
        ,btn: ['确定']
        ,yes: function(index){
            layer.msg("查看成功！", {
                icon: 1,
                time: 2000 //2秒关闭（如果不配置，默认是3秒）
            }, function(){
                window.location.reload();
            });
        }
    });

}
</script>