<?php

require ("../../../include/db_config.php");
//$result = mysqli_query($link,'select * from table_user_edupay');
//$rowFetched = mysqli_fetch_assoc($result);



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
        }
        .card {
            background-color: #25282F;
            padding: 10px;
            border:1px solid grey;
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
        <div class="row">
            <!-- section for displaying and seaeching-->
            <div class="col-sm-12 p-3">

                <!--            ROW FOR SEARCHNG-->
                <div class="row mb-5 mt-2 mr-1 ">
                    <div class="col-sm-6 ">
                        <div class="card ml-3">
                            <form method="get" id="enrollsearch" name="sdform" onsubmit="return validation()">
                                <div class="card-body bg-dark">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" name="enroll" placeholder="Enter The Enrollment Number" class="form-control" min="0">
                                            <div class="input-group-prepend">
                                                <button value="submit"  name="searchById" class="btn btn-success"><img
                                                            src="../../../include/images/search_white_18x18.png" alt=""></button>
                                            </div>
                                        </div>
                                        <sup class="text-white">
                                            Search By Enrollment Number
                                        </sup>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 mr-auto">
                        <div class="card">
                            <div class="card-body bg-dark">
                                <form action="" method="get" name="studform" onsubmit="return validation_name()" id="nameseacrch">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="name" placeholder="John Doe / Jane Doe" class="form-control">
                                            <div class="input-group-prepend">
                                                <button value="submit"  name="searchByName" class="btn btn-success"> <img
                                                            src="../../../include/images/search_white_18x18.png" alt=""></button>
                                            </div>
                                        </div>
                                        <sup class="text-white">
                                            Search By Name
                                        </sup>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <!--
                            DISPLAYING THE DETAILS  FROM DATABASE-->
                <hr>
                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:#87c4c8;"></div><span>Approved</span>
                </div>

                <div style="display:inline-block;" class="ml-3">
                    <div style="width: 7px; height: 7px;background-color:lightsalmon;"></div><span>Pending  </span>
                </div>
                <div class="float-right">
                    <form action="">
                        <button class="btn btn-danger text-capitalize" type="submit" name="alltxn">
                            View Pending Students
                        </button>
                    </form>
                </div>

                <hr>

                <?php
                if(isset($_GET["searchById"]))
                {
                    $id= $_GET["enroll"];
                    echo "<span>Search Results For   <lable style='color: green;font-size: 28px'>$id</lable></span>";

                }
                elseif(isset($_GET["searchByName"]))
                {
                    $name= $_GET["name"];
                    echo "<span>Search Results For   <lable style='color: green;font-size: 28px'>$name</lable></span>";


                }
                else{
                    echo "<h3 class='userDetails'>User Details</h3>";
                }

                ?>
                <div class="row px-3">




                    <div class="col mt-2" style="overflow: scroll;height: 550px;">

                        <table class="table table-striped table-bordered ">
                            <thead class="table table-hover  table-bordered table-striped">
                            <tr class="text-white" style="background-color: #303C52;">
                                <td>Name</td>
                                <td>Reg Number</td>
                                <td>Enroll Number</td>
                                <td>Semeter</td>
                                <td>Staus</td>
                                <td>Date Of Request</td>
                                <td>Last LogIn</td>
                                <td>Action</td>


                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $query = '';
                            if(isset($_GET["searchById"]))
                            {
                                $enroll = $_GET["enroll"];
                                $query = "select * from table_user_edupay where enroll_id like '$enroll%' order by name ASC";
                            }
                            elseif (isset($_GET["searchByName"]))
                            {
                                $enroll = $_GET["name"];

                                $query = "select * from table_user_edupay where name LIKE '$name%' order by name ASC";
                            }
                            else if(isset($_GET["alltxn"])) {
                                $query = "select * from table_user_edupay where status = 'pending' order by name ASC  ";


                            } else {
                                $query = "select * from table_user_edupay  order by name ASC";
                            }
                            $result = mysqli_query($link,$query);
                            if(mysqli_num_rows($result) == 0)
                            {
                                echo "<span style='color: Red;font-size: 28px'>No Results Found</span>";

                            }
                            else {


                                while ($rowFetched = mysqli_fetch_assoc($result)) {

                                    if ($rowFetched["status"] == 'pending') {

                                        echo "<tr style='background-color: rosybrown;' class='text-capitalize text-white'>";
                                    } else {
                                        echo "<tr style='background-color: #87c4c8;' class='text-capitalize text-white'>";
                                    }

                                        ?>
                                            <td><?php echo $rowFetched['name']; ?></td>
                                            <td class="text-uppercase"><?php echo $rowFetched['reg_num']; ?></td>
                                            <td><?php echo $rowFetched['enroll_id']; ?></td>
                                            <td><?php echo $rowFetched['semester']; ?></td>
                                            <td><?php echo $rowFetched['status']; ?></td>
                                            <td><?php echo $rowFetched['date_of_joining']; ?></td>
                                            <td><?php echo $rowFetched['last_login']; ?></td>


                                            <td>
                                                <div class="row">
                                                    <?php
                                                     if ($rowFetched["status"] == 'pending') {
                                                         ?>
                                                         <div class="col-lg-6">
                                                             <form action="approve.php" id="del">
                                                                 <input type="hidden"
                                                                        value="<?php echo $rowFetched["u_id"]; ?>"
                                                                        name="hidden_btn">
                                                                 <button type="submit" value="submit" class="btn btn-block p-0 m-0 btn-success" onclick="return confirm('Do You Want To Approve The Selected User <?php echo $rowFetched["name"] ?>?')" name="approve">
                                                                     &#x2713;
                                                                 </button>
                                                             </form>
                                                         </div>
                                                         <div class="col-lg-6">
                                                             <form action="delete.php">
                                                                 <input type="hidden"
                                                                        value="<?php echo $rowFetched["u_id"]; ?>"
                                                                        name="hidden_btn">
                                                                 <button type="submit" value="submit" class="btn btn-block p-0 m-0 btn-danger" onclick="return confirm('Do You Want To Delete The Selected User <?php echo $rowFetched["name"] ?>?')" name="delete">
                                                                     &#x2717;
                                                                 </button>
                                                             </form>
                                                         </div>

                                                         <?php
                                                     } else {
                                                         ?>
                                                         <div class="row p-1">
                                                             <div class="col-sm-6">
                                                                 <form action="editStudent.php">
                                                                     <input type="hidden"
                                                                            value="<?php echo $rowFetched["u_id"]; ?>"
                                                                            name="hidden_btn">
                                                                     <button type="submit" value="submit" class="btn btn-block p-0" name="student_edit" style="background: #94C2C7;margin-left: 10px">
                                                                         <img src="images/edit.png" alt="" width="15px" height="15px">
                                                                     </button>
                                                                 </form>
                                                             </div>
                                                             <div class="col-sm-6">
                                                                 <form action="delete.php">
                                                                     <input type="hidden"
                                                                            value="<?php echo $rowFetched["u_id"]; ?>"
                                                                            name="hidden_btn">
                                                                     <button type="submit" value="submit" class="btn btn-block p-0  btn-danger" onclick="return confirm('Do You Want To Delete The Selected User <?php echo $rowFetched["name"] ?>?')" name="delete">
                                                                         &#x2717;
                                                                     </button>
                                                                 </form>
                                                             </div>

                                                         </div>
                                                     <?php }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php

                                    } ?>


                                    <?php
                                } ?>





                            </tbody>

                        </table>



                    </div>

                </div>

            </div>
        </div>
    </div>



<!--    including footer-->

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
     <script type="text/javascript">
   
        function validation()
            {
                var enroll = document.forms["sdform"]["enroll"].value;
               
               
                 if( enroll== "")
                
                {
                    alert("**please enter valid enroll_id");
                    return false;
                }
           
                

                if((enroll.length <= 2) || (enroll.length > 20))
                {
                    alert(" **please enter atleast 3 characters of enroll_id");
                    return false;
                }
                
            }
            function validation_name()
            {
                 var name = document.forms["studform"]["name"].value;
                 
                if( name== "")
                {
                    alert(" **plese enter name");
                    return false;
                }
           
                if((name.length <= 2) || (name.length > 20))
                {
                    alert(" **please enter atleast 3 characters of name");
                    return false;
                }
                if(!isNaN(name))
                {
                    alert(" **please enter valid name ");
                    return false;
                }
            }
    </script>

</body>
</html>