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
        <h1>Student Profile</h1>
        <p>Feel free to set-up your profile anytime.</p>
      </div>
    </div>

    <div class="container">

      <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('internship/student/profile'); ?>">
        <h3 class="mb-3">Internship form</h3>

        <div class="card  p-3">

          <div class="form-group ml-3">
          <?php
            if ($this->session->flashdata('message')) {
              echo '
              <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
              ';
            }
          ?>
            <div class="row">
              <label class="control-label col-2" for="text">Name:</label>
              <div class="col-4">
                <input type="text" name="name" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>"/>
                <span class="text-danger"><?php echo form_error('name'); ?></span>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Date of Birth:</label>
              <div class="col-4">
                <input type="date" name="dob" class="form-control" placeholder="Enter date of birth" value="<?php echo $date_of_birth; ?>"/>
                <span class="text-danger"><?php echo form_error('dob'); ?></span>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Contact:</label>
              <div class="col-4">
                <input type="text" name="contact" class="form-control" placeholder="Enter contact" value="<?php echo $contact; ?>"/>
                <span class="text-danger"><?php echo form_error('contact'); ?></span>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Email:</label>
              <div class="col-4">
                <input type="text" name="email" class="form-control" placeholder="Enter valid email" value="<?php echo $email; ?>"/>
                <span class="text-danger"><?php echo form_error('email'); ?></span>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Institution:</label>
              <div class="col-4">
                <input type="text" name="institution" class="form-control" placeholder="Enter uni" value="<?php echo $institution; ?>"/>
                <span class="text-danger"><?php echo form_error('institution'); ?></span>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Program:</label>
              <div class="col-4">
                <input type="text" name="program" class="form-control" placeholder="Enter course" value="<?php echo $program; ?>"/>
                <span class="text-danger"><?php echo form_error('program'); ?></span>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Internship Period:</label>
              <div class="col-4">
                <div class="input-group">
                  <input type="date" class="form-control" name="internship_start" placeholder="Start Date" value="<?php echo $internship_start; ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      ~
                    </div>
                  </div>
                    <input type="date" class="form-control" name="internship_end" placeholder="End Date" value="<?php echo $internship_start; ?>">
                </div>
                <span class="text-danger"><?php echo form_error('internship_start'); ?></span> 
                <span class="text-danger"><?php echo form_error('internship_end'); ?></span> 
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Prefer location:</label>
              <div class="col-4">
                <input class="form-control" rows="5" name="prefer_location" placeholder="Enter prefer location" value="<?php echo $prefer_location; ?>">
                <span class="text-danger"><?php echo form_error('prefer_location'); ?></span>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Prefer allowance:</label>
              <div class="col-4">
                <input class="form-control" rows="5" name="prefer_allowance" placeholder="Enter Prefer allowance" value="<?php echo $prefer_allowance; ?>">
                <span class="text-danger"><?php echo form_error('prefer_allowance'); ?></span>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Resume:</label>
              <div class="col-4">
                <input type="file" name="resume" class="form-control-file" align="center" id="resume">
                <span class="text-danger"><?php echo form_error('resume'); ?></span><br>
                <?php if (! empty($resume)) : ?>
                <a href="<?php echo $resume; ?>">Uploaded Resume Link</a>
                <?php endif; ?>
              </div>
            </div>      
          </div>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Status:</label>
              <div class="col-4">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="1" <?php echo $status == 1 ? "checked" : ""; ?>>
                  <label class="form-check-label" for="status">
                    Active
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="0" <?php echo $status == 0 ? "checked" : ""; ?>>
                  <label class="form-check-label" for="status">
                    Non-Active
                  </label>
                </div>
              </div>
              <span class="text-danger"><?php echo form_error('status'); ?></span> 
            </div>
          </div>

        </div>

        <div class="form-group my-5">
          <div class="row">

            <div class="ml-3">
              <a href="<?php echo site_url('internship/student/my_jobs'); ?>" class="btn btn-primary">Back</a>
            </div>

            <div class="offset-4">
              <button type="submit" class="btn btn-primary">Save Form</button>
            </div>

          </div>
        </div>

      </form>

    </div>

</body>
</html>
