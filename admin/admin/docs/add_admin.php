<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 10/06/18
 * Time: 8:50 PM
 */

//admin shehxen
//pass admin_admin
//admin_email admin@gmail.com
$key="sheh_wase-nyla_yasm-";
include("../../../include/db_config.php");


$nameEdit = "";
$emailEdit = "";
$dobEdit = "";
$passwordEdit = "";
$typeFor = "";

if (isset($_GET["edit_admin"])){
    $id = $_GET["hidden_edit_btn"];
    $result = mysqli_query($link,"select * from table_admin_faculty where ad_id = $id");
    $rowFetched = mysqli_fetch_assoc($result);
    $nameEdit = $rowFetched["ad_name"];
    $emailEdit = openssl_decrypt($rowFetched["ad_email"],'AES-256-ECB',$key,'0','');

    $dobEdit = $rowFetched["dob"];
    $typeFor = $rowFetched["admin_for"];
    $passwordEdit = openssl_decrypt($rowFetched["ad_password"],'AES-256-ECB',$key,'0','');




}
?>
<?php

    if (isset($_POST["add_admin_btn"])){
//        $method = 'AES-256-ECB';
        $name = $_POST["name"];
        $type = $_POST["admin_type"];
        $dob = $_POST["dob"];
        $email = openssl_encrypt($_POST["email"],'AES-256-ECB',$key,'0','');
        $password = openssl_encrypt($_POST["password"],'AES-256-ECB',$key,'0','');
       $result = mysqli_query($link,"select ad_name,ad_email,admin_for from table_admin_faculty where (ad_email = '$email' or ad_name = '$name') and admin_for = '$type'");
        if(!(mysqli_num_rows($result) > 0)) {
            
                    if($type != 'none') {
                        if ($type == 'admin') {
                            mysqli_query($link,"INSERT INTO table_admin_edupay(admin_name,email,password,dob) VALUES ('$name','$email','$password','$dob')");
                            echo "<script>alert('Admin Added Successfully!!!');</script>";
                        } elseif ($type == 'transport' or $type == 'library') {
                            mysqli_query($link,"INSERT INTO table_admin_faculty(ad_name,ad_email,ad_password,admin_for,dob) VALUES ('$name','$email','$password','$type','$dob')");
                            if ($type == 'library') {
                                echo "<script>alert('Library Admin Added Successfully!!!');</script>";
                            } else{
                                echo "<script>alert('Transport Admin Added Successfully!!!');</script>";
                            }
                        }
                    } else{
                        echo "<script>alert('No Admin Type selected!!!');</script>";
                    }
            
        }else {
            echo "<script>alert('Admin Already authorized');</script>";
        }
    }


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
            text-transform: capitalize;

        }
        button{
            cursor: pointer;
        }
        .form-control{
            text-transform: capitalize;
        }
        .password{
            text-transform: none;
        }
        .button:hover{
            background-color:#337396 ;
        }
        #spanemail {
            color: orange;
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
        if (isset($_GET["edit_admin"])){
            ?>
        <a href="add_admin.php" class="btn text-white button"><span class="icon icon-back"></span>Back</a>

<?php        }
        ?>

        <div class="row">
            <div class="col-sm-5 ">
                <div class="card mt-lg-4 mt-2" style="background-color:#25282F; border:1px solid grey;">
                    <div class="card-header" style="background-color:#25282F;border-bottom:1px solid grey;">
                        <?php
                        if (isset($_GET["edit_admin"])){
                            echo "<h4 class='text-center text-white'>Edit Details</h4>";


                        } else {
                            echo "<h4 class='text-center text-white'>Add Admin</h4>";

                        }
                        ?>

                    </div>
                    <div class="card-body p-1">
                        <?php
                        if(isset($_GET["edit_admin"])){
                            echo "<form method='post' action='../../../include/update.php'>";
                        } else {
                            echo "<form method='post'>";

                        }
                        ?>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" value="<?php echo $nameEdit ?>" name="name" placeholder="Jane Doe" required maxlength="20" minlength="5" id="name" onfocus="nameValidate() " onblur="nameValidate()">
                                        <sup id="errorMessageName"></sup>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        <input type="email" class="form-control password" value="<?php echo $emailEdit ?>" name="email" placeholder="example@example.com" id="email" onfocus="return emailValidate()" onblur="return emailValidate()">
                                         <sup id="spanemail"></sup>
                                    </div>
                                </div>
                            </div>


                            <!--                     password -->
                            <?php
                            if (isset($_GET["edit_admin"])) {

                                ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" class="form-control password" value="<?php echo $passwordEdit ?>"
                                                   id="password" name="password" placeholder="*********"
                                                   maxlength="20" minlength="8" id="password" onfocus="return passwordValidate()" onblur="return passwordValidate()">
                                                     <sup id="spanpassword"></sup>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control password" value="<?php echo $passwordEdit ?>"
                                                   id="password" name="password" placeholder="*********"
                                                   maxlength="20" minlength="8" id="password" onfocus=" return passwordValidate()" onblur="return passwordValidate()">
                                                   <sup id="spanpassword"></sup>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="confirm_password"> Confirm Password</label>
                                            <input type="password" class="form-control password" id="txtcpswd"
                                                   name="confirm_password" placeholder="*********" required
                                                   maxlength="20" minlength="8" id="cpassword" onfocus="return cpasswordValidate()" onblur="return cpasswordValidate()">
                                                    <sup id="errorMessageCPass"></sup>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                            ?>


                            <!--					third row-->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="dob">D-O-B</label>
                                        <input type="date" class="form-control" value="<?php echo $dobEdit ?>" name="dob" placeholder="dd/mm/yyyy" max="2015-12-31" id="dob">
                                        <sup id="errorMessageDob"></sup>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="admin">Admin For:-</label>
                                        <select name="admin_type" id="selection" class="form-control" onfocus="return selectValidation()" onblur="return selectValidation()">

                                     <option value="none">select</option>
                                                <option value="library">Library</option>
                                                <option value="transport">Transport</option>
<!--                                   <option value="admin">Self</option>-->
                                        </select>
                                        <sup id="errorMessage"></sup>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (isset($_GET["edit_admin"])){

                                ?>
                                <input type="hidden" name="hidden_edit_btn" value="<?php echo $id;  ?>">

                                <input type="submit"  name="update_admin_btn" value="Update Fields" class="btn btn-success btn-block mb-2">

                           <?php } else {
                                ?>
                                <input type="submit" onclick="return validatePswd()" name="add_admin_btn" value="Add Entered Admin" class="btn btn-success btn-block mb-2">

                            <?php }
                            ?>

                        </form>
                        <script>
                            function validatePswd()
                            {
                                p=document.getElementById('password').value;
                                pc=document.getElementById('txtcpswd').value;
                                if(p!=pc)
                                {
                                    alert("Password Doesnot Match..!!");
                                    return false;
                                }

                            }
                        </script>
                    </div>
                </div>
            </div>
                <div class="col-sm-7">
                    <h4>Details</h4>
                    <table class="table table-responsive-sm table-sm table-hover mt-5 table-bordered">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Admin Name</th>
                            <th>Admin Email</th>
                            <th>For</th>
                            <th>Last Login</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = mysqli_query($link,"select * from table_admin_faculty");
                        while($rowFetched = mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td><?php echo $rowFetched["ad_id"];    ?></td>
                                <td><?php echo $rowFetched["ad_name"];    ?></td>
                                <td><?php echo openssl_decrypt($rowFetched["ad_email"],'AES-256-ECB',$key,'0','');    ?></td>
                                <td><?php echo $rowFetched["admin_for"];    ?></td>
                                <td><?php echo $rowFetched["last_login"];    ?></td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <form action="">
                                                <input type="hidden" name="hidden_edit_btn" value="<?php echo $rowFetched["ad_id"];  ?>">
                                                <button class="btn btn-block p-0"  name="edit_admin" style="background-color:#25282F;">
                                                    <img src="images/edit.png" alt="" width="15px" height="15px">

                                                </button>
                                            </form>


                                        </div>
                                        <div class="col-sm-6">
                                            <form action="delete.php">
                                                <input type="hidden" name="hidden_btn" value="<?php echo $rowFetched["ad_id"];  ?>">
                                                <button class="btn btn-danger btn-block p-0" onclick="return confirm('Do You Want To Delete This User <?php echo $rowFetched["ad_name"] ?>')" name="delete_admin">
                                                    &#x2717;
                                                </button>
                                            </form>
                                        </div>
                                    </div></div>

                                </td>
                            </tr>
                        <?php }



                        ?>
                        </tbody>
                    </table>
                </div>
        </div>
</div>

<!--form to add admin-->


<!--footer-->

    <hr class="mt-5">



    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/tether.min.js"></script>
    <script src="assets/js/chart.js"></script>
    <script src="assets/js/tablesorter.min.js"></script>
    <script src="assets/js/toolkit.js"></script>
    <script src="assets/js/application.js"></script>
    <script  type="text/javascript" src="../../../include/edupay.js">
        // execute/clear BS loaders for docs
        $(function(){while(window.BS&&window.BS.loader&&window.BS.loader.length){(window.BS.loader.pop())()}})
    </script>
</body>
</html>

