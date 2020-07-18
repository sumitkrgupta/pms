<?php
	include ("../includes/db.php");
	session_start();
?>
<?php

	
	if(isset($_POST['submit']))
  {
      $empId = $_POST['eid'];
  		$empName = $_POST['en'];
  		$empMobile = $_POST['emn'];
  		$empGender = $_POST['gender'];
  		$pass = $_POST['pas'];
  		$CPass=$_POST['cps'];
  		$empadd = $_POST['ea'];

     	$query = "SELECT reg_id FROM employee WHERE reg_id ='$empId';";
     	$result = mysqli_query($conn,$query);
     	$count = mysqli_num_rows($result);     
    	if($count==1)
    	{
    		$_SESSION['message'] = 'Already User Exists !';
		    header("location: ../add_staff.php");
    		
   	  }
    	else if($pass <> $CPass)
    	{
    	   $_SESSION['message'] = 'Password Not Matched ! Retry Again!';
     	   header("location: ../add_staff.php");
     	   
   	  }
     	else 
      {
      		$sql = "INSERT into employee(reg_id,fullname,phone,gender,password,role,join_date,address) values('$empId','$empName','$empMobile','$empGender',$pass','Student',now(),'$empadd');";

            $run=mysqli_query($conn,$sql);
            $count = mysqli_num_rows($run);
            if($count==1)
            {
              	$_SESSION['message'] = 'User Added Successfully !';
              	header("location: ../add_staff.php");
            }
      }
  }
   
?>
