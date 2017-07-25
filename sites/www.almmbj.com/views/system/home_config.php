<div class=" admin-content">
    <div class="admin-biaogelist">

        <form method="post" class="am-form am-form-horizontal layui-form" id="form">
            <legend></legend>
            <div class="am-form-group am-form-feedback">
                <label for="title" class="am-u-sm-2 am-form-label">网站标题：</label>
                <div class="am-u-sm-10">
                    <input class="am-form-field" type="text" id="title" name="title" value="<?=$home['home_title']?>">
                </div>
            </div>
            <div class="am-form-group">
                <label for="seo" class="am-u-sm-2 am-form-label">SEO关键词：</label>
                <div class="am-u-sm-10">
                    <input class="am-form-field" type="text" id="seo" name="seo" value="<?=$home['seo_keyword']?>">
                </div>
            </div>
            <div class="am-form-group">

                <label for="info" class="am-u-sm-2 am-form-label">网站简介：</label>
                <div class="am-u-sm-10">
                    <textarea class="am-form-field" id="info" rows="5" name="info"><?=$home['home_info']?></textarea>
                </div>
            </div>
            <div class="am-form-group am-u-sm-offset-2">
                <input type="submit" class="am-btn am-btn-primary" value="提交更改">
            </div>
        </form>

        <script>
            layui.use(['form'],function () {
                var form = layui.form();

                form.on('submit',function (data) {
                    var field = $('#form').serialize();
                    var load = layer.load(2,{time: 5*1000});
                    console.log(data);
                    $.post('',field,function (data) {
                        if (data.code == 201){
                            layer.msg(data.msg,{},function () {
                                window.location.reload();
                            })
                        }else{
                            layer.alert(data.msg,{icon: 5});
                        }
                    },'json');
                    layer.close(load);
                    return false;
                })
            })
        </script>