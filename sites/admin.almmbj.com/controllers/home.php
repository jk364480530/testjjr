<?php

/**
 * 管理员首页后台控制器
 * Class Home
 */
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 登陆界面
     */
    public function index() {
        $this->load->view('login/login');
    }

    /**
     * 管理员登录验证
     */
    public function check_login() {
        $data['phone'] = $this->post('phone', '手机号码', 'var_trim|required|no_ymbol|xss_clean|is_moblie', 'alert', [], 1);
        $passwd = $this->post('password', '密码', 'var_trim|required|no_ymbol|xss_clean|is_length[32]', 'alert', [], 2);

        //管理员数据库读出
        $this->load->model('login_model');
        $admin = $this->login_model->check_login($data, $passwd);
        $arr['admin_uid'] = $admin['uid'];
        $arr['nav'] =$admin['nav'];
        $this->session->set_userdata($arr);
        json_success(201, "管理员登录成功", "url", array('url' => '/main'));
    }

    /**
     * 管理员退出登录
     */
    public function admin_exit() {
        $this->session->unset_userdata('admin_uid');
        $this->session->unset_userdata('admin_phone');
        header('Location: ' . "/");
    }

}
