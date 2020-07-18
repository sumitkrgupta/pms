
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


<!--#############################################################################################################-->
		<!-- Modal for data collection -->
		<div class="modal fade" id="drugmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <form action="php_action/add_patients.php" method="post" id="Patientsform">
			            <div class="modal-body">
							<div class="form-group">
							    <label>Registration ID*</label>
							    <input type="text" class="form-control" placeholder="ID" name="RegiID" required>
							</div>
							<div class="form-group">
							    <label>Full Name*</label>
							    <input type="text" class="form-control" placeholder="Name" name="Name" required>
							</div>
							<div class="form-group">
							    <label>Mobile No*</label>
							    <input type="text" class="form-control" placeholder="Number" name="mobile" required>
							</div>
							<div class="form-group">
							    <label class="font-weight-bold">Gender</label>
							    <select name="gender">
							      		<option>Select Gender</option>
							      		<option value="Male">Male</option>
							      		<option value="Female">Female</option>
							    </select>
							</div>
							<div class="form-group">
							    <label class="font-weight-bold">Categories*</label>
							    <select name="Categories">
							      		<option>Select Categories</option>
							      		<option value="Student">Student</option>
							      		<option value="Faculty">Faculty</option>
							      		<option value="Employee">Employee</option>
							    </select>
							</div>
							<div class="form-group">
							    <label>Hostel*</label>
							    <input type="text" class="form-control" placeholder="Hostel" name="Hostel" required>
							</div>
							<div class="form-group">
							    <label>Date*</label>
							    <input type="Date" class="form-control" name="date" required>
							</div>
						</div>		
						<div class="modal-footer">
				            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				            <button type="Submit" class="btn btn-primary" name="submit" id="submit">Add</button>
			            </div>
			        </form>
			    </div>
			</div>
	    </div>


<!--################################################################################################-->	

		<!----  For Edit Modal---->
		<div class="modal fade" id="editdrugmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Add Details</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <form action="" method="post" id="">
			            <div class="modal-body">
							<div class="form-group">
							    <label>Registration ID*</label>
							    <input type="text" class="form-control" placeholder="ID" name="RegiID" required
							    id="Reg_id">
							</div>
							<div class="form-group">
							    <label>Full Name*</label>
							    <input type="text" class="form-control" placeholder="Name" name="Name" required
							    id="full_name">
							</div>
							<div class="form-group">
							    <label>Mobile No*</label>
							    <input type="text" class="form-control" placeholder="Number" name="mobile" required id="mob_num">
							</div>
							<div class="form-group">
							    <label class="font-weight-bold">Gender</label>
							    <select name="gender" id="gen">
							      		<option>Select Gender</option>
							      		<option value="Male">Male</option>
							      		<option value="Female">Female</option>
							    </select>
							</div>
							<div class="form-group">
							    <label class="font-weight-bold">Categories*</label>
							    <select name="Categories" id="cat">
							      		<option>Select Categories</option>
							      		<option value="Student">Student</option>
							      		<option value="Faculty">Faculty</option>
							      		<option value="Employee">Employee</option>
							    </select>
							</div>
							<div class="form-group">
							    <label>Hostel*</label>
							    <input type="text" class="form-control" placeholder="Hostel" name="Hostel" required id="hostel">
							</div>
							<div class="form-group">
							    <label>Date*</label>
							    <input type="Date" class="form-control" name="date" required id="date_of_record">
							</div>
						</div>		
						<div class="modal-footer">
				            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				            <button type="Submit" class="btn btn-primary" onclick="updateDetails()">Update</button>
				            <input type="hidden" name="" id="hidden_reg_id">
			            </div>
			        </form>
			    </div>
			</div>
	    </div>

<!--#########################################################################################-->
		
		<!-- Button trigger modal -->

        <div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
			<!--Sub Nav bar-->
			<nav class="navbar">
			  	<div class="container-fluid">
			  		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#drugmodal">
						<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Patients
					</button>
					<ul class="nav navbar-nav">
			      		<h2 id="h">Patients Record</h2>
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
				<li class="active">Manage Patients</li>
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
				<table id="patientsTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
						    <th>No.</th>
						    <th>Reg. No</th>
						    <th>Full Name</th>
						    <th>Mobile No</th>
						    <th>Gender</th>
						    <th>Categories</th>
						    <th>Hostel</th>
						    <th>Date</th>
						    <th>Edit</th>
						    <th>Delete</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is doctor table-->
					<?php		
							
						$query = "SELECT p_reg_id,p_name,category,hostel_name,mobile,DATE_FORMAT(record_date, '%d/%m/%Y') AS doj,gender FROM Patients ORDER BY p_name ASC;";
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
							<td><?php echo $row['mobile']; ?></td>
							<td><?php echo $row['gender']; ?></td>
							<td><?php echo $row['category']; ?></td>
							<td><?php echo $row['hostel_name']; ?></td>
							<td><?php echo $row['doj']; ?></td>
							<td> 
							   	<!--EDIT Button-->
							    <!-- <button type="button" class="btn btn-success "><a href="edit_doctor.php?id=<?php //echo $row['p_reg_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
							    </button> -->
							     <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editdrugmodal" onclick="getUserDetails('<?php echo $row['p_reg_id']; ?>')" ><i class="fas fa-edit"></i>
							    </button>
						    </td>

							<td>
							  	<!--DELETE Button>-->
							    <button type="button" class="btn btn-danger "><a href="php_action/delete_patients.php?id=<?php echo $row['p_reg_id'];?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
							echo $msg;
						}
					?>
					
			    </table>
			</div>
		</div>

		<!-------------------THIS FOR SENT DATA TO SERVER------------------->
		<script type="text/javascript">
			$(document).ready(function(){

				$('#submit').click(function(){
					$.ajax({
							url:"php_action/add_patients.php",
							method :"POST",
							data: $('#Patientsform').serialize(),
							success:function(data)
							{
								// alert(data);
								$('#Patientsform')[0].reset();
							}
					});
				});

				
		});

		function getUserDetails(id)
		{
			$('#hidden_reg_id').val(id);
			$.post("php_action/edit_patients.php",{id:id},function(data,status){

						var user = JSON.parse(data);
						$('#Reg_id').val(user.p_reg_id);
						$('#full_name').val(user.p_name);
						$('#mob_num').val(user.mobile);
						$('#gen').val(user.gender);
						$('#cat').val(user.category);
						$('#hostel').val(user.hostel_name);
						$('#date_of_record').val(user.record_date);
			});
			$('#editdrugmodal').modal("show");
		}	
		</script>


		<!------ THIS SEARCH FUNCTION--------->		
		<script type="text/javascript">				
			const searchfun = () =>{
			let filter =document.getElementById('search').value.toUpperCase();
			let patientsTable=document.getElementById('patientsTable');
			let tr = patientsTable.getElementsByTagName("tr");

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


