


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
        li:hover {
            background-color: #4496C2;
            border-radius:5px;
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

<div class="row statcards">
  <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
    <div class="statcard statcard-success">
      <div class="p-3">
        <span class="statcard-desc">Total Credit</span>
        <h2 class="statcard-number">	&#8377;
	          <?php
                  $result = mysqli_query($link,"select credit from table_transaction where statusoftxn = 'Confirmed'");
                  $sum = 0;
                  $balance=0;
                  while($rowFetched = mysqli_fetch_assoc($result)){
                   $sum += $rowFetched["credit"];
					}
                  echo $sum;

               ?>

        </h2>
        <hr class="statcard-hr mb-0">
      </div>
      <canvas id="sparkline1" width="378" height="94" class="sparkline"
        data-chart="spark-line"
        data-dataset="[[28,68,41,43,96,45,100]]"
        data-labels="['a','b','c','d','e','f','g']"
        style="width: 189px; height: 47px;">
      </canvas>
    </div>
  </div>
  <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
    <div class="statcard statcard-danger">
      <div class="p-3">
        <span class="statcard-desc">Total Debit</span>
        <h2 class="statcard-number">
            &#8377;
			<?php
				$withdraw = 0;
				$debit = 0;
				$totalDebit = 0;
				$result = mysqli_query($link,"select amount from withdraw_request_table where status = 'paid'");
                 while($rowFetched = mysqli_fetch_assoc($result)){
                 $withdraw += $rowFetched["amount"];
					}
					echo $withdraw;
//					$result = mysqli_query($link,"select debit from table_transaction where statusoftxn = 'Confirmed'");
//                 while($rowFetched = mysqli_fetch_assoc($result)){
//                 $debit += $rowFetched["debit"];
//					}
////					echo $debit;
//					$totalDebit  = $withdraw + $debit;
//					echo $totalDebit;
				?>
         </h2>
        <hr class="statcard-hr mb-0">
      </div>
        <canvas id="sparkline1" width="378" height="94" class="sparkline"
                data-chart="spark-line"
                data-dataset="[[28,68,41,43,96,45,100]]"
                data-labels="['a','b','c','d','e','f','g']"
                style="width: 189px; height: 47px;">
        </canvas>
    </div>
  </div>
  <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
    <div class="statcard statcard-info">
      <div class="p-3">
        <span class="statcard-desc">Balance</span>
        <h2 class="statcard-number">
            &#8377;
          <?php

	          echo ($sum - $withdraw)
	          ?>
        </h2>
        <hr class="statcard-hr mb-0">
      </div>
      <canvas id="sparkline1" width="378" height="94" class="sparkline"
        data-chart="spark-line"
        data-dataset="[[12,38,32,60,36,54,68]]"
        data-labels="['a', 'b','c','d','e','f','g']"
        style="width: 189px; height: 47px;"></canvas>
    </div>
  </div>
  <div class="col-md-6 col-xl-3 mb-3 mb-md-4 mb-xl-0">
    <div class="statcard statcard-warning">
      <div class="p-3">
        <span class="statcard-desc">Sign-Ups</span>
        <h2 class="statcard-number">
            <img src="images/users.png" alt="" width="40px" height="40px" style="border-radius:50%">
                    <?php
                         $result = mysqli_query($link,"SELECT COUNT(*) AS u_id FROM table_user_edupay");
                         $rowFetched = mysqli_fetch_assoc($result);
                          $num_of_rows = $rowFetched['u_id'];
                          echo $num_of_rows;
                                      ?>
        </h2>
        <hr class="statcard-hr mb-0">
      </div>
      <canvas id="sparkline1" width="378" height="94" class="sparkline"
        data-chart="spark-line"
        data-dataset="[[43,48,52,58,50,95,100]]"
        data-labels="['a', 'b','c','d','e','f','g']"
        style="width: 189px; height: 47px;"></canvas>
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

