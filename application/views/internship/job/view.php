<!DOCTYPE html>
<html>
<head>

	<title>Profile Page</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>


  	<div class="jumbotron">
      <div class="container">
        <h1>Job details</h1>
        <p>View a specific job by job ID</p>
      </div>
    </div> 

    <div class="container">

      <form class="form-horizontal" method="post" action="<?php echo site_url('internship/job/view/'.$job['id']); ?>">

        <div class="nav nav-bar" align="center">

          <h2 class="mb-4">Job information</h2>

          <?php if ($isowner == true) : ?>
           <a href="<?php echo site_url('internship/job/edit/'.$job['id']); ?>" class="btn btn-primary mb-4 ml-auto">Edit</a>
          <?php endif; ?>

          <?php if ($isStudent == true) : ?>         
            <?php if ($jobApplied == true) : ?>
               <a href="" class="btn btn-primary mb-4 ml-auto disabled">Applied</a>

            <?php else : ?>
              <a href="<?php echo site_url('internship/job/apply/'.$job['id']); ?>" class="btn btn-primary mb-4 ml-auto">Apply</a>

            <?php endif; ?>
          <?php endif; ?>
       

        </div>

        <div class="card p-3 shadow">
          <div class="row">
            <div class="comment-avatar col-2 mx-auto">
            <img class="rounded img-fluid" src="<?php echo $company_profile['company_logo']; ?>">
          </div> 
          <div class="col-10 ">
            <h2><?php echo $job['job_title']; ?></h2><br>
            <h4><?php echo $company_info['name']; ?></h4>
          </div>  
          </div>  
          <hr>
          <h5>Job Details</h5>
            <ul>
            <li>Allowance : <?php echo $job['allowance']; ?></li>
            <li>Location : <?php echo $job['location']; ?></li>
            <li>Job Posting Date : <?php echo $job['job_posting_date']; ?></li>
            <li>Job Posting Valid Until : <?php echo $job['job_posting_valid_until']; ?></li>
            </ul>
        </div>

        <br>

        <div class="card p-3 shadow">
          <h4>Requirements</h4>
          <hr>
          <ul>
          <li><?php echo $job['requirements']; ?></li>
          </ul>      
        </div>

        <br>

        <div class="card p-3 shadow">
          <h4>Responsibilities</h4>
          <hr>
          <ul>
          <li><?php echo $job['responsibility']; ?></li>
          </ul>      
        </div>

        <br>

        <div class="card p-3 shadow">
          <div class="nav nav-bar p-2">
            <h4>About Company</h4>
            <a href="<?php echo site_url('internship/company/view/'.$job['company_id']); ?>" class="btn btn-primary ml-auto">View Company Profile</a>
          </div>

          <hr>
          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Company Name:</label>
              <div class="col-4">
                <?php echo $company_info ['name']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Company Type:</label>
              <div class="col-4">
                <?php echo $company_profile['company_type']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Nature of business:</label>
              <div class="col-4">
                <?php echo $company_profile['nature_of_business']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Company Size:</label>
              <div class="col-4">
                <?php echo $company_profile['company_size']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Working Hour:</label>
              <div class="col-4">
                <?php echo $company_profile['working_hour']; ?>
              </div>
            </div>
          </div> 

        </div>    

        <div class="form-group my-5">
          <div class="row">
            <div class="offset-5">

              <?php if ($isowner == true) : ?>
                <a href="<?php echo site_url('internship/recruiter/my_jobs'); ?>" class="btn btn-primary">Back</a>
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Delete</a> 
              <?php endif; ?>

              <?php if ($isStudent == true) : ?>
               <a href="<?php echo site_url('internship/listing/job_posting'); ?>" class="btn btn-primary">Back</a>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </form>

    </div>   


</body>
</html>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Delete Job</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure want to delete this job ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?php echo site_url('internship/job/delete/'.$job['id']); ?>" class="btn btn-primary">Delete</a>
      </div>
    </div>
  </div>
</div>