
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
			  				$id = $_GET['id'];
			  				$query = "SELECT s.supplier_name,r.recive_invoice_no from supplier s inner join recive_order_details r on s.supplier_id = r.supplier_id where r.recive_id = '$id' ";
			  				$run = mysqli_query($conn,$query);
			  				while($row = mysqli_fetch_array($run))
			  				{
			  		?>	
			  					<h3 class="text-white"> Name- <?php echo $row['supplier_name']; ?></h3>
			  					<h3 class="text-white">Invoice No.- <?php echo $row['recive_invoice_no']; ?></h3>
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
			  	<li><a href="recived_invoice.php">Recived Invoice</a></li> /
			  	<li class="active text-muted">Recived List</li>
			</ol>
			<div class="tbl-content">			
				<table id="recived_item_details"class="table table-sm table table-hover" class="tbl">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
						    <th>No.</th>
						   	<th>Medicine Name</th>
						    <th>Recived Quantity</th>
						    <th>Ml/MG</th>
						    <th>Medicine Type</th>
						    <th>Unit Price</th>
						    <th>Total Price</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is doctor table-->
					<?php	
						If(isset($_GET['id']) && !empty($_GET['id']))
						{
							$id = $_GET['id'];

							$query = "SELECT d.drug_name,d.power_ml,d.drug_type,s.supply_quantity,s.unit_price,s.unit_total_price FROM drugs d inner join supply s on d.drug_name_id = s.drug_name_id where s.recive_id = '$id'";

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
						    <!-- <td><?php //echo $row['orders_id']; ?></td> -->
						   	<td><?php echo $row['drug_name']; ?></td>
							<td><?php echo $row['supply_quantity']; ?></td>
							<td><?php echo $row['power_ml']; ?></td>
							<td><?php echo $row['drug_type']; ?></td>
							<td><?php echo $row['unit_price']; ?></td>
							<td><?php echo $row['unit_total_price']; ?></td>
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
			let recived_item_details=document.getElementById('recived_item_details');
			let tr = recived_item_details.getElementsByTagName("tr");

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


