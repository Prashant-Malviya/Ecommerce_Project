<?php

if(isset($_GET['edit_brands'])){
    $edit_brand=$_GET['edit_brands'];
    // echo $edit_category;
    $get_brands="Select * from `brands` where brand_id=$edit_brand";
    $result=mysqli_query($con,$get_brands);
    $row=mysqli_fetch_assoc($result);
    $brand_title=$row['brand_title'];
    // echo $category_title;
}
if(isset($_POST['edit_brand'])){
    $brand_title=$_POST['brand_title'];


    $update_query="update `brands` set brand_title='$brand_title' where brand_id=$edit_brand";
    $result_brand=mysqli_query($con,$update_query);
    if($result_brand){
        echo "<script>alert('Brand Has been updated successfully')</script>";
        echo "<script>window.open('./view_brands.php','_self')</script>";
    }
    // brand_title=Nike1&edit_brand=Update+Brand
}

?>


<div class="container mt-3">
    <h1 class="text-center text-success">Edit Category</h1>
        <form action="" mehtod = "post" class="text-center">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="brand_title" class="form-label"><h4>Category Title</h3></label>
                <input type="text" name="brand_title" id="brand_title" class="form-control" required="required" value='<?php echo $brand_title; ?>'>
            </div>
            <input type="submit" value="Update Brand" class="btn btn-lg btn-outline-warning px-3 mb-3" name="edit_brand">
        </form>
    
</div>