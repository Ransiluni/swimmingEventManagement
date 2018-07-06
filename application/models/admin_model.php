<?php

    class admin_model extends CI_Model{

        public function admin_main(){
            $this->db->select('subevent_id');
            $this->db->select('gender');
            $this->db->select('age_group');
            $this->db->select('name');
            $this->db->from('subevent');
            $query = $this->db->get();
            return $query-> result();
        }
        public function event($user){
            $this->db->select('event_id');
            
            $this->db->from('event');
            $this->db->where('user_name',$user);
            $query = $this->db->get();
            return $query-> result();
        }
        public function eventToday($user){
            
            
            $query = $this->db->query("select event_id from event 
            where date = CURDATE() and user_name='$user' ");
            
            return $query-> result();
        }
        
        public function eventDetails($eventId){
            $this->db->select('*');
            $this->db->from('event');
            $this->db->where('event_id',$eventId);
            $query = $this->db->get();
            return $query-> result();
            
        }
        public function register_confirm($eventid){
            
            $this->db->select('event_id');
            $this->db->where('event_id',$eventid);
            $this->db->from('event');
            $query = $this->db->get();
            if($query->num_rows() ==1){
                return true;
            }else{
                return false;
            }
        }
        public function admin_updatemain($eventId){
            $query = $this->db->query("select subevent_id,gender,age_group,name from 
            subevent where subevent_id not in (SELECT subevent_id 
            from event natural join event_subevent where event_id='$eventId')");
            return $query-> result();
        }
        public function confirm_event($eventId){
            $this->db->select('event_id');
            $this->db->where('event_id',$eventId);
            $this->db->from('event');
            $query = $this->db->get();
            if($query->num_rows() ==1){
                return true;
            }else{
                return false;
            }
            
        }
        public function confirm_user($eventId){
            $this->db->select('user_name');
            $this->db->from('event');
            $this->db->where('event_id',$eventId);
            $query = $this->db->get();
            $result = $query->row();
            return $result->user_name;
            
        }
        public function confirm_swimmer($swimmerId){
            $this->db->select('user_name');
            $this->db->where('user_name',$swimmerId);
            $this->db->from('swimmer');
            $query = $this->db->get();
            if($query->num_rows() ==1){
                return true;
            }else{
                return false;
            }
            
        }
        public function swimmer_info($swimmerId){
            $this->db->select('user_name');
            $this->db->select('gender');
            $this->db->select('date_of_birth');
            $this->db->select('team_id');
            $this->db->where('user_name',$swimmerId);
            $this->db->from('swimmer');
            $query = $this->db->get();
            return $query-> result();
        }
         public function date($swimmerId){
            $this->db->select('date_of_birth');
            $this->db->from('swimmer');
            $this->db->where('user_name',$swimmerId);
            $query = $this->db->get();
            $result = $query->row();
            return $result->date_of_birth;
            
        }
        public function gender($swimmerId){
            $this->db->select('gender');
            $this->db->from('swimmer');
            $this->db->where('user_name',$swimmerId);
            $query = $this->db->get();
            $result = $query->row();
            return $result->gender;
            
        }
        public function email(){
            $this->db->select('user_name');
            $this->db->select('email_address');
            $this->db->from('swimmer');
            
            $query = $this->db->get();
            
            return $query-> result();
            
        }
        public function email_swimmer($swimmerId){
            $this->db->select('email_address');
            $this->db->from('swimmer');
            $this->db->where('user_name',$swimmerId);
            $query = $this->db->get();
            $result = $query->row();
            return $result->email_address;
            
        }
        
        public function admin_subevent($eventId){
            $query = $this->db->query("select subevent_id,gender,age_group,name from subevent 
            right outer join event_subevent using (subevent_id) where 
            event_id='$eventId'");
            return $query-> result();
            
        }
        public function updatedata($eventid,$data) {
            echo "<script>console.log( 'Entered " . $eventid . "' );</script>";
            $this->db->where('event_id', $eventid);
            $this->db->update('event', $data);
            
}
        public function dropsub($subevent_id,$data) {
                    //echo "<script>console.log( 'Entered " . $eventid . "' );</script>";
                    $this->db->where('subevent_id', $subevent_id);
                    $this->db->delete('event_subevent',$data);
                    
        }
        
        public function available_event(){
            $query = $this->db->query("select event_id,date,venue from event 
            where date > CURRENT_TIMESTAMP");
            return $query-> result();
        }
        public function registered_info($swimmerId){
            $query = $this->db->query("select event_id,name,age_group,gender from (select subevent_id,event_id,s.user_name from (select subevent_id,event_id,date from
            event left outer join event_subevent  using (event_id)
            where date > CURRENT_TIMESTAMP) as a left outer join swimmer_event as s using (event_id,subevent_id)) as b
            left outer join subevent using (subevent_id) where b.user_name='$swimmerId';");
            return $query->result();
        }
        public function registered_subinfo($swimmerId,$event){
            $query = $this->db->query("select subevent_id,name,age_group,gender from (select subevent_id,event_id,s.user_name from (select subevent_id,event_id,date from
            event left outer join event_subevent  using (event_id)
            where date > CURRENT_TIMESTAMP) as a left outer join swimmer_event as s using (event_id,subevent_id)) as b
            left outer join subevent using (subevent_id) where b.user_name='$swimmerId' and event_id='$event';");
            return $query->result();
        }
        public function register_subevent($event,$swimmer_id,$age,$gender){
            $query = $this->db->query("SELECT subevent_id,gender,age_group,name
            FROM event_subevent join subevent using (subevent_id)
            where event_id='$event' and gender='$gender' and 
            age_group='$age'and subevent_id not in (SELECT subevent_id FROM swimmer_event
            where user_name='$swimmer_id' and event_id='$event');");
            return $query->result();
        }
        public function search($event){
            $query = $this->db->query("SELECT subevent_id,name,age_group,gender,user_name 
            FROM (select event_id,subevent_id,name,age_group,gender 
            from event_subevent left outer join subevent using (subevent_id) ) as s 
            left outer join swimmer_event using (subevent_id,event_id) where event_id='$event';");
            return $query->result();
        }
        public function event_finished($swimmer_id){
            $query = $this->db->query("select event_id,subevent_id,name,age_group,gender,timing,place from 
            (select subevent_id,event_id,s.user_name,timing,place from (select subevent_id,event_id,date from
            event left outer join event_subevent  using (event_id)
            where date < CURRENT_TIMESTAMP) as a left outer join swimmer_event as s using (event_id,subevent_id)) as b
            left outer join subevent using (subevent_id) where b.user_name='$swimmer_id';");
            return $query->result();
        }
        public function event_upcoming($swimmer_id){
            $query = $this->db->query("select event_id,subevent_id,name,age_group,gender,date,venue from 
            (select subevent_id,event_id,date,venue,s.user_name from (select subevent_id,event_id,date,venue from
            event left outer join event_subevent  using (event_id)
            where date > CURRENT_TIMESTAMP) as a left outer join swimmer_event as s using (event_id,subevent_id)) as b
            left outer join subevent using (subevent_id) where b.user_name='$swimmer_id';");
            return $query->result();
        }
         public function swimmer_eventSearch($swimmer_id,$event){
            $query = $this->db->query("select event_id,subevent_id,name,age_group,gender from 
            (select subevent_id,event_id,s.user_name from (select subevent_id,event_id,date from
            event left outer join event_subevent  using (event_id)) as a left outer join swimmer_event as s using (event_id,subevent_id)) as b
            left outer join subevent using (subevent_id) where b.user_name='$swimmer_id' and b.event_id='$event';");
            return $query->result();
        }
        public function timingEnter($event_id,$subid){
            $query = $this->db->query("select event_id,subevent_id,name,age_group,gender,b.user_name,timing from 
            (select subevent_id,event_id,s.user_name,timing from (select subevent_id,event_id from
            event left outer join event_subevent  using (event_id)
            where event_id='$event_id' and subevent_id='$subid') as a left outer join swimmer_event as s using (event_id,subevent_id) where s.user_name IS NOT NULL) as b
            left outer join subevent using (subevent_id) ;");
            return $query->result();
        }
        public function addTiming($event_id,$sub_id,$name,$data) {
            
            $this->db->where('event_id', $event_id);
            $this->db->where('subevent_id', $sub_id);
            $this->db->where('user_name',$name);
            $this->db->update('swimmer_event', $data);
            
        }
        public function selectWinner($event_id,$subid){
            $query = $this->db->query("SELECT user_name FROM swimmer_event where 
                        event_id='$event_id' and subevent_id='$subid' order by timing ;");
            return $query->result();
        }
        public function emailOrg($userId){
            $this->db->select('email_address');
            $this->db->from('organizer');
            $this->db->where('user_name',$userId);
            $query = $this->db->get();
            $result = $query->row();
            return $result->email_address;
            
        }
        public function position($event_id,$sub_id,$name,$x) {
            
            $this->db->where('event_id', $event_id);
            $this->db->where('subevent_id', $sub_id);
            $this->db->where('user_name',$name);
            $this->db->update('swimmer_event',$x);
            
        }
        
        
        
        
    }
?>