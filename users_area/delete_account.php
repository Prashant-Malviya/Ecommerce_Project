
    <h3 class="text-danger mb-4">Deleting Account</h3>
    <form action="" method="post" class="mt-5">
        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto btn btn-lg btn-outline-danger" name="delete" value="Delete Your Account">
        </div>

        <div class="form-outline mb-4">
            <input type="submit" class="form-control w-50 m-auto btn btn-lg btn-outline-success" name="dont_delete" value="Don't Delete Account">
        </div>

    </form>
<?php

$user_email_session=$_SESSION['user_email'];
if(isset($_POST['delete'])){
    $delete_query="Delete from `user_table` where user_email='$user_email_session'";
    $result=mysqli_query($con,$delete_query);
    if($result){
        session_destroy();
        echo "<script>alert('You Have Deleted Your Account!!!!')</script>";
        echo "<script>window.open('../index.php','_self')</script>";
    }
}
if(isset($_POST['dont_delete'])){
    echo "<script>window.open('profile.php','_self')</script>";

}

?>