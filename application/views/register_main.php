<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register page</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/regcss.css') ?>" />


</head> 
<body> 

<?php if (isset($_SESSION["success"])){ ?>
    <div class="alert alert-success"><?php echo $_SESSION["success"]; ?></div>
<?php
} ?>

<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>

<div class="user"   >
    <header class="user__header">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3219/logo.svg" alt="" />
        <h1 class="user__title">Zwemmen Event Management REGISTRATION</h1>
        <br>
    </header>
    
     <form class="form" >
        <div class="form__group" style="text-align:center;">
             <input type="radio" name="gender" value="1" checked><lable>Organizer</label><br>
             <input type="radio" name="gender" value="0"><lable>Swimmer</label><br>
        </div>
        
        <button class="btn"  name="register_main" >Register</button>
    </form>
</div>
</body>
</html>