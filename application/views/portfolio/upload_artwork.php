<!DOCTYPE html>
<html>
<head>

	<title>Upload</title>

	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	
	<!-- Latest BS 4.4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

	<div class="container">

		<div class="jumbotron">
      <h1>Upload your artwork here</h1>
      <p>Start your career journey by uploading your portfolio</p>
    </div>

	  <form method="post" enctype="multipart/form-data" class="form-horizontal" action="<?php echo site_url('portfolio/upload_artwork'); ?>" >

      <?php  
      if ($this->session->flashdata('message')) {
        echo '
        <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
        ';
      }
      ?>

		  <div class="row">

		    <div class="col">
					<div class="mx-auto" style="width: 200px;">
						<div class="text-center">
						  <img src="..." class="rounded" alt="...">
						</div>

						  <div class="form-group">
						    <label>Upload your artwork here</label>
						    <input type="file" name="artwork" class="form-control-file" align="center" id="artwork">
						    <span class="text-danger"><?php echo form_error('artwork'); ?></span>
						  </div>

		    	</div>
		    </div>

		    <div class="col">

					  <div class="form-group">
					    <label>Title</label>
            	<input type="text" name="artwork_title" class="form-control" placeholder="Enter artwork title" />
            	<span class="text-danger"><?php echo form_error('artwork_title'); ?></span>
					  </div>

					  <div class="form-group">
					    <label>Description</label>
		        	  <textarea type="text" name="artwork_description" class="form-control" placeholder="Enter artwork description" rows="5" value="<?php echo set_value('artwork_description'); ?>"></textarea>
		        	  <span class="text-danger"><?php echo form_error('artwork_description'); ?></span>
					  </div>

					  <div class="mt-3">
					  	<button type="submit" name="submit" value="portfolio" class="btn btn-primary">Upload</button>
					  </div>

		    </div>
		    
	  	</div>

	  </form>
	  <hr>
		<a href="<?php echo site_url('portfolio/user_portfolio'); ?>" class="btn btn-primary">Back</a>
  </div>
  	
</body>
</html>