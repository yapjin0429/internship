<!DOCTYPE html>
<html>
<head>

  <title>My jobs Page</title>

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
        <h1>Jobs Application</h1>
        <p>Show all the jobs applied</p>
        <div class="container">
          <a href="<?php echo site_url('internship/student/profile'); ?>" class="btn btn-secondary"><i class="fas fa-user"></i> Internship Profile</a>
        </div>
      </div>      
    </div>

    <div class="container">

      <h2>Your Jobs Applied</h2>

      <?php if (! empty($userJobs)) : ?>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Company Name</th>
            <th scope="col">Job Title</th>
            <th scope="col">Apply On</th>
            <th scope="col">Status</th>                           
          </tr>
        </thead>
        <tbody>
   
          <?php foreach ($userJobs as $index => $userJob) : ?>

          <tr>
            <th scope="row"><?php echo $index + 1; ?></th>
            <td><?php echo ucfirst($userJob['name']); ?></td>
            <td><?php echo ucfirst($userJob['job_title']); ?></td>
            <td><?php echo $userJob['apply_on']; ?></td>
            <td>
              <?php if ($userJob['status'] == 2) : ?>
                <button class="btn btn-danger btn-xs disabled">Rejected</button>
              <?php endif; ?>

              <?php if ($userJob['status'] == 1) : ?>
                <button class="btn btn-success btn-xs disabled">Accepted</button>
              <?php endif; ?>

              <?php if ($userJob['status'] == 0) : ?>
              <button class="btn btn-warning btn-xs">Pending</button>
              <?php endif; ?>
            </td>       
          </tr>

          <?php endforeach; ?>

        </tbody>
      </table>

      <?php else : ?>

        <p>Please apply jobs</p>

      <?php endif; ?> 

    </div>

</body>
</html>

