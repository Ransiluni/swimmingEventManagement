<?php

    class subevent_model extends CI_Model{

        public function sub_con($gender,$age,$name){
            
            $this->db->select('gender');
            $this->db->select('age_group');
            $this->db->select('name');
            
            
            $this->db->where('gender',$gender);
            $this->db->where('age_group',$age);
            $this->db->where('name',$name);
          
            
            $this->db->from('subevent');
            $query = $this->db->get();
            if($query->num_rows() ==1){
                return true;
            }else{
                return false;
            }
        }
        
        
        
        
    }
?>