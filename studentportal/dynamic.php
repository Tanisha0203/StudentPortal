<?php
	
//index.php	

include('database_connection.php');

function fill_unit_select_box($connect)
{
	$output = '';

	$query = "SELECT * FROM unit_table ORDER BY unit_name ASC";

	$result = $connect->query($query);

	foreach($result as $row)
	{
		$output .= '<option value="'.$row["unit_name"].'">'.$row["unit_name"] . '</option>';
	}

	return $output;
}
		
?>
<?php

//insert.php

if(isset($_POST["item_name"]))
{

	include('database_connection.php');

	$order_id = uniqid();

	for($count = 0; $count < count($_POST["item_name"]); $count++)
	{

		$query = "
		INSERT INTO order_items 
        (order_id, item_name, item_quantity, item_unit) 
        VALUES (:order_id, :item_name, :item_quantity, :item_unit)
		";

		$statement = $connect->prepare($query);

		$statement->execute(
			array(
				':order_id'		=>	$order_id,
				':item_name'	=>	$_POST["item_name"][$count],
				':item_quantity'=>	$_POST["item_quantity"][$count],
				':item_unit'	=>	$_POST["item_unit"][$count]
			)
		);

	}

	$result = $statement->fetchAll();

	if(isset($result))
	{
		echo 'ok';
	}

}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Add or Remove Selectpicker Dropdown Dynamically in PHP using Ajax jQuery</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">

		<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>

		<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">Add or Remove Selectpicker Dropdown Dynamically in PHP using Ajax jQuery</h3>
			<br />
			<div class="card">
				<div class="card-header">Enter Item Details</div>
				<div class="card-body">

					<form method="post" id="insert_form">
						<div class="table-repsonsive">
							<span id="error"></span>
							<table class="table table-bordered" id="item_table">
								<tr>
									<th>Enter Item Name</th>
									<th>Enter Quantity</th>
									<th>Select Unit</th>
									<th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
								</tr>
							</table>
							<div align="center">
								<input type="submit" name="submit" id="submit_button" class="btn btn-primary" value="Insert" />
							</div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</body>
</html>
<script>

$(document).ready(function(){

	var count = 0;
	
	function add_input_field(count)
	{

		var html = '';

		html += '<tr>';

		html += '<td><input type="text" name="item_name[]" class="form-control item_name" /></td>';

		html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';

		html += '<td><select name="item_unit[]" class="form-control selectpicker" data-live-search="true"><option value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select></td>';

		var remove_button = '';

		if(count > 0)
		{
			remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button>';
		}

		html += '<td>'+remove_button+'</td></tr>';

		return html;

	}

	$('#item_table').append(add_input_field(0));

	$('.selectpicker').selectpicker('refresh');

	$(document).on('click', '.add', function(){

		count++;

		$('#item_table').append(add_input_field(count));

		$('.selectpicker').selectpicker('refresh');

	});

	$(document).on('click', '.remove', function(){

		$(this).closest('tr').remove();

	});

	$('#insert_form').on('submit', function(event){

		event.preventDefault();

		var error = '';

		count = 1;

		$('.item_name').each(function(){

			if($(this).val() == '')
			{

				error += "<li>Enter Item Name at "+count+" Row</li>";

			}

			count = count + 1;
		});
		count = 1;
		$('.item_quantity').each(function(){
			if($(this).val() == '')
			{
				error += "<li>Enter Item Quantity at "+count+" Row</li>";
			}
			count = count + 1;
		});
		count = 1;
		$("select[name='item_unit[]']").each(function(){
			if($(this).val() == '')
			{
				error += "<li>Select Unit at "+count+" Row</li>";
			}
			count = count + 1;
		});
		var form_data = $(this).serialize();
		if(error == '')
		{
			$.ajax({
				url:"insert.php",
				method:"POST",
				data:form_data,
				beforeSend:function()
	    		{
	    			$('#submit_button').attr('disabled', 'disabled');
	    		},
				success:function(data)
				{
					if(data == 'ok')
					{
						$('#item_table').find('tr:gt(0)').remove();
						$('#error').html('<div class="alert alert-success">Item Details Saved</div>');
						$('#item_table').append(add_input_field(0));
						$('.selectpicker').selectpicker('refresh');
						$('#submit_button').attr('disabled', false);
					}
				}
			})
		}
		else
		{
			$('#error').html('<div class="alert alert-danger"><ul>'+error+'</ul></div>');
        }
	});
});
</script>