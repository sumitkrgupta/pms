<?php include ("includes/db.php");?>
<?php
	
		date_default_timezone_set('Asia/Kolkata');
		
		//$query=	"SELECT exp_date,DATEDIFF(exp_date,NOW()) AS days FROM drugs_stocks;";
		//$query=	"SELECT  DATE_FORMAT(exp_date, '%d/%m/%Y') AS exp FROM drugs_stocks;";
		$query=	"SELECT  exp_date FROM drugs_stocks;";

		$result = mysqli_query($conn,$query);
		if($result)
		{	
			$today=date("Y/m/d");//we can use this function to change the formate of date
			$todaySec=strtotime($today);
			while($row = mysqli_fetch_array($result))
			{	
		     	$exp=$row['exp_date'];
     			$expSec=strtotime($exp);

     			$diff=$todaySec-$expSec;
					
				$days_to_expire=abs(floor($diff/(60*60*24)));
				
				if($days_to_expire<=0)
				{
					echo "Expired" .'<br>';
				}
				else if($days_to_expire==1)
				{
					echo "Expires tomorrow" .'<br>';
				}
				else if($days_to_expire==2)
				{
					echo "Expires in two days" .'<br>';
				}
				else if ($todaySec>=$expSec)
				{
					echo $exp;
					echo "Expired already ".$days_to_expire." days ".'<br>';
				}
				else
				{
					echo $exp;
					echo "Expires in ".$days_to_expire." days ".'<br>';
				}
		    }
		} 


		echo '<br>';
		
					
?>

<!--  this code work directly using sql query but there is only fault is expiry date is given in -ve ----------------->

<?php

	$query=	"SELECT DATEDIFF(exp_date,NOW()) AS days FROM drugs_stocks;";
		$result = mysqli_query($conn,$query);
     
     	if($result)
     	{
     		while($row = mysqli_fetch_array($result))
     		{
     			//$row['exp_date'];
     			$days_to_expire=$row['days'];

     			if($days_to_expire<=2)
				{
					$msg="Expired";
					echo $msg .'<br>';
				}
				else if($days_to_expire==3)
				{
					$msg="Expires tomorrow";
					echo $msg .'<br>';
				}
				else if($days_to_expire==4)
				{
					$msg="Expires in two days";
					echo $msg .'<br>';
				}
				else if ($days_to_expire>=5)
				{
					
					$msg=$days_to_expire;
					echo $msg .'<br>';
				}
				
     		}
     	}

     	echo '<br>';
?>


<!-- code for active and not active--------------------------------------------------------------------------------------->
<?php
		// echo '<br>';
		// $startdate = "6-April-2020"; //$row['datepicker'];
		// $expire = strtotime($startdate. ' + 2 days');
		// $today = strtotime("today midnight");

		// if($today >= $expire){
  //  			 echo "expired";
		// } 
		// else 
		// {
  //   		echo "active";
		// }

		// echo '<br>';
?>

<!--Code 1 test------------------------------------------------------------------------------------------------------->
<?php
	// $query=	"SELECT exp_date FROM drugs_stocks;";
	// 	$result = mysqli_query($conn,$query);//return object
		
		
		
	// 	if($result)
 //     	{
     		
 //     		while($row = mysqli_fetch_array($result))
 //     		{
     			
 //     			$exp=$row['exp_date'] .'<br>';//return string and its length is 14
 //     			$my_dt = DateTime::createFromFormat('y-m-d', $exp);// any problem here
 //     			$date = new DateTime($my_dt);
 //     			$now = new DateTime();
 //     			$diff=date_diff($now,$date);
 //     			echo $diff->days .'<br>';
 //     		}
 //     	}

 //     	echo '<br>';
     	
?>


<!-- Code for manual date taking----------------------------------------------------------------------------------------->

<?php
	// echo " 2nd" .'<br>';
	// 	$date_expire = '2020-04-20';//retrun string and length is 10   
	// 	$date = new DateTime($date_expire);//return object
	// 	$now = new DateTime();//return object
	// 	echo "<pre>";
	// 		print_r($date);
	// 	echo "</pre>";
	// 	echo "<pre>";
	// 		print_r($now);
	// 	echo "</pre>";
	// 	$diff=date_diff($now,$date);
	// 	echo "<pre>";
	// 		print_r($diff);
	// 	echo "</pre>";

	// 	echo $diff->days .'<br>';

		
	// 	echo $date->diff($now)->format("%d days, %h hours and %i minuts");
?>
