
<?php include ("includes/db.php");?>
<?php
	date_default_timezone_set('Asia/Kolkata');
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


				
<!--################################################################################################################-->	
				
		<!-- Button trigger modal -->
		<div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
			<!--Sub Nav bar-->
			<nav class="navbar">
			  	<div class="container-fluid">
			  		<ul class="nav navbar-nav">
			      		<h2 id="h">Expire Medicine</h2>
			    	</ul>
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
			  	<li class="active">Expire Medicine</li>
			</ol>
			<div class="tbl-content">			
				<table id="expTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
						    <th>No.</th>
						    <th>Medicine Name</th>
						    <th>Btach No.</th>
						    <th>Medicine Type</th>
						    <th>MG/ML</th>
						    <th>Expire Date</th>
						    <th>Quantity</th>
						    <th>Location</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is doctor table-->
					<?php		
						$query = "SELECT drug_name,batch_no,drug_type,power_ml,DATE_FORMAT(exp_date, '%d/%m/%Y') AS exp,quantity,drug_location FROM drugs  where DATEDIFF(exp_date,NOW())<=2 and quantity>=1 ORDER BY drug_name ASC;";
						$run = mysqli_query($conn,$query);
						$counter=1;
						$count = mysqli_num_rows($run);
						if($count>=1)
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
						    <td><?php echo $row['drug_type']; ?></td>
						    <td><?php echo $row['power_ml']; ?></td>
						    <td><?php echo $row['exp']; ?></td>
						    <td><?php echo $row['quantity']; ?></td>
						    <td><?php echo $row['drug_location']; ?></td>
						</tr>
					</tbody>
					<?php	
								$counter++;		
							}

						}
						else if($count<=0)
						{
							$GLOBALS['msg'] = "No Expire Medicines.!";
							// echo '<span class="text-danger" class="text-center">No Expire Medicines.!</span>';
						}
					?>
					
			    </table>
			</div>	
			<div class="messages">
				<?php 
					if(isset($GLOBALS['msg'])) 
					{
						echo '<div class="alert alert-warning" role="alert"><center>'.$GLOBALS['msg'].'</center></div>';
					} 
				?>
			</div>		
		</div>		

		<!------ THIS SEARCH FUNCTION--------->		
		<script type="text/javascript">				
			const searchfun = () =>{
			let filter =document.getElementById('search').value.toUpperCase();
			let expTable=document.getElementById('expTable');
			let tr = expTable.getElementsByTagName("tr");

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
		</style>					

</body>
</html>


