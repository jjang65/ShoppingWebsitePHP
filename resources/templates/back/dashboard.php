<?php require_once("../../resources/config.php"); ?>

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard <small>Statistics Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->





 <!-- FIRST ROW WITH PANELS -->

<!-- /.row -->
<div class="row">

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            
                            <?php 

                            $query = query("SELECT * FROM orders");

                            confirm($query);

                            $row_cnt = mysqli_num_rows($query);
                            echo $row_cnt;


                             ?>

                        </div>
                        <div>New Orders!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?orders">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            <?php 

                            $query = query("SELECT * FROM products");

                            confirm($query);

                            $row_cnt = mysqli_num_rows($query);
                            echo $row_cnt;


                             ?>
                        </div>
                        <div>Products!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?products">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            
                            <?php 

                            $query = query("SELECT * FROM categories");

                            confirm($query);

                            $row_cnt = mysqli_num_rows($query);
                            echo $row_cnt;


                             ?>

                        </div>
                        <div>Categories!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?categories">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


</div>

<!-- /.row -->


<!-- SECOND ROW WITH TABLES-->

<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Order Date</th>
                                <th>Order Time</th>
                                <th>Amount (CAD)</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php show_transaction_in_dashboard(); ?>

                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="index.php?orders">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>


     <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> User Register Panel</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>User No.</th>
                                <th>Username</th>
                                <th>Register Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>3326</td>
                                <td>10/21/2013</td>
                                <td>3:29 PM</td>
                            </tr> -->
                            <?php 
                                show_users_in_dashboard();
                             ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="index.php?users">View All Users <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div>
                    
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.row -->