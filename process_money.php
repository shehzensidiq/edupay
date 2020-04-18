;<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 23/06/18
 * Time: 10:14 PM
 */

?>

<?php
session_start();
if (!(isset($_SESSION["auth_user"]))) {
	header("location:index.php");
} else {
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


    include "include/db_config.php";
	$_SESSION["txn_id"] = $txn_id;

	if (isset($_POST["btn_pay"])) {

		$amount = $_POST["amount"];
		$balance = 0;
		$password = openssl_encrypt($_POST["password"], 'AES-256-ECB', $key, '0', '');
		$result = mysqli_query($link, "select password from table_user_edupay where password = '$password' and u_id = $session");

		$result = mysqli_query($link, "select password from table_user_edupay where password = '$password' and u_id = $session");
		if (mysqli_num_rows($result) > 0) {
			mysqli_query($link, "insert into table_transaction(u_id,txn_id,debit,credit,statusoftxn,payment_status,payee,date,time,balance) values ($session,'$txn_id',0,$amount,'pending','pending','self',NOW(),NOW(),$balance)");
			$result = mysqli_query($link, "select credit from table_transaction where u_id = '$session' and statusoftxn  =  'Confirmed'");
			$credit = 0;
			$debit = 0;
			$balance = 0;
			while ($rowFetched = mysqli_fetch_assoc($result)) {
				$credit += $rowFetched["credit"];

			}
			$result = mysqli_query($link, "select debit from table_transaction where u_id = '$session'");

			while ($rowFetched = mysqli_fetch_assoc($result)) {
				$debit += $rowFetched["debit"];
			}

			$balance = $credit - $debit;

			mysqli_query($link, "update table_transaction set balance = $balance where txn_id = '$txn_id'");
            $_SESSION["amount"] = $amount;
//window.location='student_dashboard.php';

            echo "<script>alert('The Request To Add Money Has Been Sent! Thank you');</script>";
			header("location:PayUMoney_form.php");
		} else {
			echo "<script>alert('Password Incorrect');window.location='add_money.php';</script>";

		}
//
	} else if (isset($_POST["pay_to"])) {

		$amount = $_POST["amount"];
		$payee = $_POST["payee"];
		$paidTo = $_POST["payee"];
		if($payee == 'hostel' || $payee == 'examination' || $payee == 'admission')
        {
            $payee = 'admin/'.$paidTo;
        }
		$txn_password = openssl_encrypt($_POST["txn_password"], 'AES-256-ECB', $key, '0', '');
		$result = mysqli_query($link, "select password,email from table_user_edupay where password = '$txn_password' and u_id = $session");
		$rowFetched = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result) > 0) {
			if ($amount <= $balanceCheck) {

				mysqli_query($link, "insert into table_transaction(u_id,txn_id,debit,credit,statusoftxn,payee,date,time,balance) values ($session,'$txn_id',$amount,0,'Confirmed','$payee',NOW(),NOW(),$balanceCheck)");
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
				echo "<script>alert('The Money Has Been Paid To " . $payee;
				echo "');window.location='student_dashboard.php';</script>";
				$to = openssl_decrypt($rowFetched["email"],'AES-256-ECB', $key, '0', '');
				$sub = "Payment Successful";
				$body= "The Amount Of ".$amount." Has been paid to ".$payee." with Transaction id : ".$txn_id;
				mail($to,$sub,$body);
				$query="";
				$ad_email="";
				if($payee == 'transport' || $payee == 'library'){
				    $query = "select ad_email from table_admin_faculty where admin_for = '$payee'";
                } else if($payee == 'admin'){
				    $query="select email from table_admin_edupay";
                } else if($payee == 'canteen'){
				    $query = "select canteen_email from table_canteen_admin";

                }
				$details= mysqli_query($link,$query);
				$detailsFetched = mysqli_fetch_assoc($details);
                if($payee == 'transport' || $payee == 'library'){
                    $ad_email = openssl_decrypt($detailsFetched["ad_email"],'AES-256-ECB', $key, '0', '');
                    if($payee == 'transport'){
                        $purpose = 'Transport Fee';
                    } else {
                        $purpose = 'Library';
                    }

                } else if($payee == 'admin'){
                    $ad_email = openssl_decrypt($detailsFetched["email"],'AES-256-ECB', $key, '0', '');
                    if($payee == 'hostel'){
                        $purpose = 'Hostel fee';
                    } else if($payee == 'examination') {
                        $purpose = 'Examination fee';
                    } else {
                        $purpose = 'Admission fee';
                    }

                } else if($payee == 'canteen'){
                    $ad_email = openssl_decrypt($detailsFetched["canteen_email"],'AES-256-ECB', $key, '0', '');
                    $purpose = 'Canteen Bill';

                }

//				$ad_email = openssl_decrypt($detailsFetched["ad_email"],'AES-256-ECB', $key, '0', '');
				$body = "The User with email".$rowFetched["email"]." has paid the amount of ".$amount." in your favour with transaction Id".$txn_id." with the purpose ". $purpose;
				mail($to,($sub." " .$purpose),$body);


			} else {
				echo "<script>alert('Insufficient Balance');window.location='student_dashboard.php'</script>";
			}
		} else {
			echo "<script>alert('Password Incorrect');window.location='student_dashboard.php';</script>";

		}

	}

}

?>
