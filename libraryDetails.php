<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 17/09/18
 * Time: 2:20 PM
 */
?><?php
session_start();
$session = $_SESSION["auth_user"];
$regNum = $_SESSION["reg_num"];
include 'include/db_config.php';
$key = "sheh_wase-nyla_yasm-";

error_reporting(0);


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

   <div class="card rounded p-1">
       <div class="mb-4">
           <span class="statcard-desc float-left" style="display: inline-block">Library Books History</span>
           <span class="statcard-desc float-right" style="display: inline-block;">Library Books History</span>
       </div>

       <table class="table table-bordered table-hover mb-1">
           <tr class="bg-primary text-white">
               <th>S.No</th>
               <th>Book ID</th>
               <th>Book Name</th>
               <th>Book Number</th>
               <th>Author</th>
               <th>Issue Date</th>
               <th>Return Date</th>
               <th>Days Overdue</th>
               <th>Status</th>
               <th>Fine</th>
               <th>Fine status</th>
               <th>Pay</th>
           </tr>
           <?php
           //        echo $regNum;
           $sNo = 1;
           $total = 0;
           $result = mysqli_query($link,"select * from table_book tb join table_alloted_books ta on tb.book_id = ta.book_id where ta.reg_num = '$regNum'");
           if (mysqli_num_rows($result) != 0) {

               while($rowFetched = mysqli_fetch_assoc($result))
               {
                   if(strtolower($rowFetched["status"]) == 'alloted')
                   {
                       echo "<tr style='background: lightsalmon;'>";


                   } else
                   {
                       echo "<tr style='background: lightskyblue;'>";

                   }
                   ?>
                   <td><?php echo $sNo ?></td>
                   <?php
                   $allotId = $rowFetched["id"];
                   ?>
                   <td><?php echo $rowFetched["book_id"] ?></td>
                   <td><?php echo $rowFetched["book_name"] ?></td>
                   <td><?php echo $rowFetched["book_number"] ?></td>
                   <td><?php echo $rowFetched["author"] ?></td>
                   <td><?php echo $rowFetched["alloted_date"] ?></td>

                   <td><?php echo $rowFetched["return_date"] ?></td>
                   <td><?php echo $rowFetched["daysover"]." Days" ?></td>
                   <td class="text-capitalize"><?php if($rowFetched["status"] == 'alloted'){
                           echo $rowFetched["status"]."/"."Not returned Yet";
                       } else {
                           echo $rowFetched["status"];
                       } ?></td>
                   <td>

                       <?php
                       echo $rowFetched["fine"]."/-";
                       $total+=$rowFetched["fine"];
                       ?>
                   </td>
                   <?php
                   if($rowFetched["status"] == 'returned' and $rowFetched["fine_paid"] == 'paid'){
                       $paid += $rowFetched["fine"];
                   }
                   ?>
                   <td>

                       <?php
                       echo $rowFetched["fine_paid"];
                       ?>
                   </td>
                   <td>
                       <?php
                       if(($total > 0) and $rowFetched["status"] == 'returned') {
                           if ($rowFetched["fine_paid"] == 'paid') {
                               echo "Fine Paid";
                                } else {
                               ?>
                               <form action="">
                                   <input type="hidden" name="amount" value="<?php echo $total ?>">
                                   <input type="hidden" name="bookId" value="<?php echo $rowFetched["book_id"] ?>">
                                   <input type="hidden" name="allotedDate"
                                          value="<?php echo $rowFetched["alloted_date"] ?>">
                                   <input type="submit" value="Pay" name="payLibrary" class="btn btn-success">
                               </form>
                           <?php }

                       }else if(($total > 0 and $rowFetched["status"] == 'alloted')){
                          ?>
                       <form action="">
                           <input type="hidden" name="amount" value="<?php echo $total ?>">
                           <input type="hidden" name="bookId" value="<?php echo $rowFetched["book_id"] ?>">
                           <input type="hidden" name="allotedDate" value="<?php echo $rowFetched["alloted_date"] ?>">
                           <input type="submit" value="Pay" name="payLibrary" class="btn btn-success" disabled>
                       </form>
                      <?php } else {
                           echo "Fine not calculated";
                       }
                       ?>
                   </td>
                   </tr>
                   <?php
                   $sNo++;
               }
           } else {
               echo "<h1>No book Issued Yet</h1>";
           }
           ?>
           <?php

           if(isset($_GET["payLibrary"])){
               $key = "sheh_wase-nyla_yasm-";
               $charArray = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd'
               , 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 1, 2, 3, 4, 5, 6, 7, 8, 9);
               $txn_id = ($charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] .
                   $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)]. $charArray[rand(0, 60)]. $charArray[rand(0, 60)]. $charArray[rand(0, 60)]);
               $session = $_SESSION["auth_user"];
               $query = "";
               $balanceCheck = $_SESSION["balance"];
                   $balance = 0;
                    $credit = 0;
                    $debit = 0;
                    $amount = $_GET["amount"];
               $bookId = $_GET["bookId"];
               $allotDate = $_GET["allotedDate"];
               $regNum = $_SESSION["reg_num"];

               if ($amount <= $balanceCheck) {
                   mysqli_query($link,"update table_alloted_books set fine_paid = 'paid' where reg_num = '$regNum' and book_id = $bookId and alloted_date = '$allotDate'");

                   mysqli_query($link,"insert into table_transaction(u_id,txn_id,debit,credit,statusoftxn,payee,date,time) values($session,'$txn_id',$amount,0,'Confirmed','library',NOW(),NOW())");
                   echo "<script>alert('The Fine Has been paid to Library');</script>";


                   $result = mysqli_query($link, "select debit from table_transaction where u_id = '$session'");

            while ($rowFetched = mysqli_fetch_assoc($result)) {
                $debit += $rowFetched["debit"];
            }
            $result = mysqli_query($link, "select credit from table_transaction where u_id = '$session' and statusoftxn = 'Confirmed'");
            while ($rowFetched = mysqli_fetch_assoc($result)) {
                $credit += $rowFetched["credit"];

            }
//                        while($rowFetched = mysqli_fetch_assoc($result)) {
            //                            $balance = $rowFetched["balance"];
            //                        }
            $balance = $credit - $debit;
//                        echo $balance;


                   mysqli_query($link, "update table_transaction set balance = $balance where txn_id = '$txn_id'");
                  $result = mysqli_query($link,"select ad_email from table_admin_faculty where admin_for = 'library'");
                   $rowFetched = mysqli_fetch_assoc($result);
                   $to = openssl_decrypt($rowFetched["ad_email"],'AES-256-ECB', $key, '0', '');
            $sub = "Payment Successful";
            $body= "The Amount Of ".$amount." Has been paid to library with Transaction id : ".$txn_id;
            mail($to,$sub,$body);


    }
               else {
                   echo "<script>alert('Insufficeint Balance');</script>";



               }

}

           ?>


       </table>
       <div class="mb-2 mt-2">
           <span class="statcard-desc float-left" style="font-size: 23px;display:inline-block;">Balance : Rs <?php
               echo $total - $paid;
               ?>/-</span>
           <span class="statcard-desc float-right" style="display: inline-block;font-size: 23px">Total Paid:<?php echo $paid; ?>/- </span>
       </div>
       


   </div>


</div>




<hr class="mt-5">



<script src="admin/admin/docs/assets/js/jquery.min.js"></script>
<script src="admin/admin/docs/assets/js/tether.min.js"></script>
<script src="admin/admin/docs/assets/js/chart.js"></script>
<script src="admin/admin/docs/assets/js/tablesorter.min.js"></script>
<script src="admin/admin/docs/assets/js/toolkit.js"></script>
<script src="admin/admin/docs/assets/js/application.js"></script>
<script>
    // execute/clear BS loaders for docs
    $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
</script>

</body>
</html>
