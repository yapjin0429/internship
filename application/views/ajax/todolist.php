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
    <h1 class="my-4" align="center">Todo List CRUD AJAX Tutorial</h1>

    <div class="container">
      <input type="text" class="form-control" id="todo">
      <button class="btn btn-primary mt-2 btn-sm" id="addTodo">Add Todo</button>

      <div class="card card-body mt-5">

        <h2>Todo Lists</h2><hr>
        <ul id="list">                
          <?php foreach ($lists as $index => $list) : ?>

            <div id="<?php echo 'nonEditable'.$list['id']; ?>">

              <li class="my-2" id="<?php echo 'todo_'.$list['id']; ?>">

                <div id="<?php echo 'content'.$list['id']; ?>"><?php echo $list['content']; ?></div>
              
                <button id="<?php echo 'delBtn'.$list['id']; ?>" class="js-delete-todo btn btn-danger" data-todo="<?php echo $list['id']; ?>" ?>Delete</button>

                <button id="<?php echo 'editBtn'.$list['id']; ?>" class="js-edit-todo btn btn-warning" data-target="#<?php echo 'nonEditable'.$list['id']; ?>" data-target-2="#<?php echo 'editable'.$list['id']; ?>" ?>Edit</button>

              </li> 

            </div>

            <div id="<?php echo 'editable'.$list['id']; ?>" class="d-none">
              <li class="my-2" id="<?php echo 'todo_'.$list['id']; ?>">

                <input class="form-control col-6" id="<?php echo 'input'.$list['id']; ?>" data-todo="<?php echo $list['id']; ?>" value="<?php echo $list['content']; ?>">                

                <button class="js-cancel-todo btn btn-primary" id="<?php echo 'cancel'.$list['id']; ?>" data-todo="<?php echo $list['id']; ?>" data-target="#<?php echo 'editable'.$list['id']; ?>" data-target-2="#<?php echo 'nonEditable'.$list['id']; ?>">Cancel</button>

                <button class="js-save-todo btn btn-primary" id="<?php echo 'save'.$list['id']; ?>" data-target="#<?php echo 'editable'.$list['id']; ?>" data-target-2="#<?php echo 'nonEditable'.$list['id']; ?>" data-todo="<?php echo $list['id']; ?>" data-content="<?php echo $list['content']; ?>">Save</button>
              </li>               
            </div>
          

          <?php endforeach; ?>
        </ul>
      </div>
    </div>
 
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

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
              <div id="nonEditable${data.todoId}">
                <li class="my-2" id="todo_${data.todoId}">
                  <div id="content${data.todoId}">${data.content}</div>
                  <button id="delBtn${data.todoId}" class="js-delete-todo btn btn-danger" data-todo="${data.todoId}" data-key="value">Delete</button>
                  <button id="editBtn${data.todoId}" class="js-edit-todo btn btn-warning" data-target="#nonEditable${data.todoId}" data-target-2="#editable${data.todoId}">Edit</button>
                </li>
              </div>

              <div id="editable${data.todoId}" class="d-none">
                <li class="my-2" id="todo_${data.todoId}">
                  <input class="form-control col-6" id="input${data.todoId}" data-todo="${data.todoId}" value="${data.content}">
                  <button class="js-cancel-todo btn btn-primary" id="cancel${data.todoId}" data-todo="${data.todoId}" data-target="#editable${data.todoId}" data-target-2="#nonEditable${data.todoId}">Cancel</button>
                  <button class="js-save-todo btn btn-primary" id="save${data.todoId}" data-target="editable${data.todoId}" data-target-2="nonEditable${data.todoId}" data-todo="${data.todoId}" data-content="">Save</button>
                </li>
              </div>             
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

          $('#delBtn'+todoId).html('Deleting');
          $('#delBtn'+todoId).prop('disabled', true);
          $('#editBtn'+todoId).prop('disabled', true);

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
              //Dummy function to simulate todo deletion
              $('#todo_'+todoId).remove();
              $('#delBtn'+todoId).html('Delete');
              $('#delBtn'+todoId).prop('disabled', false); 
              $('#editBtn'+todoId).prop('disabled', false); 
              alert('item deleted');          
          })
        });

        //edit
        $('body').on('click', '.js-edit-todo', function() {

          var nonEditable = $(this).data('target');
          var editable = $(this).data('target-2');
          alert(editable);
          $(nonEditable).addClass('d-none');
          $(editable).removeClass('d-none');         
        });          

        //save todo
        $('body').on('click', '.js-save-todo', function() {

          var todoId = $(this).data('todo');
          var info = $('#input'+todoId).val();

          $('#save'+todoId).html('Saving...');
          $('#save'+todoId).prop('disabled', true);
          $('#cancel'+todoId).prop('disabled', true);
          
          $.ajax({
            //Setup options
            url: "<?php echo site_url('test/ajax/edit_todo'); ?>",
            type: "POST",
            // dataType: "json",
            data: {
              "content" : info,
              "id" : todoId
            }
          }).done(function(response)  {

            alert('data successfully edited !');

            $('#save'+todoId).html('Save');
            $('#save'+todoId).prop('disabled', false);
            $('#cancel'+todoId).prop('disabled', false);

            var editable = $(this).data('target');
            var nonEditable = $(this).data('target-2');

            $('#editable'+todoId).addClass('d-none');
            $('#nonEditable'+todoId).removeClass('d-none');

            $('#content'+todoId).html(info);


          })
        });

        //cancel
        $('body').on('click', '.js-cancel-todo', function() {

          var todoId = $(this).data('todo');
          var staticText = $('#content'+todoId).html();
          $('#input'+todoId).val(staticText);

          var editable = $(this).data('target');
          var nonEditable = $(this).data('target-2');

          $(editable).addClass('d-none');
          $(nonEditable).removeClass('d-none');
        });

              

      })
    </script>


  </body>
</html>