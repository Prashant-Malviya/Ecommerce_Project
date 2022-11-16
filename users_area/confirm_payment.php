<!-- Connect File -->
<?php

include('../includes/connect.php');
session_start();

if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];

    $select_data="Select * from `user_orders` where order_id=$order_id";
    $result=mysqli_query($con,$select_data);
    $row_fetch=mysqli_fetch_assoc($result);
    $invoice_number=$row_fetch['invoice_number'];
    $amount_due=$row_fetch['amount_due'];

}

if(isset($_POST['confirm_payment'])){
    $invoice_number=$_POST['invoice_number'];
    $amount=$_POST['amount'];
    $payment_mode=$_POST['payment_mode'];
    $insert_query="insert into `user_payments` (order_id,invoice_number,payment_mode,amount) values ($order_id,$invoice_number,'$payment_mode',$amount)";
    $result=mysqli_query($con,$insert_query);
    if($result){
        echo "<script>alert('Payment Successfully')</script>";
        echo "<script>window.open('profile.php?my_orders','_self')</script>";
    }
    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>

  <!-- Bootstrap css link  -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body class = "bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method = "post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name='invoice_number' value="<?php echo  $invoice_number ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label for="" class="text-light"><b>Amount</b></label>
                <input type="text" class="form-control w-50 m-auto" name='amount' value="<?php echo  $amount_due ?>">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>NetBanking</option>
                    <option>Paypal</option>
                    <option>Cash On Delivery</option>
                </select>
                <div class="form-outline my-4 text-center w-50 m-auto">
                    <input type="submit" class="btn btn-primary btn-lg py-2 px-3" value="Confirm" name="confirm_payment">
                </div>
            </div>
        </form>
    </div>
</body>
</html>