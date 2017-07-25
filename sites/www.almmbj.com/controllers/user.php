<?php

/**
 * 个人中心控制器
 * class user
 * @author jjr<364480530@qq.com 2017-4-20>
 */
class User extends Home_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
    }

    /**
     * 个人中心
     */
    public function person_center(){

        $data['user_info']=$this->user_model->get_user_info($this->uid);
        $data['curt']=1;
        $this->load->view('user/person_center',$data);

    }

    /**
     * 修改密码
     */
    public function change_pwd(){
        if(is_ajax()){
            $post_data['old_pwd']=$this->post('old_pwd','原密码','var_trim|xss_clean|required|is_length[32]','result',[],1);
            $post_data['new_pwd']=$this->post('new_pwd','新密码','var_trim|xss_clean|required|is_length[32]','result',[],2);
            $post_data['renew_pwd']=$this->post('renew_pwd','重复密码','var_trim|xss_clean|required|max_length[32]','result',[],3);

            if($post_data['new_pwd']== $post_data['old_pwd']){
                json_error(67,'没有做任何修改','alert',[]);
            }
            if($post_data['new_pwd']!= $post_data['renew_pwd']){
                json_error(67,'两次输入的密码不一致','alert',[]);
            }
            unset( $post_data['renew_pwd']);
            $salt=random_min(6);
            $post_data['salt']=$salt;
            $post_data['new_pwd']=md5($post_data['new_pwd'].$salt);
            $this->user_model->change_pwd($post_data,$this->uid);
        }
       $data['curt'] =7;
       $this->load->view('user/change_pwd',$data);
    }

    /**
     * 修改安全密码
     */
    public function change_safe_pwd(){
        if(is_ajax()){
            $post_data['old_pwd']=$this->post('old_pwd','原安全密码','var_trim|xss_clean|required|is_length[32]','result',[],1);
            $post_data['new_pwd']=$this->post('new_pwd','新安全密码','var_trim|xss_clean|required|is_length[32]','result',[],2);
            $post_data['renew_pwd']=$this->post('renew_pwd','重复安全密码','var_trim|xss_clean|required|is_length[32]','result',[],3);

            if($post_data['new_pwd']== $post_data['old_pwd']){
                json_error(67,'没有做任何修改','alert',[]);
            }

            if(preg_match("/^\d{6}$/", $post_data['new_pwd'])){
                json_error(67,'请输入6位数字的安全密码','alert',[]);
            }
            if($post_data['new_pwd']!= $post_data['renew_pwd']){
                json_error(67,'两次输入的密码不一致','alert',[]);
            }
            unset( $post_data['renew_pwd']);

            $safe_salt=random_min(6);
            $post_data['safe_salt']=$safe_salt;
            $post_data['new_pwd']=md5($post_data['new_pwd'].$safe_salt);
            $this->user_model->change_safe_pwd($post_data,$this->uid);
        }
        $data['curt'] =8;
        $this->load->view('user/change_safe_pwd',$data);
    }
    /**
     * 绑定账号
     */
    public function bind_account(){
        if(is_ajax()){
            $post_data['area_id']=$this->post('area_id','区域ID','var_trim|xss_clean|required|is_num|int','result',[],1);
            $post_data['account']=$this->post('account','账号','var_trim|xss_clean|required','result',[],2);
            $post_data['type']=$this->post('type','账号类型','var_trim|xss_clean|required|is_num|int','result',[],3);
            $post_data['user_id']=$this->uid;
            $post_data['add_time']=time();
            $post_data['account_status']=1;
            $this->load->model('user_account_model');
            $this->user_account_model->add_account($post_data);
        }
        $this->load->model('user_account_model');
        //获取任务号
        $data['buy_account']=$this->user_account_model->user_account_list(null,$this->uid,2);
        //获取掌柜号
        $data['release_account']=$this->user_account_model->user_account_list(null,$this->uid,1);
        $this->load->model('area_model');
        $area_list =$this->area_model->area_list();
        $data['curt']=10;
        $data['area_list']=$area_list;
        $this->load->view('user/bind_account',$data);
    }

    /**
     * 删除账号
     */
    public function del_account(){
        if(is_ajax()){
            $post_data['account_id']=$this->post('account_id','账号ID','var_trim|xss_clean|required|is_num|int','result',[],1);
            $this->load->model('user_account_model');
            $this->user_account_model->del($post_data['account_id']);
        }
    }

    /**
     * 购买镖局币
     */
    public function buy_gold(){
        if(is_ajax()){
            $gold =$this->post('gold','购买的镖局币','var_trim|required|xss_clean|absolute|is_num','result',[],1);
            $this->user_model->buy_gold($gold,$this->uid);
        }
        $data['user_info']=$this->user_model->get_user_info($this->uid);
        $data['curt']=4;
        $this->load->view('user/buy_gold',$data);
    }

    /**
     * 镖局币兑现
     */
    public function cash(){
        if(is_ajax()){
            $gold =$this->post('cash_gold','兑换的镖局币','var_trim|required|xss_clean|absolute|is_num','result',[],1);
            if($gold<1){
                json_error(67,'提现镖局币不能小于1','alert',[]);
            }
            $this->user_model->cash($gold,$this->uid);
        }
        $data['user_info']=$this->user_model->get_user_info($this->uid);
        $data['curt']=5;
        $this->load->view('user/cash',$data);
    }

    /**
     * 充值
     */
    public function recharge(){
        $data['curt']=2;
        $this->load->view('user/recharge',$data);
    }

    /**
     * 提现
     */
    public function withdraw_cash(){
        $data['curt']=3;
        $this->load->view('user/withdraw_cash',$data);
    }

    /**
     * 设置提现账号
     */
    public function set_bank(){
        $data['curt']=9;
        $this->load->view('user/set_bank',$data);
    }

    /**
     * 修改资料
     */
    public function edit_profile(){
        $data['curt']=6;
        $this->load->view('user/edit_profile',$data);
    }
}