<!DOCTYPE html>
<html>

<head>
	<title>ArtWork Detail</title>
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
      <h1><?php echo $artwork['artwork_title'] ?></h1>
      <p><?php echo $artwork['artwork_description'] ?></p>
    </div>

    <form class="form-horizontal" method="post" action="<?php echo site_url('portfolio/view_artwork/'.$artwork['id']); ?>">

			<img class="rounded img-fluid" src="<?php echo $artwork['artwork_image'] ?>" align="container" alt="...">

			<div class="like-unlike-edit-bar">
				<br>
				<nav class="navbar navbar-expand-lg navbar-light bg-light">
				  <div class="collapse navbar-collapse" id="navbarNav">
				    <ul class="navbar-nav">
				      <li class="nav-item">
				      	<div class="col-3">
								<a href="#" class="fas fa-thumbs-up"></a>
								</div>
				      </li>
				      <li class="nav-item">
				      	<div class="col-3">
				        <a href="#" class="fas fa-thumbs-down"></a>
				        </div>
				      </li>
				    </ul>
				    <ul class="nav navbar-nav ml-auto">
				    	<li><a href="<?php echo site_url('portfolio/edit_artwork/'.$artwork['id']); ?>" class="btn btn-secondary">Edit</a></li>
				    </ul>	
				  </div>
				</nav>
			</div>
			
			<div class="container mt-5">
				<!-- Comment section -->
				<hr>
				<h2 align="center" class="col-12 mx-auto"><b>Comment Section</b></h2>
				<hr>
				<div class="comment-section row">
					<!-- Comment -->
					<?php foreach ($comments as $comment) : ?>
						<div class="comment col-12 mt-3 p-3" style="background: #f4f4f4 ; border-radius:25px">

								<div class="row">
									<!-- Avatar -->
									<div class="comment-avatar col-1">
										<img class="rounded img-fluid" src="https://i.imgur.com/RpzrMR2.jpg">
									</div>
									<!-- Content -->
										<div class="comment-content col-11">
											<div class="comment-author"><b><?php echo $comment['user_first_name']?>&nbsp 
											<?php echo $comment['user_last_name'] ?></b></div>
											<div class="comment-text">
												<?php echo $comment['body'] ?>
											</div>
										  <div class="comment-timestamp text-muted"><small><?php echo $comment['created_at'] ?></small></div>
										</div>
							  </div>

						</div>

					<?php endforeach; ?>

				</div>
			</div>

			<!-- Comment box -->
			<div class="comment-box p-2 my-2 mb-5">
				<div class="row">
					<div class="col-12 mx-auto">
						<textarea class="form-control" row="3" name="comment"></textarea>
						<span class="text-danger"><?php echo form_error('comment'); ?></span>
						<div class="comment-action text-right">
							<button type="submit" name="view_artwork" value="Portfolio" class="btn btn-primary btn-sm mt-3">
								Post comment
							</button>
						</div>
					</div>
				</div>
			</div>

	  </form>

	  <a href="<?php echo site_url('portfolio/user_portfolio'); ?>" class="btn btn-primary btn-md mb-3">Back</a>

	</div>

</body>


</html>    
