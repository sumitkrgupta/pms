<!DOCTYPE html>
<html lang="en">

<?php include "includes/admin_header.php"; ?>


<body>
    
		<!-- Navigation -->
		<?php include "includes/admin_navbar.php"; ?>
		
			<div class="content">

				<!-- Page Heading -->
				<div class="row">
					<div class="col-sm-12">
						<h1 class="pb-2 mt-4 mb-2 border-bottom">
							Your Profile
<!--							<small><q><?php echo $_SESSION['username']; ?></q></small>-->
						</h1>
						
						<?php
                        if(isset($_GET['source'])) {
                            $source = $_GET['source'];
                        } else {
                            $source = "";
                        }

                        switch($source) {
                            case 'edit_profile':
                                include "includes/edit_profile.php";
                                break;
                            case 'change_password':
                                include "includes/password.php";
                                break;
                            default:
                                include "includes/view_profile.php";
                        }
                        ?>
                        <!-- <?php  ?> -->
						
						

						

					</div>
				</div>
				<!-- /.row -->

			</div>
			<!-- /.container-fluid -->
	
	<?php include "includes/admin_scripts.php"; ?>
</body>

</html>