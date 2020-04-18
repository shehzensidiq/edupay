<?php
/**
 * Created by PhpStorm.
 * User: shehxen
 * Date: 18/08/18
 * Time: 12:06 AM
 */
?>
 <div class="col-sm-3 sidebar" style="border-right: 1px solid grey;">
     <nav class="sidebar-nav">
         <div class="sidebar-header">
             <button class="nav-toggler nav-toggler-md sidebar-toggler" type="button" data-toggle="collapse" data-target="#nav-toggleable-md">
                 <span class="sr-only">Toggle nav</span>
             </button>
             <a class="sidebar-brand img-responsive" href="library_dashboard.php">
                 <!--              <span class="icon icon-leaf sidebar-brand-icon"></span>-->
                 <img src="../../default.png" alt="" class="img img-fluid rounded">
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
                 <img src="../../admin/admin/docs/images/logo.png" width="100%" height="100%" alt="">
             </div>
             <ul class="nav nav-pills nav-stacked flex-column ">
                              <li class="nav-item active">
                                  <a href="library_dashboard.php" class="nav-link text-white bg-primary">Home</a>
                              </li>
                 <li class="nav-item">
                     <a href="add_book.php" class="nav-link text-white">Add Book</a>
                 </li>
                 <li class="nav-item">
                     <a href="library_students.php" class="nav-link text-white">Issue To Students</a>
                 </li>
                 <li class="nav-item">
                     <a href="history.php" class="nav-link text-white">All Issued Books</a>
                 </li>

             </ul>
             <hr class="visible-xs mt-3">
         </div>
     </nav>
 </div>
