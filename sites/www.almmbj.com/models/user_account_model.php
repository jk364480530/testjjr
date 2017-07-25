<?php

/**
 * 用户账号模块
 * Class User_account_model
 */
class User_account_model extends CI_Model {

    private $model='user_account';
    private $task_model ="task";
    private $area_model='area';


    public function __construct() {
        parent::__construct();
    }
    /**
     * 账号列表
     * @param int area_id 区域ID
     * @param int uid 用户ID
     * @param int type 账号类型1掌柜号 2为任务号
     * @param int status 账号状态
     */
   public function user_account_list($area_id=null,$uid,$type=null,$status=null){
       if(!empty($area_id)){
           $where['area_id'] =$area_id;
       }
       if(!empty($type)){
           $where['type']=$type;
       }
       if(!empty($status)){
           $where['account_status']=$status;
       }

       $where['user_id']=$uid;


       $area_field ='b.area_name,';
       $account_field='a.*';

       $this->db->select($area_field.$account_field)
                ->from($this->model.' a')
                ->join($this->area_model.' b','b.id=a.area_id','left')
                ->where($where)
                ->order_by('a.id desc');
       $user_account_list =$this->db->get()->result_array();

       return $user_account_list;
   }

    /**
     * 添加账号
     * @param array data  添加的数据数组
     */
   public function add_account($data){
       $this->db->where(['account'=>$data['account']])->get($this->model)->row_array();
       if($this->db->affected_rows()>0){
         json_error(67,'该账号已经存在','alert',[]);
       }

       $this->db->insert($this->model,$data);
       if($this->db->affected_rows()>0){
           $data['id']=$this->db->insert_id();
           $data['add_time']=date('Y-m-d h:i',$data['add_time']);
           $area_info =$this->db->where(['id'=>$data['area_id']])->get($this->area_model)->row_array();
           $data['area_name']=$area_info['area_name'];
           json_success(201,'添加账号成功','alert',$data);
       }else{
           json_error(67,'添加账号失败','alert',[]);
       }
   }

    /**
     * 删除账号
     * @param int id  账号ID
     */
   public function del($id){
       //判断是否还有任务在进行
       $release_task_info=$this->db->where(['account_id'=>$id,'is_delete'=>0])->get($this->task_model)->row_array();
       if($release_task_info){
           json_error(99,'该掌柜号还有任务在进行请先取消任务再删除','alert',[]);
       }
       $buy_task_info=$this->db->where(['buy_account_id'=>$id,'is_delete'=>0])->get($this->task_model)->row_array();
       if($buy_task_info){
           json_error(99,'该买号还有任务在进行请先取消任务再删除','alert',[]);
       }

       $this->db->where(['id'=>$id])->delete($this->model);
       if($this->db->affected_rows()>0){
           json_success(201,'删除账号成功','alert',[]);
       }else{
           json_error(67,'删除账号失败','alert',[]);
       }
   }
}
