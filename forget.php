<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 27/09/18
 * Time: 7:49 PM
 */
date_default_timezone_set('Asia/Calcutta');
include "include/db_config.php";
session_start();
$key = "sheh_wase-nyla_yasm-";
if (isset($_POST["reset"])){
    $email = openssl_encrypt($_POST["email"], 'AES-256-ECB', $key, '0', '');
    $dataSet = mysqli_query($link,"select email from table_user_edupay where email = '$email'");
    if(mysqli_num_rows($dataSet)==1){
        $data = mysqli_fetch_assoc($dataSet);

        $otp = rand(100000,1000000);
        $_SESSION["otp"] = $otp;
        $message = 'YOUR OTP is :'.$otp.". Please Use This OTP To Confirm Your Email And Proceed For Password Change";
        $newTime = date('H:i', strtotime('+15 minutes'));

//        echo $message;

        mysqli_query($link,"insert into otp (email,otp,date,time,expirytime,expirydate) values('$email',$otp,NOW(),NOW(),'$newTime',NOW()) ");


        $email = openssl_decrypt($email,'AES-256-ECB', $key, '0', '');
        mail($email,'Password Reset Request',$message);
        header("location:otp.php");
    } else {
       // echo "<div class='alert alert-info'>The User Does Not Exist</div>";
        echo"<div class='alert alert-success alert-dismissible'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <span>The User Does Not Exist</span>
        </div>";


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

        Reset Password

    </title>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="admin/admin/docs/assets/css/toolkit-light.css" rel="stylesheet">

    <link href="admin/admin/docs/assets/css/application.css" rel="stylesheet">
    <!--    <link rel="stylesheet" href="scss/style.css">-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <style>
        body {
            padding: 0;
            margin: 0;
        }
    </style>



</head>


<body>


<div class="container-fluid container-fill-height w-25">
    <div class="container-content-middle">
        <form role="form" method="post" class="mx-auto text-center app-login-form">

            <h2>EduPay <img src="include/images/logo.jpg" alt="" width="50px"></h2>
            <sup>Forget Password</sup>

            <div class="form-group">
                <input class="form-control" placeholder="Username or email" name="email" id="email"
                           onfocus="return emailValidate();" onblur="return emailValidate()">
                    <sup id="spanemail" class=""></sup>

            </div>

            <div class="mb-5">

                <button class="btn btn-primary" name="reset" type="submit" onclick="">Reset</button>
            </div>
        </form>
    </div>
</div>


<script src="admin/admin/docs/assets/js/jquery.min.js"></script>
<script src="admin/admin/docs/assets/js/tether.min.js"></script>
<script src="admin/admin/docs/assets/js/chart.js"></script>
<script src="admin/admin/docs/assets/js/toolkit.js"></script>
<script src="admin/admin/docs/assets/js/application.js"></script>
<script type="text/javascript" src="include/edupay.js" >
    // execute/clear BS loaders for docs
    $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
            while(BS.loader.length){(BS.loader.pop())()}
        }
    })
</script>
</body>
</html>
