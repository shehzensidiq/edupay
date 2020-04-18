<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 23/06/18
 * Time: 11:24 PM
 */
//session_start();



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
        .card {
            background-color: #25282F;
            padding: 10px;
            border:1px solid grey;
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
            <div class="col-sm-12 p-4" style="height: 705px ;overflow: scroll;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row mb-2">
                            <div class="col-sm-4 rounded">
                                <div class="card rounded">
                                    <div class="card-body bg-dark">
                                        <form action="" name="txnidform" onsubmit="return validate_id()">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="n8sJfFxz8nknUnfz9" name="txnId">
                                                    <div class="input-group-prepend">
                                                        <button value="submit" type="submit" class="btn btn-success rounded" name="txnIdSearch">
                                                            <img src="../../../include/images/search_white_18x18.png" alt="search">
                                                        </button>
                                                    </div>
                                                </div>
                                                <sup class="text-white">Search By Transaction Number</sup>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 rounded">
                                <div class="card rounded">
                                    <div class="card-body bg-dark">
                                        <form action="" name="txnnameform" onsubmit="return validate_name()" >
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="John Doe / Jane Doe" name="name">
                                                    <div class="input-group-prepend">
                                                        <button value="submit" type="submit" class="btn btn-success rounded" name="nameSearch">
                                                            <img src="../../../include/images/search_white_18x18.png" alt="search">
                                                        </button>
                                                    </div>
                                                </div>
                                                <sup class="text-white">Search By Name</sup>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 rounded">
                                <div class="card rounded">
                                    <div class="card-body bg-dark">
                                        <form action="" name="txndateform" onsubmit="return validate_date()" >
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <input type="date" name="from" id="" class="form-control">
                                                        <sup class="text-white">From</sup>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <input type="date" name="to" id="" class="form-control">
                                                        <sup class="text-white">To</sup>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2" style="margin-left: -28px; margin-top: 2px">
                                                    <button value="submit" type="submit" class="btn btn-success rounded" name="viewHistory">
                                                        <img src="../../../include/images/search_white_18x18.png" alt="search" >
                                                    </button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:#87c4c8;"></div><span>Credited</span>
                </div>

                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:orange;"></div><span>Canteen   </span>
                </div>

                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:chocolate;"></div><span>Transport</span>
                </div>

                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:rosybrown;"></div><span>Library</span>
                </div>

                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:burlywood;"></div><span>Examination</span>
                </div>

                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:chocolate;"></div><span>Hostel</span>
                </div>

                <hr>
                <table class="table table-hover table-striped table-bordered" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center text-white" style="background-color: #303C52;;">
                        <td>S.No</td>
                        <td>Name</td>
<!--                        <th>Semester</th>-->
<!--                        <th>Course</th>-->
                        <td>Reg Num</td>
                        <td>Credit</td>
                        <td>Debit</td>
                        <td>Payee</td>
                        <td>Transaction Num</td>
<!--                        <td>Status of Deposit</td>-->
                        <td>Date</td>
                        <td>Time</td>
                        <td>Balance</td>
                        <td id="action">Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "";
                    $s_no = 1;
                    if(isset($_GET["pending"]))

                    {
                        $query="select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where statusoftxn = 'pending' ";
                    }
                    elseif(isset($_GET["confirmed"]))
                    {
                        $query="select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where statusoftxn = 'confirmed'";

                    }
                    else if(isset($_GET["allTxnBtn"])){
                        $query="select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id  order by name DESC ";

                    }
                    elseif(isset($_GET["txnIdSearch"]))
                    {
                        $txnId = $_GET["txnId"];
                        $query="select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where tw.txn_id like '$txnId%' ";

                    }
                    elseif(isset($_GET["nameSearch"]))
                    {
                        $name = $_GET["name"];
                        $query="select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where tu.name like '$name%' ";

                    }
                    elseif(isset($_GET["viewHistory"]))
                    {
                        $from = $_GET["from"];
                        $to = $_GET["to"];
                        if ($from > $to)
                        {
                            echo "<script>alert('Invalid Date Range');window.location='txn_process.php';</script>";
                        }
                        else{
                            $query="select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where date between '$from' and '$to'";

                        }



                    }
                    else
                    {
                        $query="select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where statusoftxn = 'pending' ";

                    }

                    $result= mysqli_query($link,$query);
                    if (mysqli_num_rows($result) == 0 )
                    {
                        echo "<h3 style='color: Red;'>No Results To Show</h3>";
                    }
                    else {


                        while ($rowFetched = mysqli_fetch_assoc($result)) {
                            if ($rowFetched["statusoftxn"] == 'pending') {
                                echo "<tr class='text-center text-white' style='background-color: indianred;'>";
                            } else {
                                if($rowFetched["debit"] > 0) {
                                    if ($rowFetched["payee"] == 'canteen') {
                                        echo "<tr class='text-center text-white text-capitalize' style='background-color: orange;' >";
                                    } else if($rowFetched["payee"] == 'transport'){
                                        echo "<tr class='text-center text-white text-capitalize' style='background-color: chocolate;' >";
                                    } else if ($rowFetched["payee"] == 'library') {
                                        echo "<tr class='text-center text-white text-capitalize' style='background-color: rosybrown;' >";
                                    } else if($rowFetched["payee"] == 'exam') {
                                        echo "<tr class='text-center text-white text-capitalize' style='background-color:burlywood;' >";
                                    }
                                } else{
                                    echo "<tr class='text-center text-white text-capitalize' style='background-color: #87c4c8;' >";
                                }


                            }

                            ?>
                            <td><?php echo $s_no; ?></td>
                            <td> <?php echo $rowFetched["name"] ?></td>
<!--                            <td> --><?php //echo $rowFetched["semester"] ?><!--</td>-->
<!--                            <td> --><?php //echo $rowFetched["course"] ?><!--</td>-->
                            <td class="text-uppercase"> <?php echo $rowFetched["reg_num"] ?></td>
                            <td> <?php echo $rowFetched["credit"] ?></td>
                                <td> <?php echo $rowFetched["debit"] ?></td>
                                <td> <?php echo $rowFetched["payee"] ?></td>
                            <td> <?php echo $rowFetched["txn_id"] ?></td>
<!--                            <td> --><?php //echo $rowFetched["payment_status"] ?><!--</td>-->
                            <td> <?php echo $rowFetched["date"] ?></td>
                            <td> <?php echo $rowFetched["time"] ?></td>
                            <td> <?php echo $rowFetched["balance"] ?></td>
                            <td>
                            <?php
                            if ($rowFetched["statusoftxn"] == 'pending') {

                                ?>
                                <form action="approve.php" method="">
                                    <input type="hidden" value="<?php echo $rowFetched["txn_id"]; ?>"
                                           name="hidden_btn">
                                    <input type="hidden" value="<?php echo $rowFetched["u_id"]; ?>"
                                           name="userId">
                                    <button  type="submit" value="submit" class="btn btn-block btn-success p-0" name="confirm"  onclick="return confirm('Do You Want To Confirm?')">
                                        <span class="icon icon-check"></span>
                                    </button>
                                </form>
                                <?php
                            } else {
                                echo "Confirmed";
                                ?>
                                </td>

                                </tr>
                            <?php }
                            $s_no+=1;

                        }
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
    <script type="text/javascript">
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})

        function validate_id()
            {
                var txn = document.forms["txnidform"]["txnId"].value;
               
                 
               
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

               
            function validate_date()
             {
                 var from = document.forms["txndateform"]["from"].value;
                 var To = document.forms["txndateform"]["to"].value;
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
            function validate_name()
            {
                 var txnid = document.forms["txnnameform"]["name"].value;
                 if( txnid== "")
                {
                    alert(" **please enter  name");
                    return false;
                }
                if(!isNaN(txnid))
                {
                    alert("only characters are allowed");
                    return false;
                }
                if((txnid.length <= 2) || (txnid.length > 20))
                {
                    alert(" ** please enter 3 to 20 characters  name");
                    return false;
                }
                
            
            
            }
    </script>

</body>
</html>
 