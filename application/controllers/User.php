<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: linyi
 * Date: 16-6-6
 * Time: 上午9:53
 */

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('validateCode_model');

    }

    public function test(){
        $validate = $this->input->post('validate');
        if($_SESSION['code']==$validate){
            $this->load->view('user/success');
        }
        else{
            echo "error";
        }
    }

    public function login(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
//            $this->load->view('common/header');
            $this->load->view('user/login');
//            $this->load->view('common/footer');
        }
        else
        {
            $name = $this->input->post('username');
            //对象数组
            $user = $this->user_model->get_user($name);
            if(count($user)>0){
                $this->session->set_userdata('user', $user[0]);
                redirect('user/'.$name);
            }
            else{
                $tip = '你输入的用户名或密码有误';
                $this->load->view('common/header');
                $this->load->view('user/login');
                $this->load->view('common/footer');
            }
        }
    }

    public function logout(){
        if (isset($_SESSION['user'])){
            unset($_SESSION['user']);
            redirect('user/login');
        }
    }

    public function register()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('address', 'address', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('common/header');
            $this->load->view('user/register');
            $this->load->view('common/footer');

        }
        else
        {
            $name = $this->input->post('username');
            $this->user_model->set_user();
            redirect('user/'.$name);
        }
    }
}
