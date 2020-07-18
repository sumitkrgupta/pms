
<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?>
 
<?php

	$msg ="";
	if(isset($_POST['submit']))
   {
     	
		$consupName = $_POST['cpn'];
		$supName = $_POST['sn'];
		$supMobile = $_POST['smn'];
		$supEmail = $_POST['se'];
		$supAdd = $_POST['sa'];
		

     	$query = "SELECT supplier_name FROM supplier WHERE supplier_name = '$supName'";
     	$result = mysqli_query($conn,$query);
     	$count = mysqli_num_rows($result);     
      	if($count==1)
      	{
      		$msg = "Already Supplier Exists";
      		header("location: supplier.php");
      		
     	}
      	else 
      	{
      		$sql = "INSERT into supplier(contact_person_name,supplier_name,mobile_no,email,address,record_date) values('$consupName','$supName','$supMobile','$supEmail','$supAdd',now());";

            $run=mysqli_query($conn,$sql);
            if($run)
            {
              	$msg = "Supplier Added Successfully !";
              	header("location: supplier.php");
            }
              
        }
   	}
   
?>

<!DOCTYPE html>
<html lang="en">
<?php include ("includes/admin_header.php"); ?>


<body>
<?php include("includes/admin_navbar.php"); ?>


<!--#######################################################################################################################-->
		<!-- Modal for data collection -->
		<div class="modal fade" id="drugmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Supplier Details</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <form action="" method="post">
			            <div class="modal-body">
							
							<div class="form-group">
							    <label>Supplier Name*</label>
							    <input type="text" class="form-control" placeholder="Supplier Name" name="sn" required>
							</div>
							<div class="form-group">
							    <label>Contact Person Name</label>
							    <input type="text" class="form-control" placeholder="Contact Person" name="cpn" required>
							</div>
							
							<div class="form-group">
							    <label>Mobile Number</label>
							    <input type="text" class="form-control" placeholder="Mobile" name="smn" required="">
							</div>
							<div class="form-group">
							    <label>Email*</label>
							    <input type="text" class="form-control" placeholder="Email" name="se" required>
							</div>
							
							<div class="form-group">
							    <label>Address</label>
							    <input type="text" class="form-control" placeholder="Address" name="sa" required="">
							</div>
							
							
						</div>		
						<div class="modal-footer">
				            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				            <button type="Submit" class="btn btn-primary" name="submit">Add</button>
			            </div>
			        </form>
			    </div>
			</div>
	    </div>


<!--################################################################################################################-->	
				<!-- card body-->
				<!-- Button trigger modal -->

		       <div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
					<!--Sub Nav bar-->
					<nav class="navbar">
					  	<div class="container-fluid">
					  		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#drugmodal">
								<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Suuplier
							</button>
							<ul class="nav navbar-nav">
					      		<h2 id="h">Supplier Record</h2>
					    	</ul>
							<!-- <ul class="nav navbar-nav">
					      		<h2>DRUGS LIST</h2>
					    	</ul> -->
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
				<li class="active">Supplier</li>
				</ol>
				<div class="tbl-content">		
					<table id="drugTable"class="table table-sm table table-hover">
						<!--table Heading-->
						<thead class="badge-danger">
							<tr>
							    <th>No.</th>
							    <th>Supplier Name</th>
							    <th>Person Name</th>
							    <th>Mobile</th>
						        <th>Email</th>
						        <th>Record Date</th>
						        <th>Address</th>
						        <th>Edit</th>
						        <th>Delete</th>
						    </tr>
						</thead>

						<!--For each data fatch from database table i.e is add_drugs table-->
						<?php		
								
							$query = "SELECT supplier_id,contact_person_name,supplier_name,mobile_no,email,DATE_FORMAT(record_date, '%d/%m/%Y') AS doj,address FROM supplier ORDER BY supplier_name ASC;";
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
							    <!-- <td><?php echo $row['supplier_id']; ?></td> -->
							  	<td><?php echo $row['supplier_name']; ?></td>
								<td><?php echo $row['contact_person_name']; ?></td>
								<td><?php echo $row['mobile_no']; ?></td>
								<td><?php echo $row['email']; ?></td>
								<td><?php echo $row['doj']; ?></td>
								<td><?php echo $row['address']; ?></td>
								
								<td> 
								   	<!--EDIT Button-->
								    <button type="button" class="btn btn-success "><a href="edit_supplier.php?id=<?php echo $row['supplier_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
								    </button>
							    </td>
							    <td>
								  	<!--DELETE Button>-->
								    <button type="button" class="btn btn-danger "><a href="php_action/delete_supplier.php?id=<?php echo $row['supplier_id'];?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
		</style>			
		<?php include ("../footer.php");?>		

</body>
</html>


