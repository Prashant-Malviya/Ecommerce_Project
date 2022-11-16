<h2 class="text-success text-center">All Payments</h2>
<table class="table table-bordered text-light text-center mt-5">
    <thead class="bg-primary">

<?php

$get_payments="Select * from `user_payments`";
$result=mysqli_query($con,$get_payments);
$row_count=mysqli_num_rows($result);


if($row_count==0){
     echo "<h2 class='text-danger text-center my-3'>No Payment Recieved Yet!!</h2>";
}else{
    echo "<tr>
<th>SNo.</th>
<th>Invoice Number</th>
<th>Amount</th>
<th>Payment Mode</th>
<th>Order Date</th>

</tr>
</thead>
<tbody class='bg-secondary'>";
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $amount=$row_data['amount'];
        $invoice_number=$row_data['invoice_number'];
        $payment_mode=$row_data['payment_mode'];
        $date=$row_data['date'];
        $number++;
echo "
<tr>
    <td>$number</td>
    <td>$invoice_number</td>
    <td>$amount</td>
    <td>$payment_mode</td>
    <td>$date</td>

</tr>
";
    }
    
}
?>


      
        
    </tbody>
</table>