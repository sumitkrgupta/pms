
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
		  	<li>
		  		<a href="view_cart.php" class="badge"><span class="badge" style="font-size: 20px;"><?php echo count($_SESSION['cart']); ?> Cart <i class="fas fa-shopping-cart"></i></span></a> 
		  	</li>
		</ol>
		<div class="card">
			<div class="card-header">
				<h3 class="text-center">Medicines Details</h3>
			</div>	
			
			<div class="card-body">
			<?php 
				if(isset($_SESSION['message']))
				{
			?>
				<div class="alert alert-success">
				    <button type="button" class="close" data-dismiss="alert">&times;</button>
				    <span class="text-center">
					    <strong><span><?php echo $_SESSION['message']; ?></span></strong>
					</span>
				</div>
			<?php
				
				unset($_SESSION['message']);
				}
			?> 

			<form class="form-horizontal" method="POST" action="php_action/checkOutDrug.php" id="billingForm" autocomplete="off">
				<div class="form-row">
					<div class="col-md-4 mb-3">
						<label class="font-weight-bold" for="orderDate">Patient Registration ID*</label>
						<input type="text" class="form-control" name="regId" required placeholder="Reg No.">
					</div>
					<div class="col-md-4 mb-3">
						<label class="font-weight-bold" for="orderDate">Today Date*</label>
						<input type="Date" class="form-control" name="billingDate" required>
					</div>
					<div class="col-md-4 mb-3">
						<label class="font-weight-bold" class="col-sm-2 control-label">Doctor Name*</label>
						<?php
							$msg = "";
							$query = "SELECT doctor_name FROM doctor";
							$result = mysqli_query($conn,$query);
						?>
							<select name="doctor" class="sel" required=""> 
							<option value="">Select Doctor</option>
						<?php  	
							if($result)
							{
								while($row = mysqli_fetch_array($result))
								{
						?>
									<option value="<?php echo $row["doctor_name"]; ?>"> <?php echo $row["doctor_name"];
									?> </option>
						<?php					
								}
							}
						?>
							</select>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table" id="billingTable">
						<thead>
					  		<tr>	
								<th>No.</th>
								<th>Drug Name</th>
						     	<th>Batch No.</th>
						     	<th>Type</th>
						     	<th>Exp. Date</th>
						      	<th>MG/Ml</th>
						      	<th>Quantity</th>
						      	<th>Delete Row</th>		  			
					  		</tr>
					  	</thead>
					  	<tbody>
					  	<?php
							if(!empty($_SESSION['cart']))
							{
								$index=0;
		 						if(!isset($_SESSION['qty_array']))
		 						{
		 							$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
		 						}
								$query = "SELECT drug_name_id,drug_name,batch_no,drug_type,DATE_FORMAT(exp_date,'%d/%m/%Y') AS exp,power_ml FROM drugs WHERE drug_name_id IN (".implode(',',$_SESSION['cart']).")";
									$run = mysqli_query($conn,$query);
									$counter=1;
								if($run)
								{	
									while($row = mysqli_fetch_array($run))
									{
						?>		
										<tr>
											<td><?php echo $counter; ?></td>
											<input type="hidden" value="<?php echo $row['drug_name_id']; ?>" name="DrugId[]">
											<td><?php echo $row['drug_name']; ?></td>
											<td><?php echo $row['batch_no']; ?></td>
											<td><?php echo $row['drug_type']; ?></td>
											<td><?php echo $row['exp']; ?></td>
											<td><?php echo $row['power_ml']; ?></td>
											<td><input type="text" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_[]<?php echo $index; ?>">
											</td>
											<td>
												<button type="button" class="btn btn-danger "><a href="php_action/delete_item.php?id=<?php echo $row['drug_name_id']; ?>&index=<?php echo $index; ?>" class="text-white"><i class="fas fa-trash-alt"></i></a>
												</button>
											</td>
											
										</tr>
						<?php
										$index ++;
										$counter++;
									}
								}
							}	
							else
							{
						?>	
								<tr>		
									<div class="row">
										<div class="col-8 m-auto">
											<div class="alert alert-info text-center">
												<h3>No Item In Cart !</h3>
											</div>
										</div>
									</div>
								</tr>	
						<?php
							}	

						?>
						</tbody>
					</table>
				</div>
				<br>
				
				<div class="container text-center">
					<button type="submit" id="submit" data-loading-text="Loading..." class="btn btn-success" onclick="javascript:return confirm('Do you want to Submit?');">Sumbit</button>
					<a href="medicine_search.php" class="btn btn-primary" onclick="javascript:return confirm('Do you want to Go Back?');"> Back</a>
					<a href="php_action/clear_cart.php" class="btn btn-danger" onclick="javascript:return confirm('Do you want to Clear Cart?');"> Clear Cart</a>
				</div>
			</form>
		</div>	
	</div>

	<style type="text/css">
		
		#billingForm
		{
		 	border-radius: 5px;
 			background-color: #f2f2f2;
 			padding: 20px;
		}
		#billingTable tr:nth-child(even){background-color: #f2f2f2;}

		#billingTable tr:hover {background-color: #ddd;}

		#orderTable 
		{
		  	font-family:  Arial, Helvetica, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		  	
		}

		#billingTable td, #billingTable th 
		{
		  border: 1px solid #ddd;
		  padding: 8px;
		  color:black;
		}
		#billingTable th 
		{
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: center;
		  background-color: #4CAF50;
		  color: white;
		  font-weight: bold;
		}

	</style>

	<script type="text/javascript">
		// (document).ready(function(){

		// 		$('#submit').click(function(){
		// 			$.ajax({
		// 					url:"php_action/checkOutDrug.php",
		// 					method :"POST",
		// 					data: $('#billingForm').serialize(),
		// 					datatype:JSON,
		// 					success:function(data)
		// 					{
		// 						$('#result').html(data);
		// 					}
		// 			});
		// 		});
		// 	});
	</script>
	<?php include ("../footer.php");?>
		


</body>
</html>	