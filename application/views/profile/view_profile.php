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
  <div class="container">
  	<div class="jumbotron">
      <h1>Profile</h1>
      <p>Feel free to set-up your profile anytime.</p>
    </div>

    <form class="form-horizontal" method="post" action="<?php echo site_url('profile/view_profile'); ?>">
      
      <div class="form-group">
        <?php  
          if ($this->session->flashdata('message')) {
            echo '
            <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
            ';
          }
        ?>
        <h3 class="mb-3">Personal Information</h3>        
        <div class="row">          
          <label class="control-label col-2" for="text">First Name:</label>
          <div class="col-4">
            <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="<?php echo $first_name; ?>"/>
            <span class="text-danger"><?php echo form_error('first_name'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
         <label class="control-label col-2" for="text">Last Name:</label>
          <div class="col-4">
            <input type="text" name="last_name" class="form-control" placeholder="Enter last name" value="<?php echo $last_name; ?>"/>
            <span class="text-danger"><?php echo form_error('last_name'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
         <label class="control-label col-2" for="text">Email:</label>
          <div class="col-4">
            <input type="text" name="user_email" class="form-control" placeholder="Enter valid email" value="<?php echo $email; ?>"/>
            <span class="text-danger"><?php echo form_error('user_email'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
         <label class="control-label col-2" for="text">University:</label>
          <div class="col-4">
            <input type="text" name="university" class="form-control" placeholder="Enter uni" value="<?php echo $university; ?>"/>
            <span class="text-danger"><?php echo form_error('university'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
         <label class="control-label col-2" for="text">Major Course:</label>
          <div class="col-4">
            <input type="text" name="course" class="form-control" placeholder="Enter course" value="<?php echo $course; ?>"/>
            <span class="text-danger"><?php echo form_error('course'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="control-label col-2" for="text">Skills:</label>
          <div class="col-4">
        	  <textarea class="form-control" rows="5" name="skills"><?php echo $skills; ?></textarea>
            <span class="text-danger"><?php echo form_error('skills'); ?></span>
      		</div>
      	</div>
      </div>

    	<div class="form-group">
        <div class="row">
          <label class="control-label col-2" for="email">Experience:</label>
          <div class="col-4">
            <textarea class="form-control" rows="5" name="experience"><?php echo $experience; ?></textarea>
            <span class="text-danger"><?php echo form_error('experience'); ?></span>
      		</div>
      	</div>
      </div>

    	<div class="form-group">
        <div class="row">
          <label class="control-label col-2" for="email">Intro:</label>
          <div class="col-4">
            <textarea class="form-control" rows="5" name="intro"><?php echo $intro; ?></textarea>
            <span class="text-danger"><?php echo form_error('intro'); ?></span>
      		</div>
      	</div>
      </div>

      <h3 class="mb-3">Credentials</h3>

      <div class="form-group">
        <div class="row">
         <label class="control-label col-2" for="text">New Password:</label>
          <div class="col-4">
            <input type="text" name="user_password" class="form-control" placeholder="Enter your new password" value="<?php echo set_value('user_password'); ?>"/>
            <small>Left it blank if your password remains unchanged</small>
            <span class="text-danger"></span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
         <label class="control-label col-2" for="text">Confirm Password:</label>
          <div class="col-4">
            <input type="text" name="confirm_password" class="form-control" placeholder="Re-enter your new password"/>
            <span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group my-5">
        <div class="row">

          <div class="ml-3">
            <a href="<?php echo site_url('portfolio/user_portfolio'); ?>" class="btn btn-primary">Back</a>
          </div>

          <div class="offset-3">
            <button type="submit" name="view_profile" value="Account" class="btn btn-primary">Save Profile</button>
          </div>

        </div>
      </div>  

    </form>
  </div>
</body>
</html>