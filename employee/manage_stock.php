
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


<body>
<?php include("includes/admin_navbar.php"); ?>

		

<!--############################ Table Data ############################################################-->	
				

	<div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
		<!--Sub Nav bar-->
		<nav class="navbar">
		  	<div class="container-fluid">
		  		
				<button type="button" class="btn btn-primary "><a href="add_stock.php" class="text-white"><i class="fas fa-plus"></i>&nbsp;Add</a>
				</button>
				<ul class="nav navbar-nav">
		      		<h2 id="h">DRUGS LIST</h2>
		    	</ul>
				<ul>
		    		<div class='input-group' id="in">
		    			<input class="form-control form-control-sm ml-3 w-75"  type="text" placeholder="Search" name="" id="search" onkeyup="searchfun()"  aria-label="Search">
					</div>	
		  		</ul>
		 	</div>
		</nav>
	</div> 

	<div class="col-lg-12 m-auto"> 
		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li> /		  
			<li class="active">Drugs</li>
		</ol> 
		
		<div class="tbl-content">
			<div class="table-responsive">
				<!--Display data from database-->
				<table id="drugTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
							<th>No.</th>
							<th>Medicine Name</th>
							<th>Batch No.</th>
							<th>Quantity</th>
							<th>Company</th>
							<th>Category</th>
							<th>Desc</th>
							<th>Type</th>
							<th>MFD. Date</th>
							<th>EXP. Date</th>
							<th>Days</th>
							<th>MG/ML</th>
							<th>Location</th>
							<th>Unit Price</th>
							<th>Total Price</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is add_drugs table-->
					<?php		
						date_default_timezone_set('Asia/Kolkata');

						$query = "SELECT d.drug_name_id,d.drug_name,d.drug_categories,d.drug_description,d.batch_no,d.drug_type,DATE_FORMAT(d.mfd_date, '%d/%m/%Y') AS mfd,DATE_FORMAT(d.exp_date, '%d/%m/%Y') AS exp,d.power_ml,d.drug_location,d.quantity,s.unit_price,s.unit_total_price,DATEDIFF(d.exp_date,NOW()) AS days,c.company_name FROM drugs d inner join supply s ON d.drug_name_id = s.drug_name_id inner join drug_company c on d.company_id = c.company_id where quantity>=1 ORDER BY d.drug_name ASC;";

						$run = mysqli_query($conn,$query);
						$counter=1;
						if($run)
						{	
							while($row = mysqli_fetch_array($run))
							{
					?>
					<!--Table body-->
					<tbody>
						<tr>
							<td><?php echo $counter; ?></td> 
							<!--<td><?php //echo $row['drug_name_id']; ?></td>-->
							<td><?php echo $row['drug_name']; ?></td>
							<td><?php echo $row['batch_no']; ?></td>
							<td><?php echo $row['quantity']; ?></td>
							<td><?php echo $row['company_name']; ?></td>
							<td><?php echo $row['drug_categories']; ?></td>
							<td><?php echo $row['drug_description']; ?></td>
							<td><?php echo $row['drug_type']; ?></td>
							<td><?php echo $row['mfd']; ?></td>
							<td><?php echo $row['exp']; ?></td>
								<?php
										$days_to_expire=$row['days'];

						     			if($days_to_expire<=2)
										{
											$msg="Expired";
								?>				
											<td><button class="button" style="background-color: #cc3232;"><strong><?php echo $msg; ?></strong></button></td>
								<?php			
										}
										else if($days_to_expire>=3 && $days_to_expire<=30)
										{
											$msg="Expire in "." ".$days_to_expire ." "."Days";
								?>
											<td><button class="button" style="background-color: #FF7800;"><strong><?php echo $msg; ?></strong></button></td>
								<?php					
										}
										else if ($days_to_expire>=31)
										{
											$msg=$days_to_expire ." "."Left";
								?>	
											<td><button class="button" style="background-color: #4CAF50;"><strong><?php echo $msg; ?></strong></button></td>
								<?php					
											
										}
								?>
							<td><?php echo $row['power_ml']; ?></td>
							<td><?php echo $row['drug_location']; ?></td>
							<td><?php echo $row['unit_price']; ?></td>
							<td><?php echo $row['unit_total_price']; ?></td>
							<td>
								<!--EDIT Button-->
								<button type="button" class="btn btn-success "><a href="edit_stock.php?id=<?php echo $row['drug_name_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
								</button>
							</td>
							<td>
								<button type="button" class="btn btn-danger "><a href="#?id=<?php echo $row['drug_name_id']; ?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
								</button>
							</td>
						</tr>
					</tbody>
					<?php	
								$counter++;		
							}

						}
						else
						{
							echo "No record found";
						}
					?>
				</table>
			</div>	
		</div>
	</div>	

		<!------ THIS SEARCH FUNCTION--------->		
		<script type="text/javascript">				
			const searchfun = () =>{
			let filter =document.getElementById('search').value.toUpperCase();
			let drugTable=document.getElementById('drugTable');
			let tr = drugTable.getElementsByTagName("tr");

			for(var i=0;i<tr.length;i++)
			{
				let td = tr[i].getElementsByTagName('td')[1];
				if(td)
				{
					let textvalue = td.textContent || td.innerHTML;
					if(textvalue.toUpperCase().indexOf(filter) > -1)
					{
						tr[i].style.display = "";
					}
					else
					{
						tr[i].style.display = "none";
					}
				}	
			}

		}	
		</script>

		<!----------- Body Design ----------->

		<style type="text/css">
			@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
			body
			{
	 			font-family: 'Open Sans', sans-serif;
	  			font-weight: 300;
	  			line-height: 1.42em;
	  			color:#A7A1AE;
	  			/*background-color: #3f5c80;*/
	  			background-color:#1F2739;
	 			overflow: hidden;
			}
			.button 
			{
               border: none;
               color: white;
               /*padding: 1px 2px;*/
               text-align: center;
               text-decoration: none;
               display: inline-block;
               font-size : 12px; width: 70%; height: 40px;
               border-radius: 4px;
			}
		</style>
		<?php include ("../footer.php");?>			

</body>
</html>

