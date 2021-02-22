<html>
<body>

	<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

  <!-- Demo 1 -->
	<!-- Element with Unique ID -->
	<input value="hello world" id="name">

	<!-- Element with same class name -->
	<input class="colors red" value="Red">
	<input class="colors green" value="Green">
	<input class="colors blue" value="Blue">

	<!--Input With same name -->
	<input name="colors" value="Red">
	<input name="colors" value="Green">
	<input name="colors" value="Blue">

	<button>Click Me</button>

  <script>
  	$(function(){
  		//Select element by unique ID
  		var idSelector = '#name';
  		$(idSelector).hide();

  		//Select elements by Class Name
  		$('.colors').val('White'); //chg the value to white

  		$('.green').val('Black');

  		//Select elements by name attribute
  		$('[name=colors]').val('BLack');

  		// //Select elements by HTML Tag
  		// $('button').fadeOut(10000);
  		// $('input').fadeOut(30000);

  	})
  </script>

	<!-- Demo 2 -->
	<div id="employees">
		<div id="emp_1" class="employee emp-director emp-male">
			Xavier
		</div>
		<div id="emp_2" class="employee emp-director emp-male">
			Kelvin
		</div>
		<div id="emp_3" class="employee emp-intern emp-male">
			Yao Jin
		</div>
		<div id="emp_4" class="employee emp-accountant emp-female">
			Kafun
		</div>
	</div>

	<input type="text" id="empName" placeholder="Name">
	<input type="text" id="empPosition" placeholder="Position">
	<input type="text" id="empGender" placeholder="Gender">

	<button id="addEmployee">Add Employee</button>
	<button id="classifyEmployee">Classify Employee</button>

  <script>
  	$(function() {
  		$('#emp_1').html('Kelvin');
  		$('#emp_2').html('Xavier');

    	$('#addEmployee').click(function() {
    		var name = $('#empName').val();
    		var pos = $('#empPosition').val();
    		var gender = $('#empGender').val();  

    		if (name =='') {
    			alert('PLease enter employee name')
    			return;
    		}  	

    		var list = $('#employees');

    		list.append('<div class="employee emp-'+pos+' emp-'+gender+'">'+name+'</div>');
    	});

    	$('#classifyEmployee').click(function() {

    		$('.emp-male').css('color', 'blue');
    		$('.emp-female').css('color', 'red');		
    		$('.emp-director').css('font-weight', 'bold');
    	});
  	})
  </script>

	<!-- Demo 3 -->

	<script>
		$(function(){
			
		})
	</script>




</body>
</html>