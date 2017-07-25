<?php

/**
 * 权限管理后台控制器
 * Class Power
 * @author jjr<364480530@qq.com 2017-4-19>
 */
class Power extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('power_model');
    }
    //后台管理员分组列表
    public function group_list(){
        $page = $this->get('page','页码','page',[],1);
        $cur_page = $page ? intval($page) : 1;
        $page_size = 10;
        $group_data = $this->power_model->get_group_list($cur_page,$page_size);
        $data['list'] = $group_data['list'];
        $data['total_count'] = $group_data['count'];//总条
        $page_url = '/'.$this->router->class.'/'.$this->router->method;

        //layui分页
        $this->load->helper('layui_page_helper');
        $data['page'] = pages($cur_page,$page_size,$data['total_count'], $page_url);

        $this->load->view('power/group_list',$data);
    }

    //添加后台管理分组
    public function add_group(){
        if(is_ajax()){
            $post_data['group_name']=$this->post('group_name','分组名称','var_trim|required|xss_clean|max_length[10]','result',[],1);
            $post_data['add_time'] =time();
            $this->power_model->add_group($post_data,$this->uid);
        }
        $this->load->view('power/add_group');
    }

    //设置用户
    public function add_user(){
        if(is_ajax()){
            $post_data['group_id'] = $this->post('group_id','分组ID','var_trim|xss_clean|required|is_num','result',[],1);
            $post_data['user_id'] = $this->post('user_id','用户ID字符串','var_trim','result',[],2);
            if($post_data['user_id']){
                $post_data['user_id'] = array_filter(explode(',',$post_data['user_id']));
            }else{
                $post_data['user_id']=[];
            }
            $this->load->model('user_model');
            $this->user_model->set_group($post_data['group_id'],$post_data['user_id']);
        }
        //获取分组信息
        $group_id = $this->get('group_id','分组ID','var_trim|xss_clean|required|is_num','result',[],1);

        $data['info']=$this->power_model->get_group_info($group_id);
        $this->load->model('user_model');
        //获取该分组的用户列表
        $data['group_user']=$this->user_model->get_group_user($group_id);
        //获取未分组及该分组的管理员
        $other_user=$this->user_model->get_other_user($group_id);
        $data['user_list']=$other_user;
        $this->load->view('power/add_user',$data);
    }

    //设置权限
    public function set_power(){
        if(is_ajax()){
            $post_data['group_id'] = $this->post('group_id','分组ID','var_trim|xss_clean|required|is_num','result',[],1);
            $post_data['nav_id'] = $this->post('nav_id','导航字符串','var_trim','result',[],2);
            $post_data['nav_id'] = array_filter(explode(',',$post_data['nav_id']));
            $this->power_model->set_power($post_data['group_id'],$post_data['nav_id']);
        }
        $group_id = $this->get('group_id','分组ID','var_trim|xss_clean|required|is_num','result',[],1);
        $group_info=$this->power_model->get_group_info($group_id);

        if($group_info['group_power']){
            $group_info['group_power'] =unserialize($group_info['group_power']);
        }else{
            $group_info['group_power'] =[];
        }
        $this->load->model('navigate_model');
        $this->power?$power= $this->power:[];
        $nav_list=$this->navigate_model->sort_nav($power);
        $data['list']=$nav_list;
        $data['info']=$group_info;
        $this->load->view('power/set_power',$data);
    }

    /**
     * 删除分组
     */
    public function del_group(){
        $post_data['group_id']=$this->post('group_id','分组ID','var_trim|required|xss_clean|is_num','result',[],1);
        $this->power_model->del_group($post_data['group_id'],$this->uid);
    }

}
