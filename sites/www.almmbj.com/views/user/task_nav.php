
    <a href="/task/add_task" class="layui-btn">发布任务</a>
    <a href="/user/user_info" class="layui-btn">个人中心</a>
    <div class="layui-tab" lay-filter="test1">
        <ul class="layui-tab-title">
            <li <?php if($curt==1):?>class="layui-this"<?php endif;?> lay-id="222" url="/task/task_list">任务大厅</li>
            <li <?php if($curt==3):?>class="layui-this"<?php endif;?>lay-id="333" url="/task/my_release">我发布的任务</li>
            <li <?php if($curt==2):?>class="layui-this"<?php endif;?>lay-id="444" url="/task/my_accept">我接受的任务</li>
        </ul>
        <div class="layui-tab-content">

        </div>
    </div>
    <fieldset class="layui-elem-field">
        <legend>查询搜索</legend>
        <div class="layui-field-box">
            内容区域
        </div>
    </fieldset>




