
<?php
session_start();
$session = $_SESSION["auth_user"];
include "include/db_config.php";
error_reporting(0);
if(isset($_GET["lg"])){
    echo "<script>alert('The Amount Has Been Paid');</script>";

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
            <?php
//$result = mysqli_query($link, "select route from table_vehicle ");
//while ($rowFetched = mysqli_fetch_assoc($result)) {
//    $routeArray=explode(",", $rowFetched)
  //  echo $rowFetched["route"];
//}

if (isset($_GET["apply"])) {
    ?>
                <div class="row">
                    <div class="card mx-auto w-50 mt-5">
                        <div class="card-header">
                            <h4 class="text-white text-center">Apply For Bus</h4>
                        </div>
                        <div class="card-body">
                        <form action="">
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <label for="">Place Of Pick Up</label>
                                    <select name="pick_up" id="" class="form-control">


                    <?php
                    $check = 0;
                    $count=0;
    $result = mysqli_query($link, "select route from table_vehicle ");
                    $alreadyadded="";
                    while ($rowFetched = mysqli_fetch_assoc($result)) {
        $routeArray = explode(",", $rowFetched["route"]);
        for($i = 0; $i < sizeof($routeArray); $i++)
        {
            $routeArray[$i] = strtolower($routeArray[$i]);
            $nyla=strpos($alreadyadded , $routeArray[$i]);
            if(strlen($nyla)>0) {
                ?>

                    <?php   }
            else
            {
                ?>
                <option value="<?php echo ucwords($routeArray[$i]); ?>"><?php echo ucwords($routeArray[$i]); ?></option>

                <?php
            }
            $alreadyadded .= $routeArray[$i] . " ";



        }
    }

    ?>
                          </select>

                            </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Priorty Vehicle</label>
                                            <select name="priorty_vehicle" id="" class="form-control text-capitalize">
                                                <?php
                                                $result = mysqli_query($link,"select distinct vehicle_type from table_vehicle");
                                                while($rowFetched = mysqli_fetch_assoc($result)){
                                                    ?>
                                                <option  value="<?php echo $rowFetched["vehicle_type"] ?>"><?php echo $rowFetched["vehicle_type"] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            </div>
                                <button class="btn btn-primary mb-5 w-75" style="margin:0 auto;" value="submit" type="submit" name="request_bus" onclick="return confirm('Sure to apply !');">
                                    Request for the bus
                                </button>
                        </form>

                            </div>
                        </div>


                        </div>


                <?php
} elseif (isset($_GET["request_bus"])) {
    $from = $_GET["pick_up"];
    $pVehicle = $_GET["priorty_vehicle"];
    $result = mysqli_query($link, "select reg_num from table_user_edupay where u_id = $session");
    $rowFetched = mysqli_fetch_assoc($result);
    $reg_num = $rowFetched["reg_num"];

    mysqli_query($link, "insert into table_transport_allot(u_id,pick_up,statusOfBus,reg_num,priority_vehicle) values($session,'$from','pending','$reg_num','$pVehicle')");
    echo "<script>alert('Request Has been Sent! Please be patient..');window.location='student_dashboard.php';</script>";
} elseif (isset($_GET["details"])) {
    ?>
        <div class="container">
                    <table class="table table-bordered table-striped m-3">
                        <tr>
                            <thead class="thead-dark text-white" style="background: #000;">
                                <td>User ID</td>
                                <td>Pick Up</td>
                                <td>Vehicle Id</td>
                                <td>Status</td>
                                <td>Fee</td>
                                <td>Allotment Date</td>
                                <td>Current Date</td>
                            </thead>
                        </tr>
                        <tbody>
<!---->
                            <?php

    $result = mysqli_query($link, "select * from table_transport_allot where u_id = $session");
//    echo $session;
    $rowFetched = mysqli_fetch_assoc($result);
        if ($rowFetched["statusOfBus"] == 'pending') {
            echo '<tr class="text-capitalize" style="background-color: salmon;">';
        } else {
            echo '<tr class="text-capitalize" style="background-color: lightskyblue;">';
        }

        ?>
        <td>
            <?php echo $rowFetched["u_id"] ?>
        </td>
        <td>
            <?php echo $rowFetched["pick_up"] ?>
        </td>
        <td>
            <?php echo $rowFetched["vehicle_id"] ?>
        </td>
        <td>
            <?php echo $rowFetched["statusOfBus"] ?>
        </td>
        <td>
            <?php echo $rowFetched["fee"] ?>
        </td>
        <td>
            <?php echo $rowFetched["allot_date"] ?>
        </td>
        <td>
            <?php echo date("Y-m-d") ?>
        </td>


        </tr>


        <?php


}
?>
                        </tbody>
            </table>
            <?php
            $paid = 0;
            $paidSet = mysqli_query($link,"select amount from table_fee_transport where u_id = $session");
            while($amountFetched = mysqli_fetch_assoc($paidSet)){
                $paid +=  $amountFetched["amount"];
            }

            ?>
            <?php

            $allotid= $rowFetched["transport_allot_id"];
            $result=mysqli_query($link,"select * from table_transport_allot where transport_allot_id = $allotid and statusOfBus = 'alloted'");
            if(mysqli_num_rows($result) > 0) {
            //                $totalfee = 0;

            $row = mysqli_fetch_assoc($result);
            $date = explode("-", $row["allot_date"]);
            $month = $date[1];
            $year = $date[0];

            $currmonth = date('m');
            $curryear = date("Y");


            if ($month == $currmonth and $year == $curryear) {


                echo "<div class='alert alert-info'>It seems Bus has been alloted in the same month</div>";

            }
            else {

            if ($curryear == $year and $month != $currmonth) {
                $totalmonth = $currmonth - $month;


            } else if ($curryear > $year) {
                $totalmonth=0;
                $endmonth=12;
                while($year <= $curryear)
                {
                    for($m=$month;$m <=$endmonth;$m++)
                    {
                        $totalmonth++;
                    }
                    $month=1;
                    $year++;
                    if($year==$curryear)
                    {
                        $endmonth=$currmonth-1;
                    }
                }

            }

            $totalfee = $totalmonth * $row["fee"];
            $payable = $totalfee - $paid;
//    echo $totalmonth;

            ?>


            <!--            //For table display-->
            <?php
            $allotDate = $rowFetched["allot_date"];
            $dateExplode = explode("-", $allotDate);
            $month = $dateExplode[1] - 0;
            $currMonth = date("m");
            $year = $dateExplode[0];
            //            echo $month;
            //            echo ($currMonth - $month);
            //$loopLimit = $currMonth - $month;
            ?>
            <h1 class="w-25 float-left" style="display: inline;">Fee Details</h1>

                <div style="clear:both;height:10px;"></div>

                <h5>Total Months Calculated are : <?php echo $totalmonth; ?> </h5>
                <h5>You've Paid <?php echo $paid; ?>/-</h5>
                <h5>Balance : Rs <?php
                    echo $payable . "/-";
                    ?>
                    <?php
                    if ($payable > 0) {
                    ?>
                    <form action="feeProcess.php" method="get">
                        <input type="button" value="Select All" id="btnselectall" class="btn btn-primary float-right mt-1"/>


                        <input type="submit" value="Pay Selected Months" class="btn btn-primary mt-1"  name="paySelected">
                        <?php }
                        ?>

                </h5>
                <div style="clear:both;height:10px;"></div>

                <?php
                for($y=$year;$y<=$curryear;$y++)
                { ?>
                        <div class="card" style="margin-top: 10px;">
                            <div class="card-header mycardhead bg-primary text-white"><?php echo $y; ?>

                            </div>
                            <div class="card-body mycardbody">


            <table class="table table-bordered table-striped m-3 table-hover" style="width:97%">
                <tr style="background: #000;" class="text-white">
                    <td>Month</td>
                    <td>Amount</td>
                    <td>Date</td>
                    <td>Status</td>
                    <td>Pay</td>
                </tr>
                <?php
                $monthArray = ["", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                for ($i = 1; $i <= $totalmonth; $i++) {
                    ?>
                    <tr>
                        <td><?php
                            echo $monthArray[$month] . " " .$y;
                            ?></td>
                        <td> Rs 1800/-</td>
                        <td>
                            <?php
                            echo date("d-m-y");
                            ?>
                        </td>
                        <?php
                        $feeTableResult = mysqli_query($link,"select * from table_fee_transport where month = '$monthArray[$month]' and year = '$year' and u_id = $session");

                        ?>
                        <td>
                            <?php
                            if(mysqli_num_rows($feeTableResult) == 0){
                                echo "Pending";
                            } else {
                                echo "Paid";

                            }
                            ?>
                        </td>
                        <td>
                            <?php

                            if(mysqli_num_rows($feeTableResult) == 0){
                                ?>
                                <input type="hidden" name="userId" value="<?php echo $session ?>">
                                <input type="hidden" name="amount" value="<?php echo $rowFetched["fee"]; ?>">
                                <input type="checkbox" class="checkbox" name="selectedMonths[]" id="" value="<?php echo $monthArray[$month]."-".$year  ?>">

<?php                                } else {
                                echo "Paid";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                    $month++;
                    if ($month > 12) {
                        $year++;
                        $month = 1;
                        break;
                    }
                    if($y==$curryear&& $month==($currMonth))
                    {
                        break;
                    }
                }
                ?>
            </table>

                            </div>
                        </div>
            <?php
                }
                }
                }
               ?>
            </form>

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
<script src="admin/admin/docs/assets/js/application.js">
    // execute/clear BS loaders for docs
    $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
</script>

<script>
    $(".mycardbody").slideUp(0);
    $(".mycardbody").first().slideDown();
    $(".mycardhead").click(function(){
        $(".mycardbody").slideUp();
        $(this).siblings(".mycardbody").slideToggle();
    });

    $("#btnselectall").click(function(){

        $(".checkbox").attr("checked","checked");
    });
</script>
    </body>

    </html>