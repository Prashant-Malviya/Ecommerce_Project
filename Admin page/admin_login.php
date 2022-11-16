<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

     <!-- Bootstrap css link  -->

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- css file link  -->
    <link rel="stylesheet" href="../style.css">

  <!-- font awsome link  -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            overflow:hidden;
        }
    </style>
</head>
<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../img/admin1.jpg" alt="admin" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-4">
               <form action="" method="post">

                <div class="form-outline mb-4">
                    <label for="email" class="form-label fw-bold">User Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Your User Email" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label fw-bold">User Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Your User password" required="required" class="form-control">
                </div>
                
                <div>
                    <input type="submit" class="btn btn-lg btn-outline-primary" name="admin_login" value="Login">
                    <p class="small fw-bold mt-2 pt-1">Don't You Have An Account <a href="admin_registration.php" class="link-danger">Sing Up</a></p>
                </div>
               </form>
            </div>
        </div>
        
    </div> 

</body>
</html>