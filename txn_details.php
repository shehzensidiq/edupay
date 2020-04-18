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
        .card-body {
            /*background-color:#effdfd ;*/
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
    <div class="col" id="table">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="card mt-2 rounded p-2">
                    <div class="card-body bg-dark">
                        <form action="" onsubmit="return validate_txn_num()">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Transaction Number" name="txnId" id="txnId">
                                    <span id="spantxnId" class="text-danger font-weight-normal"></span>
                                    <div class="input-group-prepend">
                                        <button value="submit" type="submit" class="btn btn-success rounded" name="txnIdSearch"><img
                                                    src="include/images/search_white_18x18.png" alt=""></button>

                                    </div>
                                </div>
                                <sup class="text-gray-dark">Search using Transaction Number</sup>


                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card mt-2 rounded p-2" >
                    <div class="card-body bg-dark">
                        <form action="" onsubmit="return validate_date()">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="date" name="from" id="from" class="form-control">
                                        <span id="spanfrom" class="text-danger font-weight-normal"></span>
                                        <sup class="text-gray-dark">From</sup>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                            <input type="date" name="to" id="to" class="form-control" >
                                            <span id="spanto" class="text-danger font-weight-normal"></span>
                                        <sup class="text-gray-dark">To</sup>

                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <button value="submit" type="submit" class="btn btn-success rounded" name="viewHistory"><img
                                                src="include/images/search_white_18x18.png" alt=""></button>

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
                $session=$_SESSION["auth_user"];
                $result = mysqli_query($link,"select credit from table_transaction where u_id = $session and statusoftxn = 'Confirmed'");
                $credit = 0;
                $debit = 0;
                $balance = 0;
                while($rowFetched = mysqli_fetch_assoc($result)){
                    $credit += $rowFetched["credit"];
                }
                $result = mysqli_query($link,"select debit from table_transaction where u_id = $session and statusoftxn = 'Confirmed'");

                while($rowFetched = mysqli_fetch_assoc($result)) {
                    $debit += $rowFetched["debit"];

                }

                $balance = $credit - $debit;
                ?>
                <h5 style="display:inline-block;">Credited <?php echo "Rs ".$credit."/-" ?></h5><h5 style="display:inline-block;margin-left: 26%" >Debited <?php echo "Rs ".$debit."/-" ?></h5><h5 style="display: inline-block;float: right;"> Available balance <?php echo "Rs ".$balance."/-";
                    ?></h5>

                      <hr/>
                      <div style="width:10px;height: 10px;background-color: pink;display: inline-block;">
                      </div>&nbsp;<span>Canteen</span>

                        <div style="width:10px;height: 10px;background-color: lightsalmon;display: inline-block;">
                      </div>&nbsp;<span>Pending</span>

                       <div style="width:10px;height: 10px;background-color: #88C3C8;display: inline-block;">
                      </div>&nbsp;<span>Self</span>
                        <div style="width:10px;height: 10px;background-color: #D2691E;display: inline-block;">
                      </div>&nbsp;<span>Transport</span>
                    <div style="width:10px;height: 10px;background-color: #BB8F8F;display: inline-block;">
                      </div>&nbsp;<span>Library</span>
                    <div style="width:10px;height: 10px;background-color: #efdab1;display: inline-block;">
                      </div>&nbsp;<span>Examination</span>
                        <div style="width:10px;height: 10px;background-color: #29ef9e;display: inline-block;">
                      </div>&nbsp;<span>Addmission</span>
                <form action="print.php">
                    <input type="hidden" name="session" value="<?php echo $session ?>">
                    <input type="submit" class="btn btn-success float-right" value="Print" name="printBtn">
                </form>
                      <hr/>
                <div style="height: 600px;overflow-x: scroll;">

                        <table class="table table-striped table-hover table-bordered">
                            <thead style="background-color: #000;" class="text-white">
                            <tr>
                                <td>Date</td>
                                <td>Time</td>
                                <td>Transaction ID</td>
                                <td>Debit</td>
                                <td>Credit</td>
                                <td>Status</td>
                                <td>Payee</td>
                                <td>Balance</td>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query='';
                            if (isset($_GET["txnIdSearch"]))
                            {
                                $txn_id = $_GET["txnId"];
//                                echo $txn_id;
//                                echo $session;
                                $query="select date,time,txn_id,debit,credit,statusoftxn,payee,balance from table_transaction where u_id =$session and txn_id = '$txn_id' order by date asc";
                
                            }
                            elseif(isset($_GET["viewHistory"]))
                            {
                                $from=$_GET["from"];
                                $to = $_GET["to"];
                                $query="select date,time,txn_id,debit,credit,statusoftxn,payee,balance from table_transaction where u_id =$session and date between '$from' and '$to' order by date asc";
                                
                
                
                            }
                            else{
                                $query="select date,time,txn_id,debit,credit,statusoftxn,payee,balance from table_transaction  where u_id =$session order by date asc";
                
                            }
                
                                $result = mysqli_query($link,$query);
                              if (mysqli_num_rows($result) == 0) {
                                  echo "<h3 class='text-danger'>No Transactions Found</h3>";
                              } else {
                                  while($rowFetched = mysqli_fetch_assoc($result)) {
                                                
                                      if ($rowFetched["statusoftxn"] == 'Confirmed') {
                                          echo "<tr style='background:#88C3C8;'>";
                                          if (strtolower($rowFetched["payee"]) == "canteen") {
                                              echo '<tr style="background-color:pink;">';
                                          } else if (strtolower($rowFetched["payee"]) == "self") {
                                              echo '<tr style="background-color:#88C3C8;">';

                                          }else if (strtolower($rowFetched["payee"]) == "transport") {
                                              echo '<tr style="background-color:#D2691E;">';

                                          }else if (strtolower($rowFetched["payee"]) == "library") {
                                              echo '<tr style="background-color:#BB8F8F;">';

                                          }else if (strtolower($rowFetched["payee"]) == "admin/examination") {
                                              echo '<tr style="background-color:#efdab1;">';

                                          }else if (strtolower($rowFetched["payee"]) == "admin/admission") {
                                              echo '<tr style="background-color:#29ef9e;">';

                                          }
                                      } else if ($rowFetched["statusoftxn"] == 'pending') {
                                          echo "<tr style='background-color: lightsalmon;'>";
                                      }
                                          ?>
                                         
                                              <td><?php echo $rowFetched["date"] ?></td>
                                              <td><?php echo $rowFetched["time"] ?></td>
                                              <td><?php echo $rowFetched["txn_id"] ?></td>
                                              <td><?php echo $rowFetched["debit"] ?></td>
                                              <td><?php echo $rowFetched["credit"] ?></td>
                                              <td><?php echo $rowFetched["statusoftxn"] ?></td>

                                              <td><?php echo $rowFetched["payee"] ?></td>
                                              <td><?php echo $rowFetched["balance"] ?></td>
                                          </tr>
                                          <?php
                                  }
                              }
                
                            ?>
                            </tbody>
                        </table>
                </div>
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
</body>
</html>
