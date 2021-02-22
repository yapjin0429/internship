<!DOCTYPE html>
<html>
<head>

	<title>My Applicants Page</title>

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
        <h1>Applicants</h1>
        <p>Show all the applicant (student) requests.</p>
      </div>
    </div>

    <div class="container">
      <?php
        if ($this->session->flashdata('message')) {
          echo '
          <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
          ';
        }
      ?>
      <?php foreach ($applicants as $index => $applicant) : ?>

        <div class="card p-4 shadow">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Job Title</th>
                  <th scope="col">Apply On</th>
                  <th scope="col">Action</th>                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo ucfirst($applicant['job_title']); ?></td>
                  <td><?php echo $applicant['apply_on']; ?></td>
                  <td>               
                    <?php if ($applicant['status'] == 2) : ?>
                      <button class="btn btn-danger btn-xs disabled">Rejected</button>
                    <?php endif; ?>

                    <?php if ($applicant['status'] == 1) : ?>
                      <button class="btn btn-success btn-xs disabled">Accepted</button>
                    <?php endif; ?>

                    <?php if ($applicant['status'] == 0) : ?>

                      <form class="form-horizontal" method="post" action="<?php echo site_url('internship/intern/send_offer'); ?>">

                        <input type="hidden" name="company_id" value="<?php echo $applicant['company_id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $applicant['user_id']; ?>">
                        <input type="hidden" name="job_id" value="<?php echo $applicant['job_id']; ?>">  

                        <button type="submit" class="btn btn-success btn-xs">Send Offer</button>
                      </form>
                      <br>
                      <form class="form-horizontal" method="post" action="<?php echo site_url('internship/intern/reject_offer'); ?>">

                        <input type="hidden" name="company_id" value="<?php echo $applicant['company_id']; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $applicant['user_id']; ?>">
                        <input type="hidden" name="job_id" value="<?php echo $applicant['job_id']; ?>"> 

                        <button type="submit" class="btn btn-danger btn-xs">Reject</button>
                      </form>

                    <?php endif; ?>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr>
                <div class="row">
                    <div class="comment-avatar col-2 mx-auto">
                    <img class="rounded img-fluid" src="https://i.imgur.com/RpzrMR2.jpg">
                </div> 
                <div class="col-10 ">
                    <h2><?php echo $applicant['name'] ?></h2><br>
                    <h4><?php echo $applicant['age'] ?></h4>
                </div>  
                </div>  
                <hr>
                <h5>Details</h5>
                    <ul>
                    <li>Institution : <?php echo ucfirst($applicant['institution']); ?></li>
                    <li>Program : <?php echo ucfirst($applicant['program']); ?></li>
                    <li>Prefer Location : <?php echo ucfirst($applicant['preferLocation']); ?></li>
                    <li><a href="#" >Portfolio Link</a></li>
                    </ul>
        </div><br>

      <?php endforeach; ?>

    </div>
  
</body>
</html>
