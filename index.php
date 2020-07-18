
<?php include("admin/includes/db.php"); ?>
<?php

session_start();


$errors = array();

if(isset($_POST['login'])) 
{		

	$regID = mysqli_real_escape_string($conn,$_POST['id']);
	$Password = mysqli_real_escape_string($conn,$_POST['password']);

	if(empty($regID) || empty($Password)) {
		if($regID== "") 
		{
			$errors[] = "Username is required";
		} 

		if($Password== "") 
		{
			$errors[] = "Password is required";
		}
	}
	else
	{
		$query = "SELECT reg_id from employee where reg_id = '$regID' ";
	    $result = mysqli_query($conn,$query);
	    $count = mysqli_num_rows($result);

		if($count==1) 
		{
			$query = "SELECT reg_id,fullname,role from employee where reg_id = '$regID' AND password ='$Password' ";
			$result = mysqli_query($conn,$query);
			$count = mysqli_num_rows($result);
			if($count == 1) 
			{
				while($row = mysqli_fetch_array($result)) 
	    		{
			        $reg 	  = $row['reg_id'];
			        $userName = $row['fullname'];
			        $userRole = $row['role'];
		   		}
		   		if($userRole == "admin")
		      	{	
		       		$_SESSION['reg_Id']    = $reg;
		       		$_SESSION['adminname'] = $userName;
		       		$_SESSION['userrole']  = $userRole;
		       		
					header("Location: admin");
		        }
		       else if($userRole == "Student")
		       {
		       		$_SESSION['reg_Id']    = $reg;
		       		$_SESSION['userrole'] = $userRole;
		       		$_SESSION['username'] = $userName;

		       		header("Location:employee");
		        }
					
			} 
			else
			{
				
				$errors[] = "Incorrect username/password ";
			}

		}
		else 
		{		
			$errors[] = "Username doesnot exists";		
		} 
	} 
	
}  
?>	    

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Log In</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/png" href="image/icon.png">
	<!-- <link rel="stylesheet" type="text/css" href="admin/mycss/mystyle.css"> -->
	


	
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->

	<!-- Latest compiled JavaScript -->
	<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->
</head>

<body>
		
		<div class="limiter">
			<br><br>
			<div id="heading">
				<img src="image/icon.png" type="image/png" id="imgicon">
				<span >UOH HEALTH CENTER PHARMACY</span>
			</div>
			<div class="login">
				<br>
				<div class="messages">
					<?php if($errors) 
						{
							foreach ($errors as $key => $value) 
							{
								echo '<div class="alert alert-warning" role="alert" style="color:red;">
										<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
										'.$value.'</div>';										
							}
						} 
					?>
				</div>
				<h2>Log In</h2>
	            <form action="" method="POST" enctype='multipart/form-data' autocomplete="OFF">
					<div class="textbox">
						<i class="fa fa-user" aria-hidden="true"></i>
	                   	<input type="text" placeholder="ID" name="id" id="userID" required="Please Enter Username">
	                </div>
	                <small id="useridcheck"></small><br>
					<div class="textbox">
						<i class="fa fa-lock"></i>
	                    <input type="password" placeholder="Password" name="password" id="pass" required="">
	                    <h5 id="userpsscheck"></h5>
	                </div>
					<button type="submit" class="btn btn-success" name="login">Log In</button>
				</form>	
	        </div>
        </div>

		
		<script type="text/javascript">

			$(document).ready(function(){
				$('#useridcheck').hide();
				$('#userpsscheck').hide();

				var userid = true;
				var userpass = true;

				$('#userID').keyup(function(){
					validate_userID();
				}); 

				function validate_userID()
				{
					var userId_value = $('#userID').val();
					//alert(userId_value);

					if(userId_value == '')
					{
						$('#useridcheck').show();
						$('#useridcheck').html("Enter your User Id");
						$('#useridcheck').focus();
						$('#useridcheck').css("color","red");

						userid = false;
					}
					else if(userId_value.length==6)
					{

					}
					else
					{
						$('#useridcheck').hide();
					}

				}

			});
			
		</script>
		<style type="text/css">
			
		.limiter 
      	{
          width: 50%;
       	  margin: 0 auto;

      	}
      #heading 
      {
        font-family: JosefinSans-Bold;
        font-size: 30px;
        color: #fff;
        text-align: center;
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
        background-color: #57b846;
        padding-top: 50px;
        padding-bottom: 15px;
        transition: 1px;
      }
      #imgicon
      {
        width: 7%;
        height: 90px;
        position: absolute;
        top: 10px;
        left: 30px;
        border-radius: 15px;
      }
      .messages
      {
        font-size: 15px;
        font-weight: bold;
      }
      .login
      {
        width: 300px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        color: white;
      }
      
      .login h2
      {
        width: 100%;
        font-size: 20px;
        /*border-bottom: 4px solid #4caf50;*/
        margin-bottom: 50px;
        padding: 10px 0;
        text-align: center;
        background-color: #57b846;
        border-radius: 15px;
      }
      .textbox
      {
        width: 100%;
        overflow:hidden;
        font-size: 20px;
        padding: 8px 0;
        margin: 8px 0;
        border-bottom: 2px solid #4caf50;
      }
      .textbox i 
      {
        width: 26px;
        float: left;
        text-align: center;
        color: black;
      }
      .textbox input
      {
        border: none;
        outline: none;
        font-size: 18px;
        width: 80%;
        float: left;
        margin: 0 10px;
        color: black;
        font-weight: bold;
      }
      .btn
      {
        width: 100%;
        border: 2px solid #57b846;*/
        padding: 5px;
        font-size: 15px;
        cursor: pointer;
        margin: 12px 0;
        font-weight: bold;
      }
		</style>
</body>
</html>


