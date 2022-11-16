<?php
 
  include('../includes/connect.php');
  include('../functions/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User -registration</title>

    <!-- Bootstrap css link  -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- font awsome link  -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- css file link  -->
  <link rel="stylesheet" href="../style.css">

</head>
<body>
    
<div class="container-fluid my-3">
<h2 class="text-center">New User Registration</h2>
<div class="row d-flex align-items-center justify-content-center">
    <div class="col-lg-12 col-xl-6">
        <form action="" method="post" enctype="multipart/form-data">
                 <!-- username field  -->
            <div class="form-outline mb-4">
                <label for="user_username" class="form-label"><b>User Name</b></label>
                <input type="text" id="user_username" class="form-control" placeholder="Enter Your User Name" autocomplete="off" required="required" name = "user_username">
            </div>
                <!-- email field  -->
            <div class="form-outline mb-4">
                <label for="user_email" class="form-label"><b>User Email</b></label>
                <input type="email" id="user_email" class="form-control" placeholder="Enter Your email" autocomplete="off" required="required" name = "user_email">
            </div>
                <!-- Image field -->
            <div class="form-outline mb-4">
                <label for="user_image" class="form-label"><b>User Image</b></label>
                <input type="file" id="user_image" class="form-control"   required="required" name = "user_image">
            </div>

             <!-- password field  -->
             <div class="form-outline mb-4">
                <label for="user_password" class="form-label"><b>User Password</b></label>
                <input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required="required" name = "user_password">
            </div>

             <!-- confirm password field  -->
            <div class="form-outline mb-4">
                <label for="confirm_user_password" class="form-label"><b>Confirm Password</b></label>
                <input type="password" id="confirm_user_password" class="form-control" placeholder="Confirm Your Password" autocomplete="off" required="required" name = "confirm_user_password">
            </div>

             <!-- Address field  -->
             <div class="form-outline mb-4">
                <label for="user_address" class="form-label"><b>User Address</b></label>
                <input type="text" id="user_address" class="form-control" placeholder="Enter Your Address" autocomplete="off" required="required" name = "user_address">
            </div>

             <!-- Contact field  -->
             <div class="form-outline mb-4">
                <label for="user_contact" class="form-label"><b>User Contact Number</b></label>
                <input type="text" id="user_contact" class="form-control" placeholder="Enter Your Mobile Number" autocomplete="off" required="required" name = "user_contact">
            </div>
              <div class="mt-4 pt-2">
                <input type="submit" value="Register" class = "btn btn-lg btn-outline-success py-2 px-3 border-primary" name = "user_register">
                <p class="small fw-bold mt-2 mb-0 pt-1">Already have an account ? <a href="user_login.php" class = "text-danger"> Login</a> </p>
              </div>
        </form>
    </div>
</div>

</div>

</body>
</html>


<!-- php code  -->
<?php
if(isset($_POST['user_register'])){
$user_username = $_POST['user_username'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];
$hash_password = password_hash($user_password,PASSWORD_DEFAULT);
$confirm_user_password = $_POST['confirm_user_password'];
$user_address = $_POST['user_address'];
$user_contact = $_POST['user_contact'];
$user_image = $_FILES['user_image']['name'];
$user_image_tmp = $_FILES['user_image']['tmp_name'];
$user_ip = getIPAddress();

//select query;

$select_query = "Select * from `user_table` where user_email = '$user_email'";
$result = mysqli_query($con,$select_query);
$rows_count = mysqli_num_rows($result);
if($rows_count>0){
    echo "<script>alert('User email already exist')</script>";
}else if($user_password != $confirm_user_password){
  echo "<script>alert('Passwords Not Matched!')</script>";
}
else{

//insert_query
move_uploaded_file($user_image_tmp,"./user_images/$user_image");
$insert_query = "insert into `user_table` (username ,user_email, user_password, user_image, user_ip, user_address, user_mobile) values('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_address','$user_contact')";
$sql_execute = mysqli_query($con,$insert_query);
if($sql_execute){
  echo "<script>alert('Successfully Registered')</script>";
}else{
  die(mysqli_error($con));
}

}

// selecting cart item
$select_cart_items = "Select * from `cart_details` where ip_address = '$user_ip'";
$result_cart = mysqli_query($con,$select_cart_items);
$rows_count = mysqli_num_rows($result_cart);
if($rows_count>0){
  $_SESSION['user_email'] = $user_email;
  echo "<script>alert('You Have Items In Your Cart')</script>";
  echo "<script>window.open('checkout.php','_self')</script>";
}else{
  echo "<script>window.open('user_login.php','_self')</script>";
}
}
?>



