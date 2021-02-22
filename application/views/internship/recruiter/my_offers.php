<!DOCTYPE html>
<html>
<head>

	<title>My offers Page</title>

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
        <h1>My offers</h1>
        <p>Show all the offers sent to the students.</p>
      </div>
    </div>

    <div class="container">

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Job Title</th>
            <th scope="col">Offered On</th>
            <th scope="col">Applicants</th> 
            <th scope="col">Status</th>                   
          </tr>
        </thead>
        <tbody>

          <?php foreach ($offers as $index => $offer) : ?>

          <tr>
            <th scope="row"><?php echo $index + 1; ?></th>
            <td><?php echo ucfirst($offer['job_title']); ?></td>
            <td><?php echo $offer['offered_on']; ?></td>
            <td><?php echo ucfirst($offer['name']); ?></td>
            <td>
              <?php if ($offer['status'] == 0) : ?>
                <button class="btn btn-warning btn-xs">Pending</button>
              <?php endif; ?>

              <?php if ($offer['status'] == 1) : ?>
                <button class="btn btn-success btn-xs disabled">Accepted</button>
              <?php endif; ?>

              <?php if ($offer['status'] == 2) : ?>
                <button class="btn btn-danger btn-xs disabled">Rejected</button>
              <?php endif; ?>
            </td>
          </tr>

          <?php endforeach; ?>

        </tbody>
      </table>

    </div>  
  
</body>
</html>
