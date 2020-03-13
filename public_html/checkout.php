<?php 

require_once("../resources/config.php");
require_once("resources/cart_functions.php");

if(isset($_POST['firstname']) && $_SESSION['item_total'] > 0 && $_SESSION['item_quantity'] > 0){

		// store sessions to pass values from Register page to Thank you page
		$_SESSION['firstname'] 	= $_POST['firstname'];
	    $_SESSION['lastname']  	= $_POST['lastname'];
	    $_SESSION['province'] 	= $_POST['province'];
	    $_SESSION['address'] 	= $_POST['address'];
	    $_SESSION['address2'] 	= $_POST['address2'];
	    $_SESSION['towncity'] 	= $_POST['towncity'];
	    $_SESSION['postal'] 	= $_POST['postal'];
	    $_SESSION['phone'] 		= $_POST['phone'];
	    $_SESSION['email'] 		= $_POST['email'];

		// set Paypal default values
	    $item_name = 1;
	    $item_number = 1;
	    $amount = 1;
	    $quantity = 1;

	}else{
		redirect("cart.php");
	}

 ?>

<script src="js/formValidate.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/mysytles.css">

<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
		
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Checkout</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Checkout</span></p>
          </div>
        </div>
      </div>
    </div>
		
	<section class="ftco-section">
	  <form id="orderform" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
	  <input type="hidden" name="cmd" value="_cart">
  	  <input type="hidden" name="business" value="sb-f7ygs09627@business.example.com">
	  <input type="hidden" name="currency_code" value="CAD">
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

						    <?php foreach ($_SESSION as $name => $value): ?>

						    	<?php if($value > 0): ?>

						    		<?php if(substr($name, 0, 8) == "product_"): ?>

						    			<?php 

						    				// get length of product_id
											$length = strlen($name) - 8;

											// get pure id number from product_id ex) 11
											$id = substr($name, 8, $length);
											$id = intval($id);

											$query = "SELECT * FROM products WHERE id = :id";
											$statement = $db->prepare($query);
											$statement->bindValue(':id', $id, PDO::PARAM_INT);
											$statement->execute();
											$quotes = $statement->fetchAll();
											$sub = 0;

						    			 ?>

											<?php foreach($quotes as $quote): ?>
											<?php $sub = $quote['price'] * $value; ?>
											
											<tr class="text-center">
												<td class="image-prod"><img width="100" src="resources/uploads/<?= $quote['image'] ?>" alt="image"/></td>

												<td class="product-name">
													<h3><?= $quote['title'] ?></h3>
													<p><?= $quote['short_description'] ?></p>
												</td>
												<td class="price">&#36;<?= $quote['price'] ?></td>
												<td class="total"><?= $value ?></td>
												<td class="total">&#36;<?= $sub ?></td>
											</tr>

											<input type="hidden" name="upload" value="1">
						                    <input type="hidden" name="item_name_<?= $item_name ?>" value="<?= $quote['title'] ?>"/>
						                    <input type="hidden" name="item_number_<?= $item_number ?>" value="<?= $quote['id'] ?>"/>
						                    <input type="hidden" name="amount_<?= $amount ?>" value="<?= $quote['price'] ?>"/>
						                    <input type="hidden" name="quantity_<?= $quantity ?>" value="<?= $value ?>"/>

											<?php 
												// everytime, when looping though, these Paypal values increment by 1
							                    $item_name++;
							                    $item_number++;
							                    $amount++;
							                    $quantity++;
											?>

											<?php endforeach ?>

									<?php endif ?>

								<?php endif ?>

							<?php endforeach ?>
						      
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
        <div class="row justify-content-center">
          <div class="col-xl-8 ftco-animate">
	          <div class="row mt-5 pt-3 d-flex">
	          	<div class="col-md-6 d-flex">
	          		<div class="cart-detail cart-total bg-light p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Cart Total</h3>
	          			<p class="d-flex">
		    						<span>Subtotal</span>
		    						<span>
		    							<?php 
		    							echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";
		    							 ?>
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
		    						<span>&#36;
		    							<?php 
		    							echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0";
		    							 ?>
		    						</span>
		    					</p>
								</div>
	          	</div>
	          	<div class="col-md-6">
	          		<div class="cart-detail bg-light p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
	          			
						<!-- <div class="form-group">
							<div class="col-md-12">
								<div class="radio">
								   <label><input type="radio" name="optradio" class="mr-2"> Direct Bank Tranfer</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="radio">
								   <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<div class="radio">
								   <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
								</div>
							</div>
						</div> -->
						<!-- <div class="form-group">
							<div class="col-md-12">
								<div class="checkbox">
								   <label><input type="checkbox" value="" class="mr-2"> I have read and accept the terms and conditions</label>
								</div>
							</div>
						</div> -->
						<!-- <p><a href="#"class="btn btn-primary py-3 px-4">Place an order</a></p> -->
						<?php echo show_paypal(); ?>
					</div>
	          	</div>
	          </div>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
      </form>
    </section> <!-- .section -->

    
<!-- Footer Section -->	
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>