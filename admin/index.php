<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 10/06/18
 * Time: 11:09 AM
 */

require("../include/db_config.php");
//main admin details

//admin@gmail.com
//admin_admin
?>


<?php

if(isset($_POST["admin_login"]))
{
    $key="sheh_wase-nyla_yasm-";
    $email=openssl_encrypt($_POST["admin_email"],'AES-256-ECB',$key,'0','');
    $password=openssl_encrypt($_POST["admin_password"],'AES-256-ECB',$key,'0','');

    //fetching from database
    $result = mysqli_query($link,"select * from table_admin_edupay where email = '$email' and password = '$password'");
    $rowFetched = mysqli_fetch_assoc($result);
        if ($rowFetched["email"] == $email and $rowFetched["password"] == $password){
//                creating as session
            session_start();
            $_SESSION["auth_admin"] = $rowFetched["admin_id"];
            header("location:admin/docs/admin_dashboard.php");

        }
        else
        {
            echo "<script>alert('Inavlid Credentials!!!! Please Retry');</script>";
//            echo $email;
//            echo "<br>".$password;
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
    <link href="admin/docs/assets/css/toolkit-light.css" rel="stylesheet">

    <link href="admin/docs/assets/css/application.css" rel="stylesheet">

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
        }
    </style>

</head>


<body>




<div class="container-fluid container-fill-height">
    <div class="container-content-middle">
        <form role="form" method="post" class="mx-auto text-center app-login-form w-25">

                <h2>EduPay <img src="../include/images/logo.jpg" alt="" width="50px"></h2>


            <div class="form-group">
                <input class="form-control" placeholder="Username" name="admin_email" id="email" onfocus=" return emailValidate()" onblur="return emailValidate()">
                <sup id="spanemail" class=""></sup>
            </div>

            <div class="form-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="admin_password" id="password" onfocus="return passwordValidate()" onblur="return passwordValidate()">
                 <sup id="spanpassword"></sup>
            </div>

            <div class="mb-5">
                <button class="btn btn-primary" name="admin_login" type="submit">Log In</button>
            </div>

            <footer class="screen-login">
                <a href="#" class="text-muted">Forgot password</a>
            </footer>
        </form>
    </div>
</div>


<script src="admin/docs/assets/js/jquery.min.js"></script>
<script src="admin/docs/assets/js/tether.min.js"></script>
<script src="admin/docs/assets/js/chart.js"></script>
<script src="admin/docs/assets/js/toolkit.js"></script>
<script src="admin/docs/assets/js/application.js"></script>
<script type="text/javascript" src="../include/edupay.js" >
    // execute/clear BS loaders for docs
    $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
            while(BS.loader.length){(BS.loader.pop())()}
        }
    })
</script>
</body>
</html>

