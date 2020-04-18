<?php
    if(isset($_GET["allot_seat_in"])){
        $vId = $_GET["allot_seat_in"];
        $uId = $_GET["hidden_btn"];
        $fee = $_GET["fee"];
        // echo$vId;
        // echo $uId;
        // echo $fee;
        include("../include/db_config.php");
        mysqli_query($link,"update table_transport_allot set vehicle_id=$vId,statusOfBus='alloted',fee=$fee,allot_date=NOW() where u_id = $uId");
        $count = mysqli_query($link,"select count(vehicle_id) as occupied_seats from table_transport_allot where vehicle_id=$vId");
        $rowFetched= mysqli_fetch_assoc($count);
        $seats =$rowFetched["occupied_seats"];
        mysqli_query($link,"update table_vehicle set occupied_seats=$seats where vehicle_id = $vId");
        echo "<script>alert('Bus Allotted');window.location='transport_user.php';</script>";
    }

?>