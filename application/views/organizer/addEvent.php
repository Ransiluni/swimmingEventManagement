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
  <script src="<?php echo base_url('assets/js/jQuery.js') ?>"></script>



  <script>
$(document).ready(function()  {
        $("#gender").prop('disabled', true);
        $("#agegroup").prop('disabled', true);
        $("#name").prop('disabled', true);
        $("#newevent_con").attr("disabled", "disabled");
        $("#updateHide").hide();
        
        // Yes Input
         $("#newevent").on("click", function () {
            $("input").prop('disabled', true);
            $("#eventid").prop('disabled', false);
            $("#gender").prop('disabled', false);
            $("#agegroup").prop('disabled', false);
            $("#name").prop('disabled', false);
            $("#newevent_con").attr("disabled", false);
            $("#createEvent").attr("disabled", "disabled");
            
            
        });
        
        
        
    });

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
            <a class="nav-link js-scroll-trigger" href="#">Create Event/Add Subevent</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="http://localhost/website/index.php/admin_main/update">Update Event</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="http://localhost/website/index.php/admin_main/register">Register Swimmer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" id="search" href="http://localhost/website/index.php/admin_main/searchEvent">Search</a>
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
          <h1 class="mb-0">Create Event
            
          </h1>
          <div class="place">
          <form class="form" action = "" method="POST" >
         
     
        <div class="form__group">
            <input type="text"  name="eventid" id="eventid" placeholder="EventID" class="form__input" required/>
            
        </div>
        <div class="form__group">
            <input type="text" onfocus="(this.type='date')" name="event_date" id="event_date" placeholder="Date Of Event" class="form__input" required/>
        </div>
        
        <div class="form__group">
            <input type="text" name="venue" id="venue" placeholder="Venue" class="form__input"  />
        </div>
        <table align="center">
            <tr>
                <td id="black">
                    <input type="radio" name="newevent" value="1" id="newevent"><lable>Add New Subevent</label>
                </td>
            </tr>
            
            
        </table>
        <div class="form__group">
            <input list="genderlist"  name="gender" id="gender" placeholder="Gender" class="form__input" required/>
            <datalist id="genderlist">
                <option value="male">
                <option value="female">
  
            </datalist>
            </option></datalist></div>
        <div class="form__group">
            <input list="agegrouplist"  name="agegroup" id="agegroup" placeholder="Age Group" class="form__input" required/>
            <datalist id="agegrouplist">
                <option value="under9">
                <option value="under12">
                <option value="under15">
  
            </datalist>
            </option></datalist></div>
        <div class="form__group">
            <input type="text"  name="name" id="name" placeholder="Name of subevent" class="form__input" required/>
        </div>
       
    
    <div>
    
    <button class="btn" name="newevent_con" id="newevent_con" >Set SubEvent</button>
  </div>
        <div class="form__group">
            
                <tbody>
                    
                    <?php foreach($query as $row): ?>
                    
                        <input type="checkbox" name="subevent[]" value="<?php echo $row->subevent_id;?> " > <tr>   
                            <td><?php echo $row->gender; ?><label>&nbsp | &nbsp </label></td>
                            <td><?php echo $row->age_group; ?><label>&nbsp | &nbsp </label></td>
                            <td><?php echo $row->name; ?></td>
                            
    
                    </tr>
                    <br>
                    <?php endforeach; ?>
            </tbody><br>

        </div>
        
        
        <button class="btn" name="createEvent" id="createEvent" >Create Event</button>
        </div>
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
