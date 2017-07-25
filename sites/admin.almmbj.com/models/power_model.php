<?php

/**
 * 权限管理模型
 *
 * @author JJR <364480530@qq.com 2017-4-19>
 */
class Power_model extends CI_Model {

    private $model ='admin_group';
    private $log ='admin_group_log';

    public function __construct() {
        parent::__construct();
    }


    /**
     * 获取导航列表
     * @param int $page 分页
     * @param int $size 每页显示多少条
     * @return mixed
     */
    public function get_group_list($page=1,$size = 6){
        $where=[];
        $offset = ($page - 1) * $size;
        $this->db->where($where)->order_by('id desc');

        $db = clone($this->db);
        $group_res = $this->db->get($this->model,$size,$offset)->result_array();
        $date_res['count'] = $db->count_all_results($this->model);
        $date_res['list'] = $group_res;
        return $date_res;
    }

    /**
     * 后台管理员分组添加
     * @param $post_data array 分组添加数组
     * @param $uid int 后台管理员ID
     */
    public function add_group($post_data,$uid){

        $group_info =$this->db->where(['group_name'=>$post_data['group_name']])->get($this->model)->row_array();
        if($group_info){
            json_error(67,'该用户名已经存在','alert',[]);
        }
        $this->db->trans_begin();
        $this->db->insert($this->model,$post_data);
        if(!$this->db->affected_rows()){
            json_error(67,'添加分组失败','alert',[]);
        }

        //添加日志
        $action_log['action_id']=$this->db->insert_id();
        $action_log['ip']=ip();
        $action_log['add_time']=time();
        $action_log['action_name']='添加分组';
        $action_log['uid']=$uid;

        $res =$this->db->insert($this->log,$action_log);
        if(!$res){
            $this->db->trans_rollback();
            json_error(67,'添加分组失败','alert',[]);
        }

        if($this->db->trans_status()==FALSE){
            $this->db->trans_rollback();
            json_error(67,'添加分组失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_success(201,'添加分组成功','alert',[]);
        }
    }

    /**
     * 获取单条分组信息
     * @param $group_id int 分组ID
     */
    public function get_group_info($group_id){
        return $this->db->where(['id'=>$group_id])->get($this->model)->row_array();
    }


    /**
     * 分组设置权限
     * @param $group_id 管理分组ID
     * @param $nav_arr array 导航ID组
     */
    public function set_power($group_id,$nav_arr){
        $data['group_power']=serialize($nav_arr);
        $this->db->where(['id'=>$group_id])->update($this->model,$data);
        if(!$this->db->affected_rows()){
            json_error(67,'设置权限失败','alert',[]);
        }else{
            json_success(201,'设置权限成功','alert',[]);
        }

    }

    /**
     * 删除分组
     * @param $group_id int 分组ID
     */
    public function del_group($group_id,$uid){

        $this->db->trans_begin();
        $this->db->where(['id'=>$group_id])->delete($this->model);
        if(!$this->db->affected_rows()){
           json_error(67,'删除分组失败','alert',[]);
        }

        $res =$this->db->where(['id'=>$group_id])->delete($this->admin_user);
        if(!$res){
            $this->db->trans_rollback();
            json_error(67,'删除分组失败','alert',[]);
        }

        //添加日志
        $action_log['action_id']=$group_id;
        $action_log['ip']=ip();
        $action_log['add_time']=time();
        $action_log['action_name']='删除分组';
        $action_log['uid']=$uid;

        $res =$this->db->insert($this->log,$action_log);
        if(!$res){
            $this->db->trans_rollback();
            json_error(67,'删除分组失败','alert',[]);
        }

        if($this->db->trans_status()==FALSE){
            $this->db->trans_rollback();
            json_error(67,'删除分组失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_success(201,'删除分组成功','alert',[]);
        }

    }

}
