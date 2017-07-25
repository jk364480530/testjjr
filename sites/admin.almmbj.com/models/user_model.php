<?php

/**
 * 用户管理 —— 模型
 *
 * @author 韦文全
 */
class user_model extends CI_Model {

    private $model ='admin_user';

    public function __construct() {
        parent::__construct();
    }

    /**
     * 获取管理员信息
     */
    public function get_admin_info($uid){
        return $this->db->where('uid',$uid)->get($this->model)->row_array();
    }

    /**
     * 设置新密码
     */
    public function set_admin_pwd($uid,$new_pwd){

        $salt = random_min(6);

        $data['passwd'] = md5($new_pwd.$salt);
        $data['salt']= $salt;

        $this->db->where('uid',$uid)->update($this->model,$data);

        if($this->db->affected_rows()>0){
            json_success(201,'修改密码成功','alert',[]);
        }else{
            json_error(99,'修改密码失败','alert',[]);
        }

    }

    /**
     * 获取用户列表
     * @param $page_size int 每页显示多少条
     * @param $offset int 第几条开始
     * @param $search array 查询条件
     */
    public function get_user_list($page_size=6,$offset=0,$search){

        $user_feild=$this->model.'.*';
        $this->db->select( $user_feild);
        $db = clone ($this->db);
        $data['list'] = $this->db->order_by($this->model.'.add_time DESC')
                                     ->get($this->model,$page_size,$offset)
                                     ->result_array();
        $data['count'] = $db->count_all_results($this->model);
        return $data;
    }

    /*
     * 获取该分组下的用户ID
     * @param $where array 条件
     */
    public function get_group_user($group_id){
        $group_user =$this->db->where(['group_id'=>$group_id])->get($this->model)->result_array();
        $user_id=[];
        if($group_user){
            foreach ($group_user as $key=>$val){
                $user_id[]=$val['uid'];
            }
        }
        return $user_id;
    }

    /*
   * 获取该分组下的用户ID
   * @param $where array 条件
   */
    public function get_other_user($group_id){
        $where['is_root !=']=1;
        $where['group_id']=$group_id;
        $group_user =$this->db->where($where)->get($this->model)->result_array();

        $condition['is_root !=']=1;
        $condition['group_id']=null;
        $group_null =$this->db->where($condition)->get($this->model)->result_array();

        return $group_user+$group_null;
    }

    /**
     * 分组添加用户
     * @param $group_id 管理分组ID
     * @param $user_arr array 用户ID组
     */
    public function set_group($group_id,$user_arr){

        $user_id =$this->get_group_user($group_id);
        $group_user=[];
        if($user_arr){
            foreach ($user_arr as $key=>$val){
                if(!in_array($val,$user_id)){
                    $group_user[]=$val;
                }
            }
        }

        $surplus_user=[];
        if($user_id){
            foreach ($user_id as $k=>$v){
                if(!in_array($v,$user_arr)){
                    $surplus_user[]=$v;
                }
            }
        }

        if($group_user && $surplus_user){

            $this->db->trans_begin();
            $this->db->where_in('uid',$group_user)->update($this->model,['group_id'=>$group_id]);
            if(!$this->db->affected_rows()){
                json_error(67,'添加失败','alert',[]);
            }
            $res =$this->db->where_in('uid',$surplus_user)->update($this->model,['group_id'=>null]);
            if(!$res){
                $this->db->trans_rollback();
                json_error(67,'添加失败','alert',[]);
            }

            if($this->db->trans_status()==false){
                $this->db->trans_rollback();
                json_error(67,'添加失败','alert',[]);
            }else{
                json_success(201,'添加成功','alert',[]);
            }
        }elseif (!$group_user && $surplus_user){
            $res =$this->db->where_in('uid',$surplus_user)->update($this->model,['group_id'=>null]);
            if(!$res){
                json_error(67,'删除失败','alert',[]);
            }else{
                json_success(201,'删除成功','alert',[]);
            }
        }elseif ($group_user && !$surplus_user){
            $this->db->where_in('uid',$group_user)->update($this->model,['group_id'=>$group_id]);
            if($this->db->affected_rows()>0){
                json_success(201,'添加成功','alert',[]);
            }else{
                json_error(67,'添加失败','alert',[]);
            }
        }else{
            json_error(67,'你没有进行任何选择','alert',[]);
        }

    }

}
