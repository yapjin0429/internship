<!DOCTYPE html>
<html>
<head>

	<title>My offers Page</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <b class="navbar-brand">Student Dashboard </b>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/student/my_jobs'); ?>">My Jobs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/student/my_offers'); ?>">My Offers</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('internship/listing/job_posting'); ?>">Job Posts</a>
            </li>      
          </ul>
          <a href="<?php echo site_url('portfolio/user_portfolio'); ?>" class="btn btn-secondary btn-xs ml-auto">Back to ArtMeet</a>       
        </div>
      </div>
    </nav>

  	<div class="jumbotron">
      <div class="container">
        <h1>My offers</h1>
        <p>Show the offer requests sent by the recruiters.</p>
      </div>
    </div>

    <div class="container">

      <?php
        if ($this->session->flashdata('message')) {
          echo '
          <div class="alert alert-success">'.$this->session->flashdata("message").'</div>
          ';
        }
      ?>    

      <?php if (! empty($userOffers)) : ?>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Company Name</th>
            <th scope="col">Job Title</th>
            <th scope="col">Offered On</th>
            <th scope="col">Action</th>                 
          </tr>
        </thead>
        <tbody>

          <?php foreach ($userOffers as $index => $userOffer) : ?>

          <tr>
            <th scope="row"><?php echo $index + 1; ?></th>
            <td><?php echo ucfirst($userOffer['companyName']); ?></td>
            <td><?php echo ucfirst($userOffer['jobTitle']); ?></td>
            <td><?php echo $userOffer['offered_on']; ?></td>
            <td>
              <?php if ($userOffer['status'] == 0) : ?>
                <a href="<?php echo site_url('internship/student/accept_offer/'.$userOffer['job_id']); ?>" class="btn btn-success btn-xs ml-auto">Accept</a>
                <a href="<?php echo site_url('internship/student/reject_offer/'.$userOffer['job_id']); ?>" class="btn btn-danger btn-xs ml-auto">Reject</a>
              <?php endif; ?>

              <?php if ($userOffer['status'] == 1) : ?>
                <a href="<?php echo site_url(''); ?>" class="btn btn-success btn-xs ml-auto disabled">Accepted</a>
              <?php endif; ?>

              <?php if ($userOffer['status'] == 2) : ?>
                <a href="<?php echo site_url(''); ?>" class="btn btn-danger btn-xs ml-auto disabled">Rejected</a>
              <?php endif; ?>

            </td>
          </tr>

          <?php endforeach; ?>
      
        </tbody>
      </table>

      <?php else : ?>

        <p>Currently No Offer Yet</p>

      <?php endif; ?> 

    </div>        
  
</body>
</html>
