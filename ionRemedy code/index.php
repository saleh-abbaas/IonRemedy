<?php
require './Database/connectToDatabase.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['id_number'])) {
    header('Location: ./home.php');
}

$sql = "SELECT * FROM auth";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>IonRemedy Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./Assets/bootstrap-4.5.3-dist/css/bootstrap.min.css">
    <link rel="application/javascript" href="./Assets/bootstrap-4.5.3-dist/js/bootstrap.min.js">
    <link rel="application/javascript" href="./Assets/bootstrap-4.5.3-dist/js/bootstrap.bundle.min.js">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
body {
  background-image: url('Assets/Images/towfiqu-barbhuiya-w8p9cQDLX7I-unsplash.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}

        </style>
</head>


<body>
<center>
    <div class="col-xl-4  mb-5 mt-5">
        <form method="POST" action="./operations/auth.php">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-header shadow-sm p-3  bg-body rounded" style="font-size:25px">IonRemedy Login
                </div>
                <div class="card-body ">
                    <div class="row col-xl-12 mt-3 mb-4 ml-1 input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                          <img src="./Assets/Images/icons8-username-96.png" class="img-responsive"
                               alt="Responsive image" width="30" height="30"/>
                        </span>
                        </div>
                  
                            <input type="id_number" class="form-control text-center"
                               oninvalid="this.setCustomValidity('رقم الهوية')"
                               oninput="setCustomValidity('')" name="id_number" placeholder="رقم الهوية" required
                               style="font-size:20px">
           

                  
                    </div>
                    <div class="row  col-xl-12 mt-3 mb-4 ml-1 input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">
                          <img src="./Assets/Images/icons8-sign-in-form-password-96.png" class="img-responsive"
                               alt="Responsive image" width="30" height="30"/>
                        </span>
                        </div>
                        <input type="password" class="form-control text-center"
                               oninvalid="this.setCustomValidity('الرجاء ادخال كلمة المرور')"
                               oninput="setCustomValidity('')" name="password" placeholder="كلمة المرور" required
                               style="font-size:20px">
                    </div>
                    <div class="col-xl-6 col-12 ml-2 ">
                        <button type="submit" class="btn btn-success col-xl-12 rounded-pill" style="font-size:20px">
                            LogIn
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</center>
</body>
</html>