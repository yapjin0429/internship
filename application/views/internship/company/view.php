 <!DOCTYPE html>
<html>
<head>

	<title>Company View Page</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>


  	<div class="jumbotron">
      <div class="container">
        <h1>Company Profile</h1>
        <p>Allow people to view this company profile.</p>
      </div>
    </div>


    <div class="container">
      <h3 class="mb-3">Company Profile</h3>

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
            <?php echo $company['name']; ?>
          </div>
        </div>
      </div>    

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Company logo:</label>
          <div class="col-4">
            <img class="img-fluid" width="300" height="300" src="<?php echo $company_profile['company_logo']; ?>">
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Nature of Business:</label>
          <div class="col-4">
            <?php echo $company_profile['nature_of_business']; ?>
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Company type:</label>
          <div class="col-4">
            <?php echo $company_profile['company_type']; ?>
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Company size:</label>
          <div class="col-4">
           <?php echo $company_profile['company_size']; ?>
          </div>
        </div>
      </div>

      <div class="form-group ml-3">
        <div class="row">
         <label class="control-label col-2" for="text">Working hour:</label>
          <div class="col-4">
            <?php echo $company_profile['working_hour']; ?>
          </div>
        </div>
      </div>

      </div>

      <div class="form-group my-5">
        <div class="row">
          <div class="offset-6">
            <a href="<?php echo site_url('internship/listing/job_posting'); ?>" class="btn btn-primary">Back</a>
          </div>
        </div>
      </div>

    </div>


</body>
</html>
