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
            'status' =>'预约中'
        );
        
        return $this->db->insert('log', $data);
    }

    public function update_log($bookid){
        //修改上一个读者的log
        $sql = "UPDATE log SET endtime = ? , status = '读完' WHERE bookid = ? AND username = ? AND status = '在读'";
        $owner = $this->db->query("SELECT owner FROM book WHERE bookid = ".$bookid)->result();
        $this->db->query($sql, array(date('Y-m-d'),$bookid,$owner[0]->owner));

        //修改此读者log
        $sql = "UPDATE log SET begintime = ? , status = '在读' WHERE bookid = ? AND username = ? AND status = '预约中'";
        $this->db->query($sql, array(date('Y-m-d'),$bookid,$_SESSION['user']->username));
    }
}