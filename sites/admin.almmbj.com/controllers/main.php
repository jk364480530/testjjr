<?php

/**
 * 后台主控制器
 * Class Main
 */
class Main extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 后台主页
     */
    public function index(){
        $this->load->view('main');
    }

    public function menu(){
        $this->load->model('navigate_model');
        $this->power?$power= $this->power:[];
        $nav_list =$this->navigate_model->sort_nav($power);
        exit(json_encode($nav_list));
    }
}