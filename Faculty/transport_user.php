<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 01/07/18
 * Time: 8:00 PM
 */
session_start();
include "../include/db_config.php";

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

        TRANSPORT :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="../admin/admin/docs/assets/css/toolkit-inverse.css" rel="stylesheet">


    <link href="../admin/admin/docs/assets/css/application.css" rel="stylesheet">

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
            margin: 0;
            padding: 0;
        }
        li:hover {
            background-color: #4496C2;
            border-radius:5px;
        }
        li {
            margin-top: 15px;
        }
        textarea{
            resize: none;
        }
        tr {
            color: white;
        }
    </style>
</head>


<body>
<div class="row p-3">
    <?php
    include"side_panel.php"
    ?>

    <div class="col-sm-9 content">
        <?php

        include("header_faculty.php");
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
    <input type="submit" class="btn btn-primary mt-3 float-right mb-4" name="view_busses" value="View All Busses">
</form>
<table class="table table-hover table-bordered table-striped mt-2">
    <thead class="thead-dark">
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Course</th>
<!--            <th>Semester</th>-->
            <th>Reg-num</th>
<!--            <th>Enroll number</th>-->
            <th>From</th>
            <th>status</th>
            <th>V-Id</th>
            <th>Priority Vehicle</th>
            <th>Allotment date</th>
            <th>Fee</th>
            <th>Balance</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
$result = mysqli_query($link, $query);
$s_no = 1;
if (!(mysqli_num_rows($result) == 0)) {
    while ($rowFetched = mysqli_fetch_assoc($result)) {
        if ($rowFetched["statusOfBus"] == 'pending') {
            echo "<tr style='background-color: lightsalmon;' class='text-capitalize'>";
            $u_id = $rowFetched["u_id"];
        } else {
            echo "<tr style='background-color: lightskyblue;' class='text-capitalize'>";
        }
            ?>

                    <td><?php echo $s_no; ?></td>
                    <td><?php echo $rowFetched["name"]; ?></td>
                    <td><?php echo $rowFetched["course"]; ?></td>
<!--                    <td>--><?php //echo $rowFetched["semester"]; ?><!--</td>-->
                    <td class="text-uppercase"><?php echo $rowFetched["reg_num"]; ?></td>
<!--                    <td>--><?php //echo $rowFetched["enroll_id"]; ?><!--</td>-->
                    <td><?php echo $rowFetched["pick_up"]; ?></td>
                    <td><?php echo $rowFetched["statusOfBus"]; ?></td>
                    <td><?php echo $rowFetched["vehicle_id"]; ?></td>
                    <td><?php echo $rowFetched["priority_vehicle"]; ?></td>
                    <td><?php echo $rowFetched["allot_date"]; ?></td>
                    <td><?php echo $rowFetched["fee"]; ?></td>
                    <td>
                        <a href="fee.php?allotid=<?php echo $rowFetched["transport_allot_id"]?>">click</a>
                    </td>

                    <td>
                        <?php
                        if ($rowFetched["statusOfBus"] == 'pending') {
                            ?>
                            <form method="" action="">
                                <input type="hidden" name="user_id" value="<?php echo $rowFetched["u_id"]; ?>">
                                <button type="submit"  value="<?php echo $rowFetched["pick_up"] ?>" name ="allot" class="btn btn-success btn-block p-0">
                                    Allot
                                </button>
                            </form>

                            <?php
                        } else {
                            ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <span>Alloted</span>
                                </div>
                                <div class="col-sm-6">
                                    <form action="">
                                        <button type="submit" value="submit" class="btn btn-block p-0 btn-danger "  onclick="return confirm('Do You Want To Delete The Selected User <?php echo $rowFetched["name"] ?>?')" name="deleteTransport">
                                            &#x2717;
                                        </button>
                                    </form>

                                </div>
                            </div>

                            <?php
                        }
                            ?>
                    </td>
                </tr>


                <?php
}
        ?>


        <?php
        $s_no +=1;
} else {
        echo "<h2 style='color:red;'>No Records</h2>";
}
{?>

    <?php }
?>
    </tbody>
</table>

        <div style="height: 500px; overflow-x: scroll;">
            <?php
            if (isset($_GET["view_busses"]) or isset($_GET["allot"])) {
                include "bus.php";
            }
            ?>
        </div>
    </div>
</div>
    <hr class="mt-5">



    <script src="../admin/admin/docs/assets/js/jquery.min.js"></script>
    <script src="../admin/admin/docs/assets/js/tether.min.js"></script>
    <script src="../admin/admin/docs/assets/js/chart.js"></script>
    <script src="../admin/admin/docs/assets/js/tablesorter.min.js"></script>
    <script src="../admin/admin/docs/assets/js/toolkit.js"></script>
    <script src="../admin/admin/docs/assets/js/application.js"></script>
    <script>
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
    </script>
</body>
</html>

