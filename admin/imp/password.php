<?php
if(isset($_GET['u_id'])) {
    $uID = $_GET['u_id'];
}

$query = "SELECT * FROM users WHERE user_id = {$uID}";
$user = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($user)) {
    $userID = $row['user_id'];
    $userPass = $row['user_password'];
}

if(isset($_POST['submit'])) {
    $oldPass = $_POST['pswd1'];
    $newPass = $_POST['pswd2'];
    
    if($oldPass != $userPass) {
        ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> Wrong password entered!
        </div>
        <?php
    } else {
        $query = "UPDATE users SET user_password = '$newPass' WHERE user_id = $userID";
        $pass = mysqli_query($connect, $query);
        
        if(!$pass) {
            ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Sorry!</strong> Password could not be changed. Please try again!
            </div>
            <?php
        } else {
            echo "<script>alert('Password changed successfully!');</script>";
            header("Location: profile.php");
        }
    }
}
?>

   
<form action="" method="post">
    <div class="form-group">
		<label for="pswd">Old Password</label>
		<input type="password" class="form-control" name="pswd1">
	</div>
	<div class="form-group">
		<label for="pswd">New Password</label>
		<input type="password" class="form-control" name="pswd2">
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="submit" value="Change Password">
	</div>
</form>