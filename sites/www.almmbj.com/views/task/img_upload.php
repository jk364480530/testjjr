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

<input type="file" class="file" name="<?=$img_type?>" id="upload_images" multiple>
<input  type="button" id="task_save" class="layui-btn"  value="确定完成" onclick="task_save()"  style="margin-top: 10px;margin-left: 45%;display:none;">
<input type="hidden" value="<?=$img_type?>" id="upload_type">
<script>
    layui.use(['form','jquery','layer','laytpl'],function(){
        var form = layui.form(),
            layer = layui.layer,
            $ =layui.jquery,
            laytpl=layui.laytpl;

    });
    var type=$('#upload_type').val();

    var com_img=parent.$("#com_img");
    var i=com_img.find('div').length;//获取当前评论图片的张数

    var lailu_img=parent.$("#lailu_img");
    var k=lailu_img.find('div').length;//获取当前评论图片的张数

    var pay_img=parent.$("#pay_img");
    var g=pay_img.find('div').length;//获取当前支付凭证图片
    console.log(g);
    if(type=='comment_img'){
        var max=3;//最多3张评论图
        var num=max - i;//还可以上传的张数
        var error_str='您最多还能上传'+num+'张,';//超出的张数提示错误信息

    }else if(type=='pay_img'){
        var max=3;//最多3张评论图
        var num=max - g;//还可以上传的张数
        var error_str='您最多还能上传'+num+'张,';//超出的张数提示错误信息

    }else {
        var max=3;//最多上传3张来路实例图
        var num=max - k;//还可以上传的张数
        var error_str='您最多还能上传'+num+'张,';//超出的张数提示错误信息

    }
    if(num==0){
        exit();
    }
    //初始化fileinput控件（第一次初始化）
    $('#upload_images').fileinput({
        language: 'zh', //设置语言
        uploadUrl: "/upload/task_images", //上传的地址
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

        //文件上传成功后
        if(type=='comment_img'){
           if(i<3){
               var str ="";
                   str+='<div class="img-box"  style="background-image: url('+data.response.data.url+')"></div>';
                   str+='<input type="hidden" name="comment_img['+i+']" value="'+data.response.data.relative+'">';
                    com_img.append(str);
                    $('#task_save').show();
                    i++
           }

        }else if(type=='pay_img'){
            if(g<3){
                var str1 ="";
                var str2 ="";
                str1+='<div class="img-box"  style="background-image: url('+data.response.data.url+')"></div>';
                str2+='<input type="hidden" name="pay_img['+g+']" value="'+data.response.data.relative+'">';
                pay_img.append(str1);
                parent.$("#pay_img_src").append(str2);
                parent.$("#pay_img_count").val(parseInt(parent.$("#pay_img_count").val())+1);
                $('#task_save').show();
                g++
            }

        }else {
            if(k<3){
                var str ="";
                str+='<div class="img-box"  style="background-image: url('+data.response.data.url+')"></div>';
                str+='<input type="hidden" name="lailu_img['+k+']" value="'+data.response.data.relative+'">';
                lailu_img.append(str);
                $('#task_save').show();
                k++
            }
        }

    });
    //关闭
    function task_save() {
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index);
    }
</script>
</body>
</html>