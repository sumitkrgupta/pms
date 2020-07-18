<?php include ("includes/db.php"); ?>
<?php require_once __DIR__ . '/pdf/vendor/autoload.php'; ?>


<?php
	session_start();

	$orderid =  mysqli_real_escape_string($conn,$_GET['id']);
	$pdf = new \Mpdf\Mpdf();
	
	$data = '';

	$query = "SELECT o.orders_date,o.supplier_contact_person,o.orders_invoice_no,s.supplier_name from orders o inner join supplier s on o.supplier_id=s.supplier_id where orders_id = '$orderid'";
	
	$result = mysqli_query($conn,$query);
	$row    = mysqli_fetch_array($result);

	$orderDate = $row[0];
	$Supplier_contact = $row[1];
	$OrderInvoice = $row[2];
	$SupplierName = $row[3];

	$query = "SELECT i.drug_name,i.orders_quantity,c.company_name,i.drug_type,i.drug_power from orders_item i inner join drug_company c on i.company_id = c.company_id where orders_id = '$orderid'";

	$run=mysqli_query($conn,$query);

	$data = '<h5 style="text-align:center;line-height: 0;"> Order Invoice </h5>';
	$data .= '<h3 style="text-align:center;line-height: 0;"> UOH Health Center Pharmacy </h3>';
	$data .= '<h4 style="text-align:center;line-height: 0;">University of Hyderabad, CUC, Gachibowli,Hyderabad, Telagana 500046</h4>';
	$data .='<table align="center" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid black;margin-bottom: 10px;">
        <tbody>
		            
                  <tr>
                  		<td colspan="3" style=" text-align: left;padding-top: 4px; padding-left: 4px;"> TO, M/s:- '.$SupplierName.'</td>
                  		<td rowspan="8" colspan="2" style="border-left:1px solid black;"></td>
                     	<td colspan="3" style=" text-align: right;padding-top: 4px; padding-right:8px;"> Invoice Number:-'.$OrderInvoice.'</td>
                  </tr>
                  <tr>
                  		<td colspan="3" style=" text-align: left;padding-top: 4px;padding-left: 4px;"> Address:- Gachibowli,Hyderabad</td>
                     	<td colspan="3" style=" text-align: right;padding-top: 4px;padding-right:8px;">Order Date:- '.$orderDate.'</td>
                  </tr>
                  <tr>
                  		<td colspan="3" style=" text-align: left;padding-top: 4px;padding-left: 4px;"> Contact Person :-'.$Supplier_contact.'</td>
                  </tr>
                 <tr>
                  		<td colspan="3" style=" text-align: left;padding-top: 4px;padding-left: 4px;"> Mobile No:- +91 9999999999</td>
                  </tr>
                  <tr>
                  		<td colspan="3" style=" text-align: left;padding-top: 4px;padding-left: 4px;"> Email:- email@gmail.com</td>
                  </tr>
                  
               </tbody>
            </table>

            <table align="center" cellpadding="0" cellspacing="0" style="width: 100%;border:1px solid black;margin-bottom: 10px;">
            	<thead style=" box-shadow: 0 2px 2px -1px black; font-size: 17px;">
					<tr style="border:1px solid black;margin-bottom: 10px;">
						<th style="border-left: 1px solid black;height: 27px;">No.</th>
						<th style="border-left: 1px solid black;height: 27px;">Medicine Name</th>
						<th style="border-left: 1px solid black;height: 27px;">Quantity</th>
						<th style="border-left: 1px solid black;height: 27px;">Company</th>
						<th style="border-left: 1px solid black;height: 27px;">Type</th>
						<th style="border-left: 1px solid black;height: 27px;">MG/ML</th>
					</tr>
				</thead>';
				
				$counter =1;
				$count = 0;//for count item
				while($fetch = mysqli_fetch_array($run))
				{

				
       $data .='<tbody>
                  <tr style="border:1px solid black;margin-bottom: 10px;">
						<td style="border-left: 1px solid black;height: 27px; text-align: center;">'.$counter.'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["drug_name"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["orders_quantity"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["company_name"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["drug_type"].'</td>
						<td style="border-left: 1px solid black;height: 27px;text-align: center;">'.$fetch["drug_power"].'</td>
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
						<td colspan="3" style="text-align: right;padding-top: 4px;padding-right: 40px;">Order By:-'.$_SESSION["adminname"].'</td>
            		</tr>
            	</tbody>
            </table>';

	



    //echo $data;
    unset($_SESSION['order_id']);
	$pdf->WriteHTML($data);
	$pdf->Output('order.pdf','D');
	
?>

