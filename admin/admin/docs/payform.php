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
        <?

// echo $_SESSION["amount"];
error_reporting(0);
$requestId = $_GET["request_id"];
$result = mysqli_query($link,"select * from withdraw_request_table where request_id = $requestId");
$rowFetched = mysqli_fetch_assoc($result);


?>
<div class="container">
    <div class="card w-50 mx-auto">

        <h6 class="text-white text-center">Request Id  -- <?php echo $requestId;
        ?>#</h6>
        <hr style="border:1px solid grey;width: 100%;">

        <div class="card-body">
            <div class="row">
                <div class="col-sm-6 c">
                <sup>Requested By</sup><br>
                    <?php echo $rowFetched["request_from"]  ?>
                </div>
                <div class="col-sm-6">
                    <sup>Amount Requested</sup><br>
                    <?php echo "Rs " .$rowFetched["amount"]."/-"  ?>
                 </div>
                </div> <hr>
            <div class="row">
                <div class="col-sm-6 c">
                <sup>Date </sup><br>
                    <?php echo $rowFetched["date"]  ?>
                </div>
                <div class="col-sm-6">
                    <sup>Time</sup><br>
                    <?php echo $rowFetched["time"]  ?>
                </div>

            </div> <hr>

            <div class="row">
                <div class="col-sm-6 c">
                <sup>Account Number</sup><br>
                    <?php echo $rowFetched["accNum"];

                    $accNum = $rowFetched["accNum"];
                    $result = mysqli_query($link,"select * from table_bank where account_number = $accNum");
                    $rowFetched = mysqli_fetch_assoc($result);
                                        ?>
                </div>
                <div class="col-sm-6">
                    <sup>Name</sup><br>
                    <?php echo $rowFetched["name"]  ?>
                </div>
            </div><hr>

                <div class="row">
                    <div class="col-sm-6 c">
                        <sup>IFSC Code</sup> <br>
                        <?php echo $rowFetched["ifsc"];
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <sup>Bank Name</sup><br>
                        <?php echo $rowFetched["bank_name"];
                        ?>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col-sm-12">
                        <sup>Bank Branch</sup><br>
                        <?php echo $rowFetched["bank_branch"];
                        ?>
                    </div>
                </div>
            </div> <br><hr>
            <div class="row">
                <div class="col">
                    <form action="">
                        <input type="hidden" name="requestId" value="<?php echo $requestId ?>">
                        <input type="submit" value="Pay The User" class="btn btn-block btn-primary" name="pay">
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php
if(isset($_GET["pay"])){
    $charArray = array(
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 1, 2, 3, 4, 5, 6, 7, 8, 9
    );
    $requestId = $_GET["requestId"];
    $txn_id = ($charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] .
        $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)]);
        mysqli_query($link,"update withdraw_request_table set txn_id = '$txn_id', status = 'paid' where request_id = $requestId");
        echo "<script>alert('The Payment Has Been done');window.location='withdraw.php'</script>";
        // echo $txn_id;
        // echo $requestId;
}

?>
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
