
<?php include ("includes/db.php");?>
<?php 
	if(isset($_POST['submit']))
	{
		
		$drugName= $_POST['mn'];
		$drugCat=  $_POST['mc'];
		$drugDes =  $_POST['mds'];
		$cmpName =$_POST['company'];

		
		$search = "SELECT drug_name FROM drugs WHERE drug_name = '$drugName'";
     	$result = mysqli_query($conn,$search);
     	$count = mysqli_num_rows($result);
     	if($count==1)
      	{
			$msg = "Medicine is already Exist.";
      		header("location: add_drugs.php");
      	}
      	else
      	{

			$query = "INSERT INTO drugs(drug_name,drug_categories,drug_description,company_id) values('$drugName','$drugCat','$drugDes',(Select company_id from drug_company where company_name = '$cmpName'));";

			$result = mysqli_query($conn,$query);

			if($result)
			{
				$msg = "Medicine Added ";
				header('Location:add_drugs.php');
			}
			else
			{
				$msg = "Medicine Not Added";
			}
 		}
	}
?>



<!DOCTYPE html>
<html lang="en">
<?php include ("includes/admin_header.php"); ?>


<body id="bdy">
<?php include("includes/admin_navbar.php"); ?>

		<!----------------------------Modal---------------------------------->

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
							    <label class="font-weight-bold">Medicine Name*</label>
							    <input type="text" class="form-control" placeholder="Medicine Name" name="mn" required>
							</div>
							<div class="form-group">
							    <label class="font-weight-bold">Categories</label>
							    <select name="mc">
							      		<option>Select Categoroies</option>
							      		<option value="Genric">Genric</option>
							      		<option value="Branded">Branded</option>
							    </select>
							</div>
							<div class="form-group">
								<label class="font-weight-bold">Medicine Description</label>
							    <input type="text" class="form-control" placeholder="Description" name="mds">
							</div>
							<div class="form-group">
								<label class="font-weight-bold">Medicine Company Name</label><br>
							     	<?php
							     		
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
						<div class="modal-footer">
				            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				            <button type="Submit" class="btn btn-primary" name="submit">Add</button>
			            </div>
			        </form>
			    </div>
			</div>
	    </div>

<!--############################ Table Data ############################################################-->	
				

		<div class="col-lg-12 m-auto" style="background-color: #3f5c80;"><br><br>
			<!--Sub Nav bar-->
			<nav class="navbar">
			  	<div class="container-fluid">
			  		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#drugmodal">
						<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add
					</button>
					<ul class="nav navbar-nav">
			      		<h2 id="h">DRUGS LIST</h2>
			    	</ul>
					<ul>
			    		<div class='input-group' id="in">
			    			<input class="form-control form-control-sm ml-3 w-75"  type="text" placeholder="Search" name="" id="search" onkeyup="searchfun()"  aria-label="Search">
  						</div>	
			  		</ul>
			 	</div>
			</nav>
		</div> 
		<div class="col-lg-11 m-auto"> 
			<div class="tbl-content">	       
				<!--Display data from database-->
				<table id="drugTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
							<th>No.</th>
							<th>Medicine Name</th>
							<th>Categories</th>
							<th>Description</th>
							<th>Company Name</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>

					<!--For each data fatch from database table i.e is add_drugs table-->
					<?php		
						$query = "SELECT d.drug_name_id,d.drug_name,d.drug_categories,d.drug_description,c.company_name FROM drugs d inner join drug_company c ON d.company_id = c.company_id ORDER BY d.drug_name ASC;";
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
							<!--<td><?php //echo $row['drug_name_id']; ?></td>-->
							<td><?php echo $row['drug_name']; ?></td>
							<td><?php echo $row['drug_categories']; ?></td>
							<td><?php echo $row['drug_description']; ?></td>
							<td><?php echo $row['company_name']; ?></td>
							<td>
								<!--EDIT Button-->
								<button type="button" class="btn btn-success "><a href="edit_drugs.php?id=<?php echo $row['drug_name_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
								</button>
							</td>
							<td>
								<button type="button" class="btn btn-danger "><a href="delete_drugs.php?id=<?php echo $row['drug_name_id']; ?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
			body {
		 			 font-family: 'Open Sans', sans-serif;
		  			font-weight: 300;
		  			line-height: 1.42em;
		  			color:#A7A1AE;
		  			background-color: #3f5c80;
		  			/*background-color:#1F2739;*/
		 			overflow: hidden;
			}
		</style>			

</body>
</html>

