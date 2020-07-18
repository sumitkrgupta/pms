
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


<!--#################################################################################################-->
				
		

        <div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
			<!--Sub Nav bar-->
			<nav class="navbar">
			  	<div class="container-fluid">
			  		<?php
			  			If(isset($_GET['id']) && !empty($_GET['id']))
			  			{
			  				$id = mysqli_real_escape_string($conn,$_GET['id']);
			  				$query = "SELECT p_reg_id,patient_invoice_no from prescribe where prescribe_id = '$id'";
			  				$run = mysqli_query($conn,$query);
			  				while($row = mysqli_fetch_array($run))
			  				{
			  		?>	
			  					<h3 class="text-white">Reg- <?php echo $row['p_reg_id']; ?></h3>
			  					<h3 class="text-white">Invoice:- <?php echo $row['patient_invoice_no']; ?></h3>
			  		<?php					
			  				}
			  			}
			  		?>
			  		<ul>
			    		<div class='input-group' id="in">
			    			<input class="form-control form-control-sm ml-3 w-75"  type="text" placeholder="Search" name="" id="search" onkeyup="searchfun()"  aria-label="Search">
  						</div>	
			  		</ul>
			 	</div>
			</nav>
		</div> 
		<!--Display data from database-->
		<div class="col-lg-12 m-auto"> 
			<ol class="breadcrumb">
			  	<li><a href="index.php">Home</a></li> / 	  
			  	<li><a href="patients_drug_details.php">Medicine Patients Details</a></li> /
			  	<li class="active text-muted">Prescribe Drugs</li>
			</ol>
			<div class="tbl-content">			
				<table id="order_details"class="table table-sm table table-hover" class="tbl">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
						    <th>No.</th>
						   	<th>Medicine Name</th>
						   	<th>Batch No.</th>
						    <th>Order Quantity</th>
						    <th>Ml/MG</th>
						    <th>Manufacturer Name</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is doctor table-->
					<?php	
						If(isset($_GET['id']) && !empty($_GET['id']))
						{
							$id = mysqli_real_escape_string($conn,$_GET['id']);
							$query = "SELECT d.drug_name,d.batch_no,i.quantity,d.power_ml,c.company_name from prescribe p inner join prescribe_item i on p.prescribe_id = i.prescribe_id inner join drugs d on i.drug_name_id = d.drug_name_id inner join drug_company c on d.company_id = c.company_id where i.prescribe_id= '$id' ";

							$run = mysqli_query($conn,$query);
						}
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
						   	<td><?php echo $row['drug_name']; ?></td>
							<td><?php echo $row['batch_no']; ?></td>
							<td><?php echo $row['quantity']; ?></td>
							<td><?php echo $row['power_ml']; ?></td>
							<td><?php echo $row['company_name']; ?></td>
						</tr>
					</tbody>
					<?php	
								$counter++;		
							}

						}
						else
						{
							$_SESSION['message'] = 'No Record Found !';
							// echo("Error description: " . mysqli_error($conn));
						}
					?>
				</table>
			</div>
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
		</div>		

		<!------ THIS SEARCH FUNCTION--------->		
		<script type="text/javascript">				
			const searchfun = () =>{
			let filter =document.getElementById('search').value.toUpperCase();
			let order_details=document.getElementById('order_details');
			let tr = order_details.getElementsByTagName("tr");

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
			body {
		 			 font-family: 'Open Sans', sans-serif;
		  			font-weight: 300;
		  			line-height: 1.42em;
		  			color:#A7A1AE;
		  			background-color: #1F2739;
		  			/*background-color:#1F2739;*/
		 			overflow: hidden;
			}
		</style>	
		<?php include ("../footer.php");?>				

</body>
</html>


