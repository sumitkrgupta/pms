<?php
if(isset($_GET['u_id'])) {
    $uID = $_GET['u_id'];
}

$query = "SELECT * FROM users WHERE user_id = {$uID}";
$user = mysqli_query($connect, $query);

while($row = mysqli_fetch_assoc($user)) {
    $userID = $row['user_id'];
    $userName = $row['username'];
    $fullname = $row['fullname'];
    $userEmail = $row['user_email'];
    $userImage = $row['user_image'];
}

if(isset($_POST['update_profile'])) {
	$username = $_POST['user'];
    $name = $_POST['name'];
	$email = $_POST['email'];
	$user_image = $_FILES['image']['name'];
	$user_image_temp = $_FILES['image']['tmp_name'];

	move_uploaded_file($user_image_temp, "../images/users/$user_image");
    
    if(empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = $uID";
        $image = mysqli_query($connect, $query);
        
        $row = mysqli_fetch_assoc($image);
        $user_image = $row['user_image'];
    }
    
    $query = "UPDATE users SET ";
    $query .= "username = '$username', ";
    $query .= "fullname = '$name', ";
    $query .= "user_email = '$email', ";
    $query .= "user_image = '$user_image' ";
    $query .= "WHERE user_id = $uID";
    
    $update = mysqli_query($connect, $query);
    
    if(!$update) {
        die("<span class='text-danger'>Sorry, profile could not be updated. Please try again!</span>". mysqli_error($connect));
    } else {
        if($_SESSION['username'] != $username || $_SESSION['fullname'] != $name) {
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] != $name;
        }
        
        header("Location: profile.php");
    }
    
}

?>



<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="author">Full Name</label>
		<input type="text" class="form-control" name="name" value="<?php echo $fullname; ?>">
	</div>
	<div class="form-group">
		<label for="tags">Username</label>
		<input type="text" class="form-control" name="user" value="<?php echo $userName; ?>">
	</div>
	<div class="form-group">
		<label for="tags">Email</label>
		<input type="email" class="form-control" name="email" value="<?php echo $userEmail; ?>">
	</div>
	<div class="form-group">
        <label for="image">Image</label><br>
	    <img src="../images/users/<?php echo $userImage; ?>" width="100px" alt="image"><br>
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" id="update_profile" name="update_profile" value="Update Profile">
	</div>
</form>