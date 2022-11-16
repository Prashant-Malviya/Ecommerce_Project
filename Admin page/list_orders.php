<h2 class="text-success text-center">All Orders</h2>
<table class="table table-bordered text-light text-center mt-5">
    <thead class="bg-primary">

<?php

$get_orders="Select * from `user_orders`";
$result=mysqli_query($con,$get_orders);
$row_count=mysqli_num_rows($result);


if($row_count==0){
     echo "<h2 class='text-danger text-center my-3'>No Orders Yet</h2>";
}else{
    echo "<tr>
<th>SNo.</th>
<th>Due Amount</th>
<th>Invoice Number</th>
<th>Total Products</th>
<th>Order Date</th>
<th>Status</th>

</tr>
</thead>
<tbody class='bg-secondary'>";
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $order_id=$row_data['order_id'];
        $user_id=$row_data['user_id'];
        $amount_due=$row_data['amount_due'];
        $invoice_number=$row_data['invoice_number'];
        $total_products=$row_data['total_products'];
        $order_date=$row_data['order_date'];
        $order_status=$row_data['order_status'];
        $number++;
echo "
<tr>
    <td>$number</td>
    <td>$amount_due</td>
    <td>$invoice_number</td>
    <td>$total_products</td>
    <td>$order_date</td>
    <td>$order_status</td>
    
</tr>
";
    }
    
}
?>


      
        
    </tbody>
</table>