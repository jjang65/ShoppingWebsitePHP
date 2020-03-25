<?php require_once("../../resources/config.php"); ?>
<?php include(TEMPLATE_BACK . DS . "header.php"); ?>

<?php 

// Check if user is logged in
if(!isset($_SESSION['username'])){
    header("Location: ./../index.php");
}

// Check if user is valid admin
if(isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    $query = "SELECT * FROM users WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $row = $statement->fetch();

    if($row['role'] !== 'admin') {
        header("Location: ./../index.php");
    }
}

// For Toast Message
if(isset($_SESSION['message'])) {
    echo '<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>';
    echo '<link href="../node_modules/toastr/build/toastr.css" rel="stylesheet"/>';
    echo '<script src="../node_modules/toastr/toastr.js"></script>';
    echo '<script type="text/javascript">', 'let message =', json_encode($_SESSION['message']), ';', '</script>';
    echo '<script type="text/javascript">', 'toastr.options.closeButton = true;', 'toastr.info(message);','</script>';
    unset($_SESSION['message']);
}

 ?>

        <div id="page-wrapper">

            <div class="container-fluid">

            <?php

                if(($_SERVER['REQUEST_URI'] == "/ecommerce/public_html/admin/") || ($_SERVER['REQUEST_URI'] == "/ecommerce/public_html/admin/index.php")){
                    include(TEMPLATE_BACK . DS . "dashboard.php"); 
                }

                if(isset($_GET['orders'])){
                    include(TEMPLATE_BACK . DS . "orders.php");
                }

                if(isset($_GET['reports'])){
                    include(TEMPLATE_BACK . DS . "reports.php");
                }

                if(isset($_GET['products'])){
                    include(TEMPLATE_BACK . DS . "products.php");
                }

                if(isset($_GET['add_product'])){
                    include(TEMPLATE_BACK . DS . "add_product.php");
                }

                if(isset($_GET['edit_product'])){
                    include(TEMPLATE_BACK . DS . "edit_product.php");
                }            

                if(isset($_GET['categories'])){
                    include(TEMPLATE_BACK . DS . "categories.php");
                }

                if(isset($_GET['edit_category'])){
                    include(TEMPLATE_BACK . DS . "edit_category.php");
                }

                if(isset($_GET['users'])){
                    include(TEMPLATE_BACK . DS . "users.php");
                }

                if(isset($_GET['add_user'])){
                    include(TEMPLATE_BACK . DS . "add_user.php");
                }

                if(isset($_GET['edit_user'])){
                    include(TEMPLATE_BACK . DS . "edit_user.php");
                }

                if(isset($_GET['delete_order_id'])){
                    include(TEMPLATE_BACK . DS . "delete_order.php");
                }

                if(isset($_GET['delete_report_id'])){
                    include(TEMPLATE_BACK . DS . "delete_report.php");
                }

                if(isset($_GET['delete_product_id'])){
                    include(TEMPLATE_BACK . DS . "delete_product.php");
                }

                if(isset($_GET['delete_category_id'])){
                    include(TEMPLATE_BACK . DS . "delete_category.php");
                }

                if(isset($_GET['delete_user_id'])){
                    include(TEMPLATE_BACK . DS . "delete_user.php");
                }

                if(isset($_GET['subscriptions'])){
                    include(TEMPLATE_BACK . DS . "subscriptions.php");
                }

                if(isset($_GET['edit_subscription'])){
                    include(TEMPLATE_BACK . DS . "edit_subscription.php");
                }

                if(isset($_GET['delete_subscription_id'])){
                    include(TEMPLATE_BACK . DS . "delete_subscription.php");
                }

                if(isset($_GET['delete_image_id'])){
                    include(TEMPLATE_BACK . DS . "delete_image.php");
                }

                if(isset($_GET['send_email'])){
                    include(TEMPLATE_BACK . DS . "send_email.php");
                }

            ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    
<!-- get footer.php in resources/back folder-->
<?php include(TEMPLATE_BACK . DS . "footer.php"); ?>