<?php 

class Log_model extends CI_Model{
    
    public function get_log($username)
    {
        $sql = "select log.bookid bookid,bookname,begintime,endtime,log.status status from log, book where log.username=? and log.bookid = book.bookid";
        $query = $this->db->query($sql, array($username));
        return $query->result();
    }

    public function get_book_log($bookid)
    {
        $sql = "select log.username username, log.bookid bookid,bookname,begintime,endtime,log.status status from log, book where log.bookid=? and log.bookid = book.bookid";
        $query = $this->db->query($sql, array($bookid));
        return $query->result();
    }

    
    public function set_log($bookid)
    {
        $data = array(
			'bookid' => $bookid,
			'username' => $_SESSION['user']->username,
			'begintime' => date("Y-m-d"),
            'status' =>'预约中'
        );
        
        return $this->db->insert('log', $data);
    }
}