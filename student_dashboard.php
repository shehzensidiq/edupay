<?php
session_start();
$session = $_SESSION["auth_user"];
include "include/db_config.php";
$result = mysqli_query($link, "select u_id,name,course,gender,last_login,profile_pic,semester,enroll_id,reg_num from table_user_edupay where u_id = $session");
$rowFetched = mysqli_fetch_assoc($result);
$_SESSION["reg_num"] = $rowFetched["reg_num"];
$_SESSION["name"] = $rowFetched["name"];
$_SESSION["last_login"] = $rowFetched["last_login"];


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

        .dropdown-menu :hover> button {
            background-color: #4496C2;
            color: white;
        }
        .card-body {
            background-color:#effdfd ;
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
//          $session=$_SESSION["auth_user"];
          //                               echo $session;
          //                               echo $session;
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

          $_SESSION["balance"] = $balance;


          ?>

<div class="row statcards">
  <div class="col-md-6 col-xl-4 mb-3 mb-md-4 mb-xl-0">
    <div class="statcard statcard-success">
      <div class="p-3">
        <span class="statcard-desc">Balance</span>
        <h2 class="statcard-number">&#8377;
            <?php
             echo $balance;
            ?>

        </h2>
        <hr class="statcard-hr mb-0">
      </div>
      <canvas id="sparkline1" width="378" height="94"
        class="sparkline"
        data-chart="spark-line"
        data-dataset="[[28,68,41,43,96,45,100]]"
        data-labels="['a','b','c','d','e','f','g']"
        style="width: 189px; height: 47px;"></canvas>
    </div>
  </div>
  <div class="col-md-6 col-xl-4 mb-3 mb-md-4 mb-xl-0">
    <div class="statcard statcard-danger">
      <div class="p-3">
        <span class="statcard-desc">Total Credited</span>
        <h2 class="statcard-number">&#8377;
            <?php
              echo $credit;
            ?>

        </h2>
        <hr class="statcard-hr mb-0">
      </div>
      <canvas id="sparkline1" width="378" height="94"
        class="sparkline"
        data-chart="spark-line"
        data-dataset="[[4,34,64,27,96,50,80]]"
        data-labels="['a','b','c','d','e','f','g']"
        style="width: 189px; height: 47px;"></canvas>
    </div>
  </div>
  <div class="col-md-6 col-xl-4 mb-3 mb-md-4 mb-xl-0">
    <div class="statcard statcard-info">
      <div class="p-3">
        <span class="statcard-desc">Total Debited</span>
        <h2 class="statcard-number">&#8377;
            <?php
                echo $debit;
            ?>

        </h2>
        <hr class="statcard-hr mb-0">
      </div>
      <canvas id="sparkline1" width="378" height="94"
        class="sparkline"
        data-chart="spark-line"
        data-dataset="[[12,38,32,60,36,54,68]]"
        data-labels="['a','b','c','d','e','f','g']"
        style="width: 189px; height: 47px;"></canvas>
    </div>
  </div>
</div>

          <div class="row">
              <div class="col-sm-12">
                  <div class="statcard  w-50 mx-auto p-3 mt-5 " style="border: 1px solid grey;border-radius: 5px">
                      <div class="p-3">
                          <span class="statcard-desc">Make Payment</span>
                          <span class="statcard-desc float-right">Make Payment</span>

                          <hr class="statcard-hr mb-0 w-100">
                      </div>
                      <form action="process_money.php" method="post">
                          <div class="row">
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="payTo"> Pay To</label>
                                      <select name="payee" id="selection" class="form-control" onfocus="return selectValidation()" onblur="selectValidation()">
                                          <option value="none">Select</option>
                                          <option value="canteen">Canteen</option>
                                          <option value="examination">Examination Fee</option>
                                          <option value="admission">Admission Fee</option>
                                      </select>
                                      <sup id="errorMessage"></sup>
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group">
                                      <label for="amount">Amount</label>
                                      <input type="number" name="amount" id="amount" class="form-control" placeholder="Amount" onfocus="return moneyValidate(this);" onblur="return moneyValidate(this);">
                                      <sup id="errorAmount"></sup>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <div class="form-group">
                                      <label for="password"> Enter your Trasaction Password</label>
                                      <input type="password" name="txn_password" id="password" class="form-control" placeholder="************" onfocus="passwordValidate()" onblur="return passwordValidate()" >
                                      <sup id="spanpassword"></sup>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col">
                                  <input type="submit" value="Pay The Entered Amount"  class="btn btn-block  btn-primary mt-1" name="pay_to">
                              </div>
                          </div>
                      </form>
                      <form action="add_money.php" method="post">
                          <button class="btn btn-block btn-success mt-3" value="submit">Add Money</button>

                      </form>
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

          </script>
      <script>
      // execute/clear BS loaders for docs
      $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
    </script>
  </body>
</html>

