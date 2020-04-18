<?php
session_start();
include "../include/db_config.php";

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

        TRANSPORT :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="../admin/admin/docs/assets/css/toolkit-inverse.css" rel="stylesheet">


    <link href="../admin/admin/docs/assets/css/application.css" rel="stylesheet">

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
            margin: 0;
            padding: 0;
        }
        li:hover {
            background-color: #4496C2;
            border-radius:5px;
        }
        li {
            margin-top: 15px;
        }
        textarea{
            resize: none;
        }
        tr {
            color: white;
        }
    </style>
</head>


<body>
<div class="row p-3">
    <?php
    include"side_panel.php"
    ?>

    <div class="col-sm-9 content">
        <?php

        include("header_faculty.php");
        ?>

        <hr class="mt-1">

        <?php
//        $paid = 0;
//        $paidSet = mysqli_query($link,"select amount from table_fee_transport where u_id = $session");
//        while($amountFetched = mysqli_fetch_assoc($paidSet)){
//            $paid +=  $amountFetched["amount"];
//        }

        ?>

        <?php

        $allotid= $_GET["allotid"];
        $result=mysqli_query($link,"select * from table_transport_allot where transport_allot_id = $allotid and statusOfBus = 'alloted'");
        if(mysqli_num_rows($result) > 0) {
            //                $totalfee = 0;

            $row = mysqli_fetch_assoc($result);
            $userId = $row["u_id"];
            $paid = 0;
            $paidSet = mysqli_query($link,"select amount from table_fee_transport where u_id = $userId");
            while($amountFetched = mysqli_fetch_assoc($paidSet)){
                $paid +=  $amountFetched["amount"];
            }
            $date = explode("-", $row["allot_date"]);
            $month = $date[1];
            $year = $date[0];

            $currmonth = date('m');
            $curryear = date("Y");
            ?>
            <?php
            $details = mysqli_query($link,"select name,reg_num,semester,course from table_user_edupay where u_id = $userId");
            $detailsFetched = mysqli_fetch_assoc($details);
            ?>
            <h6 class="text-capitalize">Name : <?php echo $detailsFetched["name"]; ?> </h6>
            <h6 class="text-capitalize">Course : <?php echo $detailsFetched["course"]; ?> </h6>
            <h6 class="text-capitalize">Semester : <?php echo $detailsFetched["semester"]; ?> </h6>
            <h6 class="text-capitalize">Reg Number : <?php echo $detailsFetched["reg_num"]; ?> </h6>







        <?php


            if ($month == $currmonth and $curryear == $year) {


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
                $allotDate = $row["allot_date"];
                $dateExplode = explode("-", $allotDate);
                $month = $dateExplode[1] - 0;
                $currMonth = date("m");
                $year = $dateExplode[0];
                //            echo $month;
                //            echo ($currMonth - $month);
                //$loopLimit = $currMonth - $month;
                ?>
                <h1 class="w-25 float-left" style="display: inline;">Fee Details</h1>

                <div style="clear:both;height:40px;"></div>



                <h6>Total Months Calculated are : <?php echo $totalmonth; ?> </h6>
                <h6>You've Paid <?php echo $paid; ?>/-</h6>
                <h6>Balance : Rs <?php
                    echo $payable . "/-";
                    ?>
                </h6>
                <div style="clear:both;height:40px;"></div>

                <?php
                for($y=$year;$y<=$curryear;$y++)
                { ?>
                    <div class="card" style="margin-top: 10px;">
                        <div class="card-header mycardhead bg-primary"><?php echo $y; ?>

                        </div>
                        <div class="card-body mycardbody bg-inverse">


                            <table class="table table-bordered table-inverse" style="width:100%">
                                <tr style="background: #000;" class="text-white">
                                    <td>Month</td>
                                    <td>Amount</td>
                                    <td>Date</td>
                                    <td>Status</td>
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
                                        $feeTableResult = mysqli_query($link,"select * from table_fee_transport where month = '$monthArray[$month]' and year = '$year' and u_id = $userId");

                                        ?>
                                        <td>
                                            <?php
                                            if(mysqli_num_rows($feeTableResult) == 0){
                                                echo "Unpaid";
                                            } else {
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

    </div>
</div>

<hr class="mt-5">



<script src="../admin/admin/docs/assets/js/jquery.min.js"></script>
<script src="../admin/admin/docs/assets/js/tether.min.js"></script>
<script src="../admin/admin/docs/assets/js/chart.js"></script>
<script src="../admin/admin/docs/assets/js/tablesorter.min.js"></script>
<script src="../admin/admin/docs/assets/js/toolkit.js"></script>
<script src="../admin/admin/docs/assets/js/application.js"></script>
<script>
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



