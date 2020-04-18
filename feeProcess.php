<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 14/09/18
 * Time: 2:30 PM
 */
session_start();
include "include/db_config.php";
?>

<?php
//if (isset($_GET["payFull"])){
//    $userId = $_GET["userId"];
//    $fee = $_GET["payFull"];
//    $result = mysqli_query($link,"select allot_date from table_transport_allot where u_id = $userId");
//    $rowFetched = mysqli_fetch_assoc($result);
//    $dateExplode = explode("-",$rowFetched["allot_date"]);
//    $month = $dateExplode[1];
//    $currMon = date("m");
//    $limit = $currMon - $month;
//    $monthArray = ["","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
////    $monthName = $monthArray[$month-0];
//    $monthminus = $month-0;
//    $amount = ($fee/$limit);
//    if($_SESSION["balance"] >= $amount){
//        for($i = 0; $i < $limit; $i++){
//            mysqli_query($link,"insert into table_fee_transport(u_id,month,year,amount,date,status) values ($userId,'$monthArray[$monthminus]',NOW(),$amount,NOW(),'Paid')");
//            $monthminus++;
////        header("location:transport.php");
//
//        }
//    } else {
//        echo "<script>alert('Insufficient Balance');window.location='student_dashboard.php'</script>";
//
//    }
//
//} else if(isset($_GET["payMonth"])) {
//    $month = $_GET["month"];
//    $userId = $_GET["userId"];
//    $amount = $_GET["payMonth"];
//    if($_SESSION["balance"] >= $amount) {
//        mysqli_query($link, "insert into table_fee_transport(u_id,month,year,amount,date,status) values ($userId,'$month',NOW(),$amount,NOW(),'Paid')");
//    } else {
//        echo "<script>alert('Insufficient Balance');window.location='student_dashboard.php'</script>";
//    }
//
//
//}
if(isset($_GET['paySelected'])){
    $userId =  $_GET["userId"];



    if(!empty($_GET['selectedMonths'])){
        $key = "sheh_wase-nyla_yasm-";
        $charArray = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd'
        , 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $txn_id = ($charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] .
            $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)] . $charArray[rand(0, 60)]. $charArray[rand(0, 60)]. $charArray[rand(0, 60)]. $charArray[rand(0, 60)]);
        $session = $_SESSION["auth_user"];
        $query = "";
        $balanceCheck = $_SESSION["balance"];

    foreach($_GET['selectedMonths'] as $mon){
        $amount = $_GET["amount"];
        $sumAmount = 0;
        for($i=0;$i<sizeof($_GET["selectedMonths"]);$i++){
            $sumAmount +=$amount;

        }

//            $monthArray = ["","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];


        $explode = explode("-",$mon);
        $result = mysqli_query($link,"select * from table_fee_transport where u_id = $userId and month = '$explode[0]' and year = '$explode[1]'");
//        $rowFetched = mysqli_fetch_assoc($result);

//        echo $explode[0];
//        echo $explode[1];
            if($_SESSION["balance"] >= $sumAmount) {
                if (mysqli_num_rows($result) == 0) {
                    $balance = 0;
                    $credit = 0;
                    $debit = 0;
                    mysqli_query($link, "insert into table_fee_transport(u_id,month,year,amount,date,status) values ($userId,'$explode[0]','$explode[1]',$amount,NOW(),'Paid')");

                        mysqli_query($link,"insert into table_transaction(u_id,txn_id,debit,credit,statusoftxn,payee,date,time) values($session,'$txn_id',$amount,0,'Confirmed','transport',NOW(),NOW())");
                        echo "<script>alert('The Fee has Been Paid to transport');</script>";


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
                        $result = mysqli_query($link,"select ad_email from table_admin_faculty where admin_for = 'transport'");
                        $rowFetched = mysqli_fetch_assoc($result);
                        $to = openssl_decrypt($rowFetched["ad_email"],'AES-256-ECB', $key, '0', '');
                        $sub = "Payment Successful";
                        $body= "The Amount Of ".$amount." Has been paid to transport with Transaction id : ".$txn_id;
                        mail($to,$sub,$body);

//            echo "<script>alert('The Amount Has been Paid');window.location='location:transport.php?details='+'submit';</script>";
                    header("location:transport.php?details=submit&lg=set");
//            echo $rowFetched[""]
                }
            } else {
                echo "<script>alert('Insufficient Balance');window.location='transport.php?details=submit'</script>";


            }
}


//    foreach($_GET['month'] as $mon){
//        echo $mon."</br>";
//    }
} else {
        echo "<script>alert('Empty Fields');window.location='transport.php?details=submit'</script>";


    }
}
//echo $_GET["payFull"];

?>
