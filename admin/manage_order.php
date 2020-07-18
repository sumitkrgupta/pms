
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


<body style="overflow: auto;">
<?php include("includes/admin_navbar.php"); ?>


<!--#################################################################################################-->
				
		<!-- Button trigger modal -->

        <div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
			<!--Sub Nav bar-->
			<nav class="navbar">
			  	<div class="container-fluid">
			  		<ul class="nav navbar-nav">
			      		<h2 id="h">Orders Details</h2>
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
			   <li class="active">Manage Orders</li>
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
				<table id="order_details"class="table table-sm table table-hover" class="tbl">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
						    <th>No.</th>
						    <th>Invoice No.</th>
						    <th>Order Date</th>
						    <th>Supplier Name</th>
						    <th>Contact Person</th>
						    <th>Status</th>
						    <th>View Orders</th>
						    <th>Edit</th>
						    <th>Delete</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is doctor table-->
					<?php		
						$query = "SELECT o.orders_id,DATE_FORMAT(o.orders_date, '%d/%m/%Y') AS orderDate, s.supplier_name,o.supplier_contact_person,o.orders_invoice_no,o.orders_status FROM orders o inner join supplier s on o.supplier_id = s.supplier_id  ORDER BY o.orders_date DESC;";

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
						    <!-- <td><?php //echo $row['orders_id']; ?></td> -->
						    <td><?php echo $row['orders_invoice_no']; ?></td>
							<td><?php echo $row['orderDate']; ?></td>
							<td><?php echo $row['supplier_name']; ?></td>
							<td><?php echo $row['supplier_contact_person']; ?></td>
							<?php
								$status = $row['orders_status'];
								if($status==0)
								{
									$statusIs = "Not Received";
							?>
									<td><?php echo $statusIs; ?></td>
							<?php						
								}
								else
								{
									$statusIs = "Received";
							?>
									<td><?php echo $statusIs; ?></td>
							<?php				
								}
							?>
							
							<td> 
							   	<!--View Button-->
							    <button type="button" class="btn btn-secondary "><a href="view_order_item.php?id=<?php echo $row['orders_id']; ?>" class="text-white">Details</a>
							    </button>
						    </td>
							<td> 
							   	<!--EDIT Button-->
							    <button type="button" class="btn btn-success "><a href="#?id=<?php echo $row['orders_id']; ?>" class="text-white"><i class="fas fa-edit"></i>			</a>
							    </button>
						    </td>
							<td>
							  	<!--DELETE Button>-->
							    <button type="button" class="btn btn-danger "><a href="#?id=<?php echo $row['orders_id'];?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
							$msgs="No record found";
							echo $msgs;
						}
					?>
				</table>
			</div>
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
		  			/*background-color: #3f5c80;*/
		  			background-color:#1F2739;
		 			overflow: hidden;
			}
		</style>					
		<?php include ("../footer.php");?>
</body>
</html>


