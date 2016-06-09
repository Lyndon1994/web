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
        $this->load->model('log_model');
        $this->load->model('comments_model');
        $this->load->helper('form');
    }

    public function index(){
        $data['books'] = $this->book_model->get_book();
        $this->load->view('index',$data);
    }
    /**
     * 图书列表
     * @param int $num
     */
    public function show_list($num = 1){
    }
    
    public function mine(){
        $data['books'] = $this->book_model->get_mine();
        $this->load->view('book/mine',$data);
    }
    
    public function introduction($id){
        $data['book'] = $this->book_model->get_book($id)[0];
        $data['comments'] = $this->comments_model->get_comments($id);
        $this->load->view('book/introduction',$data);
    }

    public function comment(){
        $bookid = $this->input->post('bookid');
        $this->comments_model->set_comments();
        //返回原界面
        redirect('/book/'.$bookid);
    }
    /**
     * 租借图书
     */
    public function borrow($bookid){
        $this->book_model->reservation($bookid);//将图书状态改为预约中
        $this->log_model->set_log($bookid);
        redirect('user/history');
    }

    /**
     * 增加图书
     */
    public function add()
    {
        if (!isset($_SESSION['user'])){
            $data['tip'] = '请先登陆';
            redirect('user/login',$data);
        }else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('bookname', 'bookname', 'required');
            $this->form_validation->set_rules('author', 'author', 'required');
            $this->form_validation->set_rules('class', 'class', 'required');
            $this->form_validation->set_rules('introduction', 'introduction', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('book/add');
            } else {
                $config['upload_path'] = './source/images/books';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = 'book' . $this->input->post('bookid');
                $config['overwrite'] = TRUE;
                $config['max_size'] = 100;
                $config['max_width'] = 1024;
                $config['max_height'] = 768;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('tip' => "图片上传出错\n" . $this->upload->display_errors());

                    $this->load->view('book/add', $error);
                } else {
                    $image = base_url('source/images/books').$this->upload->data('file_name');
                    $this->book_model->set_book($image);
                    redirect('/');
                }


            }
        }
    }

    public function drifting($id){
        $data['logs'] = $this->log_model->get_book_log($id);
        $this->load->view("book/drifting",$data);
    }

    public function test(){
        $this->load->view("book/test");
    }
}
