<?php

class swimmer_main extends CI_Controller {
    
    public function __construct( ) {
        parent::__construct();
        $this->load->library('session');
                $name=$this->session->userdata('sname');
                if($name==""){
                    redirect('Welcome');
                }
    }
    
    
        public function registerEvent(){
            $swimmer_id=$this->session->userdata('sname');
            $this->load->model('admin_model');
            $data['registered']=$this->admin_model->registered_info($swimmer_id);
            $data['swimmer']=$this->admin_model->swimmer_info($swimmer_id);
            $data['event']=$this->admin_model->available_event();
            
            $this->load->view('swimmer/registerEvent',$data);
            
            if(isset($_POST['register'])){
                
                
                foreach($_POST['eventDetail'] as $value){
                               $event=$value;
                }
                //$event=$_POST['eventDetail'];
                echo "<script>console.log( 'we rock' );</script>";
                echo "<script>console.log( 'date: " . $event. "' );</script>";
                
           // $this->load->view('organizer/register_swimmer3',$data);
                redirect("swimmer_main/registerSubevent/$swimmer_id/$event","refresh");
               // $data['subevent']=$this->admin_model->registered_info('s1235',$swimmer_id,$age,$gender);
            }
        }
        public function registerSubevent($swimmer_id,$event){
             echo "<script>console.log( 'we rock' );</script>";
             $this->load->model('admin_model');
             
             $from = new DateTime( $this->admin_model->date($swimmer_id));
             $to = new DateTime('today');
                
                
                //echo "<script>console.log( 'date: " . $from,$to. "' );</script>";
                $age = $from->diff($to)->y;
                if($age%3==0){
                   $age=$age; 
                }else{
                    $age=($age+(3-$age%3));
                }
                $age="under".$age;
                $gender=$this->admin_model->gender($swimmer_id);
                echo "<script>console.log( 'date: " . $age. "' );</script>";
            $data['event']=$this->admin_model->eventDetails($event);
            $data['subevent']=$this->admin_model->register_subevent($event,$swimmer_id,$age,$gender);
            $data['drop']=$this->admin_model->registered_subinfo($swimmer_id,$event);
            $this->load->view('swimmer/registerSubevent',$data);
            
            if(isset($_POST['register_subevent'])){
                 
                 if(!empty($_POST['eventDetail']))
                        {
                            //echo "<script>console.log( 'subevent' );</script>";
                            foreach($_POST['eventDetail'] as $value){
                                //echo $value;
                                $data = array(
                                    'event_id'=>$event,
                    
                                    'subevent_id'=>$value,
                                    'user_name'=>$swimmer_id
                                    
                    
                                );
                                $this->db->insert('swimmer_event',$data);
                                
                            }
                        }
                            if(!empty($_POST['dropDetail']))
                        {
                            echo "<script>console.log( 'subevent' );</script>";
                            foreach($_POST['dropDetail'] as $value){
                                //echo $value;
                                $data = array(
                                    'event_id'=>$event,
                    
                                    'subevent_id'=>$value,
                                    'user_name'=>$swimmer_id
                                    
                    
                                );
                                $this->db->query("delete from swimmer_event where event_id='$event' and subevent_id='$value' and user_name='$swimmer_id';");
                                echo "<script>console.log( 'deleted' );</script>";
                            }
                            
                        }
                        redirect("swimmer_main/registerEvent","refresh");
            }
        }
        
        public function search(){
            
            $swimmer_id=$this->session->userdata('sname');
            
            $this->load->model('admin_model');
            $data['upcoming']=$this->admin_model->event_upcoming($swimmer_id);
            $data['finished']=$this->admin_model->event_finished($swimmer_id);
            
            $this->load->view('swimmer/search_swimmer',$data);
            if(isset($_POST['search'])){
                $eventid = $_POST['event_id'];
                echo '<script language="javascript">';
                        echo 'alert("event exists ")';
                        echo '</script>';
                echo "<script>console.log( 'Debug Objects: " . $eventid . "' );</script>";
                
                if($this->admin_model->confirm_event($eventid)){
                        echo '<script language="javascript">';
                        echo 'alert("event exists ")';
                        echo '</script>';
                        redirect("swimmer_main/searchDetail/$swimmer_id/$eventid","refresh");
                }else{
                    echo '<script language="javascript">';
                        echo 'alert("event  not exist ")';
                        echo '</script>';
                }
            }
            
        }
        public function searchDetail($swimmer_id,$eventid){
            
            $this->load->model('admin_model');
            $data['eventInfo']=$this->admin_model->swimmer_eventSearch($swimmer_id,$eventid);
            $data['event']=$this->admin_model->eventDetails($eventid);
            
            $this->load->view('swimmer/searchDetail',$data);
            
        }
        public function logout()
            {
                
                //$this->session->set_userdata('logged');
                $this->session->sess_destroy();
                redirect('Welcome');
            }
        
        
}

?>