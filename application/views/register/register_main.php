<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/regcss.css') ?>" />
<link href="<?php echo base_url('assets/css/form_style.css') ?>" rel="stylesheet">



</head> 
<body> 

<?php if (isset($_SESSION["success"])){ ?>
    <div class="alert alert-success"><?php echo $_SESSION["success"]; ?></div>
<?php
} ?>

<?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>

<div class="user"   >
    <header class="user__header">
        
        <h1 class="user__title">REGISTRATION</h1>
        <br>
    </header>
    
     <form class="form" action = "" method="POST">
        <div class="form__group" style="text-align:center;">
        <table align="center">
            <tr>
                <td id="radio">
                    <input type="radio" name="user" value="1"><lable>Organizer</label>
                </td>
            </tr>
            <tr>
                <td id="radio">
                    <input type="radio" name="user" value="0"><lable>Swimmer(without team)</label>
                </td>
            </tr>
            <tr>
                <td id="radio">
                    <input type="radio" name="user" value="2"><lable>Swimmer(with team)</label>
                </td>
                
             
            </tr>
        </table>
        </div>
        
        <button class="btn"  name="register_main" >Register</button>
    </form>
</div>
</body>
</html>