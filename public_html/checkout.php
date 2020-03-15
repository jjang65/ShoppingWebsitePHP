<?php 

require_once("../resources/config.php");
require_once("resources/cart_functions.php");

/*
 * Sanitizes an input filed.
 * Returns sanitized string.
 */
function valid_required_input($input) {
	return filter_input(INPUT_POST, $input, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

/*
 * Validates Canadian Province code.
 * Returns true if Province code is valid; Otherwise, returns false.
 */
function valid_province_choice() {
	return filter_input(INPUT_POST, 'province', FILTER_SANITIZE_FULL_SPECIAL_CHARS) && strlen($_POST['province']) === 2;
}

/*
 * Validates Canadian postl code.
 * Returns true if postal code is valid; Otherwise, returns false.
 */
function valid_postal_input() {
	return filter_input(INPUT_POST, 'postal', FILTER_VALIDATE_REGEXP, 
		array("options"=>array("regexp"=>"^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$^")));
}

/*
 * Validates phone number by filtering numbers and replacing '-', '(', ')' with empty string.
 * Returns true if phone number is integers with lengh between 10 and 14; otherwise, returns false.
 */
function valid_phone_number() {
	$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
	$phone = str_replace("-", "", $phone);
	$phone = str_replace("(", "", $phone);
	$phone = str_replace(")", "", $phone);
	return (strlen($phone) <= 10 || strlen($phone) >= 14);
}

if(!valid_required_input('firstname')) {
	$error_messages[] = "You should input your first name.";
}

if(!valid_required_input('lastname')) {
	$error_messages[] = "You should input your last name.";
}

if(!valid_required_input('address')) {
	$error_messages[] = "You should input your address.";
}

if(!valid_required_input('towncity')) {
	$error_messages[] = "You should input your town or city.";
}

if(isset($_POST['firstname']) && $_SESSION['item_total'] > 0 && $_SESSION['item_quantity'] > 0){

		// store sessions to pass values from Register page to Thank you page
		$_SESSION['firstname'] = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$_SESSION['lastname'] = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$_SESSION['address'] = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$_SESSION['address2'] = filter_input(INPUT_POST, 'address2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$_SESSION['towncity'] = filter_input(INPUT_POST, 'towncity', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		if(!valid_province_choice()) {
			$error_messages[] = "You must choose valid province.";
		} else {
			$_SESSION['province'] = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		}
		
		if(!valid_postal_input()) {
			$error_messages[] = "You must input valid postal code.";
		} else {
			$_SESSION['postal'] = filter_input(INPUT_POST, 'postal', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		}

		if(!valid_phone_number()) {
			$error_messages[] = "You must input valid phone number.";
		} else {
			$_SESSION['phone']  = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		}

		$total_message = "";
		if(isset($error_messages)) {
			foreach($error_messages as $error_message) {
				$total_message .= $error_message . "<br>";
			}
			set_message($total_message);
			header("Location: billing_details.php");
		}

		// set Paypal default values
	    $item_name = 1;
	    $item_number = 1;
	    $amount = 1;
	    $quantity = 1;

	}else{
		header("Location: billing_details.php");
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
												<input type="hidden" name="shipping_1" value="<?= $_SESSION['transfer_fee'] ?>">
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
    						<span>Item Quantity</span>
    						<span>
    							<?= isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = 0?>
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
    					<hr>
    					<p class="d-flex total-price">
    						<span>Total</span>
    						<span>&#36;
    							<?= isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = 0; ?>
    						</span>
    					</p>
						</div>
	          	</div>
	          	<div class="col-md-6">
	          		<div class="cart-detail bg-light p-3 p-md-4">
	          			<h3 class="billing-heading mb-4">Payment Method</h3>
	          			
						<?php if(isset($_SESSION['item_quantity']) === true && $_SESSION['item_quantity'] >= 1): ?>
         					<input id="paypalButton" type="image" name="upload" width="150" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal">
         				<?php endif ?>

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