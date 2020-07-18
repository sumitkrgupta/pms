
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
<?php include ("includes/admin_header.php");?>


<body style="overflow: auto;">
<?php include("includes/admin_navbar.php"); ?>

		<!----------------------------Modal---------------------------------->
		<div class="modal fade" id="drugmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			    <div class="modal-content">
			        <div class="modal-header">
			            <h5 class="modal-title" id="exampleModalLabel">Details Orders Invoice</h5>
			            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                <span aria-hidden="true">&times;</span>
			            </button>
			        </div>
			        <form action="" method="post" id="invoice_details">
			            <div class="modal-body">
							<div class="form-group">
							    <label>Received Invoice No.*</label>
							    <input type="text" class="form-control" placeholder="Recived Invoice No." name="reciveInvoiceNo" required>
							</div>
							<div class="form-group">
							    <label>Orders Invoice No.*</label>
							    <input type="text" class="form-control" placeholder="Orders Invoice No." name="orderInvoiceNo" required>
							</div>
							<div class="form-group">
							   	<label class="font-weight-bold">Supplier Name*</label>
								<?php
									$msg = "";
									$query = "SELECT supplier_name FROM supplier";
									$result = mysqli_query($conn,$query);
								?>
									<select name="supplier" class="sel" required=""> 
									<option value="">Select Supplier</option>
								<?php  	
									if($result)
									{
										while($row = mysqli_fetch_array($result))
										{
								?>
											<option value="<?php echo $row["supplier_name"]; ?>"> <?php echo $row["supplier_name"]; ?> </option>
								<?php					
										}
									}
								?>
									</select>
							</div>
							
							<div class="form-group">
							    <label>Received Date*</label>
							    <input type="Date" class="form-control" name="invoiceReciveDate" required="">
							</div>
							<div class="form-group">
							    <label class="font-weight-bold">Total Bill Amount*</label>
							    <input type="text" class="form-control" placeholder="Total Bill Amount" name="invoiceTotalAmount" required="" id="totalBill">
							</div>
							<div class="form-group">
							    <label class="font-weight-bold">Payment Type*</label>
								<select name="paymentType" required="" id="type"> 
				                	<option >Select</option>
									<option value="Cheque">Cheque</option>
								    <option value="Cash">Cash</option>
								    <option value="Credit">Credit Card</option>
								</select>
							</div>
							<div class="form-group">
							    <label>Amount Paid*</label>
							    <input type="text" class="form-control" placeholder="Payment Amount" name="paymentAmount" required id="paymentAmt">
							</div>
							<div class="form-group">
							    <label>Amount Due*</label>
							    <input type="text" class="form-control" placeholder="Due Amount" name="dueAmount" required id="dueAmt" readonly>
							</div>
						</div>

						<div class="modal-footer">
							<button type="Submit" class="btn btn-primary" id="submit" name="submit">Add</button>
				            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
						<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add Invoice
					</button>
					<ul class="nav navbar-nav">
			      		<h2 id="h">Received Orders Invoice</h2>
			    	</ul>
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
			  <li class="active">Manage Received Invoice</li>
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
				<table id="invoiceTable"class="table table-sm table table-hover">
					<!--table Heading-->
					<thead class="badge-danger">
						<tr>
							<th>No.</th>
						    <th>Receive Invoice No.</th>
						    <th>Order Invoice No.</th>
						    <th>Supplier Name</th>
						    <th>Receive Date</th>
						    <th>Bill Amount</th>
						    <th>Payment Amount</th>
						    <th>Payment Type</th>
						    <th>Due Amount</th>
						    <th>View</th>
						    <th>Edit</th>
						    <th>Delete</th>
						</tr>
					</thead>
					<!--For each data fatch from database table i.e is add_drugs table-->
					<?php		
					
					$query = "SELECT r.recive_id,r.recive_invoice_no,o.orders_invoice_no,s.supplier_name,DATE_FORMAT(r.recive_date,'%d/%m/%Y') AS doj,r.item_total_amount,r.payment_amount,r.payment_type,r.due_amount FROM recive_order_details r inner join orders o on o.orders_id=r.order_id inner join supplier s on r.supplier_id = s.supplier_id  ORDER BY r.recive_date ASC;";

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
						    <td><?php echo $row['recive_invoice_no']; ?></td>
						    <td><?php echo $row['orders_invoice_no']; ?></td>
							<td><?php echo $row['supplier_name']; ?></td>
							<td><?php echo $row['doj']; ?></td>
							<td><?php echo $row['item_total_amount']; ?></td>
							<td><?php echo $row['payment_amount']; ?></td>
							<td><?php echo $row['payment_type']; ?></td>
							<td><?php echo $row['due_amount']; ?></td>
							<td> 
							   	<!--View Button-->
							    <button type="button" class="btn btn-secondary "><a href="supplier_supply_item.php?id=<?php echo $row['recive_id']; ?>" class="text-white">View</a>
							    </button>
						    </td>
							<td> 
							   	<!--EDIT Button-->
							    <button type="button" class="btn btn-success "><a href="#?id=<?php echo $row['recive_id']; ?>" class="text-white"><i class="fas fa-edit"></i></a>
							    </button>
						    </td>
							<td>
							  	<!--DELETE Button>-->
							    <button type="button" class="btn btn-danger "><a href="#?id=<?php echo $row['recive_id'];?>" class="text-white" onclick="javascript:return confirm('Do you want to Delete?');"><i class="fas fa-trash-alt"></i></a>
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
							
							$_SESSION['message'] = 'No Record Found !';
						}
					?>
				</table>
			</div>	
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
		</div>

		<!------ THIS SEARCH FUNCTION--------->		
		<script type="text/javascript">				
			const searchfun = () =>{
			let filter =document.getElementById('search').value.toUpperCase();
			let invoiceTable=document.getElementById('invoiceTable');
			let tr = invoiceTable.getElementsByTagName("tr");

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
		<!---------------Sent data to server using Ajax------------->
		<script type="text/javascript">
			$(document).ready(function()
			{
				$('#submit').click(function(){
					$.ajax({
							url:"php_action/recived_invoice.php",
							method :"POST",
							data: $('#invoice_details').serialize(),
							success:function(data)
							{
								// alert(data);
								$('#invoice_details')[0].reset();
							}
					});
				});
				$('#totalBill,#paymentAmt').keyup(function()
				{
					var due = $('#totalBill').val() - $('#paymentAmt').val();
					due = due.toFixed(2);
					$("#dueAmt").val(due);
				});
			});
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

