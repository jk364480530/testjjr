<?php

/**
 * 阿里妈妈首页控制器
 * Class Home
 */
class Home extends CI_Controller {
    public $bdapi = "http://apis.baidu.com/3023/qq/qq?uins=";
    public $header = "apikey: 2db570b505380c8e72e14bb108baac5e";

    public function __construct() {
        parent::__construct();
    }

    /**
     * 阿里妈妈镖局首页
     * @author jjr <364480530@qq.com 2017-3-26>
     */
    public function index() {

        $this->load->view('home/test');
    }

    /**
     * 用户登录
     * @author jjr <364480530@qq.com 2017-3-26>
     */
    public function login(){
        if(is_ajax()){
            $post_data['phone'] =$this->post('tel','手机号码','required|is_moblie','alert',[],1);
            $post_data['password'] =$this->post('pass','密码','var_trim|required|no_ymbol|xss_clean|is_length[32]','alert',[],2);

            $this->load->model('user_model');
            $userData =$this->user_model->check_login($post_data['phone'],$post_data['password']);
            $arr['user_id']=$userData['uid'];
            $arr['user_name']=$userData['phone'];
            $this->session->set_userdata($arr);
            json_success(201,"登录成功","url",array('url'=>'/task/task_list'));

        }
        $this->load->view('home/login1');
    }

    /**
     * 验证码显示
     * @author jjr <364480530@qq.com 2017-3-26>
     */
    public function code(){
        $id = $this->get('id','验证码ID');
        $this->load->library('captcha');
        $this->captcha->entry($id);
    }
    /**
     * 用户注册
     * @author jjr <364480530@qq.com 2017-3-26>
     */
    public function reg(){
        if(is_ajax()){
            $post_data['phone'] =$this->post('tel','手机号码','required|is_moblie|no_user_phone','alert',[],1);
            $post_data['password'] =$this->post('pass','密码','var_trim|required|no_ymbol|xss_clean|is_length[32]','alert',[],2);
            $post_data['re_pass'] =$this->post('re_pass','确认密码','var_trim|required|no_ymbol|xss_clean|is_length[32]','alert',[],3);
            $post_data['email'] =$this->post('email','邮箱','required|email','alert',[],4);
            $post_data['code'] =$this->post('code','验证码','var_trim|no_ymbol|xss_clean|required','alert',[],5);
            $post_data['tx_qq'] =$this->post('tx_qq','QQ号','var_trim|is_num|xss_clean|required','alert',[],6);
            $post_data['nikename']=$this->get_qqnike($post_data['tx_qq']);
            $post_data['add_time']=time();

            $code = $this->post('code','验证码','var_trim|required|is_length[4]','result',array(),7);
            $code_id =$this->post('code_id','验证码ID','var_trim|xss_clean','result',[],8);


            $this->load->library('captcha');
            if(!$this->captcha->check($code,$code_id)){
                json_error(99,'验证码不正确','alert',[]);
            }
            unset($post_data['code']);

            if($post_data['password']!= $post_data['re_pass']){
                json_error(99,'前后密码不一致','alert',[]);
            }
            unset($post_data['re_pass']);
            $salt =random_min(6);
            $post_data['password']=md5($post_data['password'].$salt);
            $post_data['salt']=$salt;
            $this->load->model('user_model');
            $this->user_model->add_user($post_data);
        }
        $this->load->view('home/reg1');
    }


    /**
     * 用户退出登录
     * @author jjr <364480530@qq.com 2017-3-26>
     */
    public function logout()
    {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        header('Location: '."/");
    }

    /**
     * 通过QQ获取qq昵称
     * @param $qq
     * @return string
     */
    public function get_nike($qq){
        //百度的一个api
        $ch = curl_init();
        $url = $this->bdapi.$qq;
        $header=[$this->header];


        // 添加apikey到header
        curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 执行HTTP请求
        curl_setopt($ch , CURLOPT_URL , $url);
        $res = curl_exec($ch);
        $start=strpos($res,"[");
        $end=strpos($res,"]");
        $data=explode(",",substr($res,$start+1,$end-$start-1));
        $nike=$this->characet($data[6]);
        return $nike;
    }

    /*
     * 转换编码
     */
    private function characet($data){
        if( !empty($data) ){
            $fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
            if( $fileType != 'UTF-8'){
                $data = mb_convert_encoding($data ,'utf-8' , $fileType);
            }
        }
        return $data;
    }
}