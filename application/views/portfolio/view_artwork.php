<!DOCTYPE html>
<html>

<head>
	<title>ArtWork Detail</title>
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

	<!-- Latest BS 4.4 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" 
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>

	<div class="container">

		<div class="jumbotron">
      <h1><?php echo $artwork['artwork_title'] ?></h1>
      <p><?php echo $artwork['artwork_description'] ?></p>
    </div>

    <!-- <form class="form-horizontal" method="post" action="<?php echo site_url('portfolio/view_artwork/'.$artwork['id']); ?>"> -->

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
				<div id="comments" class="comment-section row">
					<!-- Comment -->
					<?php foreach ($comments as $comment) : ?>

						<!-- <div id="<?php echo 'nonEditable_'.$comment['id']; ?>"> -->

							<div  id="<?php echo 'ne_comment_'.$comment['id']; ?>" class="comment col-12 mt-3 p-3" style="background: #f4f4f4 ; border-radius:25px">

									<div class="row">
										<!-- Avatar -->
										<div class="comment-avatar col-1">
											<img class="rounded img-fluid" src="https://i.imgur.com/RpzrMR2.jpg">
										</div>
										<!-- Content -->
											<div class="comment-content col-11">
												<div class="comment-author"><b><?php echo $comment['user_first_name']?>&nbsp 
												<?php echo $comment['user_last_name'] ?></b></div>
												<div id="<?php echo 'content_'.$comment['id']; ?>" class="comment-text">
													<?php echo $comment['body'] ?>
												</div>
											  <div class="comment-timestamp text-muted"><small><?php echo $comment['created_at'] ?></small></div>

											  <div class="row">
													&nbsp&nbsp&nbsp
												  <div id="<?php echo 'delBtn_'.$comment['id']; ?>" class="js-delete-comment" data-id="<?php echo $comment['id']; ?>">
												  	<a href="#"><small>Delete</small></a>
												  </div>
												  &nbsp|&nbsp
												  <div id="<?php echo 'editBtn_'.$comment['id']; ?>" class="js-edit-comment" data-id="<?php echo $comment['id']; ?>">
												  	<a href="#"><small>Edit</small></a>
												  </div>	

											  </div>

											</div>
								  </div>

							</div>
						<!-- </div> -->

						<!-- <div id="<?php echo 'editable_'.$comment['id']; ?>"> -->

							<div  id="<?php echo 'e_comment_'.$comment['id']; ?>" class="comment col-12 mt-3 p-3" style="background: #f4f4f4 ; border-radius:25px">

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
													<input class="form-control col-6" id="<?php echo 'input_'.$comment['id']; ?>" data-id="<?php echo $comment['id']; ?>" value="<?php echo $comment['body']; ?>">
												</div>
											  <div class="comment-timestamp text-muted"><small><?php echo $comment['created_at'] ?></small></div>

											  <div class="row">
													&nbsp&nbsp&nbsp
												  <div id="<?php echo 'cancelBtn_'.$comment['id']; ?>" class="js-cancel-comment" data-id="<?php echo $comment['id']; ?>">
												  	<a href="#"><small>Cancel</small></a>
												  </div>
												  &nbsp|&nbsp
												  <div id="<?php echo 'saveBtn_'.$comment['id']; ?>" class="js-save-comment" data-id="<?php echo $comment['id']; ?>">
												  	<a href="#"><small>Save</small></a>
												  </div>	

											  </div>

											</div>
								  </div>

							</div>
						<!-- </div> -->

					<?php endforeach; ?>

				</div>
			</div>

			<!-- Comment box -->
			<div class="comment-box p-2 my-2 mb-5">
				<div class="row">
					<div class="col-12 mx-auto">
						<textarea id="commentInfo" class="form-control" row="3" name="comment"></textarea>
						<span class="text-danger"><?php echo form_error('comment'); ?></span>
						<div class="comment-action text-right">
<!-- 							<button type="submit" name="view_artwork" value="Portfolio" class="btn btn-primary btn-sm mt-3">
								Post comment
							</button> -->
							<button id="addCommentBtn" class="btn btn-primary btn-sm mt-3">
								Post
							</button>
						</div>
					</div>
				</div>
			</div>

	  <!-- </form> -->

	  <a href="<?php echo site_url('portfolio/user_portfolio'); ?>" class="btn btn-primary btn-md mb-3">Back</a>

	</div>

	<script>
		$('#addCommentBtn').click(function() {
			$('#addCommentBtn').html('Inserting...');
			$('#addCommentBtn').prop('disabled', true);

			var comment = $('#commentInfo').val();
			var commentList = $('#comments');

    	$.ajax({
            //Setup options
            url: "<?php echo site_url('test/ajax/add_comment/'.$artwork['id']); ?>",
            type: "POST",
            // dataType: "json",
            data: {
              "comment" : comment
            }
      }).done(function(response) {
      	var data = JSON.parse(response);
        console.log(data);

        var html = `
          <div id="nonEditable_${data.id}">
					 <div id="comment_${data.id}" class="comment col-12 mt-3 p-3" style="background: #f4f4f4 ; border-radius:25px">

							<div class="row">
								<!-- Avatar -->
								<div class="comment-avatar col-1">
									<img class="rounded img-fluid" src="https://i.imgur.com/RpzrMR2.jpg">
								</div>
								<!-- Content -->
									<div class="comment-content col-11">
										<div class="comment-author"><b>${data.userFirstName}&nbsp 
										${data.userLastName}</b></div>
										<div class="comment-text">
											${data.content}
										</div>
									  <div class="comment-timestamp text-muted"><small>${data.createdAt}</small></div>
									  <div class="row">
												&nbsp&nbsp&nbsp
											  <div id="delBtn_.${data.id}" class="js-delete-comment" data-id="${data.id}">
											  	<a href="#"><small>Delete</small></a>
											  </div>
											  &nbsp|&nbsp
											  <div id="editBtn_.${data.id}" class="js-edit-comment" data-id="${data.id}">
											  	<a href="#"><small>Edit</small></a>
											  </div>	

									  </div>
									</div>
						  </div>
					 </div>
				  </div>

				  <div id="editable_${data.id}">
						<div  id="e_comment_${data.id}" class="comment col-12 mt-3 p-3" style="background: #f4f4f4 ; border-radius:25px">

									<div class="row">
										<!-- Avatar -->
										<div class="comment-avatar col-1">
											<img class="rounded img-fluid" src="https://i.imgur.com/RpzrMR2.jpg">
										</div>
										<!-- Content -->
											<div class="comment-content col-11">
												<div class="comment-author"><b>${data.userFirstName}&nbsp 
												${data.userLastName}</b></div>
												<div class="comment-text">
													<input class="form-control col-6" id="input_${data.id}; ?>" data-id="${data.id}" value="${data.content}">
												</div>
											  <div class="comment-timestamp text-muted"><small><?php echo $comment['created_at'] ?></small></div>

											  <div class="row">
													&nbsp&nbsp&nbsp
												  <div id="<?php echo 'cancelBtn_'.$comment['id']; ?>" class="js-cancel-comment" data-id="${data.id}">
												  	<a href="#"><small>Cancel</small></a>
												  </div>
												  &nbsp|&nbsp
												  <div id="<?php echo 'saveBtn_'.$comment['id']; ?>" class="js-save-comment" data-id="${data.id}">
												  	<a href="#"><small>Save</small></a>
												  </div>	

											  </div>

											</div>
								  </div>
						</div>
				 	</div>
					`;
					commentList.append(html);

					$('#addCommentBtn').html('Post');
					$('#addCommentBtn').prop('disabled', false);
      })
    });

    $('body').on('click', '.js-delete-comment', function() {
    	var id = $(this).data('id');
    	
      $('#delBtn'+id).html('Deleting');
      $('#delBtn'+id).prop('disabled', true);


      $.ajax({
        //Setup options
        url: "<?php echo site_url('test/ajax/delete_comment'); ?>",
        type: "POST",
        // dataType: "json",
        data: {
          "id" : id
        }
      }).done(function(response){
          //Dummy function to simulate todo deletion
          $('#comment_'+id).remove();
          $('#delBtn'+id).html('Delete');
          $('#delBtn'+id).prop('disabled', false); 

          alert('comment deleted');          
      })
    });

    $('body').on('click', '.js-edit-comment', function() {

    	var id = $(this).data('id');
      var nonEditable = $('#nonEditable_'+id);
      var editable = $('#Editable_'+id);
      //alert(editable);
      $(nonEditable).addClass('d-none');
      $(editable).removeClass('d-none');  
    });

    $('body').on('click', '.js-save-comment', function() {

      var id = $(this).data('id');
      var info = $('#input_'+id).val();

      $('#saveBtn'+id).html('Saving...');
      $('#saveBtn'+id).prop('disabled', true);
      $('#cancelBtn'+id).prop('disabled', true);

    	$.ajax({
            //Setup options
            url: "<?php echo site_url('test/ajax/edit_comment'); ?>",
            type: "POST",
            // dataType: "json",
            data: {
              "comment" : info,
              "id" : id
            }
       }).done(function(response){

       	 alert('data successfully edited !');
       	 $('#saveBtn'+id).html('Save');
		     $('#saveBtn'+id).prop('disabled', false);
		     $('#cancelBtn'+id).prop('disabled', false);

		     $('#content_'+id).html(info);

       })
    });

    $('body').on('click', '.js-cancel-comment', function() {

      var id = $(this).data('id');
      var editable = $('#nonEditable_'+id);
      var nonEditable = $('#Editable_'+id);
      //alert(editable);
      $(editable).addClass('d-none');
      $(nonEditable).removeClass('d-none'); 	
    });        
	</script>

</body>


</html>    
