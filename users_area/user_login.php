<?php
 
  include('../includes/connect.php');
  include('../functions/common_function.php');
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User -login</title>

    <!-- Bootstrap css link  -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- font awsome link  -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- css file link  -->
  <link rel="stylesheet" href="style.css">



</head>
<body>
    
<div class="container-fluid my-3">
<h2 class="text-center">User Login</h2>
<div class="row d-flex align-items-center justify-content-center mt-5">
    <div class="col-lg-12 col-xl-6">
        <form action="" method="post">
                 <!-- username field  -->
            <div class="form-outline mb-4">
                <label for="user_email" class="form-label"><b>User Name</b></label>
                <input type="email" id="user_email" class="form-control" placeholder="Enter Your Email" autocomplete="off" required="required" name = "user_email">
            </div>
                
             <!-- password field  -->
             <div class="form-outline mb-4">
                <label for="user_password" class="form-label"><b>User Password</b></label>
                <input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required="required" name = "user_password">
            </div>

            <!-- Login button button -->
              <div class="mt-4 pt-2">
                <input type="submit" value="Login" class = "btn btn-lg btn-outline-success py-2 px-3 border-primary" name="user_login">
                <p class="small fw-bold mt-2 mb-0 pt-1">Don't have an account ? <a href="user_registration.php" class = "text-danger"> Register</a> </p>
              </div>
        </form>
    </div>
</div>

</div>

</body>
</html>

<?php

if(isset($_POST['user_login'])){
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];
  
  $select_query = "Select * from `user_table` where user_email='$user_email'";
  $result = mysqli_query($con,$select_query);
  $row_count = mysqli_num_rows($result);
  $row_data = mysqli_fetch_assoc($result);
  $user_ip = getIPAddress();



// cart item 
$select_query_cart = "Select * from `cart_details` where ip_address='$user_ip'";
$select_cart = mysqli_query($con,$select_query_cart);
$row_count_cart = mysqli_num_rows($select_cart);

  if($row_count > 0){
    $_SESSION['user_email'] = $user_email;
    if(password_verify($user_password,$row_data['user_password'])){
      // echo "<script>alert('Successfully Loged In')</script>";
      if($row_count == 1 and $row_count_cart == 0){
          // session variable
        $_SESSION['user_email'] = $user_email;
        echo "<script>alert('Successfully Loged In')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
      }else{
        $_SESSION['user_email'] = $user_email;
        echo "<script>alert('Successfully Loged In')</script>";
        echo "<script>window.open('payment.php','_self')</script>";
      }
    }else{
      echo "<script>alert('Invalid Credential')</script>";
    }

  }else{
          echo "<script>alert('Invalid Credential')</script>";
  }
  
}

?>






