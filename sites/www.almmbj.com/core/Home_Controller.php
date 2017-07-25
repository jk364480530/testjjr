<?php

/* 
 * 前台父类
 */

class Home_Controller extends CI_Controller
{
    public $uid;
    public $user_name;

    //魔术方法
    function __construct()
    {
        parent::__construct();
        header("Content-type: text/html; charset=utf-8");
        $this->check_online();
    }

    //登录验证
    public function check_online(){
        $this->uid = $this->session->userdata('user_id');
        $this->user_name = $this->session->userdata('user_name');
        if (!$this->uid) {
            header("content-type:text/html; charset=utf-8");
            echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
            echo '<a href="/home/login">登陆超时,请重新登陆!</a>';
            echo '<script type="text/javascript">parent.location.href="/home/index"</script>';
            // redirect("home/index");
        }

    }
    //字符串转换成UTF8的函数
    public function characet($string){
        if( !empty($string) ){
            $fileType = mb_detect_encoding($string , array('UTF-8','GBK','LATIN1','BIG5')) ;
            if( $fileType != 'UTF-8'){
                $string = mb_convert_encoding($string ,'utf-8' , $fileType);
            }
        }
        return $string;
    }

}
