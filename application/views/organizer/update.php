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

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/resume.min.css') ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/org.css') ?>" >

  </head>
  <script src="<?php echo base_url('assets/js/jQuery.js') ?>"></script>


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
          <h2 class="mb-5">Update Event</h2>

          <div class="resume-item d-flex flex-column flex-md-row mb-5">
            <div class="resume-content mr-auto">
              <form class="form" action = "" method="POST" >
         
     <div>
        <div class="form__group">
         
                    <?php $x=0; ?>
                    <?php foreach($event as $row): ?>
                    
             <input type="text"  name="u_eventid" id="u_eventid" placeholder="<?php echo $row->event_id; ?>" class="form__input" readonly/>
            
        </div>
        
        <label>If any registered details changed please update changes using the form below.</label>
        
        <div class="form__group">
        <label>Date set <?php echo $row->date; ?></label>
            <input type="date" name="u_eventdate" id="u_eventdate" placeholder="<?php echo $row->date; ?>" class="form__input" />
        </div>
        <label>Venue</label>
        <div class="form__group">
            <input type="text" name="u_venue" id="u_venue" placeholder="<?php echo $row->venue; ?>" class="form__input"  />
        </div>
        <?php $x+=1; ?>
        <?php endforeach; ?>
        </div>
        <div class="row">
        <div class="col-lg-6">
        <label name="u_l1" >Select to add new subevent to event.</label>
        
        <div class="form__group">
            
                <tbody>
                    <?php $x=0; ?>
                    <?php foreach($query1 as $row): ?>
                    
                        <input type="checkbox" name="subevent[]" id="subevent[]" value="<?php echo $row->subevent_id;?> " > <tr>   
                            <td><?php echo $row->gender; ?></td>
                            <td><?php echo $row->age_group; ?></td>
                            <td><?php echo $row->name; ?></td>
                            <?php $x+=1; ?>
                        
    
                    </tr>
                    <br>
                    <?php endforeach; ?>
            </tbody><br>

        </div>
        </div><div class="col-lg-6">
        <label name="u_l1" >Current available subevents. Select if you want to drop any.</label>
        
        <div class="form__group">
            
                <tbody>
                    <?php $x=0; ?>
                    <?php foreach($query2 as $row): ?>
                    
                        <input type="checkbox" name="dropevent[]" value="<?php echo $row->subevent_id;?> " > <tr>   
                            <td><?php echo $row->gender; ?></td>
                            <td><?php echo $row->age_group; ?></td>
                            <td><?php echo $row->name; ?></td>
                            <?php $x+=1; ?>
                        
    
                    </tr>
                    <br>
                    <?php endforeach; ?>
            </tbody><br>

        </div>
        </div>
        </div>       
        
        <button class="btn" name="updateEvent" id="updateEvent">Update Event</button>
        
        </form>
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
