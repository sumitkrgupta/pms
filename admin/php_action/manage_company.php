
<?php include("../includes/db.php");?>
<?php
	date_default_timezone_set('Asia/Kolkata');
	session_start();
 	if($_SESSION['userrole']==null)
 	{
       	header("Location: ../index.php"); 
  	} 
?> 
<?php
	if(isset($_POST['submit']))
  	{
	 	  $CompanyName = $_POST['cn'];
		  $CompanyDate = $_POST['cd'];
		  $query = "SELECT company_name from drug_company where company_name = '$CompanyName'";
		  $run=mysqli_query($conn,$query);
	      $count = mysqli_num_rows($run);
  		if($count==1)
  		{
  			$_SESSION['message'] = 'Company Name Already Exits !';
  			header("location: ../drug_company.php");
  		}
  		else
  		{
  			$sql = "INSERT into drug_company(company_name,record_date) values('$CompanyName','$CompanyDate')";

         	$run=mysqli_query($conn,$sql);
            // $count=mysqli_num_rows($run);
          	if($run)
          	{
              	$_SESSION['message'] = 'Company Added Successfully !';
              	header("location: ../drug_company.php");
          	}
          	else
          	{
          		$_SESSION['message'] = 'Problem Found !';
          		header("location: ../drug_company.php");
          	}
          	
		  }
		
  	}
    else
    {
    	$_SESSION['message'] = 'Data Not Found !';
    	header("location: ../drug_company.php");
    }
   
?>