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

            /*font-size: 12px;*/
            padding: 0;
            color: white;
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
<div class="row">
    <div class="col-sm-4">
        <div class="card mt-2 rounded">
            <div class="card-body bg-dark">
                 <form action="" name="tnform" onsubmit="return validation()">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Transaction Number" name="txnId" >
                            <div class="input-group-prepend">
                                <button value="submit" type="submit" class="btn btn-success rounded" name="txnIdSearch"><img
                                        src="../../../include/images/search_white_18x18.png" alt=""></button>

                            </div>
                        </div>
                        <sup class="text-white">Search using Transaction Number</sup>


                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card mt-2 rounded" >
            <div class="card-body bg-dark">
               <form action="" name="ftform" onsubmit="return validation_date()" >
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="date" name="from" id="" class="form-control" >
                                <sup class="text-white">From</sup>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="date" name="to" id="" class="form-control" >
                                <sup class="text-white">To</sup>

                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button value="submit" type="submit" class="btn btn-success rounded" name="viewHistory" style="margin-left: -20px;"><img
                                    src="../../../include/images/search_white_18x18.png" alt=""></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="card mt-2 rounded" >
            <div class="card-body bg-dark">
                <form action="" name="dnform" onsubmit="return validation_dname()">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Transaction Number" name="txnId" >
                            <div class="input-group-prepend">
                                <button value="submit" type="submit" class="btn btn-success rounded" name="txnIdSearch"><img
                                            src="../../../include/images/search_white_18x18.png" alt=""></button>

                            </div>
                        </div>
                        <sup class="text-white">Search By Department Name</sup>


                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row" style="padding: 20px;">
<!--    <div class="container-fluid">-->
        <h4>Withdrawal Request</h4>
        <table class="table table-hover  table-bordered table-striped">
            <tr style="background-color: #303C52;" class="text-white">
                <th>S.No</th>
                <th>Date</th>
                <th>Time</th>
                <th>User</th>
                <th>Transaction Number</th>
                <th>Amount</th>
                <th>status</th>
            </tr>
            <?php
            $sNo = 1;
            $result = mysqli_query($link,"select * from withdraw_request_table");
            while($rowFetched = mysqli_fetch_assoc($result)){

                if ($rowFetched["status"] =='pending')
                {
                    echo "<tr style='background-color: lightsalmon;'>";
                }
                else if($rowFetched["status"] == 'paid')
                {
                    echo "<tr style='background-color: lightskyblue;'>";
                }
                 ?>
                <td><?php echo $sNo; ?></td>

                <td><?php echo $rowFetched["date"] ?></td>
                <td><?php echo $rowFetched["time"] ?></td>
                <td><a href="withdraw_ledger.php?requestFrom=<?php echo $rowFetched["request_from"] ?>" class="text-dark"><?php echo $rowFetched["request_from"] ?></a></td>
                <td><?php echo $rowFetched["txn_id"] ?></td>
                <td><?php echo "Rs ".$rowFetched["amount"]."/-";
                    $amount = $rowFetched["amount"];

                    ?></td>
                <td><?php echo ucwords($rowFetched["status"]) ?></td>
                </tr>


                <?php
                $sNo +=1;
            }


            ?>
        </table>
<!--    </div>-->
</div>
    </div>








    <hr class="mt-5">



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/tether.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/tablesorter.min.js"></script>
    <script src="assets/js/toolkit.js"></script>
    <script src="assets/js/application.js"></script>
   <script type="text/javascript">
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})

        function validation()
            {
                var txn = document.forms["tnform"]["txnId"].value;
               
                 
               
                if( txn== "")
                {
                    alert(" ** please enter Transaction id ");
                    return false;
                }
                if((txn.length <= 2) || (txn.length > 20))
                {
                    alert(" **please enter atleast 3 characters of transaction id");
                    return false;
                }
                
             } 

               
            function validation_date()
             {
                 var from = document.forms["ftform"]["from"].value;
                 var To = document.forms["ftform"]["to"].value;
                if( from== "")
                {
                    alert(" **please enter  date");
                    return false;
                }
                if( To== "")
                {
                    alert(" **please enter date");
                    return false;
                }
                
            }
            function validation_dname()
            {
                 var txnid = document.forms["dnform"]["txnId"].value;
                 if( txnid== "")
                {
                    alert(" **please enter  department name");
                    return false;
                }
                if((txnid.length <= 2) || (txnid.length > 20))
                {
                    alert(" ** please enter 3 to 20 characters od department name");
                    return false;
                }
                
            }
            
    </script>
</body>
</html>
