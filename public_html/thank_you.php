<?php require_once("../resources/config.php"); ?>

<?php require_once("resources/cart_functions.php"); ?>

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

						      <?php process_transaction(); ?>
						      
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
    							<?php 
    							echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";
    							 ?>
    						</span>
    					</p>
    					<p class="d-flex">
    						<span>Delivery</span>
    						<span>Free Shipping</span>
    					</p>
    					<!-- <p class="d-flex">
    						<span>Discount</span>
    						<span>$3.00</span>
    					</p> -->
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span id="totalAmount">&#36;
    							<?php 
    							echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";
    							 ?>
    						</span>
    					</p>
    				</div>
    				
    			</div>
    		</div>
			</div>
		</section>
	</form>
    
<?php 

foreach ($_SESSION as $name => $value){
	debug_to_console($name);
	debug_to_console($value);
}

?>
    
<!-- Footer Section -->	
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>