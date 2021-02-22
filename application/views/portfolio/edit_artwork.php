<!DOCTYPE html>
<html>
<head>

	<title>Edit</title>

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
      <h1>Edit your artwork here</h1>
      <p>.........................................................................................................................................</p>
    </div>

	 <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo site_url('portfolio/edit_artwork/'.$artwork['id']); ?>">

	    <?php  
	    if ($this->session->flashdata('message')) {
	      echo '
	      <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
	      ';
	    }
	    ?> 

		  <div class="row">	

		    <div class="col">

		    	<div class="card mb-3">
					  <img src="<?php echo $artwork['artwork_image'] ?>" class="card-img-top" alt="...">
					</div>

					<div class="mx-auto" style="width: 200px;">
						<div class="text-center">
						  <img src="..." class="rounded" alt="...">
						</div>
						<!-- <form> -->
						  <div class="form-group">
						    <label for="exampleFormControlFile1">Upload your artwork here</label>
						    <input type="file" class="form-control-file" align="center" id="artwork" name="artwork">
						    <span class="text-danger"><?php echo form_error('artwork'); ?></span>
						  </div>
						<!-- </form> -->
		    	</div>

		    </div>

		    <div class="col">

					  <div class="form-group">
					    <label for="text">Title</label>
					    <input type="text" class="form-control" name="artwork_title" value="<?php echo $artwork['artwork_title']?>" />
					    <span class="text-danger"><?php echo form_error('artwork_title'); ?></span>
					  </div>

					  <div class="form-group">
					    <label for="text">Description</label>
		        	  <textarea class="form-control" rows="5" name="artwork_description"><?php echo $artwork['artwork_description'] ?></textarea>
		        	  <span class="text-danger"><?php echo form_error('artwork_description'); ?></span>
					  </div>

					  <div class="mt-3">
					  	<button type="submit" class="btn btn-primary">Update</button>
					  </div>

		    </div>

		  </div>

		</form>
		<hr>
		<a href="<?php echo site_url('portfolio/user_portfolio'); ?>" class="btn btn-primary">Back</a>

  </div> 

</body>
</html>