<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 27/09/18
 * Time: 10:35 PM
 */
?>

<?php
session_start();
date_default_timezone_set('Asia/Calcutta');

$currentTime =  date('H:i');
include "include/db_config.php";
$otp = $_SESSION["otp"];
$result = mysqli_query($link,"select * from otp where otp = $otp");
$rowFetched = mysqli_fetch_assoc($result);
//$time = $rowFetched["time"];
$expiryTime = $rowFetched["expirytime"];
if($rowFetched["date"] == $rowFetched["expirydate"]){
    $limit =
    $timeExploded = explode(":",$currentTime);
    $expiryTimeExploded = explode(":",$expiryTime);
    if($timeExploded[0] == $expiryTimeExploded[0]){
        if($timeExploded[1] < $expiryTimeExploded[1]){
            echo "valid";
        } else {
            echo "invalid 1";
        }
    }else if($timeExploded[0] < $expiryTimeExploded[0]) {
        if(($timeExploded[1] - $expiryTimeExploded[1]) == 15){
            echo "valid";
        } else {
            echo "invalid 1";
        }
    }

}else {
    echo "<div class='alert alert-info'>otp expired</div>";
}
?>
