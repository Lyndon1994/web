<?php 

class Book_model extends CI_Model{
    public function get_book($bookid = FALSE)
    {
        if ($bookid === FALSE)
        {
            $query = $this->db->get('book');
            return $query->result();
        }

        $sql = "select * from book where bookid=?";
        $query = $this->db->query($sql, array($bookid));
        return $query->result();
    }

    public function get_book_by_name($bookname)
    {
        if ($bookname != '') {
            $sql = "select * from book where bookname=?";
            $query = $this->db->query($sql, array($bookname));
            return $query->result();
        }
        return false;
    }

    public function get_mine(){
        $sql = "select * from book where username=?";
        $query = $this->db->query($sql, array($_SESSION['user']->username));
        return $query->result();
    }

    public function set_book($image)
    {
        $data = array(
			'username' => $_SESSION['user']->username,
			'bookname' => $this->input->post('bookname'),
			'author' => $this->input->post('author'),
			'introduction' => $this->input->post('introduction'),
			'status' => '在架上',
			'class' => $this->input->post('class'),
            'image' => $image
        );

        return $this->db->insert('book', $data);
    }

    public function reservation($id){
        $sql = "update book set status = '预约中' where bookid=?";
        $this->db->query($sql, array($id));
    }
}