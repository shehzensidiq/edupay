<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 01/07/18
 * Time: 8:00 PM
 */
//session_start();

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
        .seats {
            background-color: #25282F;
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
<?php
$query = '';
if (isset($_GET["pending_requests"])) {
    $query = "select * from table_transport_allot tt join table_user_edupay tu on tt.u_id  = tu.u_id  where tt.statusOfBus = 'pending'";
} else if (isset($_GET["approved_btn"])) {
    $query = "select * from table_transport_allot tt join table_user_edupay tu on tt.u_id  = tu.u_id  where tt.statusOfBus = 'alloted'";

} elseif (isset($_GET["all_btn"])) {
    $query = "select * from table_transport_allot tt join table_user_edupay tu on tt.u_id  = tu.u_id";

} else {
    $query = "select * from table_transport_allot tt join table_user_edupay tu on tt.u_id  = tu.u_id";

}

?>
<form action="">
    <input type="submit" class="btn btn-success mt-3 float-right mb-2" name="view_busses" value="View All Busses">
</form>
<table class="table table-hover table-sm table-bordered table-striped mt-2">
    <thead class="thead-dark">
        <tr>
            <td>Name</td>
            <td>Course</td>
            <td>Semester</td>
            <td>Reg-num</td>
            <td>Enroll number</td>
            <td>From</td>
            <td>status</td>
            <td>Vehicle Id</td>
            <td>Priority Vehicle</td>
            <td>Allotment date</td>
            <td>Fee</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
    <?php
$result = mysqli_query($link, $query);
if (!(mysqli_num_rows($result) == 0)) {
    while ($rowFetched = mysqli_fetch_assoc($result)) {
            if($rowFetched["statusOfBus"] == 'pending') {
                echo "<tr class='text-capitalize text-gray-dark' style='background-color: rosybrown;'>";
            } else {
                echo "<tr class='text-capitalize' style='background-color:#87c4c8;'>";

            }
            ?>
                    <td><?php echo $rowFetched["name"]; ?></td>
                    <td><?php echo $rowFetched["course"]; ?></td>
                    <td><?php echo $rowFetched["semester"]; ?></td>
                    <td><?php echo $rowFetched["reg_num"]; ?></td>
                    <td><?php echo $rowFetched["enroll_id"]; ?></td>
                    <td><?php echo $rowFetched["pick_up"]; ?></td>
                    <td><?php echo $rowFetched["statusOfBus"]; ?></td>
                    <td><?php echo $rowFetched["vehicle_id"]; ?></td>
                    <td><?php echo $rowFetched["priority_vehicle"]; ?></td>
                    <td><?php echo $rowFetched["allot_date"]; ?></td>
                    <td><?php echo $rowFetched["fee"]; ?></td>
                    <td>
                        <?php
                        if ($rowFetched["statusOfBus"] == 'pending') {
                            ?>
                            <form>
                                <input type="hidden" name="user_id" value="<?php echo $rowFetched["u_id"]; ?>">
                                <button type="submit"  value="<?php echo $rowFetched["pick_up"] ?>" name ="allot" class="btn btn-success btn-block p-0">
                                    Allot
                                </button>
                            </form>
                            <?php
                        } else {
                            echo "Alloted";
                        } ?>
                    </td>
                </tr>
<!--                <td>-->
<!--                    <form action="">-->
<!--                        <button class=" p-0 btn btn-block btn-success" type="submit" value="submit"-->
<!--                                name="allot_vehicle" disabled>-->
<!--                            Allot-->
<!--                        </button>-->
<!--                    </form>-->
<!---->
<!--                </td>-->



                <?php
}
        ?>


        <?php

} else {
//        header("location:transport_user.php");
}
{?>

    <?php }
?>
    </tbody>
</table>
<div class="row" style="overflow:scroll;height:500px">
    <div class="col">
       <?php
            include("../../../Faculty/bus.php");
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

