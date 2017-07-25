<?php

/**
 * 任务区域模块
 * Class Area_model
 */
class Area_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    private $model='area';

    /**
     * 区域列表
     * @author jjr <364480530@qq.com 2017-4-2>
     */
   public function area_list(){
       $area_list =$this->db->get($this->model)->result_array();
       return $area_list;
   }
}
