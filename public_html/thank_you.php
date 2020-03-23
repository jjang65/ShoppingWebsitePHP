<?php require_once("../resources/config.php"); ?>

<?php require_once("resources/cart_functions.php"); ?>

<?php 

    // if we can get transaction Identifier('tx'),
    if(isset($_GET['tx'])){
        $email = $_SESSION['username'];
        $amount = filter_input(INPUT_GET, 'amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $transfer_fee = $_SESSION['transfer_fee'];
        $currency = filter_input(INPUT_GET, 'cc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $transaction = filter_input(INPUT_GET, 'tx', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $status = filter_input(INPUT_GET, 'st', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(isset($_SESSION['firstname'])){

            // Insert data into Database in orders table
            $query = "INSERT INTO orders (email, amount, transfer_fee, currency, transaction, status, firstname, lastname, address, address2, towncity, province, postal, phone) 
                            VALUES (:email, :amount, :transfer_fee, :currency, :transaction, :status, :firstname, :lastname, :address, :address2, :towncity, :province, :postal, :phone)";
            $statement = $db->prepare($query);
            $bind_values = ['email' => $email, 'amount' => $amount, 'transfer_fee' => $transfer_fee, 'currency' => $currency, 'transaction' => $transaction, 'status' => $status, 'firstname' => $_SESSION['firstname'], 'lastname' => $_SESSION['lastname'], 'address' => $_SESSION['address'], 'address2' => $_SESSION['address2'], 'towncity' => $_SESSION['towncity'], 'province' => $_SESSION['province'], 'postal' => $_SESSION['postal'], 'phone' => $_SESSION['phone']];
            $statement->execute($bind_values);

        }else{
            session_destroy();
            set_message("Something wrong. Sign in again.");
            header("Location: index.php");
        }

        // reset total and item_quantity 
        $total = 0;
        $item_quantity = 0;

        

    } else {
        // if there is no transaction data, send the user to index.php
        session_destroy();
        set_message("Something wrong. Sign in again.");
        redirect("index.php");
    }

 ?>

<link rel="stylesheet" type="text/css" href="css/mysytles.css">

<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
		
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">My Order</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Order</span></p>
          </div>
        </div>
      </div>
    </div>
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="business" value="sb-f7ygs09627@business.example.com">
	<input type="hidden" name="currency_code" value="CAD">
		<section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">

    				<div class="cart-list">
	    				<table class="table">
	    					
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>Image</th>
						        <th>Product</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>

        <?php foreach ($_SESSION as $key => $value): ?> 

            <?php if($value > 0): ?>

                <?php if(substr($key, 0, 8) == "product_"): ?> 

                    <?php  
                        $length = strlen($key) - 8;
                        $id = substr($key, 8, $length);
                        $query = "SELECT * FROM products WHERE id = :id";
                        $statement = $db->prepare($query);
                        $statement->bindValue(':id', $id, PDO::PARAM_INT);
                        $statement->execute();
                        $rows = $statement->fetchAll();
                    ?>

                    <?php foreach($rows as $row): ?>

                        <?php 

                            // last_id == order_id which can be matched with oder_id in orders table
                            $queryForOrderId = "SELECT * FROM orders WHERE id = (SELECT MAX(id) FROM orders)";

                            $statement = $db->prepare($queryForOrderId);
                            $statement->execute();
                            $order_row = $statement->fetch();
                            $last_order_id = $order_row['id'];

                            $sub = $row['price'] * $value;
                            $item_quantity += $value;
                            $product_price = $row['price'];
                            $insert_query = "INSERT INTO reports (order_id, product_id, product_quantity, product_price) 
                                                VALUES (:last_order_id, :id, :value, :product_price)";
                            $statement = $db->prepare($insert_query);
                            $statement->bindValue(':last_order_id', $last_order_id, PDO::PARAM_INT);
                            $statement->bindValue(':id', $id, PDO::PARAM_INT);
                            $statement->bindValue(':value', $value, PDO::PARAM_INT);
                            $statement->bindValue(':product_price', $product_price, PDO::PARAM_STR);
                            $statement->execute();

                         ?>
                        
                        <tr class="text-center">
                            <td class="image-prod"><img width="100" src="resources/uploads/<?= $row['image'] ?>" alt="image"/></td>
                            <td class="product-name">
                                <h3><?= $row['title'] ?></h3>
                                <p><?= $row['short_description'] ?></p>
                            </td>
                            <td class="price">&#36;<?= $row['price'] ?></td>
                            <td class="quantity">
                                <div class="input-group mb-3">
                                    <input type="text" name="quantity" class="quantity form-control input-number" value="<?= $value ?>" min="1" max="100">
                                </div>
                            </td>
                            <td class="total">&#36;<?= $sub ?></td>
                        </tr>

                    <?php endforeach ?>

                    <?php $total += $sub; ?>

                <?php endif ?>

            <?php endif ?>

        <?php endforeach ?>
        
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-end">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Order Totals</h3>
    					<p class="d-flex">
    						<span>Items</span>
    						<span>
    							<?= isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = 0; ?>
    						</span>
    					</p>
    					<p class="d-flex">
    						<span>Delivery</span>
                            <?php if($_SESSION['transfer_fee'] === 0): ?>
    						    <span>Free Shipping</span>
                            <?php else: ?>
                                <span>&#36;<?= $_SESSION['transfer_fee'] ?></span>
                            <?php endif ?>
    					</p>
    					<!-- <p class="d-flex">
    						<span>Discount</span>
    						<span>$3.00</span>
    					</p> -->
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span id="totalAmount">&#36;
    							<?= isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = 0; ?>

                                <!-- After a transaction, destroy all sessions and assign user session again. -->
                                <?php $username = $_SESSION['username']; ?>
                                <?php session_destroy(); ?>
                                <?php $_SESSION['username'] = $username; ?>

    						</span>
    					</p>
    				</div>
    				
    			</div>
    		</div>
			</div>
		</section>
	</form>
    
<!-- Footer Section -->	
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
