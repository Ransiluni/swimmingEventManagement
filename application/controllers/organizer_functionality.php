<?php

class organizer_functionality extends CI_Controller {
    
    public function register_organizer(){
        $this->load->view('register/register');
        if(isset($_POST['register'])){
            $this->load->library('form_validation');
                $this->form_validation->set_rules('username','Username','required');
                $this->form_validation->set_rules('email','Email','required');
                $this->form_validation->set_rules('password','Password','required|min_length[8]');
            
            
                    if($this->form_validation->run() == TRUE){
                        $username = $_POST['username'];
                        $this->load->model('register_model');
                            if($this->register_model->register_organizer($username))
                        {
                            echo '<script language="javascript">';
                            echo 'alert("user registered")';
                            echo '</script>';
                    
                            redirect("login/login_organizer","refresh");
                        }else{
                        //echo "form validated";
                        
                       $password=md5($_POST['password']);
                       //print $password;
                
                //connect to database
                        $data = array(
                    
                            'user_name'=>$_POST['username'],
                            'email_address'=>$_POST['email'],
                            'password'=>$password,
                    
                        );
                //inserting data
                        $this->db->insert('organizer',$data);
                        echo '<script language="javascript">';
                        echo 'alert("message successfully sent")';
                        echo '</script>';
                        redirect("login/login_organizer","refresh");
                    }
                    }else{
                         $error=validation_errors();
                         echo '<p class="alert alert-danger"><strong>Error: </strong>'.$error.'</p>';
                         
                         
                    }
        
        
        
        
    }





}
}
?>