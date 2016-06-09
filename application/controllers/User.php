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
        $this->load->model('log_model');

    }


    public function login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('user/login');
        } else {
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            $validate = $this->input->post('validate');
            if ($_SESSION['code'] == $validate) {
                $user = $this->user_model->get_user($name, $password);
                if (count($user) > 0) {
                    $this->session->set_userdata('user', $user[0]);
                    redirect('/');
                } else {
                    $data['tip'] = '你输入的用户名或密码有误';
                    $this->load->view('user/login', $data);
                }
            } else {
                $data['tip'] = '你输入的验证码有误，请重新输入';
                $this->load->view('user/login', $data);
            }
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            redirect('/');
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

        if ($this->form_validation->run() === FALSE) {
            $data['tip'] = '错误';
            $this->load->view('user/register',$data);

        } else {
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            $this->user_model->set_user();
            $user = $this->user_model->get_user($name, $password);
            if (count($user) > 0) {
                $this->session->set_userdata('user', $user[0]);
                redirect('/');
            }else {
                $data['tip'] = '你输入的用户名已被注册';
                $this->load->view('user/register', $data);
            }
        }
    }

    public function history(){
        $data['logs'] = $this->log_model->get_log($_SESSION['user']->username);
        $this->load->view("user/history",$data);
    }
}
