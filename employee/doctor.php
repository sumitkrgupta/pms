
<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?> 
<?php

	
	if(isset($_POST['submit']))
    {
     	$DocId = $_POST['did'];
		$DocName = $_POST['dn'];
		$DocAdd = $_POST['da'];
		$Docgender = $_POST['gender'];
		
		
     	$query = "SELECT doctor_id FROM doctor WHERE doctor_id = '$DocId'";
     	$result = mysqli_query($conn,$query);
     	$count = mysqli_num_rows($result);     
      	if($count==1)
      	{
      		$_SESSION['message'] = 'Doctor Registration Id already exists!';
      		
     	}
     	else 
      	{
      		$sql = "INSERT into doctor(doctor_id,doctor_name,Join_date,address,gender) values('$DocId','$DocName',now(),'$DocAdd','$Docgender');";

            $run=mysqli_query($conn,$sql);
            if($run)
            {
      			$_SESSION['message'] = 'Added Successfully !';
              	//header("location: doctor.php");
            }
              
        }
   	}
   
?>


<!DOCTYPE html>
<html lang="en">

<?php include ("includes/admin_header.php"); ?>


<body>
<?php include("includes/admin_navbar.php"); ?>


<!--###############################################################################################-->
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
		        <form action="" method="post">
		            <div class="modal-body">
						<div class="form-group">
						    <label>Doctor ID*</label>
						    <input type="text" class="form-control" placeholder="ID" name="did" required>
						</div>
						<div class="form-group">
						    <label>Full Name*</label>
						    <input type="text" class="form-control" placeholder="Name" name="dn" required>
						</div>
						<div class="form-group">
						    <label>Address</label>
						    <input type="text" class="form-control" placeholder="Address" name="da" required>
						</div>
						<div class="form-group">
						    <label class="font-weight-bold">Gender</label>
						    <select name="gender">
						      		<option>Select Gender</option>
						      		<option value="male">Male</option>
						      		<option value="female">Female</option>
						    </select>
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
				
	<!-- Button trigger modal -->

    <div class="col-lg-12 m-auto" style="background-color: #1F2739;"><br><br>
		<!--Sub Nav bar-->
		<nav class="navbar">
		  	<div class="container-fluid">
		  		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#drugmodal">
					<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Doctor
				</button>
				<ul class="nav navbar-nav">
		      		<h2 id="h">Doctor Record</h2>
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
		  <li class="active">Manage Doctors</li>
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
			<table id="doctorTable"class="table table-sm table table-hover">
				<!--table Heading-->
				<thead class="badge-danger">
					<tr>
					    <th>No.</th>
					    <th>Reg. No</th>
					    <th>Doctor Name</th>
					    <th>Joining Date</th>
					    <th>Address</th>
					    <th>Gender</th>
					    <th>Edit</th>
					    <th>Delete</th>
					</tr>
				</thead>

				<!--For each data fatch from database table i.e is doctor table-->
				<?php		
						
					$query = "SELECT doctor_id,doctor_name,DATE_FORMAT(Join_date, '%d/%m/%Y') AS doj,address,gender FROM doctor ORDER BY doctor_name ASC;";
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
					    <td><?php echo $row['doctor_id']; ?></td>
						<td><?php echo $row['doctor_name']; ?></td>
						<td><?php echo $row['doj']; ?></td>
						<td><?php echo $row['address']; ?></td>
						<td><?php echo $row['gender']; ?></td>
						<td> 
						   	<!--EDIT Button-->
						    <button type="button" class="btn btn-success "><a href="edit_doctor.php?id=<?php echo $row['doctor_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
						    </button>
					    </td>

						<td>
						  	<!--DELETE Button>-->
						    <button type="button" class="btn btn-danger "><a href="php_action/delete_doctor.php?id=<?php echo $row['doctor_id'];?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
		    <!-- <center><p class="text-white bg-success"><strong><?php //echo $msgs; ?></p></strong></center> -->
		</div>
	</div>		

	<!------ THIS SEARCH FUNCTION--------->		
	<script type="text/javascript">				
		const searchfun = () =>{
		let filter =document.getElementById('search').value.toUpperCase();
		let doctorTable=document.getElementById('doctorTable');
		let tr = doctorTable.getElementsByTagName("tr");

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


