<?php 
class login extends CI_Controller{
    
    public function __construct( ) {
        parent::__construct();
        $this->load->library('session');
        $name=$this->session->userdata('uname');
                if($name!=""){
                    redirect('Welcome');
                }
        
    }
    public function login_main(){
        $this->load->view('login/login_main');
        if(isset($_POST['user'])){
            $user=$_POST['user'];
            if($user==1 ){
                redirect("login/login_organizer","refresh");
            }else{
                redirect("login/login_swimmer","refresh");
                
            }


        }
    }
    
    public function login_swimmer(){
        $this->load->view('login/login');
        
        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password=md5($_POST['password']);
            $this->load->model('login_model');
            if($this->login_model->login_swimmer($username,$password))
            {
                    echo '<script language="javascript">';
                    echo 'alert("login successful")';
                    echo '</script>';
                    //$this->session->set_userdata('logged','yes');
                    $this->session->set_userdata('sname', $username);
                    redirect("swimmer_main/registerEvent","refresh");
            }else{
                        echo '<script language="javascript">';
                        echo 'alert("login details not valid check and retry!")';
                        echo '</script>';
                        redirect("login/login_swimmer","refresh");
            }
        }
                
                
    }
    public function login_organizer(){
        $this->load->view('login/login');
        
        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password=md5($_POST['password']);
            
            
            $this->load->model('login_model');
            if($this->login_model->login_organizer($username,$password))
            {
                    
                    echo '<script language="javascript">';
                    echo 'alert("login successful")';
                    echo '</script>';
                    $this->session->set_userdata('uname', $username);
                    redirect("admin_main/addEvent","refresh");
                    
                    
            }else{
                        echo '<script language="javascript">';
                        echo 'alert("login details not valid check and retry!")';
                        echo '</script>';
                        redirect("login/login_organizer","refresh");
            }
        }
                
                
    }
}






 ?>