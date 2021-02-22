<!DOCTYPE html>
<html>
<head>
  
  <title>Intern Page</title>

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <b class="navbar-brand">Recruiter Dashboard </b>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/recruiter/my_jobs'); ?>">My Jobs</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/recruiter/my_offers'); ?>">My Offers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/recruiter/applicants'); ?>">Applicants</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/listing/interns'); ?>">Intern Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/recruiter/saved_interns'); ?>">Saved Interns</a>
            </li>        
          </ul>
          <a href="<?php echo site_url('company/account/logout'); ?>" class="btn btn-secondary ml-auto"><i class="fas fa-sign-out-alt"></i> Log Out</a>   
        </div>
      </div>
    </nav>

      	<div class="jumbotron">
          <div class="container">
            <h1>Intern List</h1>
            <p>Show all the active interns for recruiters</p>
          </div>
        </div>

        <div class="container">

          <?php foreach ($interns as $intern) : ?>

            <div class="card p-4 shadow">
        			<div class="row">
        				<div class="comment-avatar col-2 mx-auto">
        				  <img class="rounded img-fluid" src="https://i.imgur.com/RpzrMR2.jpg">
        			  </div> 
          			<div class="col-10 ">
          				<h2><?php echo ucfirst($intern['name']); ?></h2><br>
          				<h4><?php echo $intern['age']; ?></h4>
          			</div>
        			</div> 	

                	<hr>
                	<h5>Details</h5>
                		<ul>
                		<li>Institution : <?php echo ucfirst($intern['institution']); ?></li>
                		<li>Program : <?php echo ucfirst($intern['program']); ?></li>
                		<li>Prefer Location : <?php echo ucfirst($intern['prefer_location']); ?></li>
                		<li><a href="#" >Portfolio Link</a></li>
                		</ul>
                    <div class="ml-auto">
                      <?php if ($isRecruiter == true) : ?>
                        <?php if ($intern['isSaved'] == true) : ?>
                          <a href="<?php echo site_url(''); ?>" class="btn btn-primary disabled">Saved</a>

                        <?php else : ?>
                        <a href="<?php echo site_url('internship/intern/save/'.$intern['user_id']); ?>" class="btn btn-primary">Save</a>  

                        <?php endif; ?>
                      <?php endif; ?>
                      <a href="<?php echo site_url('internship/intern/view/'.$intern['user_id']); ?>" class="btn btn-primary ml-auto">More details</a>         
                    </div>
                    
            </div><br>

          <?php endforeach; ?>

        </div>

</body>
</html>
