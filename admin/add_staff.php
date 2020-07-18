
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

		<!----------------------------Modal---------------------------------->
		<div class="modal fade" id="drugmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <form action="php_action/add_staff.php" method="post">
			            <div class="modal-body">
							<div class="form-group">
							    <label>Employee ID*</label>
							    <input type="text" class="form-control" placeholder="ID" name="eid" required>
							</div>
							<div class="form-group">
							    <label>Full Name*</label>
							    <input type="text" class="form-control" placeholder="Name" name="en" required>
							</div>
							
							<div class="form-group">
							    <label>Mobile Number*</label>
							    <input type="text" class="form-control" placeholder="Mobile" name="emn" required="">
							</div>
							
							<div class="form-group">
							    <label class="font-weight-bold">Gender</label>
							    <select name="gender">
							      		<option>Select Gender</option>
							      		<option value="male">Male</option>
							      		<option value="female">Female</option>
							    </select>
							</div>
							<div class="form-group">
							    <label>Address</label>
							    <input type="text" class="form-control" placeholder="Address" name="ea" required>
							</div>
							<div class="form-group">
							    <label>Password*</label>
							    <input type="Password" class="form-control" placeholder="Password" name="pas" required>
							</div>
							<div class="form-group">
							    <label>Confirm Password*</label>
							    <input type="Password" class="form-control" placeholder="Confirm Password" name="cps" required>
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


<!--############################ Table Data ############################################################-->	
				

		<div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
			<!--Sub Nav bar-->
			<nav class="navbar">
			  	<div class="container-fluid">
			  		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#drugmodal">
						<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Employee
					</button>
					<ul class="nav navbar-nav">
			      		<h2 id="h">Employee Record</h2>
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
		<div class="col-lg-12 m-auto">
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a></li> /		  
				<li class="active">Employee</li>
			</ol>  
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
			<div class="tbl-content">	       
				<!--Display data from database-->
				<table id="drugTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
							<th>No.</th>
							<th>Reg. No</th>
							<th>Name</th>
						    <th>Mobile</th>
						    <th>Gender</th>
						    <th>Role</th>
						    <th>Date</th>
						    <th>Address</th>
						    <th>Edit</th>
						    <th>Delete</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is add_drugs table-->
					<?php		
								
						$query = "SELECT reg_id,fullname,phone,gender,role,DATE_FORMAT(join_date,'%d/%m/%Y') AS doj,address FROM employee ORDER BY fullname ASC;";
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
							    <td><?php echo $row['reg_id']; ?></td>
								<td><?php echo $row['fullname']; ?></td>
								<td><?php echo $row['phone']; ?></td>
								<td><?php echo $row['gender']; ?></td>
								<td><?php echo $row['role']; ?></td>
								<td><?php echo $row['doj']; ?></td>
								<td><?php echo $row['address']; ?></td>
								<td> 
								   	<!--EDIT Button-->
								    <button type="button" class="btn btn-success "><a href="edit_staff.php?id=<?php echo $row['reg_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
								    </button>
							    </td>

									
								        
								<td>
								  	<!--DELETE Button>-->
								    <button type="button" class="btn btn-danger "><a href="php_action/delete_staff.php?id=<?php echo $row['reg_id'];?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
				let td = tr[i].getElementsByTagName('td')[2];
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

