<?php

/**
 * 任务类型模块
 * Class Task_type_model
 */
class Task_type_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    private $model='task_type';

    /**
     * 任务类型列表
     * @param area_id 区域ID
     * @author jjr <364480530@qq.com 2017-4-2>
     */
   public function task_type_list($area_id){
       $task_type_list =$this->db->where(['area_id'=>$area_id])->get($this->model)->result_array();
       return $task_type_list;
   }
}
