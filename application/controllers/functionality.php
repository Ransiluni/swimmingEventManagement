<?php

class functionality extends CI_Controller {
    
    
    public function register(){
        $this->load->view('register/register_main');
        
        if(isset($_POST['user'])){
            $user=$_POST['user'];
            if($user==1 ){
                redirect("organizer_functionality/register_organizer","refresh");
            }else if($user==0 ){
                
                redirect("swimmer_functionality/register_swimmer/0","refresh");
            }else{
                redirect("team_functionality/register_team","refresh");
                
            }


        }
    }
}
?>