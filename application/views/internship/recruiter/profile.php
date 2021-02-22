<!DOCTYPE html>
<html>
<head>
 
	<title>Profile Page</title>

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

  	<div class="jumbotron">
      <div class="container">
        <h1>Recruiter Profile</h1>
        <p>Feel free to set-up your profile anytime.</p>
      </div>
    </div>

    <div class="container">

      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('internship/recruiter/profile'); ?>">
        <h3><i class="mb-3 far fa-building"></i> Company Profile</h3>

        <div class="card p-3">
          <div class="form-group ml-3">
          <?php
            if ($this->session->flashdata('message')) {
              echo '
              <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
              ';
            }
          ?>

            <div class="row">
              <label class="control-label col-2" for="text">Company Name:</label>
              <div class="col-4">
                <input type="text" name="company_name" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>"/>
                <span class="text-danger"><?php echo form_error('company_name'); ?></span>
              </div>
            </div>
          </div>    

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Company logo:</label>
              <div class="col-4">
    		    		<input type="file" name="company_logo" class="form-control-file" align="center" id="company_logo">
                <span class="text-danger"><?php echo form_error('company_logo'); ?></span><br>
                <img class="img-fluid" width="300" height="300" src="<?php echo $company_logo; ?>">
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Nature of Business:</label>
              <div class="col-4">
                <input type="text" name="nature_of_business" class="form-control" placeholder="Enter Nature of Business" value="<?php echo $nature_of_business; ?>"/>
                <span class="text-danger"><?php echo form_error('nature_of_business'); ?></span>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Company type:</label>
              <div class="col-4">
                <input type="text" name="company_type" class="form-control" placeholder="Enter Company type" value="<?php echo $company_type; ?>"/>
                <span class="text-danger"><?php echo form_error('company_type'); ?></span>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Company size:</label>
              <div class="col-4">
                <input type="text" name="company_size" class="form-control" placeholder="Enter Company size" value="<?php echo $company_size; ?>"/>
                <span class="text-danger"><?php echo form_error('company_size'); ?></span>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Working hour:</label>
              <div class="col-4">
                <input type="text" name="working_hour" class="form-control" placeholder="Enter Working hour" value="<?php echo $working_hour; ?>"/>
                <span class="text-danger"><?php echo form_error('working_hour'); ?></span>
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
              <button type="submit" class="btn btn-primary">Save Form</button>
            </div>
          </div>
        </div>
      </form>
      
    </div>

</body>
</html>
