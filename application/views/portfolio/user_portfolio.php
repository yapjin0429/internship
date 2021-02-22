<!DOCTYPE html>
<html>
<head>

	<title>User Portfolio</title>

	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!-- Latest BS 4.4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <b class="navbar-brand">User Dashboard </b>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/student/my_jobs'); ?>">Internship Platform</a>
            </li>    
          </ul>
          <a href="<?php echo site_url('account/logout'); ?>" class="btn btn-secondary ml-auto"><i class="fas fa-sign-out-alt"></i> Log Out</a>    
        </div>
      </div>
    </nav>    

		<div class="jumbotron">
      <div class="container">
        <h1><?php echo ucfirst($user); ?>'s Portfolio</h1>
        <p>Start your career journey by uploading your portfolio</p>
      		<a href="<?php echo site_url('profile/view_profile'); ?>" class="btn btn-secondary"><i class="fas fa-user"></i> View Profile</a>
      		<div class="float-right">
      		  <a href="<?php echo site_url('portfolio/upload_artwork'); ?>" class="btn btn-secondary"><i class=" fas fa-palette"></i> Upload Artwork</a>
      		</div> 
      </div>
    </div>

    <div class="container">

      <?php if (! empty($artworks)) : ?>

  		<div class="row">

  			<?php foreach ($artworks as $artwork) : ?>

  		  <div class="col-4">
  		    <div class="card">
  					<img class="img-fluid" src="<?php echo $artwork['artwork_image']; ?>">
  		      <div class="card-body">
  		        <h5 class="card-title"><?php echo ucfirst($artwork['artwork_title']); ?></h5>
  		        <p class="card-text"><?php echo ucfirst($artwork['artwork_description']); ?></p>
  		        <div align="right"><a href="<?php echo site_url('portfolio/view_artwork/'.$artwork['id']); ?>" class="btn btn-outline-primary btn-sm">More details</a></div>
  		      </div>
  		    </div>
  		  </div>

  			<?php endforeach; ?>
  		</div>

      <?php else : ?>

        <p>Please insert artworks</p>

      <?php endif; ?> 

    </div> 

<!--     <div class="row mx-auto my-5">
      <a href="<?php echo site_url('account/logout'); ?>" class="btn btn-primary">Log Out</a>
      <a href="<?php echo site_url('internship/student/my_jobs'); ?>" class="btn btn-primary ml-auto">Internship platform</a>
    </div>   -->
      

</body>
</html>
