<?php 

class Comments_model extends CI_Model{
    
    public function get_comments($bookid)
    {
        $sql = "select * from comments where bookid=? ORDER BY time DESC limit 5;";
        $query = $this->db->query($sql, array($bookid));
        return $query->result();
    }
    
    public function set_comments()
    {
        $data = array(
			'bookid' => $this->input->post('bookid'),
			'username' => $_SESSION['user']->username,
			'content' => $this->input->post('content')
        );
        
        return $this->db->insert('comments', $data);
    }
}