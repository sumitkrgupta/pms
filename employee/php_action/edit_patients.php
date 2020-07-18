<?php
	include ("../includes/db.php");

	echo "<pre>";
	print_r($_POST);
	echo "<pre>";

	if(isset($_POST['id']) && !empty($_POST['id']))
	{
		$reg_ID = $_POST['id'];

		$query = "SELECT p_reg_id,p_name,category,hostel_name,mobile,DATE_FORMAT(record_date, '%d/%m/%Y') AS doj,gender FROM Patients where p_reg_id = 'reg_ID'";
		$result = mysqli_query($conn,$query);
		if($result)
		{
			$response = array();
			while($row = mysqli_fetch_array($result))
			{
				$response = $row;
			}
		}
		else
		{
			exit(mysqli_error());
			$response['status'] = 200;
			$response['message'] = "Data Not Found";

		}

		json_encode($response);
	}
?>