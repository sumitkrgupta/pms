<?php
	include("db.php");
	if($_SERVER["REQUEST_METHOD"] == "POST")
   {
      $Reg = $_POST['reg'];
   	  $Name = $_POST['name'];
      $Email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $Password = $_POST['password'];
      $CPass = $_POST['cpassword'];

      $search = "SELECT reg_id FROM admin WHERE reg_id = '$Reg'";
      $result = mysqli_query($conn,$search);
      $count = mysqli_num_rows($result);     
      if($Password <> $CPass)
      {
        echo "<script type ='text/javascript'>alert('Enter password should be same');</script>";
      }
      else
      {
        if($count==1) 
      {
        echo "<script type ='text/javascript'>alert('user allready exit');</script>";
      }
      else 
      {
       $sql = "insert into admin(reg_id,fullname,email,phone,password) values('$Reg','$Name','$Email','$mobile','$Password');";
              mysqli_query($conn,$sql);
              header("location: login.php"); 
       }
   }
   }
?>
<html>
<head>
	
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Here</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    
	
</head>
<body>
	<div class="container">
		<div class="col-lg-8 m-auto d-block">
			<div class="page-header">
                    <h2 style="color: red;">Registration Here</h2>
                </div>
                <p>Please fill all fields</p>
			<form action="" method="post" onsubmit="return validation()" class="bg-light" enctype='multipart/form-data'>
        <div class="form-group">
                        <label>Registration Id*</label>
                        <input type="text" placeholder="Id" name="reg" class="form-control" id="r">
                        <span id="rr" class="text-danger font-weight-bold"></span>
				<div class="form-group">
                        <label>Full Name*</label>
                        <input type="text" placeholder="Name" name="name" class="form-control" id="n" required>
                        <!--<span id="fname" class="text-danger font-weight-bold"></span>-->
                </div>
				<div class="form-group ">
                        <label>Email*</label>
                        <input type="text" placeholder="Email" name="email" class="form-control" id="e">
                        <span id="ee" class="text-danger font-weight-bold"></span>
                 </div>
				
				<div class="form-group ">
                        <label>Mobile Number*</label>
                        <input type="text" placeholder="Number" name="mobile" class="form-control" id="mob">
                        <span id="mobb" class="text-danger font-weight-bold"></span>
                 </div>
				<div class="form-group ">
                        <label>Password*</label>
                        <input type="password" placeholder="Password" name="password" class="form-control" id="p">
                        <span id="pp" class="text-danger font-weight-bold"></span>
                </div>
				<div class="form-group ">
                        <label>Conform Password*</label>
                        <input type="password" placeholder="Confirm Password" name="cpassword" class="form-control" id="cp">
                        <span id="cpp" class="text-danger font-weight-bold"></span>
                </div>
				<label><input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me</label>

                     <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
                     <style type="text/css">
                          button {
                                 background-color: #4CAF50;
                                 color: white;
                                 padding: 14px 20px;
                                 margin: 8px 0;
                                 border: none;
                                 cursor: pointer;
                                 width: 20%;
                                 opacity: 0.9;
                     </style>
                    
                    <div class="clearfix">
                    	<button type="submit" class="signupbtn">Sign Up</button>
                        <button type="button" class="cancelbtn">Cancel</button>
                        Already have a account?
                        <a href="login.php" class="btn btn-default" style="color: dodgerblue">Login</a>
                    </div>        

				
			</form>
			
		</div>
		
	</div>
	<script type="text/javascript">
		function validation()
		{	

      var regis = document.getElementById("r").value;
			var email = document.getElementById("e").value;
			var number = document.getElementById("mob").value;
			var pass = document.getElementById("p").value;
			var cpass = document.getElementById("cp").value;
			/*var name = document.getElementById("n").value;
			if (name=="")
			 {
				document.getElementById("fname").innerHTML ="*Please fill";
				return false;
			 }*/
			 if (regis=="")
       {
        document.getElementById("rr").innerHTML ="*fill Id";
        return false;
       }
			if (email=="") 
			{
					alert("Email Id should not be blank.");
					return false;
			}
			if (number=="")
			 {
				document.getElementById("mobb").innerHTML ="*fill number";
				return false;
			 }
			 if (pass=="")
			 {
				document.getElementById("pp").innerHTML ="*Password required";
				return false;
			 }
			 if (cpass=="")
			 {
				document.getElementById("cpp").innerHTML ="*Confirm Password required";
				return false;
			 }
		}
	</script>
</body>
</html>