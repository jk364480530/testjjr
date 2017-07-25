<?php

/**
 * Created by PhpStorm.
 * User: jjr
 * Date: 2017/3/26
 * Time: 14:53
 */
class Task extends Home_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('task_model');
    }

    /**
     * 任务大厅
     * @author jjr <364480530@qq.com 2017-3-26>
     */
    public function task_list(){
        $search['order']=$this->get('order','排序','var_trim|xss_clean|int','order',1);
        $page = $this->get('page','页码','page',[],1);
        $cur_page = $page ? intval($page) : 1;


        $post_data['page']=$page;
        $post_data['size'] =2;
        $taskData = $this->task_model->task_list($post_data['page'],$post_data['size'],$search);
        $data['list'] = $taskData['list'];

        $data['total_count'] = $taskData['count'];//总条
        $page_url = '/'.$this->router->class.'/'.$this->router->method;

        //layui分页
        $this->load->helper('layui_page_helper');
        $data['page'] = pages($cur_page,$post_data['size'],$data['total_count'], $page_url,$search);
        //任务大厅选中
        $data['curt']=1;
        $this->load->view('task/task_list',$data);
    }

    /**
     * 发布任务
     * @author jjr<364480530@qq.com 2017-2-26>
     */
    public function add_task(){
        if(is_ajax()){
            //基本信息
            $post_data['area_id'] =$this->post('area_id','区域ID','var_trim|required|xss_clean|is_num|int','result',[],1);
            $post_data['account_id'] =$this->post('account_id','掌柜号ID','var_trim|required|xss_clean|is_num|int','result',[],2);
            $post_data['task_type'] =$this->post('task_type','任务类型','var_trim|required|xss_clean|is_num|int','result',[],3);
            $buy_car_url=[];
            if($post_data['task_type']==3){
                $buy_car_url=$this->post('buy_car_url','购物车商品地址','required','result',[],3);
            }else{
                $post_data['goods_url'] =$this->post('goods_url','商品地址','var_trim|required|max_length[200]','result',[],4);
                $post_data['goods_title'] =$this->post('goods_title','任务标题','var_trim|required|xss_clean','result',[],4);
            }
            $post_data['task_title'] =$this->post('task_title','任务标题','var_trim|required|xss_clean','result',[],4);
            $post_data['short_title'] =substr($post_data['task_title'],0,30);
            $post_data['deposit'] =$this->post('deposit','担保金额','var_trim|required|xss_clean|absolute','result',[],5);
            $post_data['limit_time'] =$this->post('limit_time','好评时限','var_trim|required|xss_clean|is_num|int','result',[],6);
            $post_data['gold'] =$this->post('gold','镖局币','var_trim|required|xss_clean|absolute','result',[],6);
            $post_data['is_origin'] =$this->post('is_origin','搜索来路','var_trim|xss_clean|int','result',[],7);
            $post_data['release_id']=$this->uid;
            $post_data['add_time'] =time();
            $post_data['task_sn'] =$this->task_sn();


            //来路条件
            $origin_data=[];
            if($post_data['is_origin']){
                $origin_data['search_mode'] =$this->post('search_mode','搜索方式','var_trim|required|xss_clean|is_num|int','result',[],8);
                $origin_data['search_hint'] =$this->post('search_hint','搜索提示','var_trim|required|xss_clean','result',[],9);
                $origin_data['search_keyword'] =$this->post('search_keyword','搜索关键词','var_trim|required|xss_clean','result',[],10);
                $origin_data['lailu_img'] =$this->post('lailu_img','搜索实例图片','pass','result',[],11);
                $origin_data['check_url'] =$this->post('check_url','校验宝贝地址','var_trim|required','result',[],12);
            }
            //默认要求可选
            $post_data['act_score'] =$this->post('act_score','是否动态评分','var_trim|xss_clean|int','result',[],13);
            $post_data['praise'] =$this->post('praise','是否带字好评','var_trim|is_num|xss_clean|int','result',[],14);
            $post_data['tb_grade'] =$this->post('tb_grade','淘宝等级要求','var_trim|xss_clean|is_num|int','result',[],15);
            $post_data['pt_Loan'] =$this->post('pt_Loan','是否平台放款','var_trim|xss_clean|int','result',[],16);
            $post_data['is_verify'] =$this->post('is_verify','是否审核','var_trim|xss_clean|int','result',[],7);

            $task_required =config_item('task_require');
            //指定要求
            $point_arr =[];
            if($post_data['is_verify']){
                $point_arr['examine'] =$task_required['examine'];
            }
            $is_evaluate =$this->post('is_evaluate','是否指定评语','var_trim|xss_clean|int','result',[],17);
            if($is_evaluate){
                $point_arr['evaluate'] =$task_required['evaluate'];
                $post_data['evaluate'] =$this->post('evaluate','指定评语','var_trim|required|xss_clean','result',[],17);
            }
            $post_data['comment_img'] =$this->post('is_com_img','是否指定评价图片','var_trim|xss_clean|int','result',[],17);
            $comment_img=[];
            if($post_data['comment_img']){
                $point_arr['com_img'] =$task_required['comimg'];
                $comment_img =$this->post('comment_img','指定评价图片','pass','result',[],18);
                if(!$comment_img){
                    json_error(67,'至少上传一张评价图','alert',[]);
                }
            }
            $is_address =$this->post('is_address','是否指定收货地址','var_trim|xss_clean|int','result',[],17);
            if($is_address){
                $point_arr['address'] =$task_required['address'];
                $post_data['address'] =$this->post('address','指定收货地址','var_trim|xss_clean','result',[],19);
            }
            $is_area =$this->post('is_area','是否指定区域接手','var_trim|xss_clean|int','result',[],17);
            if($is_area){

            }
            $is_release_time =$this->post('is_release_time','是否指定时间显示','var_trim|xss_clean|int','result',[],17);
            if($is_release_time){
                $post_data['start_time'] =$this->post('start_time','指定展示开始时间','var_trim|required|date','result',[],20);
                $post_data['end_time'] =$this->post('end_time','指定展示结束时间','var_trim|required|date','result',[],21);
                if(!$post_data['start_time']){
                    json_error(67,'请选择展示开始时间','alert',[]);
                }
                if(!$post_data['end_time']){
                    json_error(67,'请选择展示结束时间','alert',[]);
                }
                $post_data['start_time']=strtotime($post_data['start_time']);
                $post_data['end_time']=strtotime($post_data['end_time']);
            }
            $is_batch_release =$this->post('is_batch_release','是否批量发布','var_trim|xss_clean|int','result',[],17);
            if($is_batch_release){

            }

            //流程要求
            $flow_required =$this->post('task_require','流程需求','pass','result',[],22);
            //其他
            $post_data['task_warn'] =$this->post('task_warn','任务提醒','var_trim|xss_clean','result',[],6);

            //处理流程要求
            if($flow_required){
                $required_data=[];
                foreach ($flow_required as $key=>$val){
                    $required_data[]=$task_required[$val];
                }
                $post_data['require']= serialize($required_data+$point_arr);

            }

            $this->task_model->add_task($post_data,$origin_data,$comment_img,$buy_car_url,$this->uid);
        }
        $this->load->model('area_model');
        $area_list= $this->area_model->area_list();
        $data['area_list'] =$area_list;
        //默认淘宝的任务类型
        $this->load->model('task_type_model');
        $data['task_type_list']= $this->task_type_model->task_type_list(1);
        //默认淘宝的掌柜号
        $uid=$this->uid;
        $this->load->model('user_account_model');
        $data['user_account_list']= $this->user_account_model->user_account_list(1,$uid,1);

        //获取用户个人信息
        $this->load->model('user_model');
        $data['user_info']=$this->user_model->get_user_info($this->uid);
        $this->load->view('task/release_task',$data);
    }

    /**
     * 获取区域的详情 (用户的掌柜号、任务类型)
     * @author jjr<364480530@qq.com 2017-4-2>
     */
    public function area_detail(){
        $post_data['area_id']=$this->post('area_id','任务区域ID','var_trim|required|xss_clean|int','result',[],1);
        //获取任务类型
        $this->load->model('task_type_model');
        $data['task_type_list']= $this->task_type_model->task_type_list($post_data['area_id']);
        //获取掌柜号
        $uid=$this->uid;
        $this->load->model('user_account_model');
        $data['user_account_list']= $this->user_account_model->user_account_list($post_data['area_id'],$uid,1);
        json_success(201,'获取数据','alert',$data);

    }

    /**
     * 上传图片弹窗
     * @author jjr<364480530@qq.com 2017-4-4>
     */
    public function task_img(){
        $data['img_type'] = $this->get('type','图片类型','var_trim|required|xss_clean','result',[],1);
        $this->load->view('task/img_upload',$data);
    }

    /**
     * 通过路径获取淘宝商品的标题
     * @author jjr<364480530@qq.com 2017-4-4>
     */
    public function goods_title(){
        if(is_ajax()){
            $goods_url = $this->post('goods_url','淘宝商品路径','var_trim|required','result',[],1);
            $header = array(
                'user-agent:'.$_SERVER['HTTP_USER_AGENT']
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);  // 从证书中检查SSL加密算法是否存在
            curl_setopt($ch, CURLOPT_URL, $goods_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            $response = curl_exec($ch);
            if($error=curl_error($ch)){
               json_error(99,'获取标题失败','data',[]);
            }
            curl_close($ch);
            preg_match('/<title>(.*)<\/title>/', $response, $matches);
            $title = iconv("GBK", "UTF-8", $matches[1]);
            json_success(201,'获取标题成功','data',['title'=>$title]);
        }
    }

    /**
     * 生成随机订单
     */
    public function task_sn(){
        return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }

    /**
     * 接受任务
     */
    public function accept_task(){
        $post_data['task_id']=$this->post('task_id','任务ID','var_trim|required|is_num|xss_clean|int','result',[],1);
        $user_id =$this->uid;
        $this->task_model->accept_task($post_data['task_id'],$user_id);
    }

    /**
     * 我接受的任务
     */
    public function my_accept(){
        $page = $this->get('page','页码','page',[],1);
        $cur_page = $page ? intval($page) : 1;


        $post_data['page']=$page;
        $post_data['size'] =10;
        $taskData = $this->task_model->my_accept($post_data['page'],$post_data['size'],$this->uid);
        $data['list'] = $taskData['list'];

        $data['total_count'] = $taskData['count'];//总条
        $page_url = '/'.$this->router->class.'/'.$this->router->method;

        //layui分页
        $this->load->helper('layui_page_helper');
        $data['page'] = pages($cur_page,$post_data['size'],$data['total_count'], $page_url);
        //选中我的任务
        $data['curt']=2;
        $this->load->view('task/my_accept',$data);
    }
    /**
     * 我发出的任务
     */
    public function my_release(){
        $page = $this->get('page','页码','page',[],1);
        $cur_page = $page ? intval($page) : 1;


        $post_data['page']=$page;
        $post_data['size'] =10;
        $taskData = $this->task_model->my_release($post_data['page'],$post_data['size'],$this->uid);
        $data['list'] = $taskData['list'];

        $data['total_count'] = $taskData['count'];//总条
        $page_url = '/'.$this->router->class.'/'.$this->router->method;

        //layui分页
        $this->load->helper('layui_page_helper');
        $data['page'] = pages($cur_page,$post_data['size'],$data['total_count'], $page_url);
        //选中我发布的任务
        $data['curt']=3;
        $this->load->view('task/my_release',$data);
    }

    /**
     * 修改任务状态
     */
    public function change_status(){
        if(is_ajax()){
            $post_data['task_id']=$this->post('task_id','任务ID','var_trim|required|is_num|xss_clean|int','result',[],1);
            $post_data['status']=$this->post('status','状态编号','var_trim|required|is_num|xss_clean|int','result',[],2);
            $this->task_model->change_status($post_data['task_id'],$post_data['status']);
        }
    }

    /**
     * 取消任务
     */
    public function cancel_task(){
        if(is_ajax()){
            $post_data['task_id']=$this->post('task_id','任务ID','var_trim|required|is_num|xss_clean|int','result',[],1);
            $post_data['buy_account_id']=$this->post('buy_account_id','接手者ID','var_trim|xss_clean|int','result',[],2);
            $this->task_model->cancel_task($post_data['task_id'],$post_data['buy_account_id']);
        }
    }

    /**
     * 任务详情
     */
    public function task_info(){
        $post_data['id']=$this->get('id','任务ID','var_trim|required|xss_clean|is_num|int','result',[],1);
        $task_info=$this->task_model->task_info($post_data['id']);
        $data['info']=$task_info;
        $this->load->view('task/task_info',$data);
    }

    /**
     * 接手搜索来路详情
     */
    public function accept_lailu_info(){
        $post_data['id']=$this->get('id','任务ID','var_trim|required|xss_clean|is_num|int','result',[],1);
        $task_info=$this->task_model->task_info($post_data['id']);
        $data['info']=$task_info;
        $this->load->view('task/accept_lailu_info',$data);
    }

    /**
     * 发布者搜索来路详情
     */
    public function release_lailu_info(){
        $post_data['id']=$this->get('id','任务ID','var_trim|required|xss_clean|is_num|int','result',[],1);
        $task_info=$this->task_model->task_info($post_data['id']);
        $data['info']=$task_info;
        $this->load->view('task/release_lailu_info',$data);
    }


    /**
     * url校验地址
     */
    public function url_yz(){
        if(is_ajax()){
            $post_data['url']=$this->post('url','校验地址','var_trim|required','result',[],1);
            $post_data['task_id']=$this->post('task_id','来路ID','var_trim|required|xss_clean|is_num|int','result',[],2);
            $this->load->model('task_source_model');
            $this->task_source_model->check_url($post_data['url'],$post_data['task_id']);
        }

    }

    /**
     * 绑定买号
     */
    public function bind_buyer(){
        if(is_ajax()){
            $post_data['task_id']=$this->post('task_id','任务ID','var_trim|required|xss_clean|is_num','result',[],1);
            $post_data['buy_account_id']=$this->post('buy_account_id','买号ID','var_trim|required|xss_clean|is_num','result',[],2);
            $post_data['is_verify']=$this->post('is_verify','是否审核','var_trim|xss_clean|int','result',[],3);
            $post_data['is_origin']=$this->post('is_origin','是否来路搜索','var_trim|xss_clean|int','result',[],4);

            $this->task_model->bind_buyer($post_data);
        }
        $task_id =$this->get('task_id','任务ID','var_trim|required|xss_clean|is_num','result',[],1);
        $is_verify=$this->get('is_verify','是否审核','var_trim|xss_clean|int','result',[],2);
        $is_origin=$this->get('is_origin','是否来路搜索','var_trim|xss_clean|int','result',[],3);
        $this->load->model('user_account_model');
        $buy_list =$this->user_account_model->user_account_list(1,$this->uid,2,1);
        $data['list'] =$buy_list;
        $data['task_id']=$task_id;
        $data['is_verify']=$is_verify;
        $data['is_origin']=$is_origin;
        $this->load->view('task/bind_buyer',$data);
    }

    /**
     * 上传淘宝订单号
     */
    public function payment(){
        if(is_ajax()){
            $post_data['task_id']=$this->post('task_id','任务ID','var_trim|required|xss_clean|is_num','result',[],1);
            $post_data['tb_order_no']=$this->post('tb_order_no','淘宝订单号','var_trim|required|xss_clean|is_num|is_length[17]','result',[],2);
            $this->task_model->payment($post_data['task_id'],$post_data['tb_order_no']);
        }
        $task_id =$this->get('task_id','任务ID','var_trim|required|xss_clean|is_num|int','result',[],1);
        $data['task_id']=$task_id;
        $this->load->view('task/payment',$data);
    }


    /**
     * 评价凭证上传
     */
    public function praise(){
        if(is_ajax()){
            $post_data['task_id']=$this->post('task_id','任务ID','var_trim|required|xss_clean|is_num','result',[],1);
            $post_data['praise_img']=$this->post('praise_img','好评凭证','pass','result',[],2);
            $this->load->model('task_img_model');
            $this->task_img_model->praise($post_data);
        }
        $task_id =$this->get('task_id','任务ID','var_trim|required|xss_clean|is_num|int','result',[],1);
        $data['task_id']=$task_id;
        $this->load->view('task/praise',$data);
    }

    /**
     * 查看好评凭证放款
     */
    public function check_praise(){
        if(is_ajax()){
            $post_data['task_id']=$this->post('task_id','任务ID','var_trim|required|xss_clean|is_num|int','result',[],1);
            $this->task_model->loan($post_data['task_id']);
        }

        $task_id=$this->get('task_id','任务ID','var_trim|xss_clean|required|is_num|int','result',[],1);
        $this->load->model('task_img_model');
        $data['praise_img']=$this->task_img_model->img_list($task_id,3);
        $data['task_id']=$task_id;
        $this->load->view('task/check_praise',$data);
    }
}