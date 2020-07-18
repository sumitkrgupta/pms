
<?php require_once __DIR__ . '/pdf/vendor/autoload.php'; ?>
<?php
	include ("includes/db.php");
	session_start();
  date_default_timezone_set('Asia/Kolkata');

	$pdf = new \Mpdf\Mpdf();
	if(isset($_POST['submit']))
	{
		  $StartDate =  mysqli_real_escape_string($conn,$_POST['StratDate']);
  		$EndDate =  mysqli_real_escape_string($conn,$_POST['endDate']);
  		
  		$query =  "SELECT DATE_FORMAT(r.recive_date , '%d/%m/%Y')as receviedDate,s.supplier_name,o.orders_invoice_no,r.recive_invoice_no,r.item_total_amount,r.payment_amount,r.payment_type,r.due_amount from recive_order_details r inner join supplier s on s.supplier_id = r.supplier_id inner join orders o on r.order_id = o.orders_id where recive_date >= '$StartDate' and recive_date <= '$EndDate' order by recive_date desc";

      // SELECT DATE_FORMAT(r.recive_date , '%d/%m/%Y')as receviedDate,s.supplier_name,r.recive_invoice_no,r.item_total_amount,o.orders_invoice_no,r.payment_amount,r.payment_type,r.due_amount from recive_order_details r inner join supplier s on s.supplier_id = r.supplier_id inner join orders o on r.order_id = o.orders_id where recive_date >= '2020-02-01' and recive_date <= '2020-05-20' order by recive_date desc

      $date = date('d/m/Y h:i:s a', time());
  		$result = mysqli_query($conn,$query);
  		$count=mysqli_num_rows($result);
  		if($count>=1)
  		{
  			
  			$data = '';

  			$data .= '<h5 style="text-align:center;line-height: 0;"> Purchase Recevied List </h5>';
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
						<th style="border-left: 1px solid black;height: 27px;">Received Invoice No.</th>
            <th style="border-left: 1px solid black;height: 27px;">Orders Invoice No.</th>
						<th style="border-left: 1px solid black;height: 27px;">Supplier Name</th>
						<th style="border-left: 1px solid black;height: 27px;">Received Date</th>
						<th style="border-left: 1px solid black;height: 27px;">Total Amount</th>
            <th style="border-left: 1px solid black;height: 27px;">Payment Amount</th>
            <th style="border-left: 1px solid black;height: 27px;">Due Amount</th>
            <th style="border-left: 1px solid black;height: 27px;">Payment Type</th>
					</tr>
				</thead>';

				$counter =1;
				$count = 0;//for count item
				while($fetch = mysqli_fetch_array($result))
				{

			$data .= '<tbody>
                  <tr style="border:1px solid black;margin-bottom: 10px;">
						<td style="border-left: 1px solid black;height: 27px; text-align: center;">'.$counter.'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["recive_invoice_no"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["orders_invoice_no"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["supplier_name"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["receviedDate"].'</td>
            <td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["item_total_amount"].'</td>
            <td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["payment_amount"].'</td>
            <td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["due_amount"].'</td>
            <td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["payment_type"].'</td>
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
			     $pdf->Output('Received List.pdf','D');

  		}
  		else
  		{
  			$_SESSION['message'] = 'No Record Found !';
  			header("location:ReceviedReport.php");
  		}
  		
  	
	}
	
?>