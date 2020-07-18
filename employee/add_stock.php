<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?>

<!DOCTYPE html>
<html>
	<?php include "includes/admin_header.php"; ?>
<body class="bg-white">
	
	<!-- Up Navigation -->
	<nav class="navbar navbar-dark navbar-expand-md fixed-top bg-success">
	    <div class="container-fluid">
	        <a href="." class="navbar-brand mr-auto">&nbsp;<i class="fas fa-hospital-symbol"></i> UOH Health Centre</a>
	        <button type="button" class="btn btn-primary "><a href="manage_stock.php" class="text-white">View Stock</a></button>
	        <div class="navbar-nav dropdown">
	            <a class="float-right nav-link btn dropdown-toggle" data-toggle="dropdown">
	                <i class="fas fa-user"></i><span class="d-none d-sm-inline">&nbsp;&nbsp;User Name</span>
	            </a>
	            <div class="dropdown-menu">
	                <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
	                <div class="dropdown-divider"></div>
	                <a class="dropdown-item" href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a>
	            </div>
	        </div>
	    </div>
	</nav>
	<!-- body of card-->

	<br><br><br>	
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li> /		  
		  <li class="active">Add Medicine</li>
		</ol>
		<?php 
			if(isset($_SESSION['message']))
			{
		?>
			<div class="alert alert-info text-center">
				<?php echo $_SESSION['message']; ?>
			</div>
		<?php
				
				unset($_SESSION['message']);
			}
		?> 

		<div class="card">
			<div class="card-header">
				<h4 class=" text-center">Add Stocks</h4>
			</div>
			<div class="card-body">
				<form action="" method="post" autocomplete="off" id="stockform">
				  	<div class="form-row">
						<div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Medicine Name*</label><br>
					      	<input type="text" list="medicine" class="form-control" name="drug" required="" placeholder="Enter or Select Medicine">
							<datalist id="medicine">
								<?php
						     		$msg = "";
									$query = "SELECT distinct(drug_name) as drug FROM drugs";
							     	$result = mysqli_query($conn,$query);
							    ?>
							    <?php  	
							     	if($result)
							     	{
							     		while($row = mysqli_fetch_array($result))
							     		{
							   	?>
							   				<option value="<?php echo $row["drug"]; ?>"> <?php echo $row["drug"]; ?> </option>
							    <?php					
							    		}
							     	}
						     	?>
								 
							</datalist>
						</div>
						<div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Batch No.*</label>
					      	<input type="text" class="form-control"placeholder="Batch No." name="batchNo" required>
					    </div>
						<div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Medicine Categories*</label>
							<select name="mcat" required=""> 
            					<option >Select</option>
						      	<option value="Genric">Genric</option>
						      	<option value="Branded">Branded</option>
							</select>
						</div>
						<div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Medicine Type*</label>
							<select name="medicineType" required=""> 
            					<option >Select Type</option>
						      	<option value="Tablet">Tablet</option>
						      	<option value="Capsul">Capsul</option>
						      	<option value="Syrup">Syrup</option>
						      	<option value="Drop">Drop</option>
						      	<option value="Creame">Creame</option>
						      	<option value="Syringe">Syringe</option>
							</select>
						</div>
					</div>
					<br>
					<div class="form-row">
						 <div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Mfd Date *</label>
					      	<input type="Date" class="form-control" placeholder="Mfd Date" name="mfddate" required>
					    </div>
					     <div class="col-md-3 mb-3">
					     	 <label class="font-weight-bold">Exp Date *</label>
					      	<input type="Date" class="form-control" placeholder="Exp Date" name="expdate" required>
					    </div>
					     <div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">MG / Ml *</label>
					      	<input type="text" class="form-control" placeholder="Medicine Power" name="medicinePower">
					    </div>
					   
					    <div class="col-md-3 mb-3">
					    	<label class="font-weight-bold">Medicine Company Name</label><br>
						     	<?php
						     		
									$query = "SELECT company_name FROM drug_company";
							     	$result = mysqli_query($conn,$query);
							    ?>
							    	<select name="company" class="sel" required=""> 
							    	<option value="">Select Company</option>
							    <?php  	
							     	if($result)
							     	{
							     		while($row = mysqli_fetch_array($result))
							     		{
							   	?>
							   				<option value="<?php echo $row["company_name"]; ?>"> <?php echo $row["company_name"]; ?> </option>
							    <?php					
							    		}
							     	}
						     	?>
						      	    </select>	
					    </div>
					</div>
					<br>
					<div class="form-row">
						<div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Quantity *</label>
					      	<input type="text" class="form-control" placeholder="Quantity" name="quantity" id="drug_quantity" required="" value="">
					    </div>
					    
					    <div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Unit Price *</label>
					      	<input type="text" class="form-control"placeholder="Price" name="unitPrice" id="unit_price" required="" value="">
					    </div>
					     <div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Total Price</label>
					      	<input type="text" class="form-control"placeholder="Price" name="total" id="total_price"  readonly>
					      	
					    </div>
					   <div class="col-md-3 mb-3">
					      	<label class="font-weight-bold">Medicine Location</label>
					      	<input type="text" class="form-control" placeholder="Location" name="location">
					    </div>
					</div>
					<div class="form-group">
			    		<label class="font-weight-bold">Medicine Description*</label><br>
			   			<textarea id="txtArea" rows="2" class="form-control" placeholder="Drug Description" name="mds"></textarea>
					</div>

					
					<div class="container text-center">
    					<button type="Submit" class="btn btn-primary" name="submit" id="submit" onclick="javascript:return confirm('Do you want to Save ?')";>Add Medicine</button>
    					<button type="reset" class="btn btn-secondary" id="btn_reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
    				</div>	
				</form>
			</div>
		</div>
	</div>	

	<script type="text/javascript">

		
		$(document).ready(function()
		{

			$('#submit').click(function()
			{
					$.ajax(
					{
							url:"php_action/add_stock.php",
							method :"POST",
							data: $('#stockform').serialize(),
							success:function(data)
							{
								
								$('#stockform')[0].reset();
							}
					});
			});

			// Reset Button for Reset form
			$('#btn_reset').click(function()
			{
				alert("Do you Want to Reset");
				$('#stockform')[0].reset();
			});

			// Multiply unitPrice * Quantity
			$('#drug_quantity,#unit_price').keyup(function()
			{
				var total= $('#unit_price').val() * $('#drug_quantity').val();
				total = total.toFixed(2);
				$("#total_price").val(total);
			});

		});
				
	</script>

	<style type="text/css">
		body {font-family: Arial, Helvetica, 
				sans-serif;
			}
		#stockform
		{
		 	border-radius: 5px;
 			background-color: #f2f2f2;
			padding: 20px;
		}


		#medicine{
		  border: 0 !important;
		   outline: none;
		   height: 2em;
		   background:#2c3e50;
		   border-radius: 25em; 
		   width: 100%;
		  padding: 0 0 0 .5em; 
		  color: #fff; 
		  letter-spacing: .8px;
		}
	</style>
	<?php include ("../footer.php");?>

</body>
</html>
	