<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?> 
<?php 

	$msg = "";
	// If(isset($_GET['id']))
	// {
	// 		$id = $_GET['id'];
			
	// 		$query = "SELECT drug_name,drug_categories,drug_type,drug_description,(select company_name from drug_company where ) FROM drug_company where company_id = $id;";
	// 		$result = mysqli_query($conn,$query);
	// 		$result_set = mysqli_fetch_row($result);

	// 		$comName     =  $result_set[0];
	// 		$comDate    = $result_set [1];
			
			
	// }
	//
	if(isset($_POST['updatedata']) && $_GET['id']!='')
	{
		$id = $_GET['id'];

		$Udrug_Name = $_POST['udn'];
		$Udrug_cate = $_POST['udc'];
		$Udrug_des = $_POST['udd'];
		$Udrug_com = $_POST['company'];
		
		
		$query = "UPDATE drugs SET drug_name='$Udrug_Name',drug_categories='$Udrug_cate',drug_description='$Udrug_des',company_id=(Select company_id from drug_company where company_name='$Udrug_com') WHERE drug_name_id= '$id';";

		$result = mysqli_query($conn,$query);
		if($result)
		{
			$msg= "Update Success";
			header('Location:add_drugs.php?msg=update');
		}
		else
		{
			$msg=" Not Update";
			
			header('Location:add_drugs.php?msg=Not Update');
		}
 
	}
?>

<!DOCTYPE html>
<html lang="en">
	<?php include "includes/admin_header.php"; ?>
<body>
	<?php include("includes/admin_navbar.php"); ?>

		<!-- body of card-->

	<br><br><br>
	<div class="col-11 m-auto">		
		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>/
		  	<li><a href="add_drugs.php">Manage Drugs</a></li>/
		  	<li>Edit Medicine</li>
		</ol>
		<div class="panel-heading">
			<ol class="breadcrumb text-center">
		  		<li><h5><i class="fas fa-edit"></i> Edit Medicine</h5></li>
			</ol>
		</div>
		
		<!--Display data from database-->
		<form action=" " method="post" class="form-horizontal"autocomplete="off"id="editForm">
        	<div class="form-row">
				<div class="col-md-6 mb-3">
					 <label class="font-weight-bold">Medicine Name*</label>
			    	<input type="text" class="form-control" placeholder="Medicine Name" name="udn" required>
				</div>
				<div class="col-md-6 mb-3">
					 <label class="font-weight-bold">Categories</label>
			    	<select name="udc" required>
			      		<option >Select Categoroies</option>
			      		<option value="Genric">Genric</option>
			      		<option value="Branded">Branded</option>
			   		</select>
				</div>
			</div>
			<div class="form-row">
				
				<div class="col-md-6 mb-3">
					<label class="font-weight-bold">Medicine Company Name</label><br>
			     	<?php
			     		$msg = "";
						$query = "SELECT company_name FROM drug_company";
				     	$result = mysqli_query($conn,$query);
				    ?>
				    	<select name="company" class="sel" required=""> 
				    		<option value="">Select Company</option>
				    <?php  	
				     		if($result)
				     		{
				     			while($row = mysqli_fetch_array($result))
				     			{
				   	?>
				   					<option value="<?php echo $row["company_name"]; ?>"> <?php echo $row["company_name"]; ?> </option>
				    <?php					
				    			}
				     		}
			     	?>
			      	    </select>
				</div>
			</div>
			
			<div class="form-group">
			    <label class="font-weight-bold">Medicine Description*</label><br>
			    ​<textarea id="txtArea" rows="3" class="form-control" placeholder="Drug Description" name="udd"></textarea>
			</div>
			<div class="container text-center">	
				<button type="Submit" class="btn btn-primary" name="updatedata">Update</button>
			</div>
		</form>
	</div>


	<style type="text/css">
		body {font-family: Arial, Helvetica, 
				sans-serif;
			}
		#editForm
		{
		 	border-radius: 5px;
 			background-color: #f2f2f2;
			padding: 20px;
		}
	</style>

</body>
</html>