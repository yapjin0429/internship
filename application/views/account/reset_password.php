<!DOCTYPE html>
<html>
<head>

	<title>Reset Page</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

  <div class="container">

    <div class="jumbotron">
      <h1>Reset your password</h1>
      <p>Enter a new password for your email address that you're using for your account below</p>
    </div>

    <form class="form-horizontal" method="post" action="<?php echo site_url('account/reset_password/'.$code); ?>">

      <div class="form-group">
        <?php  
        if ($this->session->flashdata('message')) {
          echo '
          <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
          ';
        }
        ?>        
        <div class="row">
         <label class="control-label col-2" for="text">Password:</label>
          <div class="col-4">
            <input type="password" name="user_password" class="form-control" placeholder="Enter password" value="<?php echo set_value('user_password'); ?>"/>
            <span class="text-danger"><?php echo form_error('user_password'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="control-label col-2" for="text">Confirm Password:</label>
          <div class="col-4">
            <input type="password" name="confirm_password" class="form-control" placeholder="Re-enter password" value="<?php echo set_value('confirm_password'); ?>"/>
            <span class="text-danger"><?php echo form_error('confirm_password'); ?></span>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="offset-2 col-4">
            <button type="submit" name="reset_password" value="Account" class="btn btn-primary">Reset</button>
          </div>
        </div>
      </div>

      <div class="row">
        <p class="offset-2 col-4">
          <a href="<?php echo site_url('account/login'); ?>"> Back to Login</a>
        </p>
      </div>

    </form>
    
  </div>

</body>
</html>