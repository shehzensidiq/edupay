
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
require "../include/db_config.php";
$key = "sheh_wase-nyla_yasm-";
if (isset($_POST["login"])) {
    $email = openssl_encrypt($_POST["email"], 'AES-256-ECB', $key, '0', '');
    $password = openssl_encrypt($_POST["password"], 'AES-256-ECB', $key, '0', '');

//        getting values form database

    $result = mysqli_query($link, "select canteen_id,canteen_email,password from table_canteen_admin where canteen_email = '$email' and password = '$password'");
    $rowFetched = mysqli_fetch_assoc($result);

//         getting the login done and creating the session
    if ($email = $rowFetched["canteen_email"] and $password == $rowFetched["password"]) {
//                   echo $rowFetched["email"];
            //                    echo $rowFetched["password"];
            session_start();
            $_SESSION["auth_user"] = $rowFetched["canteen_id"];
            $_SESSION["type"] = "canteen";
//            $session = $_SESSION["auth_user"];
//                   echo $session;
            //
            //                   // redirecting
            header("location:canteen_dashboard.php");

    } else {
        echo "<script>alert('Canteen Not registered!!');</script>";
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
    <link href="../admin/admin/docs/assets/css/toolkit-light.css" rel="stylesheet">

    <link href="../admin/admin/docs/assets/css/application.css" rel="stylesheet">
    <!--    <link rel="stylesheet" href="scss/style.css">-->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">


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
<div class="container-fluid container-fill-height w-25">
    <div class="container-content-middle">
        <form role="form" method="post" class="mx-auto text-center app-login-form">

            <h2>EduPay <img src="../include/images/logo.jpg" alt="" width="50px"></h2>


            <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="email@email.com" id="email"  onfocus="return emailValidate()" onblur="return emailValidate()">
                    <sup id="spanemail"></sup>
            </div>
            <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="*************" id="password" onfocus="return passwordValidate()" onblur="return passwordValidate()">
                    <sup id="spanpassword"></sup>
            </div>

            <div class="mb-3">
                <button type="submit" value="submit" name ="login" class="btn btn-primary">LogIn &#x27B2;</button>
            </div>

            <footer class="screen-login">
                <a href="#" class="text-muted">Forgot password</a>
            </footer>
        </form>
    </div>
</div>

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



