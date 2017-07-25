<?php

/**
 * 用户后台控制器
 * Class Home
 */
class User extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("user_model");
    }

    //修改密码
    public function change_pwd(){
        if(is_ajax()){
            $post_data['old_pwd'] = $this->post('old_pwd','旧密码','var_trim|required|no_ymbol|xss_clean|is_length[32]','result',[],1);
            $post_data['new_pwd'] = $this->post('new_pwd','新密码','var_trim|required|no_ymbol|xss_clean|is_length[32]','result',[],2);
            $post_data['renew_pwd'] = $this->post('renew_pwd','重复新密码','var_trim|required|no_ymbol|xss_clean|is_length[32]','result',[],3);
            //获取用户信息
            $user_info =$this->user_model->get_admin_info($this->uid);
            if($user_info['passwd']!=md5($post_data['old_pwd'].$user_info['salt'])){
                json_error(67,'密码不正确','alert',[]);
            }

            if($post_data['new_pwd']!=$post_data['renew_pwd']){
                json_error(67,'前后密码不一致','alert',[]);
            }

            if($post_data['old_pwd']==$post_data['new_pwd']){
                json_error(67,'密码没有更改','alert',[]);
            }
            $this->user_model->set_admin_pwd($this->uid,$post_data['new_pwd']);
        }
        $this->load->view('user/change_pwd');
    }
}