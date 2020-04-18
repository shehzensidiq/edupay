<?php

//admin@gmail.com
//admin

include ("../include/db_config.php");
$key="sheh_wase-nyla_yasm-";
 if (isset($_POST["transport_btn"])){
     $email = openssl_encrypt($_POST["email"],'AES-256-ECB',$key,'0','');
     $password = openssl_encrypt($_POST["password"],'AES-256-ECB',$key,'0','');
         $result = mysqli_query($link,"select ad_id,ad_email,ad_password,admin_for from table_admin_faculty where ad_email = '$email' and ad_password = '$password'");
         $rowFetched = mysqli_fetch_assoc($result);
            if ($rowFetched["ad_email"] == $email and $rowFetched["ad_password"] == $password and $rowFetched["admin_for"] == 'transport') {
                session_start();
                $_SESSION["auth_user"] = $rowFetched["ad_id"];
                $_SESSION["type"] = "transport";
                header("location:transport_dashboard.php");
            } else {
                echo "<script>alert('You are not an Admin For transport!!');</script>";
            }
 }else if (isset($_POST["library_btn"])) {
     $email = openssl_encrypt($_POST["email"],'AES-256-ECB',$key,'0','');
     $password = openssl_encrypt($_POST["password"],'AES-256-ECB',$key,'0','');
         $result = mysqli_query($link,"select ad_id,ad_email,ad_password,admin_for from table_admin_faculty  where ad_email = '$email' and ad_password = '$password'");
         $rowFetched = mysqli_fetch_assoc($result);
       

         
         if ($rowFetched["ad_email"] == $email && $rowFetched["ad_password"] == $password && $rowFetched["admin_for"] == 'library') {
             session_start();
             $_SESSION["auth_user"] = $rowFetched["ad_id"];
             $_SESSION["type"] = "library";
             header( "location:library/library_dashboard.php");
         } else{
             echo "<script>alert('You are not an Admin For library!!');</script>";
         }
 }





?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>

        Login &middot;

    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="../admin/admin/docs/assets/css/toolkit-light.css" rel="stylesheet">

    <link href="../admin/admin/docs/assets/css/application.css" rel="stylesheet">
<!--    <link rel="stylesheet" href="scss/style.css">-->
<!--    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">-->
            <script src="https://use.fontawesome.com/c98eab8b1b.js"></script>



    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;

        }
        nav {
            margin-top: -50px;
        }
    </style>

</head>


<body>
<?php
////  including the header
include ("../admin/header_login.php");

//
//?>



<div class="container-fluid container-fill-height">
    <div class="container-content-middle " >
        <form role="form" method="post" class="mx-auto text-center app-login-form w-25">

            <h2>EduPay <img src="../include/images/logo.jpg" alt="" width="50px"></h2>


            <div class="form-group">
                <input class="form-control" placeholder="Username or email" name="email" id="email" onfocus="return emailValidate()" onblur="return emailValidate()">
                <sup id="spanemail"></sup>
            </div>

            <div class="form-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" onfocus="return passwordValidate()" onblur="return passwordValidate() ">
                <sup id="spanpassword"></sup>
            </div>

            <div class="mb-2 row">
                <div class="col-sm-6">
                    <button type="submit"  value="submit" name="transport_btn" class="btn btn-block btn-outline-primary button mt-2"> Transport Login <span class="icon icon-aircraft"></span></button>
                </div>
                <div class="col-sm-6">
                    <button type="submit"  value="submit" name="library_btn" class="btn btn-block btn-outline-primary button mt-2"> Library Login <span class="icon icon-book"></span></button>
                </div>


            </div>

            <footer class="screen-login">
                <a href="#" class="text-muted">Forgot password</a>
            </footer>
        </form>
    </div>
</div>

<?php
//
//include "../include/footer.php";
//?>
<script src="../admin/admin/docs/assets/js/jquery.min.js"></script>
<script src="../admin/admin/docs/assets/js/tether.min.js"></script>
<script src="../admin/admin/docs/assets/js/chart.js"></script>
<script src="../admin/admin/docs/assets/js/toolkit.js"></script>
<script src="../admin/admin/docs/assets/js/application.js"></script>
<script type="text/javascript" src="../include/edupay.js">
    // execute/clear BS loaders for docs
    $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
            while(BS.loader.length){(BS.loader.pop())()}
        }
    })
</script>
</body>
</html>

