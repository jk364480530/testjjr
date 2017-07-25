<?php $this->load->view('public/header')?>
    <div class=" admin-content">
        <div class="admin-biaogelist">
            <div class="listbiaoti am-cf">
                <ul class="am-icon-flag on">
                    管理员登录
                </ul>
                <dl class="am-icon-home" style="float: right;">
                    当前位置： <a href="#">系统设置</a> &gt;
                    <a href="#">管理员登陆日志</a>
                </dl>
                <!--<dl>
                    <button type="button" class="am-btn am-btn-danger am-round am-btn-xs am-icon-plus"> 添加产品</button>
                </dl>-->
            </div>
            <!--<div class="am-btn-toolbars am-btn-toolbar am-kg am-cf">
                <ul>
                    <li>
                        <div class="am-btn-group am-btn-group-xs">
                            <select data-am-selected="{btnWidth: 90, btnSize: 'sm', btnStyle: 'default'}"> <option value="b">产品分类</option> <option value="o">下架</option> </select>
                        </div> </li>
                    <li>
                        <div class="am-btn-group am-btn-group-xs">
                            <select data-am-selected="{btnWidth: 90, btnSize: 'sm', btnStyle: 'default'}"> <option value="b">产品分类</option> <option value="o">下架</option> </select>
                        </div> </li>
                    <li style="margin-right: 0;"> <span class="tubiao am-icon-calendar"></span> <input type="text" class="am-form-field am-input-sm am-input-zm  am-icon-calendar" placeholder="开始日期" data-am-datepicker="{theme: 'success',}" readonly="" /> </li>
                    <li style="margin-left: -4px;"> <span class="tubiao am-icon-calendar"></span> <input type="text" class="am-form-field am-input-sm am-input-zm  am-icon-calendar" placeholder="开始日期" data-am-datepicker="{theme: 'success',}" readonly="" /> </li>
                    <li style="margin-left: -10px;">
                        <div class="am-btn-group am-btn-group-xs">
                            <select data-am-selected="{btnWidth: 90, btnSize: 'sm', btnStyle: 'default'}"> <option value="b">产品分类</option> <option value="o">下架</option> </select>
                        </div> </li>
                    <li><input type="text" class="am-form-field am-input-sm am-input-xm" placeholder="关键词搜索" /></li>
                    <li><button type="button" class="am-btn am-radius am-btn-xs am-btn-success" style="margin-top: -1px;">搜索</button></li>
                </ul>
            </div>-->
            <form class="am-form am-g">
                <table width="100%" class="am-table am-table-bordered am-table-radius am-table-striped am-table-hover am-text-nowrap">
                    <thead>
                    <tr class="am-success">
                        <th class="table-id">序号</th>
                        <th class="table-id">UID</th>
                        <th class="table-type">手机号码</th>
                        <th class="table-author am-hide-sm-only">登录时间</th>
                        <th class="table-author am-hide-sm-only">登录IP</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($list) && is_array($list)):?>
                        <?php foreach ($list as $val):?>
                            <tr>
                                <td><?=$val['id']?></td>
                                <td><?=$val['uid']?></td>
                                <td><?=$val['phone']?></td>
                                <td><?php echo date('Y-m-d H:i',$val['login_time'])?></td>
                                <td><?php echo long2ip($val['login_ip'])?></td>
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