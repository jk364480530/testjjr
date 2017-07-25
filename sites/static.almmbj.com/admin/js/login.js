
layui.use(['layer','jquery'],function(){
    var layer=layui.layer,
        $ =layui.jquery;
});
//登录验证
$("#login_post").click(function() {
    var phone = $('input[name="phone"]').val();
    var password = hex_md5($('input[name="passwd"]').val());
    $that = $('#warm');
    if (phone === "") {
        layer.msg('手机号码不能为空', {time: 5000, icon: 6});
        $('input[name="phone"]').focus();
        return false;
    }
    if ($('input[name="passwd"]').val() === '') {
        layer.msg('密码不能为空', {time: 5000, icon: 6});
        $('input[name="phone"]').focus();
        return false;
    }
    $.ajax({
        url: '/home/check_login',
        type: 'post',
        data: {
            "phone": phone,
            "password": password
        },
        async: false,
        dataType: 'json',
        success: function(data) {
            if (data.success === false) {
                layer.alert(data.msg, {icon: 2});
            } else {
                layer.msg(data.msg, {icon: 1, time: 1000, offset: '30%'}, function() {
                    window.location.href = data.data.url;
                });
            }
        },
        error: function() {
            layer.alert('请求错误', {icon: 2});
        }
    });
    return false;
});




