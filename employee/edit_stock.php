<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?>
<?php 
	// If(isset($_GET['id']))
	// {
	// 		$id = $_GET['id'];
			
	// 		$query = "SELECT * FROM drugs_stocks where drug_name_id = $id;";
	// 		$result = mysqli_query($conn,$query);
	// 		$result_set = mysqli_fetch_row($result);

	// 		$batchN =  $result_set[1];
	// 		$drugName= $result_set[2];
	// 		$drugCat=  $result_set[3];
	// 		$drugType= $result_set[4];
	// 		$mfdDate = $result_set[5];
	// 		$expDate = $result_set[6];
	// 		$unitPrice = $result_set[7];
	// 		$drugPower = $result_set[8];
	// 		$drugQuantity = $result_set[9];
	// 		$CompanyName= $result_set[10];
	// 		$drugDes =  $result_set[11];
	// 		$drugLocation = $result_set[12];
	// }

	if(isset($_POST['updatedata']) && $_GET['id']!='')
	{

		$id =  mysqli_real_escape_string($conn,$_GET['id']);

		$drug_Name 		= $_POST['drug'];
		$batchN 		= $_POST['batchNo'];
		$drug_cat 		= $_POST['mcat'];
		$drug_type 		= $_POST['medicineType'];
		$mfdDate 		= $_POST['mfddate'];
		$expDate 		= $_POST['expdate'];
		$drugPower 		= $_POST['medicinePower'];
		$drugCompany	= $_POST['company'];
		$drugLocation 	= $_POST['location'];
		$drugDes 		= $_POST['mds'];


		$drugQuantity 	= $_POST['quantity'];
		$unitPrice 		= $_POST['unitPrice'];
		$total_price 	= $_POST['total'];
		$recivedID 		= $_SESSION['recived_id'];



		$query = "UPDATE drugs SET drug_name ='$drug_Name',batch_no ='$batchN',drug_categories='$drug_cat',drug_type='$drug_type',mfd_date ='$mfdDate',exp_date='$expDate',unit_price='$UunitPrice',drug_power='$UdrugPower',drug_quantity='$UdrugQuantity',mfd_company_name='$UCompanyName',drug_description='$UdrugDes',drug_location='$UdrugLocation' WHERE drug_name_id=$id; ";


		//$query = "UPDATE drug_name_id,d.drug_name,d.drug_categories,d.drug_description,d.batch_no,d.drug_type,DATE_FORMAT(d.mfd_date, '%d/%m/%Y') AS mfd,DATE_FORMAT(d.exp_date, '%d/%m/%Y') AS exp,d.power_ml,d.drug_location,s.supply_quantity,s.unit_price,s.unit_total_price,DATEDIFF(d.exp_date,NOW()) AS days FROM drugs d inner join supply s ON d.drug_name_id = s.drug_name_id ORDER BY d.drug_name ASC;";
		$result = mysqli_query($conn,$query);

		
		if($result)
		{
			header('Location:view_stock.php?msg=update');
		}
		else
		{
			echo'<script>alert("Data not update");</script>';
			/*header('Location:Add_Drugs.php');*/
		}
 
	}
?>

<?php include ("includes/db.php");?>



<!DOCTYPE html>
<html>
	<?php include "includes/admin_header.php"; ?>
<body class="bg-white">
	
	<!-- Up Navigation -->
	<nav class="navbar navbar-dark navbar-expand-md fixed-top bg-success">
	    <div class="container-fluid">
	        <a href="." class="navbar-brand mr-auto">&nbsp;<i class="fas fa-hospital-symbol"></i> UOH Health Centre</a>
	        <div class="navbar-nav dropdown">
	            <a class="float-right nav-link btn dropdown-toggle" data-toggle="dropdown">
	                <i class="fas fa-user"></i><span class="d-none d-sm-inline">&nbsp;&nbsp;User Name</span>
	            </a>
	            <div class="dropdown-menu">
	                <a class="dropdown-item" href="#"><i class="fas fa-user"></i> Profile</a>
	                <div class="dropdown-divider"></div>
	                <a class="dropdown-item" href="logout.php"><i class="fa fa-fw fa-power-off"></i> Logout</a>
	            </div>
	        </div>
	    </div>
	</nav>
	<!-- body of card-->

	<br><br><br>	
	<div class="col-md-12">
		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>/
		  	<li><a href="add_stock.php">Manage Stock</a></li>/
		  	<li>Edit Medicine</li>
		</ol>
		<div class="card">
			<div class="card-header">
				<h4 class=" text-center">Edit Medicine</h4>
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
									$query = "SELECT drug_name FROM drugs";
							     	$result = mysqli_query($conn,$query);
							    ?>
							    <?php  	
							     	if($result)
							     	{
							     		while($row = mysqli_fetch_array($result))
							     		{
							   	?>
							   				<option value="<?php echo $row["drug_name"]; ?>"> <?php echo $row["drug_name"]; ?> </option>
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
					      	<input type="text" class="form-control"placeholder="Price" name="total" id="total_price"  value="">
					      	
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
    					<button type="Submit" class="btn btn-primary" name="submit" id="submit">Add Medicine</button>
    					<button type="reset" class="btn btn-secondary" id="btn_reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
    				</div>	
				</form>
			</div>
		</div>
	</div>	

	<script type="text/javascript">

		
		$(document).ready(function(){

			$('#submit').click(function(){
					$.ajax({
							url:"php_action/add_stock.php",
							method :"POST",
							data: $('#stockform').serialize(),
							success:function(data)
							{
								// alert(data);
								$('#stockform')[0].reset();
							}
					});
				});

				$('#btn_reset').click(function(){
					alert("Do you Want to Reset");
					$('#stockform')[0].reset();
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


</body>
</html>
	