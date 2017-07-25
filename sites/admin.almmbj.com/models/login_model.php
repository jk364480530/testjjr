<?php

/**
 * 登录模型
 * Class Login_model
 */
class Login_model extends CI_Model {

    private $admin_user ='admin_user';
    private $group ='admin_group';
    private $nav ='admin_nav';

    public function __construct() {
        parent::__construct();
    }

    public function check_login($data,$passwd)
    {
        //密码错误次数
        $ip = ip('int');
        $error_login_pwd_count = (int)cache("error_login_pwd_count{$ip}");
        if($error_login_pwd_count>5){
            json_error(44,'密码错误次数过多，请过10分钟后再试！','alert');
        } 
        //管理员配置对照
        $login_where =array('phone'=>$data['phone']);
        $user = $this->db-> where($login_where)->get($this->admin_user)->row_array();
        if(!$user){
            json_error(0,'管理员账号不存在！','alert',[]);
        }

        //$passwd已经在MD5加密一次
        if($user['passwd'] !== md5($passwd.$user['salt'])){
            //密码错误次数
            $error_login_pwd_count = $error_login_pwd_count + 1;
            cache("error_login_pwd_count{$ip}",$error_login_pwd_count,10*60*24);
            json_error(1,"管理员密码不正确{$error_login_pwd_count}次！",'alert',[]);
        }
        unset($user['passwd']);
        unset($user['salt']);

        //判断是否是最高权限
        if($user['is_root']==1){//最高权限管理
            $nav_list =$this->db->get($this->nav)->result_array();
            if($nav_list){
                $power=[];
                foreach ($nav_list as $key=>$val){
                    $power[]=$val['id'];
                }
            }
           $user['nav'] =$power;
        }else{//普通管理员读取用户权限
            $group_info =$this->db->where(['id'=>$user['group_id']])->get($this->group)->row_array();
            if(!$group_info){
               json_error(67,'对不起您还没有任何权限');
            }
            $user['nav'] = unserialize($group_info['group_power']);
        }
        //登录日志
        $login_data=array(
            'uid'=>$user['uid'],
            'login_time'=>time(),
            'login_ip'=>$ip
        );
        $admin_login_log=$this->db->insert('admin_login_log',$login_data);
        if(!$admin_login_log){
            json_error(6,'管理员登录日志记录失败,不能登录！','alert',[]);
        }
        return $user;
    }


}
