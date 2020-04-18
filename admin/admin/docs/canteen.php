<?php
include "../../../include/db_config.php";
$key = "sheh_wase-nyla_yasm-";
$canteenNameEdit = "";
$contractorNameEdit = "";
$contractorEmailEdit = "";
$contractorPhoneEdit = "";
$contractorPasswordEdit = "";
//$dobEdit = "";
//$passwordEdit = "";
?>
<?php
if (isset($_GET["edit_canteen"])){
    $id = $_GET["hidden_btn"];
    $result = mysqli_query($link,"select * from table_canteen_admin where canteen_id = $id");
    $rowFetched = mysqli_fetch_assoc($result);
    $contractorNameEdit = $rowFetched["contractor"];
    $canteenNameEdit = $rowFetched["canteen_name"];
    $contractorPhoneEdit = $rowFetched["phone"];
    $contractorEmailEdit = openssl_decrypt($rowFetched["canteen_email"],'AES-256-ECB',$key,'0','');

//    $dobEdit = $rowFetched["dob"];
    $contractorPasswordEdit = openssl_decrypt($rowFetched["password"],'AES-256-ECB',$key,'0','');




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
            padding: 0;
            margin: 0;
        }
        th{
            font-size: 12px;
            padding: 0;
        }
        td{

            font-size: 12px;
            padding: 0;
        }
    </style>
</head>


<body>
<div class="row p-3">
    <?php
include "header.php"
?>

    <div class="col-sm-9 content">
        <?php

include "head.php";
?>

        <hr class="mt-1">
        <div class="container mt-2" id="form-canteen">
            <div class="card w-50 mx-auto"  style="background-color:#25282F; border:1px solid grey;">
                <div class="card-header"  style="background-color:#25282F; border-bottom:1px solid grey;">
                    <h3 class="text-white text-center">Add Canteen </h3>
                </div>
                <div class="card-body p-3">
                   <form method="post" name="cform" onsubmit="return validate_canteen()">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Canteen Name</label>
                                    <input type="text" name="canteen_name" value="<?php echo $canteenNameEdit ?>" class="form-control"  placeholder="ABC canteen" id="name" >
                                    <span id="spanname" class="text-danger font-weight-normal"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Contractor's Name</label>
                                    <input type="text" name="contractor" class="form-control" value="<?php echo $contractorNameEdit ?>" placeholder="Jhon Doe" id="cname" >
                                    <span id="spancname" class="text-danger font-weight-normal"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="canteen_email" class="form-control" value="<?php echo $contractorEmailEdit ?>"  placeholder="JhonDoe@jhon.com" id="email">
                                    <span id="spanemail" class="text-danger font-weight-normal"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Contractor's Phone</label>
                                    <input type="number" name="canteen_phone" class="form-control" value="<?php echo $contractorPhoneEdit ?>"  placeholder="+91-11111111111" min="0" id="phone">
                                    <span id="spanphone" class="text-danger font-weight-normal"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="JhonDoe" maxlength="10" minlength="8" id="user">
                                    <span id="spanuser" class="text-danger font-weight-normal"></span>
                                </div>
                            </div>
                            <?php
                            if(isset($_GET["edit_canteen"])){
                                ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="text" name="password" class="form-control" value="<?php echo $contractorPasswordEdit ?>"  placeholder="***********" id="password">
                                        <span id="spanpassword" class="text-danger font-weight-normal"></span>
                                    </div>
                                </div>
                            <?php } else {
                                ?>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" value="<?php echo $contractorPasswordEdit ?>"  placeholder="***********" id="password">
                                         <span id="spanpassword" class="text-danger font-weight-normal"></span>
                                    </div>
                                </div>

                          <?php  }

                            ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Contract Start Date</label>
                                    <input type="text" disabled name="start" class="form-control text-center text-success" value="<?php $startDate = date("Y-m-d");
                                        echo $startDate;?>" id="startdate">
                                        <span id="spansd" class="text-danger font-weight-normal"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Contract Expiry Date</label>
                                    <input type="text" id="expirydate" disabled name="expiry" value="<?php $date = date_create(date("Y-m-d"));
                                    date_add($date, date_interval_create_from_date_string("365 days"));
                                    $expiryDate = date_format($date, "Y-m-d");
                                    echo $expiryDate;?>"  class="form-control text-danger">
                                    <span id="spaned" class="text-danger font-weight-normal"></span>
                                                                    </div>
                            </div>
                        </div>

                       <?php
                       if (isset($_GET["edit_canteen"])){
                           ?>
                       <div class="row">
                           <div class="col">
                               <input type="submit" class="btn btn-block text-white btn-primary mt-3" value="Update Details" id="buttonSubmit" name="update_canteen">
                           </div>
                       </div>
                      <?php } else {
                           ?>
                           <div class="row">
                               <div class="col">
                                   <input type="submit" class="btn btn-block text-white btn-success mt-3" value="Add Canteen" id="buttonSubmit" name="add_canteen">
                               </div>
                           </div>
                      <?php }
                       ?>
                    </form>
                    <?php
if (isset($_POST["add_canteen"])) {
	$canteenName = $_POST["canteen_name"];
	$contractorName = $_POST["contractor"];
	$contractorEmail = openssl_encrypt($_POST["canteen_email"], "AES-256-ECB", $key, '0', '');
	$contractorPhone = $_POST["canteen_phone"];
	$username = $_POST["username"];
	$password = openssl_encrypt($_POST["password"], "AES-256-ECB", $key, '0', '');
	mysqli_query($link, "insert into table_canteen_admin (canteen_name,contractor,canteen_email,phone,username,password,start_date,expiry)
 values('$canteenName','$contractorName','$contractorEmail','$contractorPhone','$username','$password','$startDate','$expiryDate')");
	echo "<style>alert('Canteen has been Added');</style>";

}

?>
                </div>
            </div>
            <div class="row mt-1" id="table-details">
<!--                <h5>Details</h5>-->
                <?php
$result = mysqli_query($link, "select * from table_canteen_admin order by canteen_name ASC ");

?>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td>S.No</td>
                        <td>Canteen Name</td>
                        <td>Contractor Name</td>
                        <td>Contractor Phone</td>
                        <td>Username</td>
                        <td>Date of joining</td>
                        <td>Date of Expiration</td>
                        <td>Ledger</td>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$count = 1;
while ($rowFetched = mysqli_fetch_assoc($result)) {
	?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td><?php echo $rowFetched["canteen_name"] ?></td>
                            <td><?php echo $rowFetched["contractor"] ?></td>
                            <td><?php echo $rowFetched["phone"] ?></td>
                            <td><?php echo $rowFetched["username"] ?></td>
                            <td style="color: green;"><?php echo $rowFetched["start_date"] ?></td>
                            <td style="color: red;"><?php echo $rowFetched["expiry"] ?></td>
                            <td>
                                <form action="">
                                    <button class="btn p-0 btn-block">
                                        <img src="images/ledger.png" alt="" width="20px" height="20px" name="delete_admin">
                                    </button>
                                </form>

                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <form action="">
                                            <input type="hidden" name="hidden_btn" value="<?php echo $rowFetched["canteen_id"] ?>">
                                            <button class="btn p-0  btn-block  text-white"  type="submit" name="edit_canteen" style="background-color:#25282F;">
                                                <img src="images/edit.png" alt="" width="15px" height="15px">
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-sm-6">
                                        <form action="">
                                            <input type="hidden" name="hidden_btn_delete" value="<?php echo $rowFetched["canteen_id"] ?>">
                                            <button class="btn p-0  btn-block bg-danger text-white" onclick="return confirm('Do You Want To Delete This User <?php echo $rowFetched["canteen_name"] ?>')" type="submit" name="delete_canteen">
                                                &#x2717;
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
$count += 1;
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>





    <hr class="mt-5">



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/tether.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/tablesorter.min.js"></script>
    <script src="assets/js/toolkit.js"></script>
    <script src="assets/js/application.js"></script>
    <script type="text/javascript" src="../../../include/edupay.js">
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})

    </script>

</body>
</html>
