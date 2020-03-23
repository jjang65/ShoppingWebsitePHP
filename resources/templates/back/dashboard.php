<?php require_once("../../resources/config.php"); ?>
<?php 

    $query_orders = "SELECT * FROM orders WHERE date_created BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW()";
    $statement_orders = $db->prepare($query_orders);
    $statement_orders->execute();
    $statement_orders->rowCount();

    $query_products = "SELECT * FROM products LIMIT 20";
    $statement_products = $db->prepare($query_products);
    $statement_products->execute();

    $query_categories = "SELECT * FROM categories LIMIT 20";
    $statement_categories = $db->prepare($query_categories);
    $statement_categories->execute();

    // get total number of rows in orders table
    $query_all_orders = "SELECT * FROM orders";
    $statement_all_orders = $db->prepare($query_all_orders);
    $statement_all_orders->execute();
    $row_cnt = $statement_all_orders->rowCount();

    // get starting row to be shown
    $showrows = 8;
    if($row_cnt < 8){
        $showrows = $row_cnt;
        $startrow = $row_cnt - $showrows;
    }else{
        $startrow = $row_cnt - $showrows;
    }

    // get query that selects oders from 8 latest orders
    $query_latest_orders = "SELECT * FROM orders LIMIT $startrow, $showrows ";
    $statement_latest_orders = $db->prepare($query_latest_orders);
    $statement_latest_orders->execute();
    $quotes = $statement_latest_orders->fetchAll();

    // get latest enrolled users
    $query_users = "SELECT * FROM users LIMIT 8";
    $statement_users = $db->prepare($query_users);
    $statement_users->execute();
    $users_quotes = $statement_users->fetchAll();

 ?>

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
                            
                            <?= $statement_orders->rowCount() ?>

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

                            <?= $statement_products->rowCount(); ?>

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

                            <?= $statement_categories->rowCount() ?>

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
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Orders Panel</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Amount (CAD)</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Order Time</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($quotes as $quote): ?>
                                <tr>
                                    <td><?= $quote['id'] ?></td>
                                    <td>&#36;<?= $quote['amount'] ?></td>
                                    <td><?= $quote['firstname'] ?></td>
                                    <td><?= $quote['lastname'] ?></td>
                                    <td><?= $quote['date_created'] ?></td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="index.php?orders">View All Orders <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>


     <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user fa-fw"></i> User Register Panel</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Register Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>3326</td>
                                <td>10/21/2013</td>
                                <td>3:29 PM</td>
                            </tr> -->

                            <?php foreach($users_quotes as $users_quote): ?> 
                                <tr>
                                    <td><?= $users_quote['id'] ?></td>
                                    <td><?= $users_quote['email'] ?></td>
                                    <td><?= substr($users_quote['time_created'], 0, 10) ?></td>
                                </tr>
                            <?php endforeach ?>

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