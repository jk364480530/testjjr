<?php $this->load->view('public/header')?>
    <div class="admin-content">
        <div class="admin-biaogelist">
            <div class="listbiaoti am-cf">
                <ul class="am-icon-flag on">
                    广告列表
                </ul>
                <dl class="am-icon-home" style="float: right;">
                    当前位置： <a href="#">系统设置</a> >
                    <a href="#">广告列表</a>
                </dl>
                <dl>
                    <button type="button" class="am-btn am-btn-danger am-round am-btn-xs am-icon-plus" onclick="add_adver()">添加广告图片</button>
                </dl>
            </div>
            <form class="am-form am-g">
                <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped am-table-hover">
                    <thead>
                    <tr class="am-success">
                        <th class="table-id am-text-center">序号</th>
                        <th class="table-title am-text-center">广告图片</th>
                        <th width="150px" class="am-text-center">APP显示/隐藏</th>
                        <th class="table-set">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($list) && is_array($list)):?>
                        <?php foreach ($list as $val):?>
                            <tr>
                                <td class="am-text-center"><?=$val['id']?></td>
                                <td class="am-text-center">
                                    <img src="<?php echo isset($val['img_url']) && !empty($val['img_url']) ? get_thumb_img($val['img_url'],'100x60') : '暂无图片'?>">
                                </td>
                                <td class="am-text-center">
                                    <a href="javascript:;" onclick="is_show(<?=$val['id']?>)" ><i class=" <?php if($val['state']==1){?> am-icon-check-circle <?php }else{ ?> am-icon-times-circle <?php }?>"></i></a>
                                </td>
                                <td ><div class="am-btn-toolbar">
                                        <div class="am-btn-group am-btn-group-xs">
                                            <!--<a class="am-btn am-btn-default am-btn-xs am-text-success am-round am-icon-file" data-am-modal="{target: '#my-popups'}" title="添加子栏目"></a>-->
                                            <a class="am-btn am-btn-default am-btn-xs am-text-secondary am-round" title="修改" onclick="edit_adver(<?=$val['id']?>)"><span class="am-icon-pencil-square-o" ></span></a>
                                            <!-- 用按钮的时候 弹层 后缀需要加 问好 ？#的 时候才有效 真恶心 .html?# -->
<!--                                            <button class="am-btn am-btn-default am-btn-xs am-text-warning  am-round"  title="复制" data-am-modal="{target: '#my-popupss'}" ><span class="am-icon-copy"></span></button>-->
                                            <!-- 做完发现 复制栏目没什么用处 早晚都要修改 -->
                                            <a class="am-btn am-btn-default am-btn-xs am-text-danger am-round"  title="删除" onclick="is_del(<?=$val['id']?>)"><span class="am-icon-trash-o"></span></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    </tbody>
                </table>
                <div class="page">
                    <div class="pagination">
                        <?php if(isset($page)){ echo $page;}?>
                    </div>
                </div>
            </form>
<?php $this->load->view('public/footer')?>
<script>
    //添加广告
    function add_adver()
    {
        var url ='/system/add_adver';
        layer.open({
            type: 2,
            title:'添加广告图片(最多20张)',
            area: ["650px","400px"],
            content: url,
            end:function () {
                window.location.reload();
            }
        });
    }

    //修改图片
    function edit_adver(id)
    {
        var url ='/system/edit_adver?id='+id;
        layer.open({
            type: 2,
            title:'修改广告图片',
            area: ["650px","400px"],
            content: url,
            end:function () {
                window.location.reload();
            }
        });
    }
    //显示隐藏
    function is_show(id) {
        $.ajax({
            url: '/system/is_adver_show',
            type: "POST",
            data:{'id':id},
            dataType:'json',
            success: function(data){
                if(data.success == true){
                    layer.msg(data.msg, {
                        icon: 1,
                        offset: '30%',
                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                    }, function(){
                        window.location.reload();
                    });
                }else{
                    layer.alert(data.msg,{icon: 2});
                }
            },
            error: function () {
                layer.alert('请求错误',{icon: 2});
            }
        })
    }

    //删除广告图
    function is_del(id) {
        layer.confirm('您确定要删除该广告图吗？', {
            btn: ['确定','取消'], //可以无限个按钮
            btnAlign: 'c',
            offset: '80px',
            btn1: function(){
                $.ajax({
                    url: '/system/is_del',
                    type: "POST",
                    data:{'id':id},
                    dataType:'json',
                    success: function(data){
                        if(data.success == true){
                            layer.msg(data.msg, {
                                icon: 1,
                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            }, function(){
                                window.location.reload();
                            });
                        }else{
                            layer.alert(data.msg,{icon: 2});
                        }
                    },
                    error: function () {
                        layer.alert('请求错误',{icon: 2});
                    }
                })
            },btn2: function(){
                layer.close();
            }
        });
    }
</script>
