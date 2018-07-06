<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/regcss.css') ?>" />


</head> 

<link href="<?php echo base_url('assets/css/validation.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/form_style.css') ?>" rel="stylesheet">



<body> 


<div class="user">
    <header class="user__header">
        
        <h1 class="user__title">REGISTRATION</h1>
        <br>
    </header>
    
     <form class="form" action = "" method="POST">
        <div class="form__group">
            <input type="text"  name="username" id="username" placeholder="Username" class="form__input"required/>
            
        </div>
        
        <div class="form__group">
            <input type="email" name="email" id="email" placeholder="Email" class="form__input" required />
        </div>
        
        <div class="form__group">
            <input pattern=".{8,}"   title="8 characters minimum" type="password" name="password" id="password" placeholder="Password" class="form__input" REQUIRED />
            <?php if (isset($_SESSION["success"])){ ?>
                    <div class="alert alert-success"><?php echo $_SESSION["success"]; ?></div>
            <?php
            } ?>
            <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
        </div>
        
        <button class="btn btn-success" name="register" >Register</button>
        
        
    </form>
</div>
</body>
</html>
