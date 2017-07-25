<?php

/**
 * 搜索来路模型
 * Class Task_img_model
 */
class Task_img_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    private $model='task_img';
    private $task_model='task';

    /**
     * 通过任务ID类型获取图片列表
     * @param int task_id 任务ID
     * @param int type 图片类型
     * @author jjr<364480530@qq.com 2017-4-4>
     */
   public function img_list($task_id,$type){
       $img_data =$this->db->where(['task_id'=>$task_id,'type'=>$type])->get($this->model)->result_array();
       return $img_data;
   }


    /**
     * 上传评价凭证
     * @param $post_data 凭证数据
     */
    public function praise($post_data){

        $praise_img = [];
        foreach ($post_data['praise_img'] as $key => $val) {
            $praise_img[$key]['url'] = $val;
            $praise_img[$key]['task_id'] = $post_data['task_id'];
            $praise_img[$key]['type'] = 3;
        }
        $this->db->trans_begin();
        $this->db->insert_batch($this->model,$praise_img);
        if (!$this->db->affected_rows()) {
            json_error(99, '上传好评凭证失败', 'alert', []);
        }


        $res=$this->db->where(['id'=>$post_data['task_id']])->update($this->task_model,['status'=>9]);
        if(!$res){
            $this->db->trans_rollback();
            json_error(99, '上传好评凭证失败', 'alert', []);
        }

        if($this->db->trans_status()==false){
            json_error(67,'上传好评凭证失败','alert',[]);
        }else{
            json_error(201,'上传好评凭证成功','alert',[]);
        }

    }


}
