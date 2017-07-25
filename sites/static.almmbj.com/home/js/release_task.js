/**
 * Created by John on 2017/3/26.
 */

layui.use(['form','jquery','layer','laytpl','element','laydate'],function(){
    var form = layui.form(),
        layer = layui.layer,
        $ =layui.jquery,
        laytpl=layui.laytpl,
        element = layui.element(),
        laydate = layui.laydate;

    //监听所有的checkbox
    form.on('checkbox',function(data){
        if(data.elem.checked){
            var type='add';
        }else{
            var type="reduce";
        }
        change_gold(data.elem,type);
    });

    //计算总镖局币
    function change_gold(obj,type){
        var total_gold =$('input[name=gold]').val();
        var gold_data =$(obj).attr('gold-data');
        if(type=='add'){
            var new_gold=parseFloat(total_gold)+parseFloat(gold_data);
        }else{
            var new_gold=parseFloat(total_gold)-parseFloat(gold_data);
        }
        $('input[name=gold]').val(new_gold.toFixed(1));
        $('#total-gold').html(new_gold.toFixed(1));
    }
    //表单验证
    form.verify({
        // terms:function (value) {
        //     if(!value ){
        //         return '服务款项必须选择';
        //     }
        // }
    });
    // 监听复选框指定评语
    form.on('checkbox(evaluate)', function(data){
        if(data.elem.checked){
            $('.evaluate').css('display','block');
            $('.evaluate').find("input[name='evaluate']").attr('lay-verify','required');
        }else{
            $('.evaluate').css('display','none');
            $('.evaluate').find("input[name='evaluate']").attr('lay-verify','');
        }
    });

    // 监听复选框指定收货地址
    form.on('checkbox(address)', function(data){
        if(data.elem.checked){
            $('.address').css('display','block');
            $('.address').find("input[name='address']").attr('lay-verify','required');
        }else{
            $('.address').css('display','none');
            $('.address').find("input[name='address']").attr('lay-verify','');
        }

    });
    // 监听复选框搜索选项
    form.on('checkbox(source)', function(data){
        if(data.elem.checked){
            $('#source').css('display','block');
            $('#source').find("input[name='search_hint']").attr('lay-verify','required');
            $('#source').find("input[name='search_keyword']").attr('lay-verify','required');
            $('#source').find("input[name='check_url']").attr('lay-verify','required|url');
        }else{
            $('#source').css('display','none');
            $('#source').find("input[name='search_hint']").attr('lay-verify','');
            $('#source').find("input[name='search_keyword']").attr('lay-verify','');
            $('#source').find("input[name='check_url']").attr('lay-verify','');
        }

    });
    // 监听复选框指定评价图片
    form.on('checkbox(comment_img)', function(data){
        if(data.elem.checked){
            $('.com_img').show();
        }else{
            $('.com_img').hide();
        }

    });
    // 监听复选框指定评价图片
    form.on('checkbox(release_time)', function(data){
        if(data.elem.checked){
            $('.release_time').show();
        }else{
            $('.release_time').hide();
        }

    });
    //监听物流选择事件
    form.on('select(logistics)',function(data){
        var now_gold =$(data.elem).find("option:selected").attr('gold-data');
        change_gold($('input[name=last_logistics]'),'reduce');
        change_gold($(data.elem).find("option:selected"),'add');
        $('input[name=last_logistics]').attr('gold-data',now_gold);

    });

    //监听淘宝等级事件
    form.on('radio(tb_grade)',function(data){
        var now_gold =$(data.elem).attr('gold-data');
        change_gold($('input[name=last_grade]'),'reduce');
        change_gold(data.elem,'add');
        $('input[name=last_grade]').attr('gold-data',now_gold);

    });

    //监听任务类型事件
    form.on('radio(task_type)',function(data){
        var now_gold =$(data.elem).attr('gold-data');
        change_gold($('input[name=last_type]'),'reduce');
        change_gold(data.elem,'add');
        $('input[name=last_type]').attr('gold-data',now_gold);

        if(data.value==2){
            var url_name='套餐地址';
            var goods_name='套餐标题';
        }else {
            var url_name='商品地址';
            var goods_name='商品标题';
        }
        var str="";
            str+='<div class="layui-form-item">';
            str+='<label class="layui-form-label goods_url">'+url_name+'</label>';
            str+='<div class="layui-input-block">';
            str+='<input type="text" name="goods_url" lay-verify="url|required" placeholder="请输入商品地址" autocomplete="off" id="goods_url" onchange="get_title(this.value);" class="layui-input" style="width:50%;">';
            str+='</div>';
            str+='</div>';
            str+='<div class="layui-form-item">';
            str+='<label class="layui-form-label goods_title">'+goods_name+'</label>';
            str+='<div class="layui-input-block">';
            str+='<input type="text" name="goods_title" id="goods_title" lay-verify="title|required" placeholder="请输入商品标题" value="" autocomplete="off" class="layui-input" style="width:50%;">';
            str+='</div>';
            str+='</div>';

        var buy_car="";
            buy_car+='<div class="layui-form-item">';
            buy_car+='<div class="layui-input-block">';
            buy_car+='<a href="javascript:void(0);" class="layui-btn layui-btn-warm layui-btn-mini" onclick="add_goods();"><i class="layui-icon">&#xe608;</i>增加</a>';
            buy_car+='<a href="javascript:void(0);" style="margin-left: 10px;" class="layui-btn layui-btn-warm layui-btn-mini" onclick="reduce_goods();"><i class="layui-icon">&#xe640;</i>删除</a>';
            buy_car+='</div>';
            buy_car+='<label class="layui-form-label">商品地址</label>';
            buy_car+='<div class="layui-input-block goods_num">';
            buy_car+='<input type="text" name="buy_car_url[0]" lay-verify="url|required" placeholder="请输入商品地址" autocomplete="off" id="goods_url" onchange="get_title(this.value);" class="layui-input" style="width:50%;">';
            buy_car+='</div>';
            buy_car+='</div>';
        if(data.value==1){
            $('#task_type').html(str);
        }else if(data.value==2){
            $('#task_type').html(str);
        }else if(data.value==3){
            $('#task_type').html(buy_car);
            form.render('layui-input-block');
        }else if(data.value==4){
            $('#task_type').html(str);
        }

    });
    // 监听全选事件
    form.on('checkbox(check_all)', function(data){
        var child = $('.process_require').find('input[type=checkbox]');
        child.each(function(index, item){
            if(data.elem.checked==true){
                if(item.checked==false){
                    change_gold(item,'add');
                }
            }else{
                if(item.checked==true){
                    change_gold(item,'reduce');
                }
            }
            item.checked = data.elem.checked;

        });
        form.render('checkbox');
    });
    // 监听反选事件
    form.on('checkbox(select_invert)', function(data){
        var child = $('.process_require').find('input[type=checkbox]');
        child.each(function(index, item){
               if(item.checked==false){
                   change_gold(item,'add');
                   item.checked=true;
               }else{
                   change_gold(item,'reduce');
                   item.checked=false;
               }
        });
        form.render('checkbox');
    });
    //选择区域监听事件
    form.on('select(area)',function(data){
        var area_id = $(data.elem).val();
        $.ajax({
            url:"/task/area_detail",
            data:{area_id:area_id},
            type:'post',
            dataType:'json',
            success:function(data){
                if(data.code==201){
                    change_gold($('input[name=last_type]'),'reduce');
                    $('input[name=last_type]').attr('gold-data',0.0);
                    //显示任务类型
                   if(data.data.task_type_list.length>0){
                       laytpl(
                            '{{# for(var i = 0, len = d.task_type_list.length; i < len; i++){ }}'+
                            '<input type="radio" name="task_type" lay-filter="task_type"  gold-data="{{ d.task_type_list[i].gold}}" {{# if(d.task_type_list[i].id==1) { }}checked="checked" {{# } }}value="{{ d.task_type_list[i].id}}" title="{{ d.task_type_list[i].type_name}}({{ d.task_type_list[i].gold}})">'+
                            '{{# } }}'
                       ).render(data.data, function(html){
                           $('.task_type').html(html);
                       });
                    form.render('radio');
                   }else{
                       laytpl(
                           '<button class="layui-btn">该区域还没有任务类型</button>'
                       ).render(data.data, function(html){
                           $('.task_type').html(html);
                       });
                   }
                   //显示掌柜号
                    if(data.data.user_account_list.length>0){
                        laytpl(
                            '{{# for(var i = 0, len = d.user_account_list.length; i < len; i++){ }}'+
                            '<input type="radio" name="account_id" {{# if(i==0) { }}checked="checked" {{# } }} value="{{ d.user_account_list[i].id}}" title="{{ d.user_account_list[i].account}}">'+
                            '{{# } }}'
                        ).render(data.data, function(html){
                            $('.user_account').html(html);
                        });
                        form.render('radio');
                    }else{
                        laytpl(
                            '<button class="layui-btn">您还没有添加掌柜号</button>'
                        ).render(data.data, function(html){
                            $('.user_account').html(html);
                        });
                    }
                }
            },
            error:function(data){
                layer.open({
                    type:0,
                    title:"错误提示",
                    icon:5,
                    content:'网络超时！',
                })
            }
        })
    });
    //提交表单
    form.on('submit(task)',function(data){
        var field =data.field;
        $.ajax({
            type:'post',
            url:'/task/add_task',
            data:field,
            dataType:'json',
            success: function(msg){
                if(msg.code == 201){
                    layer.msg(msg.msg,{icon: 1,time:1000,offset: '30%'},function(){
                        window.location.href=msg.data.url;
                    })

                }else{
                    layer.alert(msg.msg,{icon: 2});
                }
            },
            error:function(msg){
                layer.open({
                    type:0,
                    title:"错误提示",
                    icon:5,
                    content:'网络错误'

                })
            }
        });
        return false;
    });

    var start = {
        min: laydate.now()
        ,max: '2099-06-16 23:59:59'
        ,istoday: false
        ,choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };

    var end = {
        min: laydate.now()
        ,max: '2099-06-16 23:59:59'
        ,istoday: false
        ,choose: function(datas){
            start.max = datas; //结束日选好后，重置开始日的最大日期
        }
    };

    document.getElementById('LAY_demorange_s').onclick = function(){
        start.elem = this;
        laydate(start);
    };
    document.getElementById('LAY_demorange_e').onclick = function(){
        end.elem = this
        laydate(end);
    }

});

//上传图片
function upload_img(type){
    layer.open({
        type: 2,
        title: '上传图片',
        shadeClose: true,
        shade: false,
        maxmin: true, //开启最大化最小化按钮
        area: ['650px', '500px'],
        content:'/task/task_img?type='+type
    });
}
//通过路径获取商品标题
function get_title(value){
    $.ajax({
        data:{goods_url:value},
        type:'post',
        url:"/task/goods_title",
        dataType:'json',
        success:function(data){
            console.log(data.data.title);
            if(data.code==201){
                $('#goods_title').val(data.data.title);
                $('#task_title').val(data.data.title);
            }
        },
        error:function(){

        }
    })
}

//添加担保金到计算器
function top_deposit(obj,balance){
    var deposit=$(obj).val();
    if(deposit>balance){
        layer.confirm('余额不足是否去充值？', {
            btn: ['充值','取消'] //按钮
        }, function(){
           window.location.href='/user/recharge';
        }, function(){
            $(obj).val(balance);
            layer.closeAll();
        });
    }else{
        $('#jsq_deposit').html(deposit);
    }

}
//追加金币
function surplus_gold(obj){

    var last_gold =$('input[name=last_gold]').val();
    var surplus_gold =$(obj).val();
    var gold =$('input[name=gold]').val();
    var now_gold =(parseFloat(gold)-parseFloat(last_gold)+parseFloat(surplus_gold)).toFixed(1);

    $('input[name=gold]').val(now_gold);
    $('#total-gold').html(now_gold);
    $('input[name=last_gold]').val(surplus_gold);

}

//购物车增加商品
function add_goods(){
    var num=$('.goods_num').find('input').length;
    if(num<5){
        var str ="";
        str+='<br>';
        str+='<input type="text" name="buy_car_url['+num+']" lay-verify="url|required" placeholder="请输入商品地址" autocomplete="off" id="goods_url" onchange="get_title(this.value);" class="layui-input" style="width:50%;">';
       $('.goods_num').append(str);
   }else{
       layer.msg('最多添加五个商品',{time:1000,icon:5});
   }

}
//购物车删除商品
function reduce_goods(){
    var num=$('.goods_num').find('input').length;
    if(num>=2){
        $('.goods_num input:last').remove();
        $('.goods_num br:last').remove();
    }else{
        layer.msg('至少要保留一个商品',{time:1000,icon:5});
    }
}