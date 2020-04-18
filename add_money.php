
<?php
session_start();
$session = $_SESSION["auth_user"];
include "include/db_config.php";



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

        Student :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="admin/admin/docs/assets/css/toolkit-light.css" rel="stylesheet">


    <link href="admin/admin/docs/assets/css/application.css" rel="stylesheet">

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
            padding: 0;
            margin: 0;

            /*background-color: #effdfd;*/
        }
        li {
            border-radius: 5px;
            margin-top: 20px;
            font-size: 15px;
            padding-left: 10px;
            /*text-align: center;*/
            background-color:#4496C2;
        }
        li:hover{
            /*background-color: #4496C2;*/
            border-radius:5px;
            /*color: white;*/
        }

        .dropdown-menu :hover> button  {
            background-color: #4496C2;
            color: white;
        }
        input {
            text-transform: uppercase;
            /*font-variant-caps: unicase;*/
        }
    </style>
</head>


<body>
<!--   <div class="container"> -->
<div class="row p-3">
    <?php
    include "side-panel.php";
    ?>
    <div class="col-md-10 content">
        <?php
        include "header_dash.php"
        ?>

        <hr class="mt-3">
    <div class="col">
        <div class="statcard  p-3 w-75 mx-auto" style="border: 1px solid grey;border-radius: 5px">
            <div class="p-3">
                <span class="statcard-desc">Add Amount</span>
                <span class="statcard-desc float-right">Add Amount</span>
                <h2 class="statcard-number">

                </h2>
                <hr class="statcard-hr mb-0">

                <form action="process_money.php" method="post" onsubmit="return add_money()">

                    <?php
                            $key = "sheh_wase-nyla_yasm-";   
                            $_SESSION["name"]=$rowFetched["name"];
                            $_SESSION["email"]=openssl_decrypt($rowFetched["email"],'AES-256-ECB', $key, '0', '');
                            $_SESSION["phone"]=$rowFetched["enroll_id"];
                            $_SESSION["productinfo"]="Add Money To Account";
                    ?>

                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" value="<?php echo $rowFetched["name"] ?>" disabled class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Semester</label>
                            <input type="text" value="<?php echo $rowFetched["semester"] ?>" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Course</label>
                                <input type="text" value="<?php echo $rowFetched["course"] ?>" disabled class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Registration Number</label>
                            <input type="text" value="<?php echo $rowFetched["reg_num"] ?>" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Enrollment Number</label>
                                <input type="text" value="<?php echo $rowFetched["enroll_id"] ?>" disabled class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Gender</label>
                            <input type="text" value="<?php echo $rowFetched["gender"] ?>" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Enter The Amount To Be Added</label>
                                <input type="number"  class="form-control" name="amount" placeholder="100 - 10000" min="0" id="amount" onfocus="return moneyValidate()" onblur="moneyValidate()">
                                 <sup id="errorAmount"></sup>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Password To confirm The transaction</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="*************" onfocus="return passwordValidate()" onblur="passwordValidate()">
                            <sup id="spanpassword"></sup>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <input type="submit" value="Add Money" class="btn btn-block btn-success" id="button" name ="btn_pay">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<hr class="mt-5">

<!-- </div> -->


<script src="admin/admin/docs/assets/js/jquery.min.js"></script>
<script src="admin/admin/docs/assets/js/tether.min.js"></script>
<script src="admin/admin/docs/assets/js/chart.js"></script>
<script src="admin/admin/docs/assets/js/tablesorter.min.js"></script>
<script src="admin/admin/docs/assets/js/toolkit.js"></script>
<script src="admin/admin/docs/assets/js/application.js"></script>
<script type="text/javascript" src="include/edupay.js">

    // execute/clear BS loaders for docs
    $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
</script>
</html>
