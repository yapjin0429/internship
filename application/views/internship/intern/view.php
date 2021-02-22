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
        <h1>Intern Profile</h1>
        <p>For recruiter to view the intern profile</p>
      </div>
    </div>

    <div class="container">

      <form class="form-horizontal" method="post" action="<?php echo site_url(''); ?>">
        <h3 class="mb-3">Internship profile</h3>

        <div class="card  p-3 shadow">
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
              	<?php echo $user_profile['name']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Date of Birth:</label>
              <div class="col-4">
              	<?php echo $user_profile['date_of_birth']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Contact:</label>
              <div class="col-4">
              	<?php echo $user_profile['contact']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Email:</label>
              <div class="col-4">
              	<?php echo $user_profile['email']; ?>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Institution:</label>
              <div class="col-4">
              	<?php echo $user_profile['institution']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
             <label class="control-label col-2" for="text">Program:</label>
              <div class="col-4">
              	<?php echo $user_profile['program']; ?>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Internship Period:</label>
              <div class="col-4">
                <div class="input-group">
                	<?php echo $user_profile['internship_start']; ?>
                  <div class="input-group-append">
                    &nbsp~&nbsp
                  </div>
                  <?php echo $user_profile['internship_end']; ?>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Prefer location:</label>
              <div class="col-4">
              	<?php echo $user_profile['prefer_location']; ?>
              </div>
            </div>
          </div>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Prefer allowance:</label>
              <div class="col-4">
              	<?php echo $user_profile['prefer_allowance']; ?>
              </div>
            </div>
          </div>

          <hr>

          <div class="form-group ml-3">
            <div class="row">
              <label class="control-label col-2" for="text">Resume:</label>
              <div class="col-4">
              	<a href="<?php echo $user_profile['resume']; ?>" class="btn btn-primary">Display</a>
              </div>
            </div>      
          </div>
        </div>

          <div class="form-group mt-5">
            <div class="row">
              <div class="offset-2 col-4">

                <?php if ($isOwner == true) : ?>
                <a href="<?php echo site_url('internship/student/profile/'.$user_profile['user_id']); ?>" class="btn btn-primary">Edit</a>
                <?php endif; ?>

                <?php if ($isRecruiter == true) : ?>
                  <?php if ($isSaved == true) : ?>
                    <a href="<?php echo site_url(''); ?>" class="btn btn-primary disabled">Saved</a>

                  <?php else : ?>
                  <a href="<?php echo site_url('internship/intern/save/'.$user_profile['user_id']); ?>" class="btn btn-primary">Save</a>  

                  <?php endif; ?>
                <?php endif; ?>
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Send Offer</a>
              </div>
            </div>
          </div>
   
        <div class="form-group my-5 ">
          <div class="row">
            <div class="offset-2 col-4">
              <a href="<?php echo site_url('internship/listing/interns'); ?>" class="btn btn-primary">Back</a>
            </div>
          </div>
        </div>
      </form>
      
    </div>

</body>
</html>
 
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Send Offer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php foreach ($jobs as $index => $job) : ?>

        <form class="form-horizontal" method="post" action="<?php echo site_url('internship/intern/send_offer'); ?>">

          <div class="modal-body">
            <div class="card p-4">
              <div class="row">
                <div class="col-10 ">
                  <p>Job Title : <?php echo $job['job_title']; ?></p>

                    <input type="hidden" name="company_id" value="<?php echo $job['company_id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_profile['user_id']; ?>">
                    <input type="hidden" name="job_id" value="<?php echo $job['id']; ?>">

                </div>

                <?php if ($job['isSent'] == true) : ?>
                  <a href="" class="btn btn-primary ml-auto disabled">Offer Sent</a>
                <?php else : ?>
                  <button type="submit" class="btn btn-primary ml-auto">Send Offer</button>
                <?php endif; ?>

              </div> 
            </div>
          </div>

        </form>

      <?php endforeach; ?>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
