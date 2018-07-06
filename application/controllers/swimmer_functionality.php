<?php

class swimmer_functionality extends CI_Controller {
    
    public function register_swimmer($id){
        $this->load->view('register/register_swimmer');
        if(isset($_POST['register_swimmer'])){
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('password','Password','required|min_length[8]');
            
            if($this->form_validation->run() == TRUE){
                $username = $_POST['username'];$this->load->model('register_model');
                if($this->register_model->register_swimmer($username))
                {
                    echo '<script language="javascript">';
                    echo 'alert("user registered")';
                    echo '</script>';
                    
                    redirect("swimmer_functionality/register_swimmer/$id","refresh");
                }else{
                //echo "form validated";
                
                $password=md5($_POST['password']);
                //connect to database
                        $data = array(
                    
                            'user_name'=>$_POST['username'],
                            'email_address'=>$_POST['email'],
                            'password'=>$password,
                            'date_of_birth'=>$_POST['date_of_birth'],
                            'gender'=>$_POST['gender'],
                            'team_id'=>$id,
                    
                        );
                        //inserting data
                        $this->db->insert('swimmer',$data);
                        echo '<script language="javascript">';
                        echo 'alert("Account successfully registered")';
                        echo '</script>';
                        redirect("login/login_swimmer","refresh");
                }
                    
                
            }
        
        
        
        }
    





}
}
?>