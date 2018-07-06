<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/regcss.css') ?>" />
<link href="<?php echo base_url('assets/css/validation.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/form_style.css') ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/js/jQuery.js') ?>"></script>
<script>
$(document).ready(function()  {
        // First add disabled properties to inputs
        $("input:text").prop('disabled', true);

        // Yes Input
        $("#user0").on("click", function () {
            $("#teamid").prop('disabled', false);
            $("#contact_person").prop('disabled', true);
            $("#contact_no").prop('disabled', true);
        });

        // No Input
        $("#user1").on("click", function () {
            $("#teamid").prop('disabled', false);
            $("#contact_person").prop('disabled', false);
            $("#contact_no").prop('disabled', false);
        });
    });

</script>

</head> 
<body> 




<div class="user">
    <header class="user__header">
        
        <h1 class="user__title">REGISTRATION</h1>
        <br>
    </header>
    
     <form class="form" action = "" method="POST">
         <table align="center">
            <tr>
                <td>
                    <input type="radio" name="user" value="1" id="user1"><lable>Register new team</label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="radio" name="user" value="0" id="user0"><lable>Add to existing team</label>
                </td>
            </tr>
            
        </table>
     
        <div class="form__group">
            <input type="text"  name="teamid" id="teamid" placeholder="TeamID" class="form__input" required/>
            
        </div>
        
        <div class="form__group">
            <input type="text" name="contact_person" id="contact_person" placeholder="ContactPerson" class="form__input" required />
        </div>
        
        <div class="form__group">
            <input type="text" name="contact_no" id="contact_no" placeholder="ContactNo" class="form__input" REQUIRED />
            <?php if (isset($_SESSION["success"])){ ?>
                    <div class="alert alert-success"><?php echo $_SESSION["success"]; ?></div>
            <?php
            } ?>
            <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
        </div>
        
        <button class="btn" name="register_team" >Register</button>
        
        
    </form>
</div>
</body>
</html>