<?php
if(isset($_COOKIE["auth_user"]))
{
    $_SESSION["auth_user"] = $_COOKIE["auth_user"];
}
if(!isset($_SESSION["auth_user"]))
{
    header("location:index.php");

}
$session= $_SESSION["auth_user"];
$result = mysqli_query($link, "select u_id,name,course,gender,last_login,profile_pic,semester,enroll_id,reg_num,email from table_user_edupay where u_id = $session");

$rowFetched = mysqli_fetch_assoc($result);
?>

<div class="col-md-2 sidebar" style="border-right: 1px solid grey; ">
    <nav class="sidebar-nav">
        <div class="sidebar-header">
            <button class="nav-toggler nav-toggler-md sidebar-toggler" type="button" data-toggle="collapse" data-target="#nav-toggleable-md">
                <span class="sr-only">Toggle nav</span>
            </button>
            <img src="include/images/logo.jpg" alt="" width="50px">

        </div>
        <hr style="margin-top: -10px">
        <div style="width: 100%;height: 150px;">
            <img src="<?php echo $rowFetched["profile_pic"] ?>" alt="Image Failed" width="100px" height="100px" style="border-radius: 50%;margin-left: 50px">
            <form action="file_upload.php" method="post" enctype="multipart/form-data">
                <div class="form-group" style="width:40px;height: 30px;background-image: url(camera.png);background-size:40px 30px;margin-top: -60px;position:absolute;margin-left: 80px;">
                    <input type="file" onchange="submit()" name="file_upload" class="form-control-file mt-1" style="color: white;width: 40px;height: 30px;opacity: 0;">
                </div>


            </form>
        </div>

        <hr class="mb-5" style="margin-top: -10px">


        <div class="collapse nav-toggleable-md" id="nav-toggleable-md">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="student_dashboard.php" class="nav-link text-white"> Home</a>
                </li>
                <li class="nav-item">
                    <a href="libraryDetails.php" class="nav-link text-white">Library Details</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link  dropdown-toggle text-white" data-toggle="dropdown">Details</a>
                    <div class="dropdown-menu w-100">
                        <form action="txn_details.php">
                            <button class="dropdown-item">Transaction</button>
                        </form>
                        <form action="canteen.php">
                            <button class="dropdown-item">Canteen</button>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link  dropdown-toggle text-white" data-toggle="dropdown">Transport</a>
                    <div class="dropdown-menu w-100">
                        <form action="transport.php">
                            <?php
                            $result = mysqli_query($link,"select u_id from table_transport_allot where u_id=$session");
                            if (mysqli_num_rows($result) == 0) {
                                ?>
                                <button class="dropdown-item" type="submit" value="submit" name="apply">
                                    Apply For Transport
                                </button>
                        <form action="">
                            <button class="dropdown-item" type="submit" value="submit" name="details" disabled>
                                Get details
                            </button>
                        </form>

                        <?php
                    }else {

                        ?>
                        <form action="">
                            <button class="dropdown-item" type="submit" value="submit" name="details">
                                Get details
                            </button>
                        </form>
                        <?php
                    }

                    ?>

                    </div>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white">Notifications</a>
                </li><li class="nav-item">
                    <a href="#" class="nav-link text-white">Library Details</a>
                </li>
               </ul>
         </div>
    </nav>
</div>