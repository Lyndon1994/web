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
        $this->load->model('user_model');
        $this->load->model('log_model');
        $this->load->model('comments_model');
        $this->load->helper('form');
    }

    public function index()
    {
        $data['books'] = $this->book_model->get_book();
        $this->load->view('common/header');
        $this->load->view('index', $data);
        $this->load->view('common/footer');
    }

    public function manage()
    {
        $this->user_model->is_manager();
        $data['books'] = $this->book_model->get_book();
        $this->load->view('common/header');
        $this->load->view('book/manage', $data);
        $this->load->view('common/footer');
    }
    

    /**
     * 滚动加载
     */
    public function more(){
        $page = intval($_GET['page']);  //获取请求的页数
        $start = $page*5;
        $sql="select * from book ORDER BY bookid DESC limit $start,5";
        $arr = $this->db->query($sql)->result_array();
        echo json_encode($arr);  //转换为json数据输出
    }

    public function introduction($id)
    {
        $books = $this->book_model->get_book($id);
        $data['book'] = $books[0];
        $data['comments'] = $this->comments_model->get_comments($id);
        $this->load->view('common/header');
        $this->load->view('book/introduction', $data);
        $this->load->view('common/footer');
    }

    public function comment()
    {
        $this->user_model->is_login();
        $bookid = $this->input->post('bookid');
        $content = $this->input->post('content');
        if (strlen($content)<10) {
            //如何提示？？？？？？
//            $this->session->set_userdata('error', "评轮不得少于10个字！");
            redirect('/book/' . $bookid);
        } else {
            $this->comments_model->set_comments();
//            unset($_SESSION['error']);
            //返回原界面
            redirect('/book/' . $bookid);
        }
    }

    public function more_comment(){
        $page = intval($_GET['page']);  //获取请求的页数
        $bookid = intval($_GET['id']);  //获取请求的页数
        $start = $page*5;
        $sql="select * from comments  where bookid=$bookid ORDER BY time DESC limit $start,5";
        $arr = $this->db->query($sql)->result_array();
        echo json_encode($arr);  //转换为json数据输出
    }
    /**
     * 租借图书
     */
    public function borrow($bookid)
    {
        $this->user_model->is_login();
        $this->book_model->reservation($bookid);//将图书状态改为预约中
        $this->log_model->set_log($bookid);
        $this->user_model->change_credits(-10);
        redirect('user/history');
    }

    public function get($bookid)
    {
        $this->user_model->is_login();
        $this->log_model->update_log($bookid);
        $this->book_model->reading($bookid);//将图书状态改为在读
        redirect('user/history');
    }

    public function pass($bookid)
    {
        $this->user_model->is_manager();
        $this->book_model->pass($bookid);//将图书状态改为在读
        redirect('book/manage');
    }

    public function delete($bookid)
    {
        $this->user_model->is_manager();
        $this->book_model->delete($bookid);//将图书状态改为在读
        redirect('book/manage');
    }

    /**
     * 增加图书
     */
    public function add()
    {
        $this->user_model->is_login();

        $this->load->library('form_validation');
        $this->form_validation->set_rules('bookname', 'Book\'s Name', 'required');
        $this->form_validation->set_rules('author', 'Author', 'required');
        $this->form_validation->set_rules('class', 'Class', 'required');
        $this->form_validation->set_rules('introduction', 'Introduction', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('common/header');
            $this->load->view('book/add');
        } else {
            if (!empty($_FILES['userfile']['tmp_name'])) {
                $config['upload_path'] = './source/images/books';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['file_name'] = 'book' . $this->input->post('bookid');
                $config['overwrite'] = TRUE;
                $config['max_size'] = 1000;
                $config['max_width'] = 1024;
                $config['max_height'] = 768;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('userfile')) {
                    $error = array('tip' => "图片上传出错\n" . $this->upload->display_errors());

                    $this->load->view('common/header');
                    $this->load->view('book/add', $error);
                } else {
                    
                    $image =base_url('source/images/books') . '/' . $this->upload->data('file_name');
                    $this->book_model->set_book($image);
                    $this->user_model->change_credits(50);
                    redirect('/');
                }
            }else if(!empty($this->input->post('webimage'))){
                $image = $this->input->post('webimage');
                $this->book_model->set_book($image);
                $this->user_model->change_credits(50);
                redirect('/');
            }else{
                $error = array('tip' => "请上传图片");

                $this->load->view('common/header');
                $this->load->view('book/add', $error);
            }



        }
    }

    public function drifting($id)
    {
        $this->user_model->is_login();
        $data['logs'] = $this->log_model->get_book_log($id);
        $this->load->view('common/header');
        $this->load->view("book/drifting", $data);
        $this->load->view('common/footer');
    }

    public function search()
    {
        //搜索图书
        $data['books'] = $this->book_model->search();

        //搜索用户
        $data['users'] = $this->user_model->search();

        $this->load->view('common/header');
        $this->load->view("search", $data);
        $this->load->view('common/footer');
    }
}
