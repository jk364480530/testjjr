<?php

/**
 * 任务模型
 * @author jjr<364480530>
 * Class Task_model
 */
class Task_model extends CI_Model {

    private $model='task';
    private $type_model ='task_type';
    private $user_model ='user';
    private $account_model='user_account';
    private $user_wallet_model='user_wallet';
    private $img_model='task_img';
    private $cart_model='task_buycar';
    private $source_model='task_source';


    public function __construct() {
        parent::__construct();
    }



    /**
     * 获取任务列表
     * @param int $page 页码
     * @param int $size 每页条数
     * @param arr $search 搜索信息
     * @param string $order 排序
     * @return mixed
     */
    public function task_list($page=1,$size=6,$search,$order='.id desc'){

        if(!empty($search['order'])){
            switch ($search['order']){
                case 1:
                    $order='.deposit asc';
                    break;
            }
        }
        $where['status']=1;
        $offset = ($page - 1) * $size;
        $task_field =$this->model.".*";
        $task_type_field=",b.type_name";
        $release_field=",a.nikename,a.username,a.tx_qq,a.phone";

        $this->db->select($task_field.$task_type_field.$release_field)
                 ->where($where)
                 ->join('task_type as b','b.id='.$this->model.'.task_type','left')
                 ->join('user as a','a.uid='.$this->model.'.release_id','left')
                 ->order_by($this->model.$order);

        $db = clone($this->db);
        $taskData = $this->db->get($this->model,$size,$offset)->result_array();
        foreach ($taskData as $k=>$v){
            $taskData[$k]['require'] =unserialize($v['require']);
        }
        $date_res['count'] = $db->count_all_results($this->model);
        $date_res['list'] = $taskData;
        return $date_res;
    }


    /**
     * 我的任务列表
     * @param int $page 页码
     * @param int $size 每页条数
     * @param $user_id  用户ID
     * @return mixed
     */
    public function my_accept($page=1,$size=6,$user_id){

        $where['accept_id']=$user_id;
        $where['status !=']=1;
        $offset = ($page - 1) * $size;

        $task_field ="a.*";
        $task_type_field=",b.type_name";
        $user_field=",c.username as release_username,c.nikename as release_nikename,c.phone as release_phone,c.tx_qq as release_qq";

        $this->db->select($task_field.$task_type_field.$user_field)
            ->from($this->model.' a')
            ->join($this->type_model.' b','b.id=a.task_type','left')
            ->join($this->user_model.' c','c.uid=a.release_id','left')
            ->where($where)
            ->order_by('a.id desc');

        $db = clone($this->db);
        $taskData = $this->db->limit($size,$offset)->get()->result_array();

        $this->load->model('task_source_model');
        $this->load->model('task_img_model');
        foreach ($taskData as $k=>$v){
            $taskData[$k]['lailu']=$this->task_source_model->lailu_info($v['id']);
            $taskData[$k]['com_img'] =$this->task_img_model->img_list($v['id'],2);
            $taskData[$k]['require'] =unserialize($v['require']);
        }
        $date_res['count'] = $db->count_all_results();
        $date_res['list'] = $taskData;
        return $date_res;
    }


    /**
     * 我的任务列表
     * @param int $page 页码
     * @param int $size 每页条数
     * @param $user_id 用户ID
     * @return mixed
     */
    public function my_release($page=1,$size=6,$user_id){

        $where['release_id']=$user_id;
        $where['status !=']=1;
        $offset = ($page - 1) * $size;
        $task_field ="a.*";
        $task_type_field=",b.type_name";
        $user_field=",c.username as accept_username,c.nikename as accept_nikename,c.phone as accept_phone,c.tx_qq as accept_qq";
        $buy_field =',d.account as buy_account';
        $release_field =',e.account as release_account';

        $this->db->select($task_field.$task_type_field.$user_field.$buy_field.$release_field)
            ->from($this->model.' a')
            ->join($this->type_model." b",'b.id=a.task_type','left')
            ->join($this->user_model." c",'c.uid=a.accept_id','left')
            ->join($this->account_model." d",'d.id=a.buy_account_id','left') //接手号
            ->join($this->account_model." e",'e.id=a.account_id','left') //掌柜号
            ->where($where)
            ->order_by('a.id desc');

        $db = clone($this->db);
        $taskData = $this->db->limit($size,$offset)->get()->result_array();

        $this->load->model('task_source_model');
        $this->load->model('task_img_model');
        foreach ($taskData as $k=>$v){
            $taskData[$k]['lailu']=$this->task_source_model->lailu_info($v['id']);
            $taskData[$k]['com_img'] =$this->task_img_model->img_list($v['id'],2);
            $taskData[$k]['require'] =unserialize($v['require']);
        }
        $date_res['count'] = $db->count_all_results();
        $date_res['list'] = $taskData;
        return $date_res;
    }
    /**
     * 添加任务
     * @param $data  任务数组
     * @param $origin 搜索来路
     * @param $com_img 评价图片
     * @param $buy_cart 购物车商品地址
     * @param $uid 用户ID
     * @author jjr <364480530@qq.com 2017-4-4>
     */
    public function add_task($data,$origin,$com_img,$buy_cart,$uid){
        $this->db->trans_begin();
        $this->db->insert($this->model,$data);
        $task_id =$this->db->insert_id();

        if(!$this->db->affected_rows()){
            json_error(67,'添加任务失败','alert',[]);
        }
        //添加来路搜索
        if(!empty($origin)){
            $origin_img =$origin['lailu_img'];
            unset($origin['lailu_img']);
            $origin['task_id']=$task_id;
            $res = $this->db->insert($this->source_model,$origin);
            if(!$res){
                $this->db->trans_rollback();
                json_error(67,'添加任务失败','alert',[]);
            }

            if($origin_img){
                $img_arr =[];
                foreach ($origin_img as $key=>$val){
                    $img_arr[$key]['task_id']=$task_id;
                    $img_arr[$key]['url']=$val;
                    $img_arr[$key]['type']=1;//1为搜索来路
                }
                $res =$this->db->insert_batch($this->img_model,$img_arr);
                if(!$res){
                    $this->db->trans_rollback();
                    json_error(99,'添加任务失败','alert',[]);
                }
            }
        }
        //添加评论图片
        if(!empty($com_img)){
            $img_arr=[];
            foreach ($com_img as $k=>$v){
                $img_arr[$k]['task_id']=$task_id;
                $img_arr[$k]['url']=$v;
                $img_arr[$k]['type']=2;//2为评价图片
            }
            $result =$this->db->insert_batch($this->img_model,$img_arr);
            if(!$result){
                $this->db->trans_rollback();
                json_error(99,'添加任务失败','alert',[]);
            }
        }
        if(!empty($buy_cart)){
            $buy_cart_url=[];
            foreach ($buy_cart as $key=>$val){
                $buy_cart_url[$key]['goods_url']=$val;
                $buy_cart_url[$key]['task_id']=$task_id;
            }
            $re =$this->db->insert_batch($this->cart_model,$buy_cart_url);
            if(!$re){
                $this->db->trans_rollback();
                json_error(99,'添加购物车任务失败','alert',[]);
            }

        }
        //任务发布成功更新钱包
        $user_wallet =$this->db->where(['uid'=>$uid])->get($this->user_wallet_model)->row_array();
        if($user_wallet['balance']<$data['deposit']){
            json_error(99,'余额不足请及时充值','alert',[]);
        }

        if($user_wallet['gold']<$data['gold']){
            json_error(99,'镖局币不足请及时购买','alert',[]);
        }
        $wallet_data['balance']=$user_wallet['balance']-$data['deposit'];
        $wallet_data['gold']=$user_wallet['gold']-$data['gold'];
        $wallet_data['lock_gold']= $user_wallet['lock_gold']+$data['gold'];
        $wallet_data['lock_deposit']=$user_wallet['lock_deposit']+$data['deposit'];
        $result=$this->db->where(['uid'=>$uid])->update($this->user_wallet_model,$wallet_data);

        if(!$result){
            $this->db->trans_rollback();
            json_error(99,'用户钱包更新失败','alert',[]);
        }

        if($this->db->trans_status()==FALSE){
            $this->db->trans_rollback();
            json_error(67,'添加任务失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_error(201,'添加任务成功','alert',['url'=>'/task/task_list']);
        }
    }

    /**
     * 接受任务
     * @param $task_id 任务ID
     * @param $user_id 用户ID
     */
    public function accept_task($task_id,$user_id){

        $task_info =$this->db->where(['id'=>$task_id])->get($this->model)->row_array();
        if($task_info['release_id']==$user_id){
            json_error(67,'您不能接自己的任务','alert',[]);
        }

        $data['status']=2;
        $data['accept_id']=$user_id;
        $data['count_down']=time()+3600*0.5;//绑定买号的时间
        $this->db->where(['id'=>$task_id])->update($this->model,$data);
        if($this->db->affected_rows()>0){
            json_success(201,'成功接受','alert',[]);
        }else{
            json_error(67,'任务接受失败','alert',[]);
        }

    }

    /**
     * 修改任务状态
     * @param $id 任务ID
     * @param $status 修改的状态编号
     */
    public function change_status($id,$status){
        $task_info=$this->db->where(['id'=>$id])->get($this->model)->row_array();
        $data=[];
        switch ($status){
            case 4:
                if($task_info['is_origin']==1){
                    $data['count_down']=time()+3600*0.5 ;//搜索验证倒计时0.5小时
                    $data['status']=$status;
                }else{
                    $data['count_down']=time()+3600*1.5 ;//支付倒计时1.5小时
                    $data['status']=5;
                }

            break;
            case 5:
                $data['count_down']=time()+3600*1.5 ;//支付倒计时1.5小时
                $data['status']=$status;
            break;
            case 7:
                switch ($task_info['limit_time']){
                    case 1:
                        $data['count_down']=time()+3600*3*24 ;//物流到后默认3天
                        break;
                    case 2:
                        $data['count_down']=time();//立刻
                        break;
                    case 3:
                        $data['count_down']=time()+3600*0.5 ;//30分钟
                        break;
                    case 4:
                        $data['count_down']=time()+3600*1*24 ;//1天
                        break;
                    case 5:
                        $data['count_down']=time()+3600*2*24 ;//2天
                        break;
                    case 6:
                        $data['count_down']=time()+3600*3*24 ;//3天
                        break;
                    case 7:
                        $data['count_down']=time()+3600*4*24 ;//4天
                        break;
                    case 8:
                        $data['count_down']=time()+3600*5*24 ;//5天
                        break;
                    case 9:
                        $data['count_down']=time()+3600*6*24 ;//6天
                        break;
                    case 10:
                        $data['count_down']=time()+3600*7*24 ;//7天
                        break;
                }
                $data['status']=$status;
                break;
            case 8:
                $data['status']=$status;
                break;
        }

        $this->db->where(['id'=>$id])->update($this->model,$data);
        if($this->db->affected_rows()>0){
            json_success(201,'更新成功','alert',[]);
        }else{
            json_error(67,'更新状态失败','alert',[]);
        }

    }

    /**
     * 取消任务
     * @param int id 任务ID
     * @param int buy_account_id 接手者账号ID
     */
    public function cancel_task($id,$buy_account_id){

        $this->db->trans_begin();
        $this->db->where(['id'=>$id])->update($this->model,['status'=>1,'buy_account_id'=>null,'accept_id'=>null]);
        if(!$this->db->affected_rows()){
            json_error(67,'取消任务失败','alert',[]);
        }
        //更改绑定买号的状态
        if(!empty($buy_account_id)){
            $res =$this->db->where(['id'=>$buy_account_id])->update($this->account_model,['account_status'=>1]);
            if(!$res){
                $this->db->trans_rollback();
                json_error(67,'取消任务失败','alert',[]);
            }
        }

        if($this->db->trans_status()==false){
            $this->db->trans_rollback();
            json_error(67,'取消任务失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_success(201,'取消任务成功','alert',[]);
        }



    }

    /**
     * 通过ID获取任务详情
     * @param $id 任务ID
     */
    public function task_info($id){

        $where['a.id']=$id;

        $task_field='a.*';
        $user_field=',b.tx_qq as accept_qq,b.nikename as accept_nikename,c.tx_qq as release_qq,c.nikename as release_nikename';
        $buy_field =',d.account as buy_account';
        $release_field =',e.account as release_account';
        $type_field =',f.type_name';
        $this->db->select($task_field.$user_field.$buy_field.$release_field.$type_field)
                 ->from($this->model.' a')
                 ->join($this->user_model.' b','b.uid=a.accept_id','left')
                 ->join($this->user_model.' c','c.uid=a.release_id','left')
                 ->join($this->account_model.' d','d.id=a.buy_account_id','left')
                 ->join($this->account_model.' e','e.id=a.account_id','left')
                 ->join($this->type_model.' f','f.id=a.task_type','left')
                 ->where($where);
        $task_info=$this->db->get()->row_array();
        $task_info['require']=unserialize($task_info['require']);
        //任务来路搜索
        if($task_info['is_origin']==1){
            $this->load->model('task_source_model');
            $task_info['lailu']=$this->task_source_model->lailu_info($id);
        }

        //任务评价图片
        if($task_info['comment_img']==1){
            $this->load->model('task_img_model');
            $task_info['com_img'] = $this->task_img_model->img_list($id, 2);
        }
        //购物车任务商品地址
        if($task_info['task_type']==3){
            $task_info['buy_cart'] = $this->db->where(['task_id'=>$id])->get($this->cart_model)->result_array();
        }
        return $task_info;
    }

    /**
     * 绑定买号
     * @param $post_data array 绑定数组
     */
    public function bind_buyer($post_data){


        //判断买号任务时间是否超过三天
        $account_info=$this->db->where(['id'=>$post_data['buy_account_id']])->get($this->account_model)->row_array();
        if((time()-$account_info['last_accept_time'])<3*24*3600){
            json_error(67,'对不起该账号距离上次任务时间不到3天不能绑定','alert',[]);
        }

        if($post_data['is_verify']==0){
            if($post_data['is_verify']==1){
                $data['status']=4;
                $data['count_down']=time()+3600*0.5;
            }else{
                $data['status']=5;
                $data['count_down']=time()+3600*1.5;
            }
        }else{
            $data['status']=3;
            $data['count_down']=time()+3600*0.5;
        }
        $data['buy_account_id']=$post_data['buy_account_id'];


        $this->db->trans_begin();
        //绑定买号
        $this->db->where(['id'=>$post_data['task_id']])->update($this->model,$data);
        if(!$this->db->affected_rows()){
            json_error(67,'绑定失败','alert',[]);
        }
        //更新账号状态
        $res=$this->db->where(['id'=>$post_data['buy_account_id']])->update($this->account_model,['account_status'=>2]);
        if(!$res){
            $this->db->trans_rollback();
            json_error(67,'绑定失败','alert',[]);
        }

        if($this->db->trans_status()==false){
            $this->db->trans_rollback();
            json_error(67,'绑定失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_success(201,'绑定成功','alert',[]);
        }
    }

    /**
     * 发布者放款
     * @param $task_id int 任务ID
     */
    public function loan($task_id){

        $this->db->trans_begin();
        $this->db->where(['id'=>$task_id])->update($this->model,['status'=>10]);
        if(!$this->db->affected_rows()){
            json_error(99,'放款失败','alert',[]);
        }

        $task_info=$this->db->where(['id'=>$task_id])->get($this->model)->row_array();
        $accept_wallet =$this->db->where(['uid'=>$task_info['accept_id']])->get($this->user_wallet_model)->row_array();
        $release_wallet =$this->db->where(['uid'=>$task_info['release_id']])->get($this->user_wallet_model)->row_array();
        //更新接手者钱包
        $new_accept_wallet['balance']=$accept_wallet['balance']+$task_info['deposit'];
        $new_accept_wallet['gold']=$accept_wallet['gold']+$task_info['gold'];
        $res=$this->db->where(['uid'=>$task_info['accept_id']])->update($this->user_wallet_model,$new_accept_wallet);
        if(!$res){
            $this->db->trans_rollback();
            json_error(99,'放款失败','alert',[]);
        }
        //更新发布者钱包
        $new_release_wallet['lock_deposit']=$release_wallet['lock_deposit']-$task_info['deposit'];
        $new_release_wallet['lock_gold']=$release_wallet['lock_gold']-$task_info['gold'];
        $result=$this->db->where(['uid'=>$task_info['release_id']])->update($this->user_wallet_model,$new_release_wallet);
        if(!$result){
            $this->db->trans_rollback();
            json_error(99,'放款失败','alert',[]);
        }

        if($this->db->trans_status()==false){
            $this->db->trans_rollback();
            json_error(99,'放款失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_error(201,'放款成功','alert',[]);
        }
    }

    /**上传淘宝订单号
     * @param $task_id int 任务ID
     * @param $tb_order string 淘宝订单号
     */
    public function payment($task_id,$tb_order){

        $this->db->trans_begin();
        //更新任务状态
        $data['count_down']=time()+3600*24 ;//发货倒计时不能超过1天
        $data['status']=6;
        $data['tb_order_no']=$tb_order;
        $this->db->where(['id'=>$task_id])->update($this->model,$data);

        if(!$this->db->affected_rows()){
            json_error(67,'上传淘宝订单号失败','alert',[]);
        }
        //更新买号状态,恢复正常
        $task_info=$this->db->where(['id'=>$task_id])->get($this->model)->row_array();
        $res=$this->db->where(['id'=>$task_info['buy_account_id']])->update($this->account_model,['account_status'=>1,'last_accept_time'=>time()]);
        if(!$res){
            $this->db->trans_rollback();
            json_error(67,'接手人状态更新失败','alert',[]);
        }

        if($this->db->trans_status()==false){
            $this->db->trans_rollback();
            json_error(67,'上传淘宝订单号失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_error(201,'上传淘宝订单号成功','alert',[]);
        }
    }

}
