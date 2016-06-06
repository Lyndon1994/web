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

    public function set_book()
    {
        $data = array(
			'userid' => $this->input->post('bookname'),
			'bookname' => $this->input->post('bookname'),
			'author' => $this->input->post('author'),
			'introduction' => $this->input->post('introduction'),
			'status' => 'on',
			'class' => $this->input->post('class'),
            'image' => $this->input->post('image')
        );

        return $this->db->insert('book', $data);
    }

    
}