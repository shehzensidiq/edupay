<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 19/08/18
 * Time: 11:23 AM
 */
include "../../../include/db_config.php";
$key="sheh_wase-nyla_yasm-";
//session_start();

$nameEdit = "";
$emailEdit = "";
$semEdit = "";
$courseEdit = "";
$regEdit = "";
$erollEdit = "";
$passwordEdit = "";
$gender="";
if (isset($_GET["student_edit"])){
    $id = $_GET["hidden_btn"];
    $result= mysqli_query($link,"select * from table_user_edupay where u_id = $id ");
    $rowFetched = mysqli_fetch_assoc($result);
    $nameEdit = $rowFetched["name"];
    $emailEdit = openssl_decrypt($rowFetched["email"],'AES-256-ECB',$key,'0','');
    $semEdit = $rowFetched["semester"];
    $courseEdit = $rowFetched["course"];
    $regEdit = $rowFetched["reg_num"];
    $erollEdit = $rowFetched["enroll_id"];
    $gender = $rowFetched["gender"];
    $passwordEdit = openssl_decrypt($rowFetched["password"],'AES-256-ECB',$key,'0','');;


}
if (isset($_GET["returnId"])){
    $id = $_GET["returnId"];
    $result= mysqli_query($link,"select * from table_user_edupay where u_id = $id ");
    $rowFetched = mysqli_fetch_assoc($result);
    $nameEdit = $rowFetched["name"];
    $emailEdit = openssl_decrypt($rowFetched["email"],'AES-256-ECB',$key,'0','');
    $semEdit = $rowFetched["semester"];
    $courseEdit = $rowFetched["course"];
    $regEdit = $rowFetched["reg_num"];
    $erollEdit = $rowFetched["enroll_id"];
    $gender = $rowFetched["gender"];
    $passwordEdit = openssl_decrypt($rowFetched["password"],'AES-256-ECB',$key,'0','');
    echo "<script>alert('The Details Have Been Updated');</script>";

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

        ADMIN :: Dashboard

    </title>
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="assets/css/toolkit-inverse.css" rel="stylesheet">


    <link href="assets/css/application.css" rel="stylesheet">

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
        }
        th{
            font-size: 12px;
            padding: 0;
        }
        td{

            font-size: 12px;
            padding: 0;
        }
        .card {
            background-color: #25282F;
            padding: 10px;
            border:1px solid grey;
        }
        button
        {
            cursor: pointer;
        }
         .form-control{
            text-transform: capitalize;
        }
        .password {
            text-transform: none;
        }
        .button:hover{
            background-color:#337396 ;
        }
    </style>
</head>


<body>
<div class="row p-3">
    <?php
    include"header.php"
    ?>

    <div class="col-sm-9 content">
        <?php

        include("head.php");
        ?>

        <hr class="mt-1">
        <div class="col">

            <a href="student-details.php" class="btn text-white button"><span class="icon icon-back"></span>Back</a>
            <div class="statcard  p-3 w-75 mx-auto" style="border: 1px solid grey;border-radius: 5px">
                <div class="p-3">
                    <span class="statcard-desc">Edit Details</span>
                    <span class="statcard-desc text-white" style="margin-left: 26%;"><?php
                        echo $nameEdit;
                        ?></span>
                    <span class="statcard-desc float-right">Edit Details</span>
                    <h2 class="statcard-number">

                    </h2>
                    <hr class="statcard-hr mb-0">

                    <form action="../../../include/update.php" method="post" id="form">
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" value="<?php echo $nameEdit ?>"  class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Semester</label>
                                <input type="text" value="<?php echo $semEdit ?>" class="form-control" name="semester">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Course</label>
                                    <input type="text" value="<?php echo $courseEdit ?>" class="form-control" name="course">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Registration Number</label>
                                <input type="text" value="<?php echo $regEdit ?>" class="form-control text-uppercase" name="reg_num">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Enrollment Number</label>
                                    <input type="text" value="<?php echo $erollEdit ?>"  class="form-control" name="enroll_id">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Gender</label>
                                <input type="text" value="<?php echo $gender ?>" class="form-control" name="gender">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email"  class="form-control password" value="<?php echo $emailEdit ?>" name="email" min="0">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Password</label>
                                <input type="text" class="form-control password" name="password" value="<?php echo $passwordEdit ?>" id="">
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                <input type="submit" value="Update Details" class="btn btn-block btn-success" id="button" name ="update_btn_std">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

<!--form to add admin-->


<!--footer-->

<hr class="mt-5">



<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tether.min.js"></script>
<script src="assets/js/chart.js"></script>
<script src="assets/js/tablesorter.min.js"></script>
<script src="assets/js/toolkit.js"></script>
<script src="assets/js/application.js"></script>
<script>
    // execute/clear BS loaders for docs
    $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
</script>
</body>
</html>
