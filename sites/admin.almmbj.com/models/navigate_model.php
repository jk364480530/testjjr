<?php

/**
 * 导航管理模型
 *
 * @author JJR <364480530@qq.com 2017-4-18>
 */
class Navigate_model extends CI_Model {

    private $model ='admin_nav';
    private $log ='admin_nav_log';

    public function __construct() {
        parent::__construct();
    }


    /**
     * 获取导航列表
     * @param int $page 分页
     * @param int $size 每页显示多少条
     * @return mixed
     */
    public function get_nav_list($page=1,$size = 6){
        $where=[];
        $offset = ($page - 1) * $size;
        $this->db->where($where)->order_by('id desc');

        $db = clone($this->db);
        $nav_res = $this->db->get($this->model,$size,$offset)->result_array();
        //列表转换成树形
        $nav_data=tree($nav_res,0,'pid','id');
        $nav_tree=build_tree_name($nav_data,'nav_name');
        $date_res['count'] = $db->count_all_results($this->model);
        $date_res['list'] = $nav_tree;
        return $date_res;
    }


    /**
     * 获取下一级的nav
     * @param $pid int 父级ID
     */
    public function next_nav($pid){
        return $this->db->where(['pid'=>$pid])->get($this->model)->result_array();
    }

    /**
     * 添加导航
     * @param $data array 导航添加数据
     * @param $uid 管理员ID
     */
    public function add_nav($data,$uid){

        $this->db->where(['nav_name'=>$data['nav_name']])->get($this->model)->row_array();
        if($this->db->affected_rows()>0){
            json_error(67,'该导航名已经存在','alert',[]);
        }

        $this->db->trans_begin();
        $this->db->insert($this->model,$data);
        if(!$this->db->affected_rows()){
            json_error(67,'添加导航失败','alert',[]);
        }

        //添加日志
        $action_log['action_id']=$this->db->insert_id();
        $action_log['ip']=ip();
        $action_log['add_time']=time();
        $action_log['action_name']='添加导航';
        $action_log['uid']=$uid;

        $this->db->insert($this->log,$action_log);
        if(!$this->db->affected_rows()){
            $this->db->trans_rollback();
            json_error(67,'添加日志失败','alert',[]);
        }

        if($this->db->trans_status()==FALSE){
            $this->db->trans_rollback();
            json_error(67,'添加导航失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_success(201,'添加导航成功','alert',[]);
        }

    }

    /**
     * 修改导航
     * @param $data array 导航修改数据
     * @param $uid 管理员ID
     * @param $nav_id 导航ID
     */
    public function edit_nav($data,$uid,$nav_id){

        $this->db->where(['nav_name'=>$data['nav_name'],'id !='=>$nav_id])->get($this->model)->row_array();
        if($this->db->affected_rows()>0){
            json_error(67,'该导航名已经存在','alert',[]);
        }

        $this->db->trans_begin();
        $this->db->where(['id'=>$nav_id])->update($this->model,$data);
        if(!$this->db->affected_rows()){
            json_error(67,'更新导航失败','alert',[]);
        }

        //添加日志
        $action_log['action_id']=$nav_id;
        $action_log['ip']=ip();
        $action_log['add_time']=time();
        $action_log['action_name']='更新导航';
        $action_log['uid']=$uid;

        $this->db->insert($this->log,$action_log);
        if(!$this->db->affected_rows()){
            $this->db->trans_rollback();
            json_error(67,'添加日志失败','alert',[]);
        }

        if($this->db->trans_status()==FALSE){
            $this->db->trans_rollback();
            json_error(67,'更新导航失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_success(201,'更新导航成功','alert',[]);
        }

    }
    /**
     * 删除导航
     * @param $id int 导航ID
     * @param $uid int 管理员ID
     */
    public function del($id,$uid){

        $child_nav =$this->db->where(['pid'=>$id])->get($this->model)->row_array();
        if($child_nav){
            json_error(67,'该导航下的子导航还未删除','alert',[]);
        }

        $this->db->trans_begin();
        $this->db->where(['id'=>$id])->delete($this->model);
        if(!$this->db->affected_rows()){
            json_error(67,'删除失败','alert',[]);
        }

        //添加日志
        $action_log['action_id']=$id;
        $action_log['ip']=ip();
        $action_log['add_time']=time();
        $action_log['action_name']='删除导航';
        $action_log['uid']=$uid;

        $this->db->insert($this->log,$action_log);
        if(!$this->db->affected_rows()){
            $this->db->trans_rollback();
            json_error(67,'添加日志失败','alert',[]);
        }

        if($this->db->trans_status()==FALSE){
            $this->db->trans_rollback();
            json_error(67,'删除导航失败','alert',[]);
        }else{
            $this->db->trans_commit();
            json_success(201,'删除导航成功','alert',[]);
        }
    }


    /**
     * 重组导航列表
     * @param $power array 权限组合
     */
    public function sort_nav($power){
        $nav_list = $this->db->where_in('id',$power)->get($this->model)->result_array();
        //重新组合导航信息
        $nav_html=[];
        foreach ($nav_list as $key=>$val){
                $nav_html[$key]['title']=$val['nav_name'];
                $val['icon']?$nav_html[$key]['icon']=$val['icon']:$nav_html[$key]['icon']='fa-cubes';
                $nav_html[$key]['href']='/'.$val['controller_name'].'/'.$val['action_name'];
                $val['pid']!=0?$nav_html[$key]['spread']=true:$nav_html[$key]['spread']=false;
                $nav_html[$key]['id']=$val['id'];
                $nav_html[$key]['pid']=$val['pid'];
        }
        $nav_data=nav_tree($nav_html,0);
        return $nav_data;
    }

    //获取单个导航信息
    public function get_nav_info($where){
        return $this->db->where($where)->get($this->model)->row_array();
    }
}
