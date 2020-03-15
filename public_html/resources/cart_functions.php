<!-- Configuration-->
<!-- <?php require_once("../resources/config.php"); ?> -->


<?php 

	
	




// function cart(){
// 	debug_to_console("cart() is called");
// 	$total = 0;
// 	$item_quantity = 0;

// 	// in cart() function, if 'remove' button is clicked, below if statement will be operated
// 	if(isset($_GET['product_id']) && isset($_GET['quantity'])){
// 		debug_to_console("if is called");
// 		$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
// 		$query = query("SELECT * FROM products WHERE id = :id");

// 		while($row = fetch_array($query)){
// 			debug_to_console("product_in_stock-> " . $row['product_in_stock']);
// 			debug_to_console("quantity-> " . $_GET['quantity']);
// 			// if product_quantity is less than the quantity required by customer
// 			if($row['product_in_stock'] > $_GET['quantity']){
// 				debug_to_console("if product_in_stock > quantity is called");
// 				$_SESSION['product_' . $_GET['product_id']] = $_GET['quantity'];
// 				redirect("cart.php");
// 			}else{
// 				debug_to_console("else is called");
// 				set_message("Sorry, We only have " . $row['product_in_stock'] . " " . "{$row['product_title']}" . " Available");
// 				redirect("cart.php");
// 			}
// 		}
// 	}

// 	// in cart() function, if 'delete' button is clicked, below if statement will be operated
// 	if(isset($_GET['delete'])){
// 		$_SESSION['product_' . $_GET['delete']] = '0';

// 		unset($_SESSION['item_total']);
// 		unset($_SESSION['item_quantity']);

// 		redirect("cart.php");

// 	}

// 	// if 'add to cart' button is clicked, below if statement will be operated
// 	if(isset($_GET['add'])){
// 		$query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['add']) . " ");
// 		confirm($query);

// 		while($row = fetch_array($query)){

// 			if($row['product_in_stock'] != $_SESSION['product_' . $_GET['add']]){
// 				$_SESSION['product_' . $_GET['add']] += 1;
// 				redirect("cart.php");
// 			}else{
// 				set_message("Sorry, We only have " . $row['product_in_stock'] . " " . "{$row['product_title']}" . " Available");
// 				redirect("cart.php");
// 			}
// 		}
// 	}

// 	// if 'remove' button is clicked, below if statement will be operated
// 	if(isset($_GET['subtract'])){

// 		$_SESSION['product_' . $_GET['subtract']]--;

// 		if($_SESSION['product_' . $_GET['subtract']] < 1){
// 			unset($_SESSION['item_total']);
// 			unset($_SESSION['item_quantity']);

// 			redirect("cart.php");

// 		}else{
// 			redirect("cart.php");

// 		}
		
// 	}


// 	// set Paypal default values
//     // $item_name = 1;
//     // $item_number = 1;
//     // $amount = 1;
//     // $quantity = 1;


// 	foreach ($_SESSION as $name => $value) {
// 		debug_to_console("foreach is called");
// 		debug_to_console("name-> " . $name);
// 		debug_to_console("value-> " . $value);
// 		if($value > 0){
// 			debug_to_console("value > 0 is called");
// 			if(substr($name, 0, 8) == "product_"){
// 				debug_to_console("substr() is called");
// 				// get length of product_id
// 				$length = strlen($name) - 8;
// 				debug_to_console("length -> " . $length);

// 				// get pure id number from product_id ex) 11
// 				$id = substr($name, 8, $length);
// 				debug_to_console("id -> " . $id);

// 				$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
// 				confirm($query);

// 				$sub = 0;

// 				while($row = fetch_array($query)){
// 					debug_to_console("while is called");
// 					$sub = $row['product_price'] * $value;
// 					$item_quantity += $value;

// 					$product =<<<DELIMETER
// 					<tr class="text-center">
// 						<td class="product-remove mytd"><a href="cart.php?subtract={$row['product_id']}"><span class="ion-md-remove"></span></a></td>
// 						<td class="product-remove mytd"><a href="cart.php?add={$row['product_id']}"><span class="ion-md-add"></span></a></td>
// 						<td class="product-remove mytd"><a href="cart.php?delete={$row['product_id']}"><span class="ion-md-close"></span></a></td>

// 						<td class="image-prod"><img width="100" src="resources/uploads/{$row['product_image']}" alt="image"/></td>

// 						<td class="product-name">
// 							<h3>{$row['product_title']}</h3>
// 							<p>{$row['product_short_desc']}</p>
// 						</td>
// 						<td class="price">&#36;{$row['product_price']}</td>
// 						<td class="quantity">
// 							<div class="input-group mb-3">
// 								<input type="text" name="quantity" class="quantity form-control input-number" value="{$value}" min="1" max="100">
// 							</div>
// 						</td>
// 						<td class="total">&#36;{$sub}</td>
// 					</tr>

					
// DELIMETER;
// 					echo $product;

// 					// everytime, when looping though, these Paypal values increment by 1
//                     // $item_name++;
//                     // $item_number++;
//                     // $amount++;
//                     // $quantity++;

// 				}

// 				$total += $sub;

// 				$_SESSION['item_total'] = $total;
// 				$_SESSION['item_quantity'] = $item_quantity;


// 			}
// 		}
// 	}
	
// }

// function checkout(){

// 	if(isset($_POST['firstname']) && $_SESSION['item_total'] > 0 && $_SESSION['item_quantity'] > 0){

// 		// store sessions to pass values from Register page to Thank you page
// 		$_SESSION['firstname'] 	= $_POST['firstname'];
// 	    $_SESSION['lastname']  	= $_POST['lastname'];
// 	    $_SESSION['province'] 	= $_POST['province'];
// 	    $_SESSION['address'] 	= $_POST['address'];
// 	    $_SESSION['address2'] 	= $_POST['address2'];
// 	    $_SESSION['towncity'] 	= $_POST['towncity'];
// 	    $_SESSION['postal'] 	= $_POST['postal'];
// 	    $_SESSION['phone'] 		= $_POST['phone'];
// 	    $_SESSION['email'] 		= $_POST['email'];

// 		// set Paypal default values
// 	    $item_name = 1;
// 	    $item_number = 1;
// 	    $amount = 1;
// 	    $quantity = 1;

// 		foreach ($_SESSION as $name => $value) {
// 			debug_to_console("foreach is called");
// 			debug_to_console("name-> " . $name);
// 			debug_to_console("value-> " . $value);
// 			if($value > 0){
// 				debug_to_console("value > 0 is called");
// 				if(substr($name, 0, 8) == "product_"){
// 					debug_to_console("substr() is called");
// 					// get length of product_id
// 					$length = strlen($name) - 8;
// 					debug_to_console("length -> " . $length);

// 					// get pure id number from product_id ex) 11
// 					$id = substr($name, 8, $length);
// 					debug_to_console("id -> " . $id);

// 					$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
// 					confirm($query);

// 					$sub = 0;

// 					while($row = fetch_array($query)){
// 						debug_to_console("while is called");
// 						$sub = $row['product_price'] * $value;

// 						$product =<<<DELIMETER
// 						<tr class="text-center">
// 							<td class="image-prod"><img width="100" src="resources/uploads/{$row['product_image']}" alt="image"/></td>

// 							<td class="product-name">
// 								<h3>{$row['product_title']}</h3>
// 								<p>{$row['product_short_desc']}</p>
// 							</td>
// 							<td class="price">&#36;{$row['product_price']}</td>
// 							<td class="total">{$value}</td>
// 							<td class="total">&#36;{$sub}</td>
// 						</tr>

// 						<input type="hidden" name="upload" value="1">
// 	                    <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}"/>
// 	                    <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}"/>
// 	                    <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}"/>
// 	                    <input type="hidden" name="quantity_{$quantity}" value="{$value}"/>
// DELIMETER;
// 						echo $product;

// 						// everytime, when looping though, these Paypal values increment by 1
// 	                    $item_name++;
// 	                    $item_number++;
// 	                    $amount++;
// 	                    $quantity++;

// 					}
// 				}
// 			}
// 		}
// 	}else{
// 		redirect("cart.php");
// 	}
// }



// function show_proceed(){
// 	if(isset($_SESSION['item_quantity']) === true && $_SESSION['item_quantity'] >= 1){
// 		$proceed_button =<<<DELIMETER
// 		<p class="text-center"><a id="proceed" href="register.php" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
// DELIMETER;
// 		return $proceed_button;
// 	}	
// }


// function show_paypal(){

//     if(isset($_SESSION['item_quantity']) === true && $_SESSION['item_quantity'] >= 1){
//         $paypal_button = <<<DELIMETER
//         <input id="paypalButton" type="image" name="upload"
//         width="150" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
//         alt="PayPal">
// DELIMETER;

//         return $paypal_button;

//     }
// }



// // function in thank_you page
// function process_transaction(){

// 	// if we can get transaction Identifier('tx'),
// 	if(isset($_GET['tx'])){
// 		$amount = $_GET['amt'];
// 		$currency = $_GET['cc'];
// 		$transaction = $_GET['tx'];
// 		$status = $_GET['st'];

// 		// set order time and get order date and time
// 		date_default_timezone_set('America/Winnipeg');
//         $order_date = date('Y-m-d');
//         $order_time = date('H:i:s');

// 		if($_SESSION['firstname']){

// 		// Insert data into Database in orders table
// 		$send_order = query("INSERT INTO orders (order_amount, order_currency, order_transaction, order_status, firstname, lastname, province, address, address2, towncity, postal, phone, email, order_date, order_time) 
// 							VALUES ('{$amount}', '{$currency}', '{$transaction}', '{$status}', '{$_SESSION['firstname']}', '{$_SESSION['lastname']}', '{$_SESSION['province']}', '{$_SESSION['address']}', '{$_SESSION['address2']}', '{$_SESSION['towncity']}', '{$_SESSION['postal']}', '{$_SESSION['phone']}', '{$_SESSION['email']}', '{$order_date}', '{$order_time}'	)");

// 		confirm($send_order);
// 		}else{
// 			session_destroy();
// 			redirect("index.php");
// 		}

// 		// reset total and item_quantity 
// 		$total = 0;
// 		$item_quantity = 0;

// 		// generated by function in functions.php as global id that is used to be inserted into report table in database
// 		// last_id == order_id which can be matched with oder_id in orders table
//         $last_id = last_id();

// 		foreach ($_SESSION as $name => $value) {

// 			if($value > 0){

// 				if(substr($name, 0, 8) == "product_"){
// 					$length = strlen($name) - 8;
// 					$id = substr($name, 8, $length);

//                     $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
//                     confirm($query);

//                     while($row = fetch_array($query)){
//                     	$sub = $row['product_price'] * $value;
//                     	$item_quantity += $value;

//                     	// Insert data into Database in reports table
//                         //$id is already defined above
//                     	$product_price = $row['product_price'];
//                     	$product_title = $row['product_title'];
//                     	//$value is already defined above

//                     	$insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity, sub_total) 
//                     							VALUES ('{$id}', '{$last_id}', '{$product_title}', '{$product_price}', '{$value}', '{$sub}') ");
//                     	confirm($insert_report);

//                     	// display orders to the customer
//                     	$product =<<<DELIMETER
//                     	<tr class="text-center">

// 							<td class="image-prod"><img width="100" src="resources/uploads/{$row['product_image']}" alt="image"/></td>

// 							<td class="product-name">
// 								<h3>{$row['product_title']}</h3>
// 								<p>{$row['product_short_desc']}</p>
// 							</td>
// 							<td class="price">&#36;{$row['product_price']}</td>
// 							<td class="quantity">
// 								<div class="input-group mb-3">
// 									<input type="text" name="quantity" class="quantity form-control input-number" value="{$value}" min="1" max="100">
// 								</div>
// 							</td>
// 							<td class="total">&#36;{$sub}</td>
// 						</tr>
// DELIMETER;
// 						echo $product;

//                     }
//                     $total += $sub;
// 				}
// 			}
// 		}
// 		// end of foreach loop for inserting and displaying data
// 		session_destroy();

// 	}else{
// 		// if there is no transaction data, go to index.php
// 		redirect("index.php");
// 	}
// }



?>