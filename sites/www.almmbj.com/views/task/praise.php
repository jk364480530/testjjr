

<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>图片上传</title>
    <script src="<?= config_item('domain_static')?>common/javascript/jquery-3.2.1.min.js"></script>
    <!--引入文件上传框架-->
    <link rel="stylesheet" type="text/css" href="<?= config_item('domain_static')?>common/bootstrap/css/fileinput.min.css">
    <link href="<?= config_item('domain_static')?>common/bootstrap/css/green-theme-bootstrap.css" type="text/css" rel="stylesheet">
    <script src="<?= config_item('domain_static')?>common/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= config_item('domain_static')?>common/bootstrap/js/fileinput.min.js"></script>
    <script src="<?= config_item('domain_static')?>common/bootstrap/js/zh.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= config_item('domain_static')?>common/layui/css/layui.css">
    <script src="<?= config_item('domain_static')?>common/layui/layui.js"></script>
</head>
<body>
<style>
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

<input type="file" class="file" name="praise_img" id="upload_images" multiple>
<input type="hidden" value="praise_img" id="upload_type">
<form class="layui-form" action="">
    <div style="margin-top:20px;">
        <input type="hidden" name="task_id" value="<?=$task_id?>">
        <div class="layui-form-item" pane="">
            <div class="layui-input-block">
                <div id="praise_img"></div>
                <div id="praise_img_src"></div>
                <input type="hidden" id="praise_img_count" name="praise_img_count" value="0">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="praise">立即上传</button>
            </div>
        </div>
    </div>
</form>
<script>
    layui.use(['form','jquery','layer','laytpl'],function(){
        var form = layui.form(),
            layer = layui.layer,
            $ =layui.jquery,
            laytpl=layui.laytpl;

        form.on('submit(praise)', function(data){
            var field=data.field;
            var img_count =$('input[name=praise_img_count]').val();

            if(img_count<1){
                layer.msg('至少上传一张凭证图',{time:1000,icon:5});return false;
            }
//            console.log(field);
            $.ajax({
                url:'/task/praise',
                data:field,
                type:'post',
                dataType:'json',
                success:function(msg){
                    if(msg.code==201){
                        layer.open({
                            type:0,
                            title:'消息提示',
                            icon:1,
                            end: function () {
                                //关闭父layer
                                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                                if (index === undefined){
                                    window.location.reload();
                                }else{
                                    parent.layer.close(index); //再执行关闭
                                    parent.window.location.reload();
                                }
                            },
                            content:msg.msg
                        })
                    }else{
                        layer.open({
                            type:0,
                            title:"消息提示",
                            icon:5,
                            content:msg.msg
                        })
                    }
                },
                error:function(msg){
                    layer.open({
                        type:0,
                        title:"错误提示",
                        icon:5,
                        content:'网络超时！'
                    })
                }

            });
            return false;
        });

    });

    var praise_img=$("#praise_img");
    var i=praise_img.find('div').length;//获取当前评论图片的张数
//    console.log(i);
    var max=3;//最多3张评价凭证
    var num=max-i
    var error_str='您最多还能上传'+num+'张,';//超出的张数提示错误信息
    if(num==0){
        exit();
    }


    //初始化fileinput控件（第一次初始化）
    $('#upload_images').fileinput({
        language: 'zh', //设置语言
        uploadUrl: "/upload/praise_images", //上传的地址
        allowedFileExtensions : ['jpg','png','gif'],//接收的文件后缀,
        minFileCount: 0,
        maxFileCount: num,
        maxFileSize: 2000,
        enctype: 'multipart/form-data',
        showUpload: true, //是否显示上传按钮
        showCaption: true,//是否显示标题
        browseClass: "btn btn-primary", //按钮样式
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
        msgFilesTooMany: error_str,
    });

    //上传控件上传成功后
    $('#upload_images').on('fileuploaded', function(index,data){
         if(i<3){
                var str1 ="";
                var str2 ="";
                str1+='<div class="img-box"  style="background-image: url('+data.response.data.url+')"></div>';
                str2+='<input type="hidden" name="praise_img['+i+']" value="'+data.response.data.relative+'">';
                praise_img.append(str1);
                $("#praise_img_src").append(str2);
                $("#praise_img_count").val(parseInt($("#pay_img_count").val())+1);
                i++

            }
    });

</script>
</body>
</html>

