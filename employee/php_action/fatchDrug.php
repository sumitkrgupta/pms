<?php include ("../includes/db.php"); ?>
<?php
	
	date_default_timezone_set('Asia/Kolkata');
	$output = '';

	$query = "SELECT drug_name_id,drug_name,batch_no,drug_type,power_ml,DATEDIFF(exp_date,NOW()) as days,quantity,drug_location from drugs where DATEDIFF(exp_date,NOW())>=2 and drug_name LIKE '%".$_POST['search']."%'";

	$result = mysqli_query($conn,$query);

	if(mysqli_num_rows($result)>0)
	{
		$output .= '<h3 class="text-center text-success"> Medicine Search Result </h3>';
		$output .= '<div class="tbl-content">
					<div class="table-responsive">
					
					<table class="table table-sm table-hover class="table-bordered>
					<thead class="badge-danger">
						<tr>
							<th>No.</th>
							<th>Drug Id</th>
							<th>Drug Name</th>
							<th>Batch No.
							<th>Type</th>
							<th>MG/ML</th>
							<th>Days to Expire </th>
							<th>Total Quantity</th>
							<th>Location</th>
							<th>Add to Cart</th>
							
						</tr>
					</thead>';
					$counter=1;
					while($row= mysqli_fetch_array($result))
					{
						$output .= '
									<tbody>
										<tr> 
											<td>'.$counter.'</td>
											<td>'.$row["drug_name_id"].'</td>
											<td>'.$row["drug_name"].'</td>
											<td>'.$row["batch_no"].'</td>
											<td>'.$row["drug_type"].'</td>
											<td>'.$row["power_ml"].'</td>
											<td>'.$row["days"].'</td>
											<td>'.$row["quantity"].'</td>
											<td>'.$row["drug_location"].'</td>
											<td>
												<span><a href="php_action/add_cart.php?id='.$row["drug_name_id"].' ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i>Add</a>
												</span>
											</td>
										</tr>
									</tbody>
									';
									$counter++;	
					}
					echo $output;
					
					 
	}
	else
	{
		echo '<h2 class="text-center text-light">Medicine Not Found</h2>';
	}
?>
