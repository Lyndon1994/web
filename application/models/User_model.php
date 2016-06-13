<?php

class User_model extends CI_Model
{

    public function is_login(){
        if (!isset($_SESSION['user'])){
            $data['tip'] = '请先登陆';
            redirect('user/login',$data);
        }
    }
    public function is_manager(){
        if (!isset($_SESSION['user'])&&$_SESSION['user']->role=='admin'){
            $data['tip'] = '您不是管理员！';
            redirect('user/login',$data);
        }
    }
    
    public function get_all_user()
    {
        $query = $this->db->get('user');
        return $query->result();
    }

    public function get_user($name = FALSE, $password = FALSE)
    {
        if ($name === FALSE || $password === FALSE) {
            return null;
        }
        $sql = "select * from user where username=? AND password = ?";
        $query = $this->db->query($sql, array($name, $password));
        return $query->result();
    }


    public function get_user_by_username($username)
    {
        $sql = "select * from user where username=?";
        $query = $this->db->query($sql, array($username));
        if($query->num_rows()>0)
            return $query->unbuffered_row();
        return FALSE;
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
        if ($name != '') {
            $sql = "update user set role = 'manager' where username = ?";
            $this->db->query($sql, array($name));
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
        return false;
    }
    
    public function change_credits($credit, $username =FALSE){
        if ($username === FALSE) {
            $username=$_SESSION['user']->username;
        }
        $sql = "update user set credits = credits + ? where username = ?";
        $this->db->query($sql,array($credit, $username));
    }
    
    public function search(){
        $key = $this->input->post('key');
        $sql = "select * from user WHERE username LIKE '%' '".$key."' '%' OR address LIKE '%' '".$key."' '%' OR phone LIKE '%' '".$key."' '%' OR role LIKE '%' '".$key."' '%'";
        return $this->db->query($sql)->result();
    }
}