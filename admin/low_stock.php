
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


				
<!--################################################################################################################-->	
				
		<!-- Button trigger modal -->
		<div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
			<!--Sub Nav bar-->
			<nav class="navbar">
			  	<div class="container-fluid">
			  		<ul class="nav navbar-nav">
			      		<h2 id="h">Low Stock</h2>
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
			  	<li class="active">Low Stock</li>
			</ol>
			<div class="tbl-content">			
				<table id="expTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
						    <th>No.</th>
						    <th>Medicine Name</th>
						    <th>Type</th>
						    <th>MG/ML</th>
						   
						    <th>Quantity</th>
						    <th>Location</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is doctor table-->
					<?php	
						date_default_timezone_set('Asia/Kolkata');	
						
						$query = "SELECT count(drug_name_id),drug_name,drug_type,power_ml,sum(quantity) as total_quantity,drug_location from drugs where DATEDIFF(exp_date,NOW())>=2 GROUP BY drug_name,drug_type,power_ml HAVING sum(quantity)<=50";

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
						    <td><?php echo $row['drug_type']; ?></td>
						    <td><?php echo $row['power_ml']; ?></td>
						    <td><button class="button" style="background-color: #cc3232;"><strong><?php echo $row['total_quantity']; ?></strong></button></td>
						   <td><?php echo $row['drug_location']; ?></td>
						</tr>
					</tbody>
					<?php	
								$counter++;		
							}

						}
						else if($count<=0)
						{
							$GLOBALS['msg'] = "No Data Present.!";
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

			.button 
			{
	           border: none;
	           color: white;
	           /*padding: 1px 2px;*/
	           text-align: center;
	           text-decoration: none;
	           display: inline-block;
	           font-size : 12px; width: 35%; height: 30px;
	           border-radius: 4px;
			}
		</style>					

</body>
</html>


