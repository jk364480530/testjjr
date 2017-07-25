<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>广告图片上传</title>
    <script src="<?= config_item('domain_static')?>common/jquery/jquery-3.1.1.min.js"></script>
    <!--引入文件上传框架-->
    <link rel="stylesheet" type="text/css" href="<?= config_item('domain_static')?>common/bootstrap/css/fileinput.min.css">
    <link href="<?= config_item('domain_static')?>common/bootstrap/css/green-theme-bootstrap.css" type="text/css" rel="stylesheet">
    <script src="<?= config_item('domain_static')?>common/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= config_item('domain_static')?>common/bootstrap/js/fileinput.min.js"></script>
    <script src="<?= config_item('domain_static')?>common/bootstrap/js/zh.js"></script>
    <script src="<?= config_item('domain_static')?>common/layer/layer.js"></script>
</head>
<body>
     <input type="file" class="file" name="upload_images" id="upload_images" multiple>
     <input  type="button" id="daoyou_save" class="btn btn-primary btn-block"  value="确定完成" onclick="daoyou_save()" style="width: 80px;padding:5px;margin-top: 10px;margin-left: 45%;display: none">
<script>

//初始化fileinput控件（第一次初始化）
$('#upload_images').fileinput({
    language: 'zh', //设置语言
    uploadUrl: "/upload/adver_images", //上传的地址
    allowedFileExtensions : ['jpg','png','gif'],//接收的文件后缀,
    maxFileCount: 20,//最多上传二十张广告图
    maxFileSize: 2000,
    enctype: 'multipart/form-data',
    showUpload: true, //是否显示上传按钮
    showCaption: true,//是否显示标题
    browseClass: "btn btn-primary", //按钮样式
    previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
    msgFilesTooMany: '您最多只能上传20张',
});

//上传控件上传成功后
$('#upload_images').on('fileuploaded', function(index,data){
    //文件上传成功后
    var img_url=data.response.data.relative;//保存的图片地址
    $.ajax({
        url: '/system/add_adver',
        type: "POST",
        data:{'img_url':img_url},
        dataType:'json',
        success: function(data){
            if(data.success == false){
                layer.alert(data.msg,{icon: 2});
            }
        },
        error: function () {
            layer.alert('请求错误',{icon: 2});
        }
    })
});
//关闭
    function daoyou_save() {
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index);
    }
</script>
</body>
</html>