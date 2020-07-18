
<?php include ("includes/db.php");?>
<?php
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?>
<?php
	
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart']))
	{
		$_SESSION['cart'] = array();
	}

	//unset qunatity
	unset($_SESSION['qty_array']);
?>

<!DOCTYPE html>
<html lang="en">

<?php include ("includes/admin_header.php"); ?>


<body style="background-color: #1F2739;">
<?php include("includes/admin_navbar.php"); ?>
	<br><br><br>
	<div class="container">
		<div class="col-12">
			<ol class="breadcrumb">
			  	<li>
			  		<a href="view_cart.php" class="badge"><span class="badge" style="font-size: 20px;"><?php echo count($_SESSION['cart']); ?> Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i></span></a> 
			  	</li>
			</ol>
			<?php
				//info message
				if(isset($_SESSION['message']))
				{
			?>
					<div class="col-8 m-auto">
						<div class="alert alert-success">
						    <button type="button" class="close" data-dismiss="alert">&times;</button>
						    <span class="text-center">
							    <strong><span><?php echo $_SESSION['message']; ?></span></strong>
							</span>
						</div>
					</div>
			<?php
					unset($_SESSION['message']);
				}
			?>	
			<h2  id="h" class="text-center"> Search Medicines </h2>
			<div class="form-group">
				<div class="input-group">
					<span  id="drugSearchIcon"><i class="fas fa-search" aria-hidden="true"></i></span>
					<input type="text" name="searchMedicine" class="form-control form-control-sm ml-3 w-75" id="search_drug" placeholder="Search Medicine" aria-label="Search">
				</div>
			</div>
			<div id="result"></div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#search_drug').keyup(function(){
				var drug = $(this).val();
				if(drug!= '')
				{
					$.ajax({
							
							url:"php_action/fatchDrug.php",
							method :"POST",
							data:{search:drug},
							datatype:"text",
							success:function(data)
							{
								$('#result').html(data);
							}
					});
				}
				else
				{
					$('#result').html('');
					
				}
			});
		});
	</script>
	<style type="text/css">
		#drugSearchIcon
		{
		  font-size: 25px;
		  color: #fff;
		  font-weight: 300;
		}
	</style>
	
</body>
</html>