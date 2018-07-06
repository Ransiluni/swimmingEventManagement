<?php

    class login_model extends CI_Model{
        var $name;

        public function login_swimmer($username,$password){
            $this->db->select('user_name','password');
            $this->db->where('user_name',$username);
            $this->db->where('password',$password);
            $this->db->from('swimmer');
            $query = $this->db->get();
            if($query->num_rows() ==1){
                return true;
            }else{
                return false;
            }
            
        }
        public function login_organizer($username,$password){
            $this->name=$username;
            $this->db->select('user_name','password');
            $this->db->where('user_name',$username);
            $this->db->where('password',$password);
            $this->db->from('organizer');
            $query = $this->db->get();
            if($query->num_rows() ==1){
                return true;
            }else{
                return false;
            }
            
        }
        public function getname(){
            return $this->name;
        }
        
        
    }
?>