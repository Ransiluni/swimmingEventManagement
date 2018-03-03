<?php

class functionality extends CI_Controller {
    
    
    public function register(){
        //validation
        if(document.getElementById('1').checked){
        if(isset($_POST['register'])){
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('password','Password','required|min_length[8]');
            
            
            if($this->form_validation->run() == TRUE){
                echo "form validated";
                
                //connect to database
                $data = array(
                    
                    'user_name'=>$_POST['username'],
                    'email_address'=>$_POST['email'],
                    'password'=>$_POST['password'],
                    
                );
                //inserting data
                $this->db->insert('organizer',$data);
                $this->session->set_flashdata("success","Account Registered");
                redirect("functionality/register","refresh");
            }
        }else{
        }if(isset($_POST['register_swimmer'])){
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('password','Password','required|min_length[8]');
            $this->form_validation->set_rules('date_of_birth','Date_of_birth','required');
            $this->form_validation->set_rules('gender','gender','required');
            //$this->form_validation->set_rules('email','Email','required');
            
            
            if($this->form_validation->run() == TRUE){
                echo "form validated";
                
                //connect to database
                $data = array(
                    
                    'user_name'=>$_POST['username'],
                    'email_address'=>$_POST['email'],
                    'password'=>$_POST['password'],
                    'date_of_birth'=>$_POST['date_of_birth'],
                    'gender'=>$_POST['gender'],
                    'team_id'=>$_POST['team_id'],
                    
                );
                //inserting data
                $this->db->insert('swimmer',$data);
                $this->session->set_flashdata("success","Account Registered");
                redirect("functionality/register","refresh");
            }
        }
        }
     
    
    $this->load->view('register_main');
    }


}
?>