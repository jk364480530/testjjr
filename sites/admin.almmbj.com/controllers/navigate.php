<?php

/**
 * 导航后台控制器
 * Class Navigate
 * @author jjr<364480530@qq.com 2017-4-18>
 */
class Navigate extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('navigate_model');
    }

    //导航列表
   public function nav_list(){

       $page = $this->get('page','页码','page',[],1);
       $cur_page = $page ? intval($page) : 1;
       $page_size = 10;
       $nav_data = $this->navigate_model->get_nav_list($cur_page,$page_size);
       $data['list'] = $nav_data['list'];
       $data['total_count'] = $nav_data['count'];//总条
       $page_url = '/'.$this->router->class.'/'.$this->router->method;

        //layui分页
       $this->load->helper('layui_page_helper');
       $data['page'] = pages($cur_page,$page_size,$data['total_count'], $page_url);
       $data['top_nav']=$this->navigate_model->next_nav(0);
       $this->load->view('navigate/nav_list',$data);
   }

    //添加导航
   public function add_nav(){

       if(is_ajax()){
            $post_data['nav_name'] =$this->post('nav_name','导航名称','var_trim|xss_clean|max_length[20]|required','result',[],1);
            $post_data['controller_name'] =$this->post('controller_name','控制器名称','var_trim|xss_clean|required','result',[],2);
            $post_data['action_name'] =$this->post('action_name','方法名称','var_trim|xss_clean','result',[],3);
            $post_data['pid'] =$this->post('pid','父级ID','var_trim|xss_clean','result',[],4);
            $post_data['icon'] =$this->post('icon','导航图标','var_trim|required','result',[],5);
            $post_data['add_time']=time();
            $this->navigate_model->add_nav($post_data,$this->uid);
       }

   }


    //编辑导航
    public function edit_nav(){
        if(is_ajax()){
            $post_data['nav_name'] =$this->post('nav_name','导航名称','var_trim|required|xss_clean|max_length[20]','result',[],1);
            $post_data['controller_name'] =$this->post('controller_name','控制器名称','var_trim|required|xss_clean','result',[],2);
            $post_data['action_name'] =$this->post('action_name','方法名称','var_trim|xss_clean','result',[],3);
            $post_data['pid'] =$this->post('pid','父级ID','var_trim|xss_clean','result',[],4);
            $post_data['icon'] =$this->post('icon','导航图标','var_trim|required','result',[],5);
            $post_data['add_time']=time();
            $nav_id =$this->post('nav_id','导航ID','var_trim|required|xss_clean|is_num','result',[],5);
            $this->navigate_model->edit_nav($post_data,$this->uid,$nav_id);
        }
        $nav_id =$this->get('nav_id','导航ID','var_trim|required|xss_clean|is_num','result',[],1);
        $nav_info=$this->navigate_model->get_nav_info(['id'=>$nav_id]);
        $data['top_nav']=$this->navigate_model->next_nav(0);
        $data['nav_info']=$nav_info;
        $this->load->view('navigate/edit_nav',$data);
    }


   //获取子集导航
   public function get_child(){
       if(is_ajax()){
           $post_data['nav_id']=$this->post('nav_id','导航ID','var_trim|required|xss_clean|is_num','result',[],1);
           $data=$this->navigate_model->next_nav(intval($post_data['nav_id']));
            json_success(201,'下一级导航数组','data',$data);
       }
   }


   //删除导航
   public function del(){
       if(is_ajax()){
           $post_data['id']=$this->post('nav_id','导航ID','var_trim|required|xss_clean|is_num','result',[],1);
           $this->navigate_model->del(intval($post_data['id']),$this->uid);
       }
   }

}
