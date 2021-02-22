<!DOCTYPE html>
<html>
<head>

	<title>Add job Page</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

  	<div class="jumbotron">
      <div class="container">
        <h1>Add job</h1>
        <p>For recruiters add their new job post</p>
      </div>
    </div>

    <div class="container">   

      <form class="form-horizontal" method="post" action="<?php echo site_url('internship/job/add'); ?>">
      <h3 class="mb-3">Job Information</h3>

      <div class="card p-3 shadows">
        <div class="form-group ml-3">
        <?php
          if ($this->session->flashdata('message')) {
            echo '
            <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
            ';
          }
        ?>

        <div class="row">
          <label class="control-label col-2" for="text">Job Title:</label>
          <div class="col-4">
            <input type="text" name="job_title" class="form-control" placeholder="Enter Job Title" value=""/>
            <span class="text-danger"><?php echo form_error('job_title'); ?></span>
          </div>
        </div>
      </div>    

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Allowance:</label>
          <div class="col-4">
            <input type="number" name="allowance" class="form-control" placeholder="Enter Allowance" value=""/>
            <span class="text-danger"><?php echo form_error('allowance'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Location:</label>
          <div class="col-4">
            <input type="text" name="location" class="form-control" placeholder="Enter Location" value=""/>
            <span class="text-danger"><?php echo form_error('location'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Job Posting Date:</label>
          <div class="col-4">
            <input type="date" name="job_posting_date" class="form-control" placeholder="Enter Job Posting Date" value=""/>
            <span class="text-danger"><?php echo form_error('job_posting_date'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Job Posting Valid Until:</label>
          <div class="col-4">
            <input type="date" name="job_posting_valid_until" class="form-control" placeholder="Enter Job Posting Valid Until" value=""/>
            <span class="text-danger"><?php echo form_error('job_posting_valid_until'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Requirements:</label>
          <div class="col-4">
            <textarea type="text" name="requirements" rows="3" class="form-control" placeholder="Enter Requirements" value=""></textarea>
            <span class="text-danger"><?php echo form_error('requirements'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Responsibilities:</label>
          <div class="col-4">
            <textarea type="text" name="responsibilities" rows="3" class="form-control" placeholder="Enter Responsibilities" value=""></textarea>
            <span class="text-danger"><?php echo form_error('responsibilities'); ?></span>
          </div>
        </div>
      </div>

      </div>

      <div class="form-group my-5">
        <div class="row">
          <div class="ml-3">
            <a href="<?php echo site_url('internship/recruiter/my_jobs'); ?>" class="btn btn-primary">Back</a>
          </div>
          <div class="offset-5">
            <button type="submit" name="view_profile" value="Account" class="btn btn-primary">Create Form</button>
          </div>
        </div>
      </div>
      </form>
      
    </div>


</body>
</html>
