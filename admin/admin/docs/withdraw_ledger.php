<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 01/08/18
 * Time: 9:04 PM
 */
error_reporting(0);

include "../../../include/db_config.php";
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
		<div class="col-sm-6">
			<div class="card mt-2 rounded">
				<div class="card-body">
					<form action="">
						<div class="form-group">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Transaction Number" name="txnId" required>
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
									<input type="date" name="to" id="" class="form-control" required>
									<sup class="text-white">To</sup>

								</div>
							</div>
							<div class="col-sm-2">
								<button value="submit" type="submit" class="btn btn-success rounded" name="viewHistory"><img
                                        src="../../../include/images/search_white_18x18.png" alt=""></button>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row" style="max-height: 400px; overflow: scroll;">
		<div class="col p-2">
            <div style="display:inline-block;" class="ml-3">
                <div style="width: 7px; height: 7px;background-color:lightseagreen;"></div><span>Credited</span>
            </div>

            <div style="display:inline-block;" class="ml-3">
                <div style="width: 7px; height: 7px;background-color:indianred;"></div><span>Withdrawal   </span>
            </div>


            <hr>
			<h3>Ledger</h3>
            <hr>
            <?php
            $name = $_GET["requestFrom"];
            $debit = 0;
            $credit = 0;
            $balance = 0;
                $row = mysqli_query($link,"select debit from table_transaction where payee = 'canteen'");
                while($rowFetched = mysqli_fetch_assoc($row)){
                    $credit += $rowFetched["debit"];
                }
                echo "<sup>Total Creditted Rs :$credit/-</sup>";


                $row = mysqli_query($link,"select amount from withdraw_request_table where request_from = '$name' and status = 'paid'");

                    while($rowFetched = mysqli_fetch_assoc($row)){
                        $debit += $rowFetched["amount"];
                    // echo $debit;

                    }
                    $balance=$credit-$debit;
                    echo "<sup  style='margin-left:50%'>Total Balance Rs :$balance/-</sup>";






            ?>
			<table class="table table-hover  table-bordered table-striped">
				<tr class="text-white" style="background-color: #303C52;">
					<th>S.No</th>
					<th>Date</th>
<!--					<th>Time</th>-->
					<th>Payer</th>
					<th>Transaction Number</th>
					<th>Amount</th>
					<th>Balance</th>
				</tr>
				<?php
				$query = "";
				if ( isset( $_GET[ "txnIdSearch" ] ) ) {
					$txnNum = $_GET[ "txnId" ];
					$query = "select date,time,u_id,debit,txn_id from table_transaction where payee = 'canteen' and txn_id ='$txnNum'";
				} else if ( isset( $_GET[ "viewHistory" ] ) ) {
					$from = $_GET[ "from" ];
					$to = $_GET[ "to" ];
					$query = "select date,time,u_id,debit,txn_id from table_transaction where payee = 'canteen' and date between '$from' and '$to'";

				} else {
					$query = "select date,time,u_id,debit,txn_id from table_transaction where payee = 'canteen'";

				}
				$result = mysqli_query( $link, $query );
				$sNo = 1;
				//            $balance = 0;
				//            $total = 0;
				$debit = 0;
				if ( mysqli_num_rows( $result ) == 0 ) {
					echo "<h3 class='text-danger'>No Transactions</h3>";
				} else {
				while ( $rowFetched = mysqli_fetch_assoc( $result ) ) {
					?>
				<tr style="background-color: darkseagreen ;color: white;">
					<td>
						<?php echo $sNo; ?> </td>
					<td>
						<?php echo $rowFetched["date"]; ?> </td>
<!--					<td>-->
<!--						--><?php //echo $rowFetched["time"]; ?><!-- </td>-->
					<td class="text-capitalize">
						<?php $userId = $rowFetched["u_id"];
                                $res = mysqli_query($link,"select name from table_user_edupay where u_id = $userId");
                                $row = mysqli_fetch_assoc($res);
                                echo $row["name"];

                        ?> </td>
					<td>
						<?php
						echo $rowFetched[ "txn_id" ];
						?>
					</td>
					<td>
						<?php echo $rowFetched["debit"]."/-"; ?> </td>
					<?php
					$txnNum = $rowFetched[ "txn_id" ];
					$balance = mysqli_query( $link, "select debit from table_transaction where payee = 'canteen' and txn_id = '$txnNum' " );
					while ( $balanceFetched = mysqli_fetch_assoc( $balance ) ) {
						$debit += $balanceFetched[ "debit" ];

					}


					?>

					<td>
						<?php
						echo $debit . "/-";
						?>


					</td>

				</tr>
				<?php
				$sNo += 1;
				}

				}
				?>
			</table>
		</div>

	</div>
        <div class="row" style="max-height: 400px; overflow: scroll;">
            <div class="col">

                <h3 class="mt-1">Withdrawal Requests</h3>

                <hr>
                <?php
                echo "<sup  style=''>Total withdrawn Rs :$debit/-</sup>";

                ?>
                <table class="table table-striped table-hover table-bordered p-0">
                    <tr class="text-white" style="background-color: #303C52;">
                        <th>S.No</th>
                        <th>Date</th>
                        <!--					<th>Time</th>-->
                        <th>Amount</th>
                        <th>Reference Number</th>
                        <th>Status</th>
                        <th>Pay</th>
                    </tr>
                    <?php
                    $sNo = 1;
                    $result = mysqli_query( $link, "select * from withdraw_request_table where request_from = '$name'" );
                    if ( mysqli_num_rows( $result ) == 0 ) {
                        echo "<h3 class='text-danger'>No Transactions</h3>";
                    } else {
                        while ( $rowFetched = mysqli_fetch_assoc( $result ) ) {

                            ?>
                            <tr style="background-color: indianred;color: white;">
                                <td>
                                    <?php echo $sNo; ?>
                                </td>

                                <td>
                                    <?php echo $rowFetched["date"] ?>
                                </td>
                                <!--					<td>-->
                                <!--						--><?php //echo $rowFetched["time"] ?>
                                <!--					</td>-->
                                <td>
                                    <?php echo $rowFetched["amount"]."/-";
                                    $amount = $rowFetched["amount"];

                                    ?>
                                </td>
                                <td>
                                    <?php echo $rowFetched["txn_id"]  ?>
                                </td>
                                <td>
                                    <?php
                                    echo $rowFetched[ "status" ];

                                    ?>
                                </td>
                                <td>
                                    <form action="payform.php">
                                        <?php
                                        // $_SESSION["amount"] = $rowFetched["amount"];
                                        if($rowFetched["status"] == 'paid'){
                                            echo "Paid";

                                        }else {

                                            ?>
                                            <input type="hidden" name="request_id" value="<?php echo $rowFetched["request_id"] ?>">
                                            <input type="submit" value="Pay" class='btn btn-primary p-0 m-0'>
                                            <?php
                                        }
                                        ?>
                                    </form>
                                </td>
                            </tr>


                            <?php

                            $sNo += 1;
                        }
                    }


                    ?>
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
    <script>
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
    </script>
</body>
</html>
