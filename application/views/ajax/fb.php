<!DOCTYPE html>
<html>
<head>

  <title>FB Basic Info</title>

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body>

	<div class="jumbotron">
    <div class="container">
      <h1>FB Basic Info</h1>
      <p>Edit User Info Personal Information</p>
    </div>
  </div>

  <div class="container">

      <div class="card p-4 shadow">

  			<div class="row">

  				<div class="col-1">
  				  <h1 class="far fa-male"></h1>
  			  </div> 

    			<div class="col-5">

            <div id="genderNonEditable">
              <div id="genderText" class="lead"><?php echo $fb['gender'];?></div>
              <small class="text-muted">Gender</small>
            </div>

            <div id="genderEditable" class="d-none">
              <input id="gender" class="form-control" value="<?php echo $fb['gender'];?>">
            </div>

    			</div>

          <div class="col-6 ml-auto text-right">

            <button class="btn btn-light" id="editGenderBtn">
              <i class="fal fa-pen"></i>
            </button>

            <button class="btn btn-primary d-none" id="cancelGenderBtn">Cancel</button>
            <button class="btn btn-primary d-none" id="saveGenderBtn">Save</button>
            
          </div>
  			</div>

        <br>

        <div class="row">

          <div class="col-1">
            <h1 class="fas fa-birthday-cake"></h1>
          </div> 

          <div class="col-5">
            <input type="text" class="form-control" id="birthdate" value="<?php echo $fb['birthdate'];?>"/>
            &nbsp<small class="text-muted">Birth Date</small>
          </div>

          <div class="col-1 ml-auto">
            <h2 class="fal fa-pen" id="editBirthdate"></h2>
          </div>
        </div>

        <br>

        <div class="row">

          <div class="col-1">
            <h1 class="fas fa-"></h1>
          </div> 

          <div class="col-5">
            <input type="text" class="form-control" id="birthyear" value="<?php echo $fb['birthyear'];?>"/>
            &nbsp<small class="text-muted">Birth Year</small>
          </div>

          <div class="col-1 ml-auto">
            <h2 class="fal fa-pen" id="editBirthyear"></h2>
          </div>
        </div>

        <br>

        <div class="row">

          <div class="col-1">
            <h1 class="fas fa-comment-alt"></h1>
          </div> 

          <div class="col-5">
            <input type="text" class="form-control" id="languages" value="<?php echo $fb['languages'];?>"/>
            &nbsp<small class="text-muted">Languages</small>
          </div>

          <div class="col-1 ml-auto">
            <h2 class="fal fa-pen" id="editLanguages"></h2>
          </div>
        </div> 

        <br>

        <div class="row">

          <div class="col-1">
            <h1 class="far fa-female"></h1>
          </div> 

          <div class="col-5">
            <input type="text" class="form-control" id="interested" value="<?php echo $fb['interested'];?>"/>
            &nbsp<small class="text-muted">Interest In</small>
          </div>

          <div class="col-1 ml-auto">
            <h2 class="fal fa-pen" id="editInterested"></h2>
          </div>
        </div>         
      </div>

  </div>

  <script>

    $(function(){

      //edit info
      $('#editGenderBtn').click(function() { 

        $('#genderNonEditable').addClass('d-none');
        $('#genderEditable').removeClass('d-none');

        $('#cancelGenderBtn, #saveGenderBtn').removeClass('d-none');

        //#editGenderBtn or (this)
        $('#editGenderBtn').addClass('d-none');
      });

      $('#cancelGenderBtn').click(function() { 

        $('#genderNonEditable').removeClass('d-none');
        $('#genderEditable').addClass('d-none');

        $('#cancelGenderBtn, #saveGenderBtn').addClass('d-none');

        //#editGenderBtn or (this)
        $('#editGenderBtn').removeClass('d-none');

        var staticText = $('#genderText').html();
        $('#gender').val(staticText);
      });

      $('#saveGenderBtn').click(function() {

        var info = $('#gender').val();

        $('#saveGenderBtn').html('Saving...');
        $('#saveGenderBtn').prop('disabled', true);
        $('#cancelGenderBtn').prop('disabled', true);

        $.ajax({
          //Setup options
          url: "<?php echo site_url('test/ajax/edit'); ?>",
          type: "POST",
          // dataType: "json",
          data: {
            "gender" : info
          }
        }).done(function(response) {

          $('#genderNonEditable').removeClass('d-none');
          $('#genderEditable').addClass('d-none');

          $('#cancelGenderBtn, #saveGenderBtn').addClass('d-none');

           //#editGenderBtn or (this)
          $('#editGenderBtn').removeClass('d-none');

          var inputText = $('#gender').val();
          $('#genderText').html(inputText);

          $('#saveGenderBtn').html('Save');
          $('#saveGenderBtn').prop('disabled', false);
          $('#cancelGenderBtn').prop('disabled', false);
        })

      });            

      $('#editBirthdate').click(function() {

        var info = $('#birthdate').val();
        $.ajax({
          //Setup options
          url: "<?php echo site_url('test/ajax/edit'); ?>",
          type: "POST",
          // dataType: "json",
          data: {
            "birthdate" : info
          }
        }).done(function(response)  {
          alert('Info Updated !');
        })
      });

      $('#editBirthyear').click(function() {

        var info = $('#birthyear').val();
        $.ajax({
          //Setup options
          url: "<?php echo site_url('test/ajax/edit'); ?>",
          type: "POST",
          // dataType: "json",
          data: {
            "birthyear" : info
          }
        }).done(function(response)  {
          alert('Info Updated !');
        })
      });

      $('#editLanguages').click(function() {

        var info = $('#languages').val();
        $.ajax({
          //Setup options
          url: "<?php echo site_url('test/ajax/edit'); ?>",
          type: "POST",
          // dataType: "json",
          data: {
            "languages" : info
          }
        }).done(function(response)  {
          alert('Info Updated !');
        })
      });

      $('#editInterested').click(function() {

        var info = $('#interested').val();
        $.ajax({
          //Setup options
          url: "<?php echo site_url('test/ajax/edit'); ?>",
          type: "POST",
          // dataType: "json",
          data: {
            "interested" : info
          }
        }).done(function(response)  {
          alert('Info Updated !');
        })
      });                        
    })

  </script>  

</body>
</html>
