<?php

include('../includes/connect.php');


if(isset($_POST['insert_brand'])){
  $brand_title=$_POST['brand_title'];

  //to check whether the field is empty;
  if (empty($brand_title))
  echo "<script>alert('Please insert brand')</script>";
  else{
//Select data from database
$select_query="Select * from `brands` where brand_title='$brand_title'";
$result_select=mysqli_query($con,$select_query);
$number=mysqli_num_rows($result_select);
if($number>0){
echo "<script>alert('This Brand is already present')</script>";
}
else{
  $insert_query="insert into `brands` (brand_title) values ('$brand_title')";
  $result=mysqli_query($con,$insert_query);
  if($result){
    echo "<script>alert('Brand hass been inserted successfully')</script>";
  }
}
  }
}

?>


<h2 class="text-center">Insert Brands</h2>

<form action="" method="post" class="mb-2">
  <div class="input-group w-90 mb-2">
    <span class="input-group-text bg-primary" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="brands"
      aria-describedby="basic-addon1">
  </div>

  <div class="input-group w-90 mb-2">

    <!-- <input type="submit" class="form-control" name = "cat_title" value="Insert Categories" aria-label="Username" aria-describedby="basic-addon1" class="bg-success"> -->

    <input type="submit" class="btn btn-outline-success p-2 my-3" name="insert_brand" value="Insert Brands">

  </div>

</form>