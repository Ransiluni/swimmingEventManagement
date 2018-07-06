<?php

    class register_model extends CI_Model{

        public function register_swimmer($username){
            $this->db->select('user_name');
            $this->db->where('user_name',$username);
            $this->db->from('swimmer');
            $query = $this->db->get();
            if($query->num_rows() ==1){
                return true;
            }else{
                return false;
            }
            
        }
        public function register_organizer($username){
            $this->db->select('user_name');
            $this->db->where('user_name',$username);
            $this->db->from('organizer');
            $query = $this->db->get();
            if($query->num_rows() ==1){
                return true;
            }else{
                return false;
            }
            
        }
        public function register_team($tid){
                $this->db->where('team_id',$tid);
                $this->db->from('team');
                $query = $this->db->get();
                if($query->num_rows() ==1)
                {
                    return true;
                }else{
                    return false;
                }
        }
    }
?>