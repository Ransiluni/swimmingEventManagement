<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Swimmer</title>
    
    <link href="<?php echo base_url('assets/css/validation.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/form_style.css') ?>" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/devicons/css/devicons.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/simple-line-icons/css/simple-line-icons.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/simple-line-icons/css/simple-line-icons.css') ?>" rel="stylesheet">
    <!--<link href="<?php echo base_url('assets/bootstrap-3.3.7/dist/css/bootstrap.css') ?>" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/resume.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/org.css') ?>" >

  </head>
  <script src="<?php echo base_url('assets/js/jQuery.js') ?>"></script>


  <body id="page-top">


    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Start Bootstrap</span>
        <span class="d-none d-lg-block">
          <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="http://localhost/website/assets/img/profile2.png" alt="">
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#">Register Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="http://localhost/website/index.php/swimmer_main/search">Search</a>
          </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="http://localhost/website/swimmer_main/logout">Logout<i class="glyphicon glyphicon-search" ></i></a>
            </li>
          
          
        </ul>
        
        
      </div>
    </nav>

     <div class="container-fluid p-0">

      <section class="resume-section p-3 p-lg-5 d-flex d-column" id="about">
        <div class="my-auto">
          <h1 class="mb-0">Register Event
            
          </h1>
          <div class="place">
            
                
                    <form class="form" action = "" method="POST" >
            
                        <?php foreach($swimmer as $row): ?>
     
                        <div class="form__group">
        
            
                            <input type="text"  name="user_id" id="user_id" placeholder="<?php echo $row->user_name; ?>" class="form__input" readonly/>
            
                        </div>
    
                        
                        <?php endforeach; ?>
        
                        <div class="form__group">
        
                             <tbody>
                    
                            <?php foreach($event as $row): ?>
                    
                    
                            <input type="radio" name="eventDetail[]" value="<?php echo $row->event_id;?> " required/> <tr>   
                            <td>'<?php echo $row->event_id; ?>'<label>&nbsp scheduled to</label> </td>
                            <td><?php echo $row->date; ?><label>&nbsp at</label></label></td>
                            <td><?php echo $row->venue; ?></td>
                            
                            
                        
    
                            </tr>
                            <br>
                    
                            <?php endforeach; ?>
                        </tbody>

                    </div>
        

                    <button class="btn" name="register" >REGISTER SUBEVENT</button>
        
                </form>
        
        
            <h3>Registered events</h3>
            <div class="form__group ">
        
        
                    
        
                
            
                <table border=1 class="table table-dark thead-light">
                    <?php $event=""; ?>
                                <tr><th>Event Name</th>
                                <th>Subevent Name</th>
                                <th>Gender</th>
                                <th>Age Group</th>
                                
                    
                    <?php foreach($registered as $row): ?>
                    
                            
                             
                            <script>console.log( 'event  <?php echo ($row->event_id)?> ' );</script>
                            <script>console.log( 'events  <?php echo ($event)?> ' );</script>
                            <?php if($event==$row->event_id){ ?>
                                
                                <tr>   
                                <td></td>
                                <td><?php echo $row->name; ?></td>
                                <td><?php echo $row->gender; ?></td>
                                <td><?php echo $row->age_group; ?></td>
                                
                                
                            <?php }else{  ?>
                            
                            <tr>
                            <td><?php echo $row->event_id; ?></td>
                            <td><?php echo $row->name; ?></td>
                            
                            <td><?php echo $row->gender; ?></td>
                            <td><?php echo $row->age_group; ?></td>
                            
                            
                            <?php } ?>
                        <?php $event=$row->event_id; ?>
    
                    </tr>
                    <br>
                    <?php endforeach; ?>
            </tr></table><br>

        </div>
        
        
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
