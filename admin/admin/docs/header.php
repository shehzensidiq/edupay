
<?php
   //checking for sessions creation
   session_start();
    if(!(isset($_SESSION['auth_admin'])))
    {
        header("location:../../index.php");
    }
    else
    {
        $session = $_SESSION["auth_admin"];
        require("../../../include/db_config.php");
        $result = mysqli_query($link,"SELECT count(*) as number FROM table_transaction where statusoftxn = 'pending'");
        $rowFetched = mysqli_fetch_assoc($result);
        $pending = $rowFetched["number"];
    }
   ?>
    <div class="col-sm-3 sidebar" style="border-right: 1px solid grey;">
        <nav class="sidebar-nav">
          <div class="sidebar-header">
            <button class="nav-toggler nav-toggler-md sidebar-toggler" type="button" data-toggle="collapse" data-target="#nav-toggleable-md">
              <span class="sr-only">Toggle nav</span>
            </button>
            <a class="sidebar-brand img-responsive" href="admin_dashboard.php">
<!--              <span class="icon icon-leaf sidebar-brand-icon"></span>-->
                <img src="../../../default.png" alt="" class="img img-fluid rounded">
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
                  <img src="images/logo.png" width="100%" height="100%" alt="">
              </div>
            <ul class="nav nav-pills nav-stacked flex-column ">
	            <li class="nav-item mt-2">
                   <a href="admin_dashboard.php" class="nav-link text-white active "><span class="icon icon-home"></span> Home</a>
               </li>
              <li class="nav-item dropdown mt-2">
                   <a href="#" class="nav-link dropdown-toggle text-white  mt-2" data-toggle="dropdown"><span class="icon icon-add-user"></span> &nbsp;Add Operator</a>
                   <div class="dropdown-menu w-100">
                       <form action="add_admin.php">
                           <input type="submit" name="add_admin" value="For Administration" class="dropdown-item">
                       </form>
                       <form action="canteen.php">
                           <input type="submit" value="For Canteen" name="add_canteen_btn" class="dropdown-item">
                       </form>
                   </div>
               </li>
               <li class="nav-item dropdown mt-2">
                   <a href="#" class="nav-link dropdown-toggle text-white" data-toggle="dropdown"> <span class="icon icon-ruler"></span> &nbsp;Transactions</a>
                   <div class="dropdown-menu w-100">
                       <form action="txn_process.php">
                           <button class="dropdown-item" type="submit" value="submit" name="pending">
                               Pending <span class="badge badge-danger text-white"><?php echo $pending . " Pending"; ?></span>
                           </button>
                       </form>
                       <form action="txn_process.php">
                           <input type="submit" value="Confirmed" name="confirmed" class="dropdown-item">
                       </form>
                       <form action="txn_process.php">
                           <input type="submit" value="View All Transactions"name="allTxnBtn" class="dropdown-item">
                       </form>
                   </div>
               </li>
               <li class="nav-item dropdown mt-2">
                   <a href="" class="nav-link dropdown-toggle text-white" data-toggle="dropdown"><span class="icon icon-info"></span> &nbsp;Details</a>
                   <div class="dropdown-menu w-100">
                       <a href="student-details.php" class="dropdown-item">Student Details
                           <?php
                            $result = mysqli_query($link, "SELECT count(*) as number FROM table_user_edupay where status = 'pending'");
                            $rowFetched = mysqli_fetch_assoc($result);
                            $pending = $rowFetched["number"];
                            ?>
                           <span class="badge badge-danger text-white"><?php echo $pending . " Pending"; ?></span>
                       </a>
                       <a href="#" class="dropdown-item ">Library Details</a>
                       <a href="transport_user.php" class="dropdown-item ">Transport Details</a>
                   </div>
               </li>
               <li class="nav-item mt-2">
                   <a href="ledger.php" class="nav-link text-white "><span class="icon icon-book"></span> &nbsp;Ledger</a>
               </li>

               <li class="nav-item mt-2">
                   <a href="withdraw.php" class="nav-link text-white"><span class="icon">&#36;</span> &nbsp;Withdraw</a>
               </li>
               </li>

               <li class="nav-item mt-2">
                   <a href="populate_acc.php" class="nav-link  text-white"> <span class="icon">&#36;</span> &nbsp; Populate Account</a>
               </li>
               <li class="nav-item mt-2">
                   <a href="#" class="nav-link text-white "> <span class="icon icon-eye"></span> &nbsp;View Particular Account</a>
               </li>

            </ul>
            <hr class="visible-xs mt-3">
          </div>
        </nav>
      </div>