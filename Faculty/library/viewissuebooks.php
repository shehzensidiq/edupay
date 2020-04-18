<?php
session_start();
$session = $_SESSION["auth_user"];

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

        LIBRARY :: Dashboard

    </title>

    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">

    <link href="../../admin/admin/docs/assets/css/toolkit-inverse.css" rel="stylesheet">


    <link href="../../admin/admin/docs/assets/css/application.css" rel="stylesheet">

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
        }
        li:hover {
            background-color: #4496C2;
            border-radius:5px;
        }
        li{
            margin-top: 20px;
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

        include("library_header.php");
        ?>

        <hr class="mt-1">
        <?php
               $regNum =  $_GET["regno"];
               $result = mysqli_query($link,"select * from table_alloted_books ta join table_book tb on ta.book_id = tb.book_id where reg_num = '$regNum'");

        ?>
        <table class="table table-bordered table-hover text-capitalize text-white">
            <tr>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Book Number</th>
                <th>Author</th>
                <th>Issue Date</th>
                <th>Return Date</th>
                <th>Days OverDue</th>
                <th>Fine</th>
                <th>Return</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) != 0) {
                while ($rowFetched = mysqli_fetch_assoc($result)) {
                    $id = $rowFetched["id"];
                    if (strtolower($rowFetched["status"]) == 'alloted') {
                        echo "<tr style='background: lightsalmon;'>";
                    } else {
                        echo "<tr style='background: lightskyblue;'>";

                    }
                    ?>

                    <td><?php echo $rowFetched["book_id"];
                    $bookId = $rowFetched["book_id"];
                    $id = $rowFetched["id"];

                    ?></td>
                    <td><?php echo $rowFetched["book_name"] ?></td>
                    <td><?php echo $rowFetched["book_number"] ?></td>
                    <td><?php echo $rowFetched["author"] ?></td>
                    <td><?php echo $rowFetched["alloted_date"] ?></td>
                    <td><?php
                        echo $rowFetched["return_date"];

                        ?></td>

                    <?php
                    if($rowFetched["status"] == "alloted" and $id == $rowFetched["id"]) {
                        $currentDate = date("Y-m-d");
                        $returnDate = $rowFetched["return_date"];
                        $allotedDate = $rowFetched["alloted_date"];
                        $fine = 0;
                        //exploding
                        $returnDateExploded = explode("-", $returnDate);
                        $currentDateExplode = explode("-", $currentDate);
                        //return
                        $returnDay = $returnDateExploded[2];
                        $returnMonth = $returnDateExploded[1];
                        $returnYear = $returnDateExploded[0];
                        //curr
                        $currentDay = $currentDateExplode[2];
                        $currentMonth = $currentDateExplode[1];
                        $currentYear = $currentDateExplode[0];
                        $days = 0;

                        //checking for conditions
                        if ($currentYear == $returnYear) {
                            if ($currentMonth < $returnMonth) {
                                $days = 0;
                            } else if ($currentMonth == $returnMonth) {
                                if ($currentDay < $returnDay) {
                                    $days = 0;
//                                $days = $currentDay - $returnDay;
                                } else if ($currentDay > $returnDay) {
                                    $days = $currentDay - $returnDay;


                                }
                            } else if ($currentMonth > $returnMonth) {

                                $monthDifference = $currentMonth - $returnMonth;
                                if ($returnDay == $currentDay) {
                                    $days = $monthDifference * 30;
                                } else if ($currentDay < $returnDay) {
                                    $days = $currentDay + ($monthDifference * 30);
                                } else if ($currentDay > $returnDay) {
                                    $days = ($currentDay - $returnDay) + ($monthDifference * 30);
                                }

                            }
                        }
//                    else if($currentYear == $returnYear and $currentMonth > $returnMonth){
//                        $monthDifference = $currentMonth - $returnMonth;
//                        if($returnDay == $currentDay){
//                            $days = $monthDifference*30;
//                        } else if($currentDay < $returnDay) {
//                            $days = $currentDay+($monthDifference*30);
//                        } else if($currentDay > $returnDay){
//                            $days = ($returnDay - $currentDay)+($monthDifference*30);
//                        }
//                        $days = ($currentMonth - $returnMonth)*30;
                        //}
                        else if ($currentYear > $returnYear) {
                            $yearDifference = $currentYear - $returnYear;

                            if ($currentMonth == $returnMonth) {
                                if ($currentDay == $returnDay) {
                                    $days = 365 * $yearDifference;
                                } else if ($currentDay < $returnDay) {
                                    $days = $currentDay + (365 * $yearDifference);
                                } else if ($currentDay > $returnDay) {
                                    $days = ($currentDay - $returnDay) + (365 * $yearDifference);
                                }
                            } else if ($currentMonth < $returnMonth) {
                                if ($currentDay == $returnDay) {
                                    $days = (360 - (($returnMonth - $currentMonth) * 30)) * $yearDifference;

                                } else if ($currentDay < $returnDay) {
                                    $days = ((360 - (($returnMonth - $currentMonth) * 30)) * $yearDifference) + $currentDay;
                                } else if ($currentDay > $returnDay) {
                                    $days = ((360 - (($returnMonth - $currentMonth) * 30)) * $yearDifference) + ($currentDay - $returnDay);


                                }


                            } else if ($currentMonth > $returnMonth) {
                                if ($currentDay == $returnDay) {
                                    $days = (360 + (($currentMonth - $returnMonth) * 30)) * $yearDifference;

                                } else if ($currentDay < $returnDay) {
                                    $days = ((360 + (($returnMonth - $currentMonth) * 30)) * $yearDifference) + $currentDay;
                                } else if ($currentDay > $returnDay) {
                                    $days = ((360 + (($currentMonth - $returnMonth) * 30)) * $yearDifference) + ($currentDay - $returnDay);


                                }
                            }
                        }
                        $fine = $days*2;

//                        if ($days < 15) {
//                            $fine = $days * 2;
//                        } else if ($days < 15 and $days > 15) {
//                            $fine = (15 * 2) + (($days - 15) * 3);
//                        }
                        mysqli_query($link,"update table_alloted_books set fine = $fine , daysover = $days where book_id = $bookId and reg_num = '$regNum' and id = $id");
                    }



                    ?>
                    <td><?php echo $rowFetched["daysover"]." Days" ?> </td>

                    <td><?php echo $rowFetched["fine"]."/-" ?></td>
                    <td>
                        <?php

                        if($rowFetched["status"] == 'alloted') {
                            ?>
                            <form action="return.php">
                                <input type="hidden" name="regno" value="<?php echo $_GET["regno"] ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="bookId" value="<?php echo $rowFetched["book_id"] ?>">
                                <button class="btn  btn-primary" type="submit" name="returnBtn">Return</button>

                            </form>
                            <?php
                        } else {
                            echo "Returned";
                        }
                        ?>

                    </td>
                    </tr>

                <?php }
            } else {
                echo "<h3 class='text-danger'>No Books Issued Yet</h3>";
            }
            ?>
        </table>

        </div>
</div>



    <hr class="mt-5">



    <script src="../../admin/admin/docs/assets/js/jquery.min.js"></script>
    <script src="../../admin/admin/docs/assets/js/tether.min.js"></script>
    <script src="../../admin/admin/docs/assets/js/chart.js"></script>
    <script src="../../admin/admin/docs/assets/js/tablesorter.min.js"></script>
    <script src="../../admin/admin/docs/assets/js/toolkit.js"></script>
    <script src="../../admin/admin/docs/assets/js/application.js"></script>
    <script>
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
    </script>

</body>
</html>
