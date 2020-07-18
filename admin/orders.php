<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?>

<!DOCTYPE html>
<html lang="en">

<?php include ("includes/admin_header.php"); ?>
<body class="bg-white">
<?php include("includes/admin_navbar.php"); ?>


	<br><br><br>
	<div class="col-12 m-auto">	
		<ol class="breadcrumb">
		  	<li><a href="index.php">Home</a></li> /
		  	<li>Order</li>
		</ol>
	
		<div class="card">
			<div class="card-header">
				<h5><i class="fa fa-shopping-cart" aria-hidden="true"></i> Make Order</h5>
			</div>	
			<?php 
				if(isset($_SESSION['message']))
				{
			?>
				<div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <button type="button" class="btn btn-primary "><a href="ordersInvoice.php?id=<?php echo $_SESSION['order_id']; ?>" class="text-white"><i class="fa fa-print" aria-hidden="true"></i> Print</a>
					</button>
					<span class="text-center">
					    <strong>
					       	<i class="fa fa-check" aria-hidden="true"></i>
					        <span><?php echo $_SESSION['message']; ?></span>
					    </strong>
				    </span>
				</div>
			<?php
					
					unset($_SESSION['message']);
				}
			?> 
			<div class="card-body">
				<div class="success-messages"></div> 

				<form class="form-horizontal" method="POST" action="" id="createOrderForm" autocomplete="off">
					<div class="form-row">
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold" for="orderDate">Order Date*</label>
							<input type="Date" class="form-control" name="orderDate" required>
						</div>
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold" class="col-sm-2 control-label">Supplier Name*</label>
							<?php
								$msg = "";
								$query = "SELECT supplier_name FROM supplier";
								$result = mysqli_query($conn,$query);
							?>
								<select name="supplier" class="sel" required=""> 
								<option value="">Select Supplier</option>
							<?php  	
								if($result)
								{
									while($row = mysqli_fetch_array($result))
									{
							?>
										<option value="<?php echo $row["supplier_name"]; ?>"> <?php echo $row["supplier_name"]; ?> </option>
							<?php					
									}
								}
							?>
								</select>
						</div>
						<div class="col-md-4 mb-3">
							<label class="font-weight-bold">Supplier Contact Name*</label>
							<input type="text" class="form-control" name="ContactPerson" required placeholder="Name">
						</div>
					</div>
					<br> 
					<div class="table-responsive" class="tbl-content">
						<table class="table" id="orderTable">
							<thead>
						  		<tr>	
									<th>No.</th>
							     	<th>Medicine</th>
							     	<th>Company</th>
							      	<th>Order Quantity</th>
							      	<th>MG/Ml</th>
							      	<th>Medicine Type</th>
							      	<th>Delete</th>		  			
						  		</tr>
						  	</thead>
						  	<tbody>
						  	
								<tr>
									<td style="color:black" id="num">1</td>
									<td>
										<input type="text" class="form-control" name="drug[]" placeholder="Medicine Name" required="" id="drugName">
									</td>
									<td>
										<?php
										     		
											$query = "SELECT company_name FROM drug_company";
											$result = mysqli_query($conn,$query);
										?>
											<select  class="sel" data-type="drug_company"name="dcn[]" required="" id="drugcompany"> 
											<option value="">Select</option>
										<?php  	
											if($result)
											{
											   	while($rows = mysqli_fetch_array($result))
											    {
										?>
											   		<option value="<?php echo $rows["company_name"]; ?>"> <?php echo $rows["company_name"]; ?> </option>
										<?php					
											    }
											}
										?>
										    </select>
									</td>
									
									<td><input type="text" class="form-control" name="odrquantity[]" required="" id="orderquantity" placeholder="Order Quantity"></td>	
									<td><input type="text" class="form-control" name="mgpower[]" required="" id="mgpower"
										placeholder="Mg/Ml"></td>	
									<td>
										<select name="mt[]" required="" id="drugtype"> 
												<option >Selet Type</option>
												<option value="Tablet">Tablet</option>
										      	<option value="Capsul">Capsul</option>
										      	<option value="Syrup">Syrup</option>
										      	<option value="Drop">Drop</option>
										      	<option value="Creame">Creame</option>
										      	<option value="Syringe">Syringe</option>
			                			</select>
									</td>
								</tr>
							
							</tbody>
						</table>
					</div>
					<br>
					<div class="container" align="center">
						<button type="button" class="btn btn-success"  id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus" aria-hidden="true"></i> Add Row</button>
					</div>
					<br>
					
					<div class="container text-center">
						<button type="submit" id="submit" data-loading-text="Loading..." class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Save</button>
						<button type="reset" class="btn btn-secondary" id="btn_reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
					</div>
				</form>
			</div>	
		</div>
	</div>	
<!----------------------------------------------------------------------------->
	<style type="text/css">
		
		#createOrderForm
		{
		 	border-radius: 5px;
 			background-color: #f2f2f2;
 			padding: 20px;
		}
		#orderTable tr:nth-child(even){background-color: #f2f2f2;}

		#orderTable tr:hover {background-color: #ddd;}

		#orderTable 
		{
		  	font-family:  Arial, Helvetica, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		  	
		}

		#orderTable td, #orderTable th 
		{
		  border: 1px solid #ddd;
		  padding: 8px;
		  color:black;
		}
		#orderTable th 
		{
		  padding-top: 5px;
		  padding-bottom: 8px;
		  text-align: center;
		  background-color: #4CAF50;
		  color: white;
		  font-weight: bold;
		}

	</style>



<!---------------------------------------------------------------------------------------------->



	<script type="text/javascript">
		
		$(document).ready(function()
		{
				var i=1;
				$('#addRowBtn').click(function(){
					i++;
					$('#orderTable').append('<tr id="row'+i+'"><td style="color:black" id="num">1</td> <td><input type="text" class="form-control" name="drug[]" placeholder="Medicine Name" required="" id="drugName"></td><td><?php $query = "SELECT company_name FROM drug_company";$result = mysqli_query($conn,$query);?><select  class="sel" data-type="drug_company" required="" name="dcn[]" id="drugcompany"><option value="">Select</option><?php if($result){while($rows = mysqli_fetch_array($result)){?><option value="<?php echo $rows["company_name"]; ?>"> <?php echo $rows["company_name"]; ?> </option><?php }}?> </select></td><td><input type="text" class="form-control" name="odrquantity[]" required="" id="orderquantity" placeholder="Order Quantity"></td><td><input type="text" class="form-control" name="mgpower[]" required="" id="mgpower" placeholder="Mg/Ml"></td><td><select name="mt[]" required="" id="drugtype"> <option >Selet Type</option><option value="Tablet">Tablet</option><option value="Capsul">Capsul</option><option value="Syrup">Syrup</option><option value="Drop">Drop</option><option value="Creame">Creame</option><option value="Syringe">Syringe</option></select></td><td><button type="button" class="btn btn-danger btn_remove " name="remove" id="'+i+'"><i class="fas fa-trash-alt"></i></button></td></tr>');
				});
				/* for Remove Raw from table */
				$(document).on('click','.btn_remove',function(){
					var btn_id = $(this).attr("id");
					$("#row"+btn_id+"").remove();
				});

				// Sumbit data
				$('#submit').click(function(){
					$.ajax({
							url:"php_action/ordersfile.php",
							method:"POST",
							data:$('#createOrderForm').serialize(),					
							
							success:function(data)
							{
								//alert(data);
								$('#createOrderForm')[0].reset();
							}
					});
				});

				$('#btn_reset').click(function(){
					alert("Do you Want to Reset");
					$('#createOrderForm')[0].reset();
				});

		});
	</script>

	<?php include ("../footer.php");?>
</body>
</html>



					