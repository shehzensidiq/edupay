<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 10/06/18
 * Time: 11:09 AM
 */
//admin@gmail.com
//admin_admin with u_id = 23
//error_reporting(0);
?>



<?php
require "include/db_config.php";
$key = "sheh_wase-nyla_yasm-";
if (isset($_POST["login"])) {
    $email = openssl_encrypt($_POST["email"], 'AES-256-ECB', $key, '0', '');
    $password = openssl_encrypt($_POST["password"], 'AES-256-ECB', $key, '0', '');
    //echo $email;

//        getting values form database

    $result = mysqli_query($link, "select u_id,email,password,status from table_user_edupay where email = '$email' and password = '$password'");
    $rowFetched = mysqli_fetch_assoc($result);

//         getting the login done and creating the session
    if ($email = $rowFetched["email"] and $password == $rowFetched["password"]) {
        if ($rowFetched["status"] == 'Approved') {
//                   echo $rowFetched["email"];
            //                    echo $rowFetched["password"];
            session_start();
            setcookie("auth_user",$rowFetched["u_id"],time()+86400);
            $_SESSION["auth_user"] = $rowFetched["u_id"];
            $session = $_SESSION["auth_user"];
//                   echo $session;
            //
            //                   // redirecting
            header("location:student_dashboard.php");

        } else {
            echo "<script>alert('Your Request is not yet verified and is PENDING.');</script>";

        }
    } else {
        echo "<script>alert('User Doesn\'t exist.Please try Again');</script>";
    }

//

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
<?php
//  including the header
require "header.php";

?>



<div class="container-fluid container-fill-height w-25">
    <div class="container-content-middle">
        <form role="form" method="post" class="mx-auto text-center app-login-form" onsubmit="emptyCheck()">

            <h2>EduPay <img src="include/images/logo.jpg" alt="" width="50px"></h2>


            <div class="form-group">
                <input class="form-control" placeholder="Username or email" name="email" id="email" onfocus="return emailValidate();" onblur="return emailValidate()">
                <sup id="spanemail" class=""></sup>
            </div>

            <div class="form-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" onfocus="return passwordValidate();" onblur="return passwordValidate()">
                <sup id="spanpassword"></sup>
            </div>

            <div class="mb-5">
                <button class="btn btn-primary" name="login" type="submit" onclick="">Log In</button>
                <a href="register.php" class="btn btn-success">Register</a>

            </div>

            <footer class="screen-login">
                <a href="forget.php" class="text-muted">Forgot password</a>
            </footer>
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


