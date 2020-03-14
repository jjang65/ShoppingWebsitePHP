<?php 
require_once("../resources/config.php"); 
require_once("resources/cart_functions.php"); 

$total = 0;
$item_quantity = 0;

    if(isset($_GET['id']) && isset($_GET['quantity'])){
        debug_to_console("if is called");
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $quantity = filter_input(INPUT_GET, 'quantity', FILTER_SANITIZE_NUMBER_INT);

        $query = "SELECT * FROM products WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $quotes = $statement->fetchAll();

        foreach($quotes as $quote) {
            debug_to_console("product_in_stock-> " . $quote['in_stock']);
            debug_to_console("quantity-> " . $quantity);
            // if product_quantity is less than the quantity required by customer
            if($quote['in_stock'] > $quantity){
                debug_to_console("if in_stock > quantity is called");
                $_SESSION['product_' . $id] = $quantity;
            }else{
                debug_to_console("else is called");
                set_message("Sorry, We only have " . $quote['in_stock'] . " " . "{$quote['title']}" . " Available");
            }
        }
    }

    // in cart() function, if 'delete' button is clicked, below if statement will be operated
    if(isset($_GET['delete'])){
        $delete = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['product_' . $delete] = '0';

        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);

        header("Location:cart.php");
    }

    // if 'add to cart' button is clicked, below if statement will be operated
    if(isset($_GET['add'])){
        $add = filter_input(INPUT_GET, 'add', FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM products WHERE id = :add";
        $statement = $db->prepare($query);
        $statement->bindValue(':add', $add, PDO::PARAM_INT);
        $statement->execute();
        $quotes = $statement->fetchAll();

        foreach($quotes as $quote){

            if($quote['in_stock'] != $_SESSION['product_' . $add]){
                $_SESSION['product_' . $add] += 1;
                header("Location:cart.php");
            }else{
                set_message("Sorry, We only have " . $quote['in_stock'] . " " . "{$quote['title']}" . " Available");
                header("Location:cart.php");
            }
        }
    }

    // if 'remove' button is clicked, below if statement will be operated
    if(isset($_GET['subtract'])){
        $subtract = filter_input(INPUT_GET, 'subtract', FILTER_SANITIZE_NUMBER_INT);
        $_SESSION['product_' . $_GET['subtract']]--;

        if($_SESSION['product_' . $subtract] < 1){
            unset($_SESSION['item_total']);
            unset($_SESSION['item_quantity']);
            header("Location:cart.php");
        }else{
            header("Location:cart.php");
        }
    }

?>



<link rel="stylesheet" type="text/css" href="css/mysytles.css">

<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
		
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">My Cart</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Cart</span></p>
          </div>
        </div>
      </div>
    </div>
	<form action="#" method="post">
		<section class="ftco-section ftco-cart">
			<div class="container">
				<div><h4 class="text-center bg-danger"><?php toast_message(); ?></h4></div>
				<div class="row">
    			<div class="col-md-12 ftco-animate">

    				<div class="cart-list">
	    				<table class="table">
	    					
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>&nbsp;</th>
						        <th>Image</th>
						        <th>Product</th>
						        <th>Price</th>
						        <th>Quantity</th>
						        <th>Total</th>
						      </tr>
						    </thead>
						    <tbody>

                                <?php foreach ($_SESSION as $name => $value): ?>
                                    <?php if($value > 0): ?>
                                        <?php if(substr($name, 0, 8) == "product_"): ?>

                                            <?php 
                                                // get length of product_id
                                                $length = strlen($name) - 8;

                                                // get pure id number from product_id ex) 11
                                                $id = substr($name, 8, $length);
                                                $id = intval($id);
                                                debug_to_console("id -> " . $id);

                                                $query = "SELECT * FROM products WHERE id = :id";
                                                $statement = $db->prepare($query);
                                                $statement->bindValue(':id', $id, PDO::PARAM_INT);
                                                $statement->execute();
                                                $quotes = $statement->fetchAll();

                                                $sub = 0;
                                            ?>
                                                

                                                <?php foreach($quotes as $quote): ?>
                                                 
                                                <?php 
                                                    $sub = $quote['price'] * $value;
                                                    $item_quantity += $value;
                                                ?>

                                                    <tr class="text-center">
                                                        <td class="product-remove mytd"><a href="cart.php?subtract=<?= $quote['id'] ?>"><span class="ion-md-remove"></span></a></td>
                                                        <td class="product-remove mytd"><a href="cart.php?add=<?= $quote['id'] ?>"><span class="ion-md-add"></span></a></td>
                                                        <td class="product-remove mytd"><a href="cart.php?delete=<?= $quote['id'] ?>"><span class="ion-md-close"></span></a></td>

                                                        <td class="image-prod"><img width="100" src="resources/uploads/<?= $quote['image'] ?>" alt="image"/></td>

                                                        <td class="product-name">
                                                            <h3><?= $quote['title'] ?></h3>
                                                            <p><?= $quote['short_description'] ?></p>
                                                        </td>
                                                        <td class="price">&#36;<?= $quote['price'] ?></td>
                                                        <td class="quantity">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="quantity" class="quantity form-control input-number" value="<?= $value ?>" min="1" max="100">
                                                            </div>
                                                        </td>
                                                        <td class="total">&#36;<?= $sub ?></td>
                                                    </tr>
                                                    <?php $total += $sub; ?>
                                                <?php endforeach ?>

                                            <?php endif ?>

                                        <?php endif ?>
                                    
                                    <?php 
                                        $_SESSION['item_total'] = $total;
                                        $_SESSION['item_quantity'] = $item_quantity; 
                                    ?>

                                <?php endforeach ?>
						      
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-end">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3>Cart Totals</h3>
    					<p class="d-flex">
    						<span>Items</span>
    						<span>
    							<?= isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";?>
    						</span>
    					</p>
    					<p class="d-flex">
    						<span>Delivery</span>
                            <?php if($_SESSION['item_total'] >= 100): ?>
    					   	    <span>Free Shipping</span>
                            <?php else: ?>
                                <span>$30</span>
                            <?php $_SESSION['item_total'] = $_SESSION['item_total'] + 30; ?>
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
    							<?= isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0"; ?>
    						</span>
    					</p>
    				</div>
    				<!-- <p class="text-center"><a id="proceed" href="checkout.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p> -->

                    <!-- Show Proceed button -->
                    <?php if(isset($_SESSION['item_quantity']) === true && $_SESSION['item_quantity'] >= 1): ?>
                        <p class="text-center"><a id="proceed" href="billing_details.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
    				<?php endif ?>
    			</div>
    		</div>
			</div>
		</section>
	</form>
    
<!-- Footer Section -->	
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

