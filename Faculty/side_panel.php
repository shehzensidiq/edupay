<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 17/08/18
 * Time: 10:27 PM
 */
$session = $_SESSION["auth_user"];
?>
<div class="col-sm-3 sidebar" style="border-right: 1px solid grey;">
    <nav class="sidebar-nav">
        <div class="sidebar-header">
            <button class="nav-toggler nav-toggler-md sidebar-toggler" type="button" data-toggle="collapse" data-target="#nav-toggleable-md">
                <span class="sr-only">Toggle nav</span>
            </button>
            <a class="sidebar-brand img-responsive" href="transport_dashboard.php">
                <!--              <span class="icon icon-leaf sidebar-brand-icon"></span>-->
                <img src="../default.png" alt="" class="img img-fluid rounded">
            </a>
        </div>

        <div class="collapse nav-toggleable-md" id="nav-toggleable-md">
            <!--            <form class="sidebar-form">-->
            <!--              <input class="form-control" type="text" placeholder="Search...">-->
            <!--              <button type="submit" class="btn-link">-->
            <!--                <span class="icon icon-magnifying-glass"></span>-->
            <!--              </button>-->
            <!--            </form>-->

            <div style="width: 100%;height: 250px;">
                <img src="../admin/admin/docs/images/logo.png" width="100%" height="100%" alt="">
            </div>
            <ul class="nav nav-pills nav-stacked flex-column ">
                <li class="nav-item active bg-primary" style="border-radius: 5px">
                    <a href="transport_dashboard.php" class="nav-link">
                        Home
                        <i class="fa fa-car" aria-hidden="true"></i>

                    </a>
                </li>
                <li class="nav-item">
                    <a href="add_vehicle.php" class="nav-link">
                        Add vehicle
                        <i class="fa fa-car" aria-hidden="true"></i>

                    </a>
                </li>
                <li class="nav-item dropdown">
                    <?php
$result = mysqli_query($link, "select count(*) as total from table_transport_allot where statusOfBus = 'pending'");
$rowFetched = mysqli_fetch_assoc($result);
$total = $rowFetched["total"];

?>
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Users</a>
                    <div class="dropdown-menu">
                        <form action="transport_user.php">
                            <button  name="pending_requests" class="dropdown-item">
                                Pending Requests
                                <span class="badge badge-danger" style="font-size: 10px;">
                            <?php
echo $total;

?>
                        </span>
                            </button>
                            <button class="dropdown-item" name="approved_btn">
                                Approved users
                            </button>
                            <button class="dropdown-item" name="all_btn">
                                All Users
                            </button>
                        </form>

                    </div>
                </li>

            </ul>
            <hr class="visible-xs mt-3">
        </div>
    </nav>
</div>
