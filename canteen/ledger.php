<?php
session_start();
include "../include/db_config.php";
$id = $_SESSION["auth_user"];
$result = mysqli_query($link,"select * from table_canteen_admin where canteen_id = $id");
$rowFetched = mysqli_fetch_assoc($result);
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

        Canteen :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="../admin/admin/docs/assets/css/toolkit-light.css" rel="stylesheet">


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

        .dropdown-menu :hover> button {
            background-color: #4496C2;
            color: white;
        }
        .card-body {
            /*background-color:#effdfd ;*/
            padding: 10px;
        }
    </style>
</head>


<body>
<!--   <div class="container"> -->
<div class="row p-3">
    <?php
    include "side.php";
    ?>
    <div class="col-md-10 content">
        <?php
        include "header.php"
        ?>

        <hr class="mt-3">
	<div class="row">
		<div class="col-sm-6">
			<div class="card mt-2 rounded">
				<div class="card-body bg-dark">
					<form action="">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Transaction Number" name="txnId" required>
								<div class="input-group-prepend">
									<button value="submit" type="submit" class="btn btn-success rounded" name="txnIdSearch"><img
                                            src="../include/images/search_white_18x18.png" alt=""></button>

								</div>
							</div>
							<sup class="text-white">Search using Transaction Number</sup>


						</div>

					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="card mt-2 rounded">
				<div class="card-body bg-dark">
					<form action="">
						<div class="row">
							<div class="col-sm-5">
								<div class="form-group">
									<input type="date" name="from" id="" class="form-control" required>
									<sup class="text-white">From</sup>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<input type="date" name="to" id="" class="form-control" required/>
									<sup class="text-white">To</sup>

								</div>
							</div>
							<div class="col-sm-2">
								<button value="submit" type="submit" class="btn btn-success rounded" name="viewHistory"><img
                                        src="../include/images/search_white_18x18.png" alt=""></button>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<hr>
        <div class="row">
            <div class="col">
                <?php
                $prevDate="";

                $query = "";
                if ( isset( $_GET[ "txnIdSearch" ] ) ) {
                    $txnNum = $_GET[ "txnId" ];
                    $query = "select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where tw.payee = 'canteen' and tnx_id = '$txnNum' order by date,time Asc ";
//                    $query = "select * from table_transaction where payee = 'canteen' and txn_id ='$txnNum'";
                } else if ( isset( $_GET[ "viewHistory" ] ) ) {
                    $from = $_GET[ "from" ];
                    $to = $_GET[ "to" ];
                    $query = "select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where tw.payee = 'canteen' and date between '$from' and '$to' order by date,time Asc ";
//                    $query = "select * from table_transaction where payee = 'canteen' and date between '$from' and '$to'";

                } else {
                    //$query = "select * from table_transaction where payee = 'canteen'";
                    $query = "select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id where tw.payee = 'canteen' order by date,time Asc ";


                }
                $result = mysqli_query( $link, $query );
                //$result = mysqli_query($link,"select * from table_transaction tw join table_user_edupay tu on tw.u_id = tu.u_id  order by date,time Asc ");

                //                    $rowFetched = mysqli_fetch_assoc($result);

                ?>
                <h4>Ledger</h4>
                <hr>
                <table class="table table-hover table-striped table-bordered text-capitalize" width="100%" cellspacing="0">
                    <thead>
                    <tr class="text-center text-white" style="background-color: #303C52;;">

                        <th>Name</th>
                        <th>Reg Num</th>
                        <th>Amount</th>
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
                        <td> <?php echo $rowFetched["debit"]."/-" ?></td>
<!--                        <td> --><?php //echo "h"; ?><!--</td>-->
                        <td> <?php echo $rowFetched["payee"] ?></td>
                        <td> <?php echo $rowFetched["txn_id"] ?></td>
                        <td> <?php echo $rowFetched["statusoftxn"] ?></td>
                        <td> <?php echo $rowFetched["date"] ?></td>
                        <td> <?php echo $rowFetched["time"] ?></td>
                        <!--                            <td> --><?php //echo $rowFetched["balance"] ?><!--</td>-->
                        <td>
                            <?php

                            $amountCredit += $rowFetched["debit"];
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

<hr class="mt-5">

<!-- </div> -->


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
</body>
</html>