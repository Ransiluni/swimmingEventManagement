<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Organizer</title>
    
    <link href="<?php echo base_url('assets/css/validation.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/form_style.css') ?>" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/devicons/css/devicons.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/simple-line-icons/css/simple-line-icons.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/simple-line-icons/css/simple-line-icons.css') ?>" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/resume.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/org.css') ?>" >

  </head>
  <script src="<?php echo base_url('assets/js/jQuery.js') ?>">

  
  </script>
  
  <body id="page-top">
  
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Organizer</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="http://localhost/website/assets/img/profileo.png" alt="">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="http://localhost/website/index.php/admin_main/addEvent">Create Event/Add Subevent</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="http://localhost/website/index.php/admin_main/update">Update Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="http://localhost/website/index.php/admin_main/register">Register Swimmer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="http://localhost/website/index.php/admin_main/searchEvent">Search</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="http://localhost/website/index.php/admin_main/timingDetail">Timing</a>
          </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" id="logout" href="http://localhost/website/admin_main/logout">Logout<i class="glyphicon glyphicon-search" ></i></a>
         </li>
          
        </ul>
        
        
      </div>
    </nav>

    <div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex d-column" id="about">
        <div class="my-auto">
          <h1 class="mb-0">Timing Detail
            
          </h1>
          <div class="place">
          <form class="form" action = "" method="POST" >
          
         
     
         <div class="form__group table-responsive">
                <?php if(empty($event_today )){?>
                <label> No registered swimmer </label>
                <?php }else{?>
            
                <table border=1 class="table table-dark " id="tsize" >
                    <?php $event=""; ?>
                            <tr><th>Subevent Name</th>
                                <th>Gender</th>
                                <th>Age Group</th>
                                <th>SwimmerName</th>
                                <th>Timing</th></tr>
                    <?php $x=0;
                    foreach($event_today as $row): 
                        
                    ?>
                    
                            
                             
                            <?php if($event==$row->subevent_id){ ?>
                                
                                <tr>   
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><?php echo $row->user_name; ?></td>
                                <td><input type="text" name=<?php echo $x;?> id="timing" placeholder=<?php echo $row->timing;?> id="timing" value=<?php echo $row->timing;?>  class="form__input"  /></td>
                                
                            <?php }else{  ?>
                            
                            <tr>   
                            <td><?php echo $row->name; ?></td>
                            <td><?php echo $row->gender; ?></td>
                            <td><?php echo $row->age_group; ?></td>
                            <td><?php echo $row->user_name; ?></td>
                            <td><input type="text" name=<?php echo $x;?> id="timing" placeholder=<?php echo $row->timing;?> value=<?php echo $row->timing;?>  class="form__input" /></td>
                           
                            
                            <?php } ?>
                        <?php $event=$row->subevent_id;
                            $x++;
                            ?>
    
                    </tr>
                    <br>
                    <?php endforeach; ?>
            </tr></table><br>

        </div>
       
           
    
    
        <div name="row">
        
            <button class="btn" name="enterTime" id="enterTime" >Insert Timing</button><br>
       
       
            <button class="btn" name="finalize" id="finalize" >Finalize Subevent</button>
       </div>
       <?php }?>
      
        </form>
        </div>
        </div>
      </section>

     </div>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url('assets/js/resume.min.js') ?>"></script>

  </body>

</html>
