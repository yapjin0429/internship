<!DOCTYPE html>
<html>
<head>

  <title>Job posting Page</title>

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <b class="navbar-brand">Student Dashboard </b>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/student/my_jobs'); ?>">My Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/student/my_offers'); ?>">My Offers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/listing/job_posting'); ?>">Job Posts</a>
            </li>      
          </ul>
          <a href="<?php echo site_url('portfolio/user_portfolio'); ?>" class="btn btn-secondary btn-xs ml-auto">Back to ArtMeet</a>       
        </div>
      </div>
    </nav>  

  	<div class="jumbotron">
      <div class="container">
      <h1>Job posting lists</h1>
      <p>Show all the latest job posts for students.</p>
      </div>
    </div>

    <div class="container">

      <?php foreach ($jobs as $job) : ?>

      <div class="card p-4 shadow">

  			<div class="row">   
  				<div class="comment-avatar col-2 mx-auto">
  				<img class="rounded img-fluid" src="<?php echo $job['logo']; ?>">
  			  </div> 

    			<div class="col-10 ">
    				<h2><?php echo ucfirst($job['job_title']); ?></h2><br>
    				<h4><?php echo ucfirst($job['name']); ?></h4>
    			</div>          
  			</div> 

          	<hr>
          	<h5>Requirement Details</h5>
          		<ul>
          		<li>Allowance : RM<?php echo $job['allowance']; ?></li>
          		<li>Location : <?php echo ucfirst($job['location']); ?></li>
          		<li>Job Posting Date : <?php echo $job['job_posting_date']; ?></li>
          		<li>Job Posting Valid Until : <?php echo $job['job_posting_valid_until']; ?></li>
          		</ul>

             <div class="ml-auto">
                <?php if ($isStudent == true) : ?>
                  <?php if ($job['isApplied'] == true) : ?>
                    <a href="<?php echo site_url(''); ?>" class="btn btn-primary disabled">Applied</a>

                  <?php else : ?>
                  <a href="<?php echo site_url('internship/job/apply/'.$job['id']); ?>" class="btn btn-primary">Apply</a>  

                  <?php endif; ?>
                <?php endif; ?> 
                    <a href="<?php echo site_url('internship/job/view/'.$job['id']); ?>" class="btn btn-primary">More details</a>     
            </div>

      </div><br>

      <?php endforeach; ?>

    </div>

</body>
</html>
