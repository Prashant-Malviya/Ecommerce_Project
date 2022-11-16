<!-- Connect File -->
<?php

include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecommerce Website- Cart Details</title>

  <!-- Bootstrap css link  -->

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- font awsome link  -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- css file link  -->
    <link rel="stylesheet" href="style.css">
    <style>
.cart_img{
    width: 100px;
    height: 100px;
    object-fit:contain;
}

    </style>

</head>

<body>
  <!-- navbar -->
  <div class="container-fluid p-0">
    <!-- first child -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <img src="./img/ekart_logo.png" alt="" class="logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display_all.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./users_area/user_registration.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
            </li>
            
          </ul>
          
        </div>
      </div>
    </nav>
 
         <!-- calling cart function -->
        <?php cart(); ?>


    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
      <ul class="navbar-nav me-auto">
        
        <?php

if(!isset($_SESSION['user_email'])){
  echo " <li class='nav-item'>
  <a href='#' class='nav-link text-light'>Welcome Guest!</a>
</li>";
}else{
  echo "<li class='nav-item'>
  <a href='#' class='nav-link text-light'>Welcome ".$_SESSION['user_email']."</a>
</li>";
}

                if(!isset($_SESSION['user_email'])){
                  echo "<li class='nav-item'>
                  <a href='./users_area/user_login.php' class='nav-link text-light'>Login</a>
                </li>";
                }else{
                  echo "<li class='nav-item'>
                  <a href='./logout.php' class='nav-link text-light'>Logout</a>
                </li>";
                }

          ?>
      </ul>
    </nav>

    <!-- third child -->
    <div class="bg-light">
      <h3 class="text-center">Here are our Top Products</h3>
      <p class="text-center">Communication is at the heart of e-commerce and community</p>
    </div>

    <!-- fourth child  -->

    <div class="container">
        <div class="row">
            <form action="" method="post">
            <table class="table table-bordered text-center">
                
                <!-- php code to display dynamic data -->
<?php

$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query="Select * from `cart_details` where ip_address='$get_ip_address'";
$result=mysqli_query($con,$cart_query);

$result_count = mysqli_num_rows($result);
if($result_count>0){

  echo "
  <thead class='bg-primary text-light'>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Remove</th>
                        <th colspan='2'>Operations</th>
                    </tr>
                </thead>
                <tbody>
  
  ";

while($row=mysqli_fetch_array($result)){
  $product_id=$row['product_id'];
  $select_products="Select * from `products` where product_id='$product_id'";
  $result_products=mysqli_query($con,$select_products);


  while($row_product_price=mysqli_fetch_array($result_products)){

      $product_price=array($row_product_price['product_price']);
      $price_table=$row_product_price['product_price'];
      $product_title= $row_product_price['product_title'];
      $product_image1= $row_product_price['product_image1'];
      $product_values=array_sum($product_price);
      $total_price+=$product_values;
  

?>
                    <tr>
                        <td><?php echo $product_title ?></td>
                        <td><img src="./Admin page/product_images/<?php echo $product_image1 ?>" alt="cap" class="cart_img"></td>
                        <td><input type="text" name="qty" id="" class="form-input w-50">
                        </td>
                        <?php  
                            $get_ip_address = getIPAddress();
                          if(isset($_POST['update_cart'])){
                            $quantities=$_POST['qty'];
                            $update_cart="update `cart_details` set quantity=$quantities where ip_address='$get_ip_address'";
                            $result_products_quantity=mysqli_query($con,$update_cart);
                            $total_price=$total_price*$quantities;
                          }

                        ?>
                        <td>₹<?php echo $price_table ?>/-</td>

                        <td><input type="checkbox" name="removeitem[]" value="<?php  echo $product_id  ?>"></td>
                        <td>
                            <!-- <button class="btn btn-outline-primary mx-3 my-2"><b>Update</b></button> -->
                            <input type="submit" value="Update Cart" class="btn btn-lg btn-outline-success mx-3 my-2" name="update_cart">
                            <!-- <button class="btn btn-outline-primary mx-3 my-2"><b>Remove</b></button> -->
                            <input type="submit" value="Remove From Cart" class="btn btn-lg btn-outline-danger mx-3 my-2" name="remove_cart">
                        </td>
                    </tr>
             <?php    }

  }
}else{
  echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
}
 ?>
                </tbody>
            </table>

            <!-- subtotal  -->
         <div class="d-flex mb-5">


         <?php

$get_ip_address = getIPAddress();
$cart_query="Select * from `cart_details` where ip_address='$get_ip_address'";
$result=mysqli_query($con,$cart_query);

$result_count = mysqli_num_rows($result);
if($result_count>0){

echo "
<div class='mb-5'>
<h4 class='px-3 py-3'><b>Subtotal:</b><strong class='text-success'>₹$total_price /-</strong></h4>
<input type='submit' value='Continue Shopping' class='btn btn-primary btn-lg mx-3 my-2' name='Continue_Shopping'>
             <button class='btn btn-primary btn-lg mx-3 my-2'><a href='./users_area/checkout.php' class='text-light text-decoration-none'>Check Out</a></button></div>
";

}else{
  echo"
  <input type='submit' value='Continue Shopping' class='btn btn-primary btn-lg mx-3 my-2' name='Continue_Shopping'>";
}
if(isset($_POST['Continue_Shopping'])){
  echo "<script>window.open('index.php', '_self')</script>";
}
         ?>

          
          </div>
        </div>
    </div>
</form>
  <!-- function to remove item -->
    <?php
        function remove_cart_item(){
          global $con;
          if(isset($_POST['remove_cart'])){
            foreach($_POST['removeitem'] as $remove_id){
              echo $remove_id;
              $delete_query="Delete from `cart_details` where product_id=$remove_id";
              $run_delete=mysqli_query($con,$delete_query);
              if($run_delete)
              {
                echo "<script>window.open('cart.php','_self')</script>";
              }
            }
          }
        }
          echo $remove_item=remove_cart_item();

      ?>



       <!-- last child -->
     <!-- <?php include("./includes/footer.php");
     ?> -->
     <div class="bg-dark text-light text-center p-3 fixed-bottom">
      <p><b>All right reserved, &copy; Developed by Prashant</p></b>
    </div>
  </div>



  <!-- Bootstrap js link  -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>

</body>

</html>