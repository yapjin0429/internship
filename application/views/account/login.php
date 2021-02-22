<!DOCTYPE html>
<html>
<head>

	<title>Login Page</title>
  <!-- Latest BS 4.4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>
  
  <div class="container">

  	<div class="jumbotron">
      <h1>Login</h1>
      <p>Welcome to abc application.</p>
    </div>

  	<form method="post" class="form-horizontal" action="<?php echo site_url('account/login'); ?>">

      <div class="form-group">
        <?php  
          if ($this->session->flashdata('message')) {
            echo '
            <div class="alert alert-info">'.$this->session->flashdata("message").'</div>
            ';
          }
        ?>
        <div class="row">
          <label class="control-label col-2" for="text">Email:</label>
          <div class="col-4">
            <input type="text" name="user_email" class="form-control" placeholder="Enter email" value="<?php echo set_value('user_email'); ?>" />
            <span class="text-danger"><?php echo form_error('user_email'); ?></span>            
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <label class="control-label col-2" for="text">Password:</label>
          <div class="col-4">
            <input type="text" name="user_password" class="form-control" placeholder="Enter password" value="<?php echo set_value('user_password'); ?>" />
            <span class="text-danger"><?php echo form_error('user_password'); ?></span>    
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="offset-2 col-4">
            <div class="checkbox">
              <label><input type="checkbox">Remember me</label>
            </div>
          </div>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="offset-2 col-4">
            <button type="submit" name="login" value="Account" class="btn btn-primary">Login</button>
          </div>
        </div>
      </div>

      <div class="row">
        <p class="offset-2 col-4">
          <a href="<?php echo site_url('account/register'); ?>">Not a member ? Click here</a>
        </p>
      </div>

      <div class="row">
        <p class="offset-2 col-4">
          <a href="<?php echo site_url('account/forgot_password'); ?>">Forget your password? Click here</a>
        </p>
      </div> 

    </form>

  </div>

</body>
</html>