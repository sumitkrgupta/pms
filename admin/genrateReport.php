<?php require_once __DIR__ . '/pdf/vendor/autoload.php'; ?>

<?php

	include ("includes/db.php");
	session_start();
  date_default_timezone_set('Asia/Kolkata');

	$pdf = new \Mpdf\Mpdf();

	if(isset($_POST['submit']))
	{
		  $StratDate =  mysqli_real_escape_string($conn,$_POST['StratDate']);
  		$EndDate =  mysqli_real_escape_string($conn,$_POST['endDate']);
  		

  		
  		
  		$query =  "SELECT DATE_FORMAT(o.orders_date , '%d/%m/%Y')as orderDate,s.supplier_name,o.orders_invoice_no,o.supplier_contact_person from orders o inner join supplier s on s.supplier_id = o.supplier_id where orders_date >= '$StratDate' and orders_date <= '$EndDate' order by orders_date desc";

      $date = date('d/m/Y h:i:s a', time());
  		$result = mysqli_query($conn,$query);
  		$count=mysqli_num_rows($result);
      
  		if($count>=1)
  		{
  			
  			$data = '';

  			$data .= '<h5 style="text-align:center;line-height: 0;"> Purchase Order List </h5>';
  			$data .= '<h3 style="text-align:center;line-height: 0;"> UOH Health Center Pharmacy </h3>';
  			$data .= '<h4 style="text-align:center;line-height: 0;">University of Hyderabad, CUC, Gachibowli,Hyderabad, Telagana 500046</h4>';

  			$data .= '<table align="center" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid black;margin-bottom: 10px;">
       			 <tbody>
		         <tr>
                  		
                     	<td colspan="3" style=" text-align: left;padding-top: 4px;padding-left: 4px;"> Date:-'.$date.'</td>
                  </tr>
                 
                  
               </tbody>
            </table>

            <table align="center" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid black;margin-bottom: 10px;">
            	<thead align="center" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid black;margin-bottom: 10px; font-size: 17px;">
					<tr style="border:1px solid black;margin-bottom: 10px;">
						<th style="border-left: 1px solid black;height: 27px;">No.</th>
						<th style="border-left: 1px solid black;height: 27px;">Order Invoice No.</th>
						<th style="border-left: 1px solid black;height: 27px;">Supplier Name</th>
						<th style="border-left: 1px solid black;height: 27px;">Order Date</th>
						<th style="border-left: 1px solid black;height: 27px;">Supplier Person</th>
					</tr>
				</thead>';

				$counter =1;
				$count = 0;//for count item
				while($fetch = mysqli_fetch_array($result))
				{

			$data .= '<tbody>
                  <tr style="border:1px solid black;margin-bottom: 10px;">
						<td style="border-left: 1px solid black;height: 27px; text-align: center;">'.$counter.'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["orders_invoice_no"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["supplier_name"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["orderDate"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["supplier_contact_person"].'</td>
					</tr>		
                     	
              		</tbody>';
              		$counter++;
              		$count++;
          		}	

          		$data .= '</table>
            
            <table align="center" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid black;margin-bottom: 10px;">
            	<tbody>
            		<tr>
            			<td colspan="3" style="text-align: left;padding-top: 4px;padding-left: 20px;">Total Item:-'.$count.'</td>
						<td colspan="3" style="text-align: right;padding-top: 4px;padding-right: 40px;">Admin:-'.$_SESSION["adminname"].'</td>
            		</tr>
            	</tbody>
            </table>';	

            $pdf->WriteHTML($data);
			     $pdf->Output('Order List.pdf','D');

  		}
  		else
  		{
  			$_SESSION['message'] = 'No Record Found !';
  			header("location:reportForOrder.php");
  		}
  		
  	
	}
	
?>