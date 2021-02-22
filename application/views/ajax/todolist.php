<!doctype html> 
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>

  <body>
    <h1>Hello, world!</h1>

    <div class="container">
      <input type="text" class="form-control" id="todo">
      <button class="btn btn-primary" id="addTodo">Add Todo</button>

      <div class="card card-body">
        <ul id="list"></ul>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

    <script>
      $(function(){})
    </script>


    <script>
      $(function(){

        //add todo
        $('#addTodo').click(function() {
          var note = $('#todo').val();
          var list = $('#list');
          
          //list.append('<li>'+note+'</li>');

          $.ajax({
            //Setup options
            url: "<?php echo site_url('test/ajax/add_todo'); ?>",
            type: "POST",
            // dataType: "json",
            data: {
              "todo" : note
            }
          }).done(function(response) {
            console.log(response);

            console.log(response.status);
            console.log(response.todoId);

            //To convert JSON string into JS Objects
            var data = JSON.parse(response);
            console.log(data);

            //To access JS Oject elements
            console.log(data.status);
            console.log(data.todoId);

            // ---------------------------------------
            if (data.status == 1) {
              var todoHtml = `
                <li id="todo_${data.todoId}">
                  ${data.content}
                  <button class="js-delete-todo btn btn-danger" data-todo="${data.todoId}" data-key="value">
                    Delete
                  </button>
                </li>
              `;

              list.append(todoHtml) ;            
            }
            else {
              alert('Fail to add new to do');
            }

          })
        });

        //delete todo
        $('body').on('click', '.js-delete-todo', function() {
          //$('.js-delete-todo').click(function() {
          var todoId = $(this).data('todo');

          //Dummy function to simulate todo deletion
          $('#todo_'+todoId).remove();

          //Execute AJAX to delete todo by specific id 
          $.ajax({
            //Setup options
            url: "<?php echo site_url('test/ajax/delete_todo'); ?>",
            type: "POST",
            // dataType: "json",
            data: {
              "id" : todoId
            }
          }).done(function(response){
             console.log(response);           
          })
        });

      })
    </script>


  </body>
</html>