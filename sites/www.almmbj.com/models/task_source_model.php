<?php

/**
 * 搜索来路模型
 * Class Task_source_model
 */
class Task_source_model extends CI_Model {

    private $model='task_source';

    public function __construct() {
        parent::__construct();
    }


    /**
     * 通过任务ID获取来路信息
     * @param $task_id 任务ID
     * @author jjr<364480530@qq.com 2017-4-4>
     */
   public function lailu_info($task_id){

       $lailu_data =$this->db->where(['task_id'=>$task_id])->get($this->model)->row_array();

       //获取来路图片
       $this->load->model('task_img_model');
       $lailu_data['img']= $this->task_img_model->img_list($task_id,1);
       return $lailu_data;
   }

    /**
     * 校验来路地址
     * @param $url string 校验地址
     * @param $task_id int 任务ID
     * @return bool
     */
    public function check_url($url,$task_id){
        $lailu_info=$this->db->where(['task_id'=>$task_id])->get($this->model)->row_array();
        if($lailu_info['check_url']!=$url){
            json_error(67,'校验地址错误','alert',[]);
        }else{
            $this->load->model('task_model');
            $this->task_model->change_status($task_id,5);

        }

    }
}
