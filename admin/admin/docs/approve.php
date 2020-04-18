<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 14/06/18
 * Time: 3:30 PM
 */
include ("../../../include/db_config.php");


?>



<?php
 echo "approved";
 if(isset($_GET["approve"]))
 {
     $id = $_GET["hidden_btn"];
     mysqli_query($link,"update table_user_edupay set status = 'Approved' where u_id = $id");
     header("location:student-details.php");
 } else  if (isset($_GET["confirm"])) {

     $txnId = $_GET["hidden_btn"];
     $userId = $_GET["userId"];
//     echo $txnId;
//     echo $userId;
     mysqli_query($link, "update table_transaction set statusoftxn = 'Confirmed', date = NOW() , time = NOW() where txn_id = '$txnId'");
     $result = mysqli_query($link,"select credit from table_transaction where u_id = '$userId' and statusoftxn = 'Confirmed'");
     $credit = 0;
     $debit = 0;
     $balance = 0;
     while($rowFetched = mysqli_fetch_assoc($result)){
         $credit += $rowFetched["credit"];
         }
         $result = mysqli_query($link,"select debit from table_transaction where u_id = '$userId' and statusoftxn = 'Confirmed'");

     while($rowFetched = mysqli_fetch_assoc($result)) {
         $debit += $rowFetched["debit"];
         }
         $balance = $credit - $debit;
     mysqli_query($link, "update table_transaction set balance = $balance where txn_id = '$txnId'");

     echo "<script>window.location='txn_process.php'</script>";
 }
?>

<?php
if (isset($_GET["pay"])) {
    $txnId  = $_GET["txn_id"];
    mysqli_query($link,"update withdraw_request_table set status = 'paid' where txn_id = '$txnId'");
    echo "<script>alert('Paid');window.location='withdraw.php'</script>";


}


//if (isset($_GET["confirm_payment_btn"])) {
//    $id = $_GET["hidden_btn"];
//    $txnId = $rowFetched["txn_id"];
//    echo $txnId;
//    mysqli_query($link, "update table_wallet_history set statusOfTxn = 'Confirmed' where u_id = $id and txn_id = '$txnId' ");
//    echo "<script>window.location='txn_process.php'</script>";
//    header("location:txn_process.php");
//}


?>
