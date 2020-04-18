<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 12/08/18
 * Time: 9:40 AM
 */
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
            color: white;
            /*height: 18px*/
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
            <div class="col" style="height: 500px;scroll:overflow">
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
                    <div style="width: 7px; height: 7px;background-color:lightseagreen;"></div><span>Hostel</span>
                </div>
                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:indianred;"></div><span>Withdrawal</span>
                </div>

                <hr>
                <div class="row">
                    <div class="col">
                        <?php

                        $prevDate="";





                            $result = mysqli_query($link,"select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id  order by date,time Asc ");

                    //                    $rowFetched = mysqli_fetch_assoc($result);

                        ?>
                            <h4>Ledger</h4>
                            <hr>
                            <table class="table table-hover table-striped table-bordered text-capitalize" width="100%" cellspacing="0">
                                <thead>
                                <tr class="text-center text-white" style="background-color: #303C52;;">
                                                        
                                    <th>Name</th>
                                    <th>Reg Num</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Paid To</th>
                                    <th>Transaction Num</th>
                                    <th>Status of Deposit</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <!--                        <th>Balance</th>-->
                                    <th>My Bal</th>
                                </tr>
                                </thead>
                                </tbody>
                                <?php
                                $amountCredit=0;
                                $amountDebit=0;
                                while ($rowFetched = mysqli_fetch_assoc($result)) {

                                    if($rowFetched["statusoftxn"] == 'pending'){
                                        echo "<tr class='text-center' style='color:black;background-color: indianred;'>";

                                    } else {
                                        if ($rowFetched["payee"] == 'self') {
                                            echo "<tr class='text-center' style='color:black;background-color: #87c4c8;'>";
                                        } else if ($rowFetched["payee"] == 'canteen') {
                                            echo "<tr class='text-center text-capitalize' style='background-color:#dfa068;color: white;' >";

                                        } else if ($rowFetched["payee"] == 'library') {
                                            echo "<tr class='text-center text-capitalize' style='background-color: rosybrown;color: white;' >";
                                        }  else if ($rowFetched["payee"] == 'transport') {
                                            echo "<tr class='text-center text-capitalize' style='background-color: chocolate;color: white;' >";
                                        }  else if ($rowFetched["payee"] == 'examination') {
                                            echo "<tr class='text-center text-capitalize' style='background-color: burlywood;color: white;' >";
                                        }  else if ($rowFetched["payee"] == 'hostel') {
                                            echo "<tr class='text-center text-capitalize' style='background-color: lightseagreen;color: white;' >";
                                        }

                                    }

                                    ?>
                                    <!--                            <td>--><?php //echo $s_no; ?><!--</td>-->
                                    <td> <?php echo $rowFetched["name"] ?></td>
                                  
                                    <td class="text-uppercase"> <?php echo $rowFetched["reg_num"] ?></td>
                                    <td> <?php echo $rowFetched["credit"] ?></td>
                                    <td> <?php echo $rowFetched["debit"] ?></td>
                                    <td> <?php echo $rowFetched["payee"] ?></td>
                                    <td> <?php echo $rowFetched["txn_id"] ?></td>
                                    <td> <?php echo $rowFetched["statusoftxn"] ?></td>
                                    <td> <?php echo $rowFetched["date"] ?></td>
                                    <td> <?php echo $rowFetched["time"] ?></td>
                                    <!--                            <td> --><?php //echo $rowFetched["balance"] ?><!--</td>-->
                                    <td>
                                        <?php

                                        $amountCredit += $rowFetched["credit"];
                                        echo $amountCredit."/-";
                                        ?>
                                    </td>

                                    </tr>



                                    <?php
                                    // $number = 0;
                                        
                                    if($prevDate!=$rowFetched["date"])
                                    {    
                                        $datawithdraw= mysqli_query($link,"select * from withdraw_request_table where date='".$rowFetched["date"]."'");

                                        $withdraw = 0;
                                    if(mysqli_num_rows($datawithdraw) > 0)
                                    {
                                     while ( $rowFetched2 = mysqli_fetch_assoc( $datawithdraw ) )
                                      {
                                            $prevDate=$rowFetched["date"];
                                    ?>
                                    <tr style="background-color:maroon;color: white;text-align:center">
                                     

                                        <td>
                                            <?php echo $rowFetched2["request_from"] ?>
                                        </td>
                                    <td> <?php echo "N/A" ?></td>


                                        <td>
                                            <?php echo "00.00" ?>
                                        </td>
                                        <td>
                                            <?php echo $rowFetched2["amount"]."/-";
                                            $amount = $rowFetched2["amount"];

                                            ?>
                                        </td>
                                         <td>
                                            <?php echo "Withdraw Request" ?>
                                        </td>
                                        <td>
                                            <?php echo $rowFetched2["txn_id"]  ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo $rowFetched2[ "status" ];

                                            ?>
                                        </td>
                                         <td>
                                            <?php echo $rowFetched2["date"] ?>
                                        </td>
                                         <td>
                                            <?php echo $rowFetched2["time"] ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($rowFetched2["status"] == 'pending'){
                                                    echo $amountCredit."/-";
                                                } else {
                                                    $withdraw+=$rowFetched2["amount"];
                                                    $amountCredit= $amountCredit-$withdraw;
                                                    echo $amountCredit."/-";
                                                }

                                            ?>
                                        </td>
                                       
                                    </tr>
                        <?php
                        
                                }

                                }
                            }
                         }
                            


                         /*  gettinng remaining entries from withdraw request*/

                                $datawithdraw= mysqli_query($link,"select * from withdraw_request_table where date > '".$prevDate."'");

                                $withdraw = 0;
                                if(mysqli_num_rows($datawithdraw) > 0) {
                                    while ($rowFetched2 = mysqli_fetch_assoc($datawithdraw)) {
                                        $prevDate = $rowFetched["date"];
                                        ?>
                                        <tr style="background-color:maroon;color: white;text-align:center">


                                            <td>
                                                <?php echo $rowFetched2["request_from"] ?>
                                            </td>
                                            <td> <?php echo "N/A" ?></td>


                                            <td>
                                                <?php echo "00.00" ?>
                                            </td>
                                            <td>
                                                <?php echo $rowFetched2["amount"] . "/-";
                                                $amount = $rowFetched2["amount"];

                                                ?>
                                            </td>
                                            <td>
                                                <?php echo "Withdraw Request" ?>
                                            </td>
                                            <td>
                                                <?php echo $rowFetched2["txn_id"] ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $rowFetched2["status"];

                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $rowFetched2["date"] ?>
                                            </td>
                                            <td>
                                                <?php echo $rowFetched2["time"] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($rowFetched2["status"] == 'pending') {
                                                    echo $amountCredit . "/-";
                                                } else {
                                                    $withdraw += $rowFetched2["amount"];
                                                    $amountCredit = $amountCredit - $withdraw;
                                                    echo $amountCredit . "/-";
                                                }

                                                ?>
                                            </td>

                                        </tr>
                                        <?php

                                    }
                                }

                          /* ending */
                        ?>
                        </table>
                    </div>

                </div>




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
    <script>
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
    </script>
</body>
</html>
