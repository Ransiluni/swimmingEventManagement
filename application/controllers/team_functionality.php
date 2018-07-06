<?php

class team_functionality extends CI_Controller {
    
    public function register_team(){
        $this->load->view('register/register_team');
        if(isset($_POST['register_team'])){
            $user=$_POST['user'];
            $team=$_POST['teamid'];
            if($user==1 ){
                $this->form_validation->set_rules('teamid','TeamID','required');
                $this->form_validation->set_rules('contact_no','Contact No','required|min_length[10]|max_length[10]');
            
                if($this->form_validation->run() == TRUE){
                //echo "form validated";
                
                
                
                    $this->load->model('register_model');
                    if($this->register_model->register_team($team))
                    {
                        echo '<script language="javascript">';
                        echo 'alert("user registered")';
                        echo '</script>';
                    
                        redirect("team_functionality/register_team","refresh");
                    }else{
                
                //connect to database
                        $data = array(
                    
                        'team_id'=>$_POST['teamid'],
                        'contact_person'=>$_POST['contact_person'],
                        'contact_no'=>$_POST['contact_no'],
                    
                    
                        );
                //inserting data
                        $this->db->insert('team',$data);
                        echo '<script language="javascript">';
                        echo 'alert("Team successfully registered")';
                        echo '</script>';
                        
                        redirect("swimmer_functionality/register_swimmer/$team","refresh");
                    }
            
                }else{
                         $error=validation_errors();
                         echo '<p class="alert alert-danger"><strong>Error: </strong>'.$error.'</p>';
                }        
                         
            }else{
                $this->load->model('register_model');
                if($this->register_model->register_team($team))
                {
                
                     redirect("swimmer_functionality/register_swimmer/$team","refresh");
                
                
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("Team not registered")';
                    echo '</script>';
                    
                    redirect("team_functionality/register_team","refresh");
                }
            }
                    
        
            
        
        }
    }





}
?>