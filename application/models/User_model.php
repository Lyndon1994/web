<?php 

class User_model extends CI_Model{
    public function get_all_user(){
        $query = $this->db->get('user');
        return $query->result();
    }
    
    public function get_user($name = FALSE,$password= FALSE)
    {
        if ($name === FALSE||$password === FALSE)
        {
            return null;
        }
        $sql = "select * from user where username=? AND password = ?";
        $query = $this->db->query($sql, array($name,$password));
        return $query->result();
    }
    

    public function get_user_by_id($userid)
    {
        if ($userid != '') {
            $sql = "select * from user where userid=?";
            $query = $this->db->query($sql, array($userid));
            return $query->result();
        }
        return false;
    }

    public function set_user()
    {
        $data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'role' => 'user',
			'credits' => 0
        );
        
        return $this->db->insert('user', $data);
    }

    public function set_manager($name)
    {
    	if ($name!='') {
    		$sql = "update user set role = 'manager' where username = ?";
        	$this->db->query($sql, array($name));
            if($this->db->affected_rows()>0){
                return true;
            }
    	}
        return false;
    }
}