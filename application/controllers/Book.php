<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: linyi
 * Date: 16-6-6
 * Time: 上午9:53
 */

class Book extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('book_model');

    }
    
    

    /**
     * 租借图书
     */
    public function borrow(){
        
    }

    /**
     * 增加图书
     */
    public function add()
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
