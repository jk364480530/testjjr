<?php
/**
 * 用户图片上传
 */

class Upload extends Home_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload_image');
    }
    //上传评价凭证
    public function praise_images(){
        $images = $_FILES['praise_img'];
        $save_path='praise';//图片保存文件夹
        $upload_type='praise_img';
        $this->upload_images($images,$save_path,$upload_type);
    }


    public function task_images(){

        if (isset($_FILES['comment_img'])){

            $images = $_FILES['comment_img'];
            $upload_type = 'comment_img';
            $save_path='comment';//图片保存文件夹

        }elseif(isset($_FILES['pay_img'])){

            $images = $_FILES['pay_img'];
            $upload_type = 'pay_img';
            $save_path='pay';//图片保存文件夹

        }else{

            $images = $_FILES['origin_img'];
            $upload_type = 'origin_img';
            $save_path='origin';//图片保存文件夹
        }
        $this->upload_images($images,$save_path,$upload_type);
    }

    //上传任务图片
    public function upload_images($images,$save_path,$upload_type){

        if (empty($images)){
            @header("HTTP/1.1 404 File upload failed");
            @header("Status: 404 File upload failed");
            json_error(99,'请上传至少一张图片！','alert',[]);
        }
        // 文件最大上限/KB
        $size_max = 500;
        // 文件后缀
        $type = strtolower(end(explode('.', $images['name'])));

        // 判断文件格式
        if( !in_array($type, array('jpg', 'jpeg', 'png', 'bmp')) )
        {
            $this->upload_image->delete($images['tmp_name']);
            $this->failure(array( 'msg' => '文件格式必须为：jpg、png、bmp'));
        }
        //判断文件大小
        if($images['size'] > $size_max * 20240)
        {
            $this->upload_image->delete($images['tmp_name']);
            $this->failure(array( 'msg' => '文件大小不能超过'.$size_max * $this->coefficient_mb.'K'));
        }

        $this->_check_upload($images);


        $relativePath = $this->upload_image->save($save_path,$images['tmp_name']);
        if ($relativePath) {
            $this->upload_image->delete($images['tmp_name']);
            json_success(201,"上传成功",$upload_type,array('relative'=>$relativePath,'url'=>get_thumb_img($relativePath,'224x224')));
        }else{
            //控件只能判断返回的状态码
            @header("HTTP/1.1 404 File upload failed");
            @header("Status: 404 File upload failed");
            json_error(99,'图片上传失败：'.$this->upload_image->error(),'alert',[]);
        }
    }

    /*
    * 检查上传文件的合法性
    * @param array $file
    */
    private function _check_upload($file)
    {
        if(empty($file)){
            $this->failure(array( 'msg' => '服务器无法获取文件'));
        }
        if ($file['error']) {
            $this->failure(array( 'msg' => '上传错误'));
        }

        /* 无效上传 */
        if (empty($file['name'])){
            $this->failure(array( 'msg' => '未知上传错误！'));
        }

        /* 检查是否合法上传 */
        if (!is_uploaded_file($file['tmp_name'])) {
            $this->failure(array( 'msg' => '非法上传文件！'));
        }
    }
}