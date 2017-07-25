<?php

/**
 * 登录模型
 * Class User_model
 */
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    private $model='user';
    private $wallet='user_wallet';
    /**
     * 添加用户
     * @param $data array 用户数据
     * @author jjr<364480530@qq.com 2017-3-26>
     */
    public function add_user($data){
        //验证邮箱是否被占用
        $had_email = $this->db->where(['email'=>$data['email']])->get($this->model)->row_array();
        if($had_email){
            json_error(67,'该邮箱已经被注册','alert',[]);
        }

        $this->db->insert($this->model,$data);
        if($this->db->affected_rows()>0){
            json_success(201,'注册成功','alert',['url'=>"login"]);
        }else{
            json_success(67,'注册失败','alert',[]);
        }
    }

    /**
     * 检查登录
     * @param $username 用户名
     * @param $password 密码
     * @author jjr <364480530@qq.com 2017-3-26>
     */
    public function check_login($username,$password){
        $userData =$this->db->where(['phone'=>$username])->get($this->model)->row_array();
        if(!$userData){
            json_error(67,'用户名不存在','alert',[]);
        }
        if($userData['password']!=md5($password.$userData['salt'])){
            json_error(67,'用户密码错误','alert',[]);
        }
        return $userData;
    }

    /**
     * 修改密码
     * @param $data array 密码数组
     */
    public function change_pwd($data,$uid){
        $user_info=$this->db->where(['uid'=>$uid])->get($this->model)->row_array();

        if($user_info['password']!=md5($data['old_pwd'].$user_info['salt'])){
            json_error(99,'密码错误','alert',[]);
        }
        $this->db->where(['uid'=>$uid])->update($this->model,['password'=>$data['new_pwd'],'salt'=>$data['salt']]);
        if($this->db->affected_rows()>0){
            json_success(201,'修改密码成功','alert',[]);
        }else{
            json_success(99,'修改密码失败','alert',[]);
        }

    }
    /**
     * 修改安全密码
     * @param $data array 密码数组
     */
    public function change_safe_pwd($data,$uid){
        $user_info=$this->db->where(['uid'=>$uid])->get($this->model)->row_array();

        if($user_info['safe_pwd']!=md5($data['old_pwd']).$user_info['safe_pwd']){
            json_error(99,'密码错误','alert',[]);
        }
        $this->db->where(['uid'=>$uid])->update($this->model,['safe_pwd'=>$data['new_pwd'],'safe_salt'=>$data['safe_salt']]);
        if($this->db->affected_rows()>0){
            json_success(201,'修改安全密码成功','alert',[]);
        }else{
            json_success(99,'修改安全密码失败','alert',[]);
        }

    }

    /**
     * 获取用户信息
     * @param $uid int 用户ID
     */
    public function get_user_info($uid){

        $user_field='a.*,';
        $wallet_field ="b.balance,b.gold";
        $this->db->select($user_field.$wallet_field)
                 ->from($this->model.' a')
                 ->where(['a.uid'=>$uid])
                 ->join($this->wallet.' b','b.uid=a.uid','left')
                 ->order_by('a.uid desc');
        $user_info=$this->db->get()->row_array();
        return $user_info;

    }

    /**购买镖局币
     * @param $gold 购买的镖局币
     * @param $uid int 用户ID
     */
    public function buy_gold($gold,$uid){
        $user_wallet=$this->db->where(['uid'=>$uid])->get($this->wallet)->row_array();
        if($gold*0.5>$user_wallet['balance']){
            json_error(67,'对不起余额不足','alert',[]);
        }
        $data['balance']=$user_wallet['balance']-($gold*0.5);
        $data['gold']=$user_wallet['gold']+$gold;

        $this->db->where(['uid'=>$uid])->update($this->wallet,$data);
        if($this->db->affected_rows()>0){
            json_success(201,'购买成功','alert',[]);
        }else{
            json_error(67,'购买失败','alert',[]);
        }
    }

    /**镖局币兑现
     * @param $gold 兑现的镖局币
     * @param $uid int 用户ID
     */
    public function cash($gold,$uid){
        $user_wallet=$this->db->where(['uid'=>$uid])->get($this->wallet)->row_array();
        if($gold>$user_wallet['gold']){
            json_error(67,'对不起兑换已经超过余额上限','alert',[]);
        }
        $data['balance']=$user_wallet['balance']+($gold*0.4);
        $data['gold']=$user_wallet['gold']-$gold;

        $this->db->where(['uid'=>$uid])->update($this->wallet,$data);
        if($this->db->affected_rows()>0){
            json_success(201,'兑换成功','alert',[]);
        }else{
            json_error(67,'兑换失败','alert',[]);
        }
    }
}
