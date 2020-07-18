
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
<?php include ("includes/admin_header.php");?>


<body>
<?php include("includes/admin_navbar.php"); ?>

		
<!--############################ Table Data ############################################################-->	
				

		<div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
			<!--Sub Nav bar-->
			<nav class="navbar">
			  	<div class="container-fluid">
			  		
					<ul class="nav navbar-nav">
			      		<h2 id="h">patients Medicine details</h2>
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
			  <li class="active">patients Medicine details</li>
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
			<div class="tbl-content">	       
				<!--Display data from database-->
				<table id="patientsDetailsTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
							<th>No.</th>
							<th>Reg No.</th>
							<th>Name</th>
						    <th>Invoice No.</th>
						    <th>Prescribe Date</th>
						    <th>Doctor</th>
						    <th>View</th>
						    <th>Edit</th>
						    <th>Delete</th>
						</tr>
					</thead>
					<!--For each data fatch from database table i.e is add_drugs table-->
					<?php		
					
					$query = "SELECT p.prescribe_id,p.p_reg_id,p.patient_invoice_no,DATE_FORMAT(p.prescribe_date, '%d/%m/%Y') AS pDate,s.p_name,d.doctor_name FROM prescribe p inner join patients s on p.p_reg_id=s.p_reg_id inner join doctor d on d.doctor_id = p.doctor_id  ORDER BY p.prescribe_date ASC;";

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
						    <td><?php echo $row['p_reg_id']; ?></td>
						    <td><?php echo $row['p_name']; ?></td>
							<td><?php echo $row['patient_invoice_no']; ?></td>
							<td><?php echo $row['pDate']; ?></td>
							<td><?php echo $row['doctor_name']; ?></td>
							
							<td> 
							   	<!--View Button-->
							    <button type="button" class="btn btn-secondary "><a href="prescribe_item.php?id=<?php echo $row['prescribe_id']; ?>" class="text-white">View</a>
							    </button>
						    </td>
							<td> 
							   	<!--EDIT Button-->
							    <button type="button" class="btn btn-success "><a href="#?id=<?php echo $row['prescribe_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
							    </button>
						    </td>
							<td>
							  	<!--DELETE Button>-->
							    <button type="button" class="btn btn-danger "><a href="#?id=<?php echo $row['prescribe_id'];?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
							//echo("Error description: " . mysqli_error($conn));
							$_SESSION['message'] = 'No Record Found !';
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
			let patientsDetailsTable=document.getElementById('patientsDetailsTable');
			let tr = patientsDetailsTable.getElementsByTagName("tr");

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
		  			/*background-color: #3f5c80;*/
		  			background-color:#1F2739;
		 			overflow: hidden;
			}
		</style>			
		<?php include ("../footer.php");?>
</body>
</html>

