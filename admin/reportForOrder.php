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

<body style="background-color: ">
<?php include("includes/admin_navbar.php"); ?>

	<br><br><br>
	<div class="col-lg-10 m-auto"> 
		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li> /		  
			<li class="active">Reports</li>
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

		<div class="card">
			<div class="card-header" style="background-color: #e8e8e8">
				<h5><i class="fa fa-file" aria-hidden="true"></i> Genrate Reports</h5>
			</div>
			<div class="card-body">
				<form  action="genrateReport.php" method="post">
					<div class="col-md-10 mb-3">
				      	<label class="font-weight-bold">Starting Date.*</label>
				      	<input type="Date" class="form-control" name="StratDate" required>
					</div>
					<div class="col-md-10 mb-3">
				      	<label class="font-weight-bold">Ending Date.*</label>
				      	<input type="Date" class="form-control" name="endDate" required >
					</div>
				 
				  	<br>
				    <div class="col-sm-offset-2 col-sm-10 text-center">
				       <button type="Submit" class="btn btn-primary" name="submit"> Generate Report</button>
				    </div>
				</form>
			</div>
		</div>	
	</div>	

	<!-- <script type="text/javascript">
		
	$(document).ready(function(){
		 $("#startdate").datepicker();
	})
 
	</script> -->

</body>
</html>