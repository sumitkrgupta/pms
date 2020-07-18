<?php
    $servername='localhost';
    $username='root';
    $password='';
    $dbname = 'uhpharmacy';
    $conn=mysqli_connect($servername,$username,$password,$dbname);
    //mysqli_select_db($conn,'pharmacystore');

    if(!$conn)
    {
         die('Could not Connect MySql Server:' .mysql_error());
    }
?>