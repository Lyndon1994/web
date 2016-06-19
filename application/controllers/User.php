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
        $this->load->model('book_model');
        $this->load->model('log_model');

    }

    public function index($username = FALSE)
    {
        $this->user_model->is_login();
        if ($username === FALSE) {
            $data['userInfo'] = $_SESSION['user'];
            $data['books'] = $this->book_model->get_mine($_SESSION['user']->username);
            $data['ownbooks'] = $this->book_model->get_own($_SESSION['user']->username);
            $this->load->view('common/header');
            $this->load->view('user/user', $data);
            $this->load->view('common/footer');
        } else {
            $data['userInfo'] = $this->user_model->get_user_by_username($username);
            if ($data['userInfo'] === FALSE) show_404();
            $data['books'] = $this->book_model->get_mine($username);
            $data['ownbooks'] = $this->book_model->get_own($username);
            $this->load->view('common/header');
            $this->load->view('user/user', $data);
            $this->load->view('common/footer');
        }
    }

    public function login()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('validate', 'Captcha', array(
            'required',
            array(
                'validate',
                function () {
                    $value = $this->input->post('validate');
                    if (strtolower(trim($value)) == $_SESSION['code'])
                        return TRUE;
                    return FALSE;
                })
        ), array('validate' => '验证码输入错误'));
        
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('common/header');
            $this->load->view('user/login');
        } else {
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->user_model->get_user($name, $password);
            if (count($user) > 0) {
                $this->session->set_userdata('user', $user[0]);
                redirect('/');
            } else {
                $data['tip'] = '你输入的用户名或密码有误';
                $this->load->view('common/header');
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
        $this->form_validation->set_rules('nickname', 'User Name', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('username', 'User Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('common/header');
            $this->load->view('user/register');

        } else {
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->user_model->get_user($name, $password);
            if (count($user) > 0) {
                $data['tip'] = '你输入的用户名已被注册';
                $this->load->view('common/header');
                $this->load->view('user/register', $data);
            } else {
                $this->user_model->set_user();
                $user = $this->user_model->get_user($name, $password);
                $this->session->set_userdata('user', $user[0]);

                //发送邮件
                $this->load->library('email');
                $this->email->from('wuhulinyi@126.com', '图书漂流网');
                $this->email->to($name);
                $this->email->subject('欢迎注册图书漂流网');
                $this->email->message('欢迎您注册图书漂流网，您的账户为:' . $name . "\n您的密码为:" . $password);
                $this->email->send();
                //echo $this->email->print_debugger();
                redirect('/user/');
            }
        }
    }

    public function modify()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nickname', 'User Name', 'trim|required|min_length[1]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('common/header');
            $this->load->view('user/modify');

        } else {
            $name = $_SESSION['user']->username;
            $this->user_model->modify_user();
            $user = $this->user_model->get_user_by_username($name);
            unset($_SESSION['user']);
            $this->session->set_userdata('user', $user);

            redirect('/user/');

        }
    }

    public function history()
    {
        $this->user_model->is_login();
        $data['logs'] = $this->log_model->get_log($_SESSION['user']->username);
        $this->load->view('common/header');
        $this->load->view("user/history", $data);
        $this->load->view('common/footer');
    }

    public function manage()
    {
        $this->user_model->is_manager();
        $data['users'] = $this->user_model->get_all_user();
        $this->load->view('common/header');
        $this->load->view('user/manage', $data);
        $this->load->view('common/footer');
    }

    public function change_credits($c, $username)
    {
        $this->user_model->is_manager();
        $this->user_model->change_credits($c, $username);
        redirect('/user/manage/');
    }

    /**
     * 找回密码
     */
    public function get_password()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $name = $this->input->post('username');
        if ($name == "") {
            $this->load->view('common/header');
            $this->load->view('user/getpass');
        } else {
            $this->form_validation->set_rules('username', 'Email', 'required');
            $this->form_validation->set_rules('validate', 'Captcha', array(
                'required',
                array(
                    'validate',
                    function () {
                        $value = $this->input->post('validate');
                        if (strtolower(trim($value)) == $_SESSION['code'])
                            return TRUE;
                        return FALSE;
                    })
            ), array('validate' => '验证码输入错误'));

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('common/header');
                $this->load->view('user/getpass');
            } else {
                $user = $this->user_model->get_user_by_username($name);
                if ($user == FALSE) {
                    $data['error'] = '用户不存在！';
                    $this->load->view('common/header');
                    $this->load->view('user/getpass', $data);
                } else {
                    //发送邮件
                    $this->load->library('email');
                    $this->email->from('wuhulinyi@126.com', '图书漂流网');
                    $this->email->to($name);
                    $this->email->subject('【图书漂流网】找回密码');
                    $this->email->message('您的账户为:' . $name . "\n您的密码为:" . $user->password);
                    $this->email->send();
                    $data['success'] = '邮件已发送，请查看您的邮箱！';
                    $this->load->view('common/header');
                    $this->load->view('user/getpass', $data);
                }
            }
        }
    }
}
