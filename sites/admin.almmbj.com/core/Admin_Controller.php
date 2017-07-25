<?php

/* 
 * 管理员基础类 刘剑超 2016年11月3日18:10:46
 */

class Admin_Controller extends CI_Controller {
    public $uid;
    public $phone;
    public $power;
    //魔术方法
    function __construct() {
        parent::__construct();
        header("Content-type: text/html; charset=utf-8");
        $this->check_online();
        //检验权限
        $this->check_power();


        //$this -> load -> view('/public/header');
    }

    //登录验证
    private function  check_online(){
        $this->uid = $this->session->userdata('admin_uid');
        $this->phone = $this->session->userdata('admin_phone');
        if(!$this->uid){
            redirect("/home/index");
        }

    }
    //检验权限
    private function check_power(){
        $this->power = $this->session->userdata('nav');
            //获取当前导航的ID
       $where['controller_name']=$this->router->class;
       $where['action_name'] =$this->router->method;

                //通过控制器跟方法名获取导航信息
       $this->load->model('navigate_model');
       $nav_info=$this->navigate_model->get_nav_info($where);
       if($nav_info){
//                    echo "对不起该导航不存在";exit;
        if(!in_array($nav_info['id'],$this->power)){
                        echo "对不起你没有权限";exit;
                    }
       }



    }
    // 导航+子菜单
    public function menu()
    {
        $i = 0;
        $menu[$i] = array('id'=>($i+1),'menu_name'=>'后台首页','href'=>"/system/index",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"后台首页",'classfunction'=>"/system/index",'href'=>"/system/index",'is_show'=>1);

        $i ++;
        $menu[$i] = array('id'=>($i+1),'menu_name'=>'信息审核','href'=>"/guide/guide_list",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"导游审核",'classfunction'=>"/guide/guide_list",'href'=>"/guide/guide_list",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>2,'menu_name'=>"线路审核",'classfunction'=>"/line/line_list",'href'=>"/line/line_list",'is_show'=>1);

        $i ++;
        $menu[$i] = array('id'=>($i+1),'menu_name'=>'订单管理','href'=>"/order/order_list",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"订单信息",'classfunction'=>"/order/order_list",'href'=>"/order/order_list",'is_show'=>1);

        $i ++;
        $menu[$i] = array('id'=>($i+1),'menu_name'=>'系统设置','href'=>"/system/admin_login_log_list",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"登录日志",'classfunction'=>"/system/admin_login_log_list",'href'=>"/system/admin_login_log_list",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"添加分类",'classfunction'=>"/category/add_category",'href'=>"/category/add_category",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"添加广告",'classfunction'=>"/system/adver_list",'href'=>"/system/adver_list",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"首页设定",'classfunction'=>"/system/home_config",'href'=>"/system/home_config",'is_show'=>1);
        $i ++;
        $menu[$i] = array('id'=>($i+1),'menu_name'=>'导航管理','href'=>"/navigate/nav_list",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"导航列表",'classfunction'=>"/navigate/nav_list",'href'=>"/navigate/nav_list",'is_show'=>1);
        $menu[$i]['son_menu_list'][] = array('id'=>1,'menu_name'=>"添加导航",'classfunction'=>"/navigate/add_nav",'href'=>"/navigate/add_nav",'is_show'=>1);
        return $menu;
    }

}

