<style>
    .order_search{
        width:100%;
        height:30px;
    }
    .order_search li{
        float: left;
        height:30px;
        text-align: center;
        width: 100px;
        border: dashed 1px #eee;
        line-height: 30px;
        margin-left: 2px;
    }
</style>
    <a href="/task/add_task" class="layui-btn">发布任务</a>
    <a href="/user/person_center" class="layui-btn">个人中心</a>
    <div class="layui-tab" lay-filter="nav">
        <ul class="layui-tab-title">
            <li <?php if($curt==1):?>class="layui-this"<?php endif;?> lay-id="222" url="/task/task_list">淘宝押镖</li>
            <li <?php if($curt==4):?>class="layui-this"<?php endif;?> lay-id="111" url="/task/综合">综合押镖</li>
            <li <?php if($curt==3):?>class="layui-this"<?php endif;?>lay-id="333" url="/task/my_release">我发布的镖</li>
            <li <?php if($curt==2):?>class="layui-this"<?php endif;?>lay-id="444" url="/task/my_accept">我接受的镖</li>
        </ul>
    </div>
    <fieldset class="layui-elem-field">
        <legend>查询搜索</legend>
        <div class="layui-field-box">
           <div>

           </div>
           <ul class="order_search">
               <a href="/task/task_list?order=1">
                   <li>
                       <i class="layui-icon" style="float: right;margin-top: 2px;margin-right: 5px;s">&#xe601;</i>
                       担保金
                   </li>
               </a>
               <a href="">
                   <li>
                       <i class="layui-icon" style="float: right;margin-top: 2px;margin-right: 5px;s">&#xe601;</i>
                       镖局币
                   </li>
               </a>
               <a href="">
                   <li>
                       <i class="layui-icon" style="float: right;margin-top: 2px;margin-right: 5px;s">&#xe601;</i>
                       江湖信誉
                   </li>
               </a>
           </ul>
        </div>
    </fieldset>

