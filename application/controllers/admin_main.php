<?php

class admin_main extends CI_Controller {
    var $username;
    public function __construct( ) {
        parent::__construct();
                
                $this->load->library('session');
                $name=$this->session->userdata('uname');
                if($name==""){
                    redirect('Welcome');
                }
        
        $this->load->model('admin_model');
        
        
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'zwemmeneventmanager@gmail.com',
            'smtp_pass' => 'Zwemmen@95',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
    }
    
   
    
    public static function addEvent(){
        
        $this->load->model('admin_model');
    
        $data['query'] = $this->admin_model->admin_main(); 
        $this->load->view('organizer/addEvent',$data);
    
        
        if(isset($_POST['newevent_con'])){
            
            $gen = $_POST['gender'];
            $age_g=$_POST['agegroup'];
            $name_event=$_POST['name'];
            $this->load->model('subevent_model');
            
            if($this->subevent_model->sub_con($gen,$age_g,$name_event))
            {
                    echo '<script language="javascript">';
                    echo 'alert("subevent registered")';
                    echo '</script>';
                    
                    redirect("admin_main/addEvent","refresh");
            }else{
                $data = array(
                    
                'gender'=>$_POST['gender'],
                'age_group'=>$_POST['agegroup'],
                'name'=>$_POST['name'],
                );
                $this->db->insert('subevent',$data);
                redirect("admin_main/addEvent","refresh");
            }
        }
        
        if(isset($_POST['createEvent'])){
            $eventid = $_POST['eventid'];
            $this->load->model('admin_model');
            if($this->admin_model->register_confirm($eventid))
            {
                echo '<script language="javascript">';
                echo 'alert("event id already exists!")';
                echo '</script>';
                    
                redirect("admin_main/addEvent","refresh");
            }else{
                        //echo "form validated";
                
                //connect to database
                        $data = array(
                    
                            'event_id'=>$_POST['eventid'],
                            'date'=>$_POST['event_date'],
                            'venue'=>$_POST['venue'],
                            'user_name'=>$this->session->userdata('uname'),
                        );
                //inserting data
                        $this->db->insert('event',$data);
                        $query=$this->admin_model->email();
                        
                        $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                    <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
                                    <body>
                                    <h1>New Event Registered</h1>
                                    <p>Information <br><h3>Event name:</h3> '.$eventid.'<br><h3>Date:</h3>'.$_POST['event_date'].'<br><h3>venue:</h3>'.$_POST['venue'].'</p>
                                    <p>For more information visit the website</p>
                                    <p>Zwemmen Event Management</p>
                                    </body>
                                    </html>';
                                    
                        foreach($query as $value){
                             
                             //echo $value->email_address;
                             $this->sendEmail($message,$value->email_address);
                        }
                        
                        echo '<script language="javascript">';
                        echo 'alert("message successfully sent")';
                        echo '</script>';
                        
                        if(!empty($_POST['subevent']))
                        {
                            foreach($_POST['subevent'] as $value){
                                echo $value;
                                $data = array(
                    
                                    'event_id'=>$_POST['eventid'],
                                    'subevent_id'=>$value,
                                    
                    
                                );
                                $this->db->insert('event_subevent',$data);
                            }
                        }
                        redirect("admin_main/addEvent","refresh");
            }
                    
        
        
        
        
        }
        
        
        
        
        
    }
    public function sendEmail($message,$email){
        echo "<script>console.log( 'emails' );</script>";
        

        $this->email->from('zwemmeneventmanager@gmail.com','ZWEMMEN');
        $this->email->to($email);
        $this->email->subject('event registered');
        //$message="hello";
        $this->email->message($message);
        $this->email->send();
        
        
        
    }
    public function update(){
         //echo "<script>console.log( 'Debug Objects: " . $this->username . "' );</script>";
             $user=$this->session->userdata('uname');
             $data['event']=$this->admin_model->event($user);
            $this->load->view('organizer/update_main',$data);
    //}
        //public function updateEvent(){
            //$this->load->view('admin_update');
    
            if(isset($_POST['update_event'])){
                foreach($_POST['event'] as $value){
                               $eventid=$value;
                }
            echo "<script>console.log( 'Debug Objects: " . $eventid . "' );</script>";
            $this->load->model('admin_model');
            
            if($this->admin_model->confirm_event($eventid)){
                echo '<script language="javascript">';
                    echo 'alert("event  registered")';
                    echo '</script>';
                
                //redirect("admin_main/updateEvent/$eventid","refresh");
                //$this->load->view('organizer/update',$data);
                echo "<script>console.log( 'Debug Objects: " . $this->session->userdata('uname') . "' );</script>";
                echo "<script>console.log( 'Debug Objects: " . $this->admin_model->confirm_user($eventid) . "' );</script>";
                if($this->session->userdata('uname')==$this->admin_model->confirm_user($eventid)){
                    echo '<script language="javascript">';
                    echo 'alert("update event")';
                    echo '</script>';
                
                redirect("admin_main/updateEvent/$eventid","refresh");
                }
                else{
                    
                    echo '<script language="javascript">';
                    echo 'alert("different user. not authorized to update event")';
                    echo '</script>';
                
                }
            }else{
                echo '<script language="javascript">';
                    echo 'alert("event not registered")';
                    echo '</script>';
                    redirect("admin_main/update","refresh");
            }
            }
        
}
    public function updateEvent($eventid){
        
         
        // echo "<script>console.log( 'Date: " . $date,$venue . "' );</script>";
        $this->load->model('admin_model');
        
        $data['query1'] = $this->admin_model->admin_updatemain($eventid); 
        $data['query2'] = $this->admin_model->admin_subevent($eventid);
        $data['event']=$this->admin_model->eventDetails($eventid); 
        
        $this->load->view('organizer/update',$data);
        if(isset($_POST['updateEvent'])){
             $date=$_POST['u_eventdate'];
         $venue=$_POST['u_venue'];
            //connect to database
            if($date!="" and $venue!=""){
                 echo "<script>console.log( 'ENTERED' );</script>";
                        $data = array(
                    
                           
                            'date'=>$date,
                            'venue'=>$venue,
                            
                        );
                //updating data
                        $this->admin_model->upddata($eventid,$data);
                        
                      
        }
        else if($venue!=""){
            echo "<script>console.log( 'venue' );</script>";
                        $data = array(
                    
                           
                        
                            'venue'=>$venue
                            
                        );
                //inserting data
                        $this->admin_model->upddata($eventid,$data);
                        
        }
        else if($date!="") {
            echo "<script>console.log( 'date only' );</script>";
                        $data = array(
                    
                           
                            'date'=>$date
                            
                            
                        );
                //inserting data
                        //$this->admin_model->upddata($eventid,$data);
                    $this->admin_model->updatedata($eventid,$data);    
                       
        }
        
        
        if(!empty($_POST['subevent']))
                        {
                            //echo "<script>console.log( 'subevent' );</script>";
                            foreach($_POST['subevent'] as $value){
                                //echo $value;
                                $data = array(
                                    'event_id'=>$eventid,
                    
                                    'subevent_id'=>$value,
                                    
                    
                                );
                                $this->db->insert('event_subevent',$data);
                            }
                        }
        if(!empty($_POST['dropevent']))
                        {
                            foreach($_POST['dropevent'] as $value){
                                $subeventid=$value;
                                $data = array(
                                    'event_id'=>$eventid,
                                    'subevent_id'=>$value,
                                    
                    
                                );
                                $this->admin_model->dropsub($subeventid,$data);
                            }
                        }
        $query=$this->admin_model->email();
        $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                    <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
                                    <body>
                                    <h1>Event Updated</h1>
                                    <p>Information <br><h3>Event name:</h3> '.$eventid.'<br></p>
                                    <p>For more information visit the website</p>
                                    <p>Zwemmen Event Management</p>
                                    </body>
                                    </html>';
                                    
                        foreach($query as $value){
                             
                             //echo $value->email_address;
                             $this->sendEmail($message,$value->email_address);
                        }                
                        
        redirect("admin_main/updateEvent/$eventid","refresh");
    }
}
        public function register(){
             $this->load->model('admin_model');
             $data['swimmer']=$this->admin_model->email();
             
            $this->load->view('organizer/register_swimmer',$data);
             if(isset($_POST['register'])){
                 foreach($_POST['swimmer'] as $value){
                               $swimmer_id=$value;
                }
                 
                 $this->load->model('admin_model');
                 if( $this->admin_model->confirm_swimmer($swimmer_id)){
                     echo '<script language="javascript">';
                     echo 'alert("Swimmer registered")';
                     echo '</script>';
                     redirect("admin_main/register_swimmer/$swimmer_id","refresh");
                 }else{
                     echo '<script language="javascript">';
                     echo 'alert("Sorry, Swimmer not registered")';
                     echo '</script>';
                     redirect("admin_main/register","refresh");
                 }
    
            }
        }
        public function register_swimmer($swimmer_id){
             $this->load->model('admin_model');
              $data['registered']=$this->admin_model->registered_info($swimmer_id);
             $data['swimmer']=$this->admin_model->swimmer_info($swimmer_id);
             
                
                
            
            $data['event']=$this->admin_model->available_event();
            
            $this->load->view('organizer/register_swimmer2',$data);
            if(isset($_POST['register'])){
                
                
                foreach($_POST['eventDetail'] as $value){
                               $event=$value;
                }
                //$event=$_POST['eventDetail'];
                echo "<script>console.log( 'we rock' );</script>";
                echo "<script>console.log( 'date: " . $event. "' );</script>";
                
           // $this->load->view('organizer/register_swimmer3',$data);
                redirect("admin_main/swimmer_subevent/$swimmer_id/$event","refresh");
               // $data['subevent']=$this->admin_model->registered_info('s1235',$swimmer_id,$age,$gender);
            }
        }
        public function swimmer_subevent($swimmer_id,$event){
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
            $this->load->view('organizer/register_swimmer3',$data);
            
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
                            $query=$this->admin_model->email_swimmer($swimmer_id);
                            $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                                        <html xmlns="http://www.w3.org/1999/xhtml">
                                                        <head>
                                                        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
                                                        <body>
                                                        <h1>New registration</h1>
                                                        <p>You have been registered to an new event in <h3>Event name:</h3> '.$event.'<br></p>
                                                        <p>For more information visit the website</p>
                                                        <p>Zwemmen Event Management</p>
                                                        </body>
                                                        </html>';
                                                        
                            echo "<script>console.log( 'Debug Objects: " . $query . "' );</script>";
                            $this->sendEmail($message,$query); 
                            redirect("admin_main/register_swimmer/$swimmer_id","refresh");
                        }
              
            
                         
            }
        }
        public function searchEvent(){
            $user=$this->session->userdata('uname');
            $data['event']=$this->admin_model->event($user);
            $this->load->view('organizer/search',$data);
            if(isset($_POST['search'])){
                foreach($_POST['event'] as $value){
                               $eventid=$value;
                }
                echo "<script>console.log( 'Debug Objects: " . $eventid . "' );</script>";
                
                
                if($this->admin_model->confirm_event($eventid)){
                    echo '<script language="javascript">';
                        echo 'alert("event exists ")';
                        echo '</script>';
                    
                    //redirect("admin_main/updateEvent/$eventid","refresh");
                    //$this->load->view('organizer/update',$data);
                    echo "<script>console.log( 'Debug Objects: " . $this->session->userdata('uname') . "' );</script>";
                    echo "<script>console.log( 'Debug Objects: " . $this->admin_model->confirm_user($eventid) . "' );</script>";
                    
                        echo '<script language="javascript">';
                        echo 'alert("you are the organizer :)")';
                        echo '</script>';
                        
                        redirect("admin_main/eventInfo/$eventid","refresh");
                
                    
                }
            }
            
        }
        public function eventInfo($eventid){
             $data['search']=$this->admin_model->search($eventid);
             $data['event']=$this->admin_model->eventDetails($eventid);
             $this->load->view('organizer/search2',$data);
            
        }
        public function timingDetail(){
            $user=$this->session->userdata('uname');
             $data['event_today']=$this->admin_model->eventToday($user);
            $this->load->view('organizer/timing',$data);
    //}
        //public function updateEvent(){
            //$this->load->view('admin_update');
    
            if(isset($_POST['event_today'])){
                foreach($_POST['event'] as $value){
                               $eventid=$value;
                }
                redirect("admin_main/setTiming/$eventid","refresh");
                
            
            }
        }
        public function setTiming($event_id){
            //$data['event_today']=$this->admin_model->timingEnter($event_id);
            $data['query'] = $this->admin_model->admin_subevent($event_id);
            $this->load->view('organizer/timingEnter',$data);
            
            if(isset($_POST['search'])){
                
                       foreach($_POST['subevent'] as $value){
                               $subeventid=$value;
                        }       
                               redirect("admin_main/setTimingFinal/$event_id/$subeventid","refresh");
                
            }
        }
        public function setTimingFinal($event_id,$sub_id){
            
            $data['event_today']=$this->admin_model->timingEnter($event_id,$sub_id);
            $this->load->view('organizer/timingFinal',$data);
            //print_r($data['event_today'][0]->user_name);
            //$result = json_decode($data['event_today'][0], true);
            //print_r($result);
            $count=0;
            $name=array();
             foreach($data['event_today'] as $value=>$data){
                 //print_r($data->user_name);
                 
                 $count=$value;
                 $name[$count]=$data->user_name;
                 $subevent=$data->name;
                 $agegroup=$data->age_group;
                 $gender=$data->gender;
                               
            } 
            //print_r ($subevent);
            
            if(isset($_POST['enterTime'])){
                
                for($ncount=0;$ncount<($count+1);$ncount++){
                    $data1 = array(
                                    'event_id'=>$event_id,
                                    'subevent_id'=>$sub_id,
                                    'user_name'=>$name[$ncount],
                                    'timing'=>$_POST[$ncount]
                                    
                    
                                );
                                //print_r($data1);
                                $this->admin_model->addTiming($event_id,$sub_id,$name[$ncount],$data1);
                                
                }  

                redirect("admin_main/setTimingFinal/$event_id/$sub_id","refresh");  

                
            } 
            if(isset($_POST['finalize'])){
                $nameList=$this->admin_model->selectWinner($event_id,$sub_id);
                //print_r($nameList);
                $x=1;
                $msg="";
                foreach ($nameList as $name=>$val){
                    //print( $val->user_name);
                    $dt=array('place'=>$x);
                    $this->admin_model->position($event_id,$sub_id,$val->user_name,$dt);
                    $msg.=$x.' '.$val->user_name.'<br>';
                    $x++;
                }

                 //print ($msg);                                   
                $user=$this->session->userdata('uname');
                $email=$this->admin_model->emailOrg($user);
                      
                        $message='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                    <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
                                    <body>
                                    <h1>'.$event_id.' results of '.$subevent.' '.$agegroup.' '.$gender.'</h1>
                                    <p>'.$msg.'</p>
                                    
                                    
                                    <p>Zwemmen Event Management</p>
                                    </body>
                                    </html>';
                           //print $message;         
                         $this->sendEmail($message,$email);
                        
                redirect("admin_main/setTiming/$event_id","refresh");;                
            }  

                //redirect("admin_main/setTimingFinal/$event_id/$sub_id","refresh");     

                
            } 
            
            public function logout()
            {
                
                //$this->session->set_userdata('logged');
                $this->session->sess_destroy();
                redirect('Welcome');
            }
   
            
        
        
        
}

?>