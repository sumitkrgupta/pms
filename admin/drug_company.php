
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


<!--##################################################################################################-->
		<!-- Modal for data collection -->
		<div class="modal fade" id="drugmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <form action="php_action/manage_company.php" method="post">
			            <div class="modal-body">
							<div class="form-group">
							    <label>Company Name*</label>
							    <input type="text" class="form-control" placeholder="Name" name="cn" required>
							</div>
							<div class="form-group">
							    <label>Date*</label>
							    <input type="Date" class="form-control" name="cd" required>
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
						<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Company
					</button>
					<ul class="nav navbar-nav">
			      		<h2 id="h">Company Record</h2>
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
				<li class="active">Company</li>
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
				<table id="drugTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
						    <th>No.</th>
						   	<th>Company Name</th>
						    <th>Record Date</th>
						    <th>Edit</th>
						    <th>Delete</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is doctor table-->
					<?php		
							
						$query = "SELECT company_id,company_name,DATE_FORMAT(record_date, '%d/%m/%Y') AS doj FROM drug_company ORDER BY company_name ASC;";
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
						   <!-- <td><?php echo $row['company_id']; ?></td>-->
						    <td><?php echo $row['company_name']; ?></td>
							<td><?php echo $row['doj']; ?></td>
							
							<td> 
							   	<!--EDIT Button-->
							    <button type="button" class="btn btn-success "><a href="edit_company.php?id=<?php echo $row['company_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
							    </button>
						    </td>

							<td>
							  	<!--DELETE Button>-->
							    <button type="button" class="btn btn-danger "><a href="php_action/delete_company.php?id=<?php echo $row['company_id'];?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
	// $(document).ready(function(){
	// 	$('#dismiss').on('click',function(){
	// 		 $(this).parent().alert('close');
	// 	});
	// });
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


