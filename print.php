<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 27/09/18
 * Time: 6:17 PM
 */
if (isset($_GET["printBtn"])) {
    $session = $_GET["session"];
    include "include/db_config.php";
}
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
    </style>
</head>


<body>
<button class="btn  btn-primary mt-2 mb-2 ml-2" id="print" onclick="print()"> Print statement</button>
<table class="table">
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

        $query="select date,time,txn_id,debit,credit,statusoftxn,payee,balance from table_transaction  where u_id =$session order by date asc";

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
