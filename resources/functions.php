<?php 

require_once("connect.php");

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}


function redirect($location){

	header("Location: $location ");
}


function redirect_prior_page($prior_webpage_name){
	redirect("../../../public_html/{$prior_webpage_name}");
}


function set_message($msg){
	if(!empty($msg)){
		$_SESSION['message'] = $msg;
	}else{
		$msg = "";
	}
}

function display_message(){
	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function toast_message() {
	if(isset($_SESSION['message'])) {
        echo '<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>';
        echo '<link href="node_modules/toastr/build/toastr.css" rel="stylesheet"/>';
        echo '<script src="node_modules/toastr/toastr.js"></script>';
        echo '<script type="text/javascript">', 'let message =', json_encode($_SESSION['message']), ';', '</script>';
        echo '<script type="text/javascript">', 'toastr.options.closeButton = true;', 'toastr.info(message);', '</script>';
        unset($_SESSION['message']);
    }
}

function file_upload_path($original_filename, $upload_subfolder_name = '../../public_html/resources/uploads') {
	$current_folder = dirname(__FILE__);
	$path_segments = [$upload_subfolder_name, basename($original_filename)];
	return join(DIRECTORY_SEPARATOR, $path_segments);
}

function file_is_an_image($temporary_path, $new_path) {
	$allowed_mime_types = ['image/gif', 'image/jpeg', 'image/png'];
	$allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
	$actual_file_extension = pathinfo($new_path, PATHINFO_EXTENSION);
	$actual_mime_type = getimagesize($temporary_path)['mime'];
	$file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
	$mime_type_is_valid = in_array($actual_mime_type, $allowed_mime_types);
	return $file_extension_is_valid && $mime_type_is_valid;
}


function send_message(){
	if(isset($_POST['submit'])){

		require_once __DIR__ . DIRECTORY_SEPARATOR . '../vendor/autoload.php';

		// Create the Transport
		$transport = (new Swift_SmtpTransport('loalhost', 25))
		  // ->setUsername('your username')
		  // ->setPassword('your password')
		;

		// Create the Mailer using your created Transport
		$mailer = new Swift_Mailer($transport);

		// Create a message
		$message = (new Swift_Message('Wonderful Subject'))
		  ->setFrom(['john@doe.com' => 'John Doe'])
		  ->setTo(['jjy2zzbai2@gmail.com'=> 'Jinyoung'])
		  ->setBody('Here is the message itself')
		  ;

		// Send the message
		$result = $mailer->send($message);
	}
}






/************************************************ Frent End Functions ***********************************************************/


// function get_slides_in_index(){
// 	$query = query("SELECT * FROM products");
// 	confirm($query);

// 	// get total number of rows in orders table
// 	$row_cnt = mysqli_num_rows($query);

// 	// get starting row to be shown
// 	$showrows = 6;
// 	if($row_cnt < 6){
// 		$showrows = $row_cnt;
// 		$startrow = $row_cnt - $showrows;
// 	}else{
// 		$startrow = $row_cnt - $showrows;
// 	}

// 	// get query that selects oders from 8 latest orders
// 	$new_query = query("SELECT * FROM products LIMIT $startrow, $showrows ");
// 	confirm($new_query);

// 	while($row = fetch_array($new_query)){
// 		$product =<<<DELIMETER
// 		<div class="item">
// 			<div class="product">
// 				<a href="product-single.php?id={$row['product_id']}" class="img-prod"><img class="img-fluid" src="resources/uploads/{$row['product_image']}" alt="Colorlib Template">
// 			</a>
// 				<div class="text pt-3 px-3">
// 					<h3><a href="product-single.php?id={$row['product_id']}">{$row['product_title']}</a></h3>
// 					<div class="d-flex">
// 						<div class="pricing">
// 							<p class="price"><span class="price-sale">&#36;{$row['product_price']}</span></p>
// 						</div>
// 					</div>
// 				</div>
// 			</div>
// 		</div>
// DELIMETER;
// 		echo $product;
// 	}
// }



// function get_products_in_index(){
// 	$query = query("SELECT * FROM products");
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 		$product = <<<DELIMETER

// 		<div class="col-sm col-md-6 col-lg-3 ftco-animate">
// 			<div class="product">
// 				<a href="product-single.php?id={$row['product_id']}" class="img-prod"><img class="img-fluid" src="resources/uploads/{$row['product_image']}" alt="Colorlib Template"></a>
// 				<div class="text py-3 px-3">
// 					<h3><a href="product-single.php?id={$row['product_id']}">{$row['product_title']}</a></h3>
// 					<div class="d-flex">
// 						<div class="pricing">
//     						<p class="price"><span>&#36;{$row['product_price']}</span></p>
//     					</div>
// 					</div>
// 					<hr>
// 					<p class="bottom-area d-flex">
// 						<a href="resources/cart.php?add={$row['product_id']}" class="add-to-cart"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
// 					</p>
// 				</div>
// 			</div>
// 		</div>

// DELIMETER;
// 		echo $product;
// 	}
// }


// function get_categories(){
// 	$query = query("SELECT * FROM categories");
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 		$category = <<<DELIMETER
// 		<div class="list-group">
// 		    <a href="categories.php?id={$row['cat_id']}" class="list-group-item">{$row['cat_title']}</a>
// 		</div>

// DELIMETER;
// 		echo $category;
// 	}
// }



// function get_products_in_cat_page(){
// 	$query = query("SELECT * FROM products WHERE product_category_id = " . escape_string($_GET['id']) . " " );
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 		$categories_link = <<<DELIMETER
// 		<div class="col-sm col-md-6 col-lg-3 ftco-animate">
// 			<div class="product">
// 				<a href="product-single.php?id={$row['product_id']}" class="img-prod"><img class="img-fluid" src="resources/uploads/{$row['product_image']}" alt="Colorlib Template">
					
// 				</a>
// 				<div class="text py-3 px-3">
// 					<h3><a href="product-single.php?id={$row['product_id']}">{$row['product_title']}</a></h3>
// 					<div class="d-flex">
// 						<div class="pricing">
// 							<p class="price"><span class="price-sale">&#36;{$row['product_price']}</span></p>
// 						</div>
// 					</div>
// 					<hr>
// 					<p class="bottom-area d-flex">
// 						<a href="cart.php?add={$row['product_id']}" class="add-to-cart"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
// 					</p>
// 				</div>
// 			</div>
// 		</div>
// DELIMETER;
// 		echo $categories_link;
// 	}
// }





// function sign_in(){
// 	if(isset($_POST['submit'])){

// 		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
// 		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// 		$query = "SELECT * FROM users WHERE email = :email AND password = :password";
// 		$statement = $db->prepare($query);
// 		$statement->bindValue(':email', $email);
// 		$statement->bindValue(':password', $password);
// 		$statement->execute();
// 		$row = $statement->fetch();
// 		print_r($row);

// 		if($row['email'] === null || $row['email'] === ""){
// 			set_message("Your password or Username are wrong");
// 			redirect("sign_in.php");
// 		}else{
// 			$_SESSION['username'] = $email;
// 			redirect("admin");
// 		}
// 	}
// }







/***************ADMIN PAGES**********************/

// function show_admin_top_nav(){
// 	// To print Username on top-right corner
// 	$query = query("SELECT * FROM users WHERE username = '" . escape_string($_SESSION['username']) .  "'  ");
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 	    $user =<<<DELIMETER
// 	<ul class="nav navbar-right top-nav">
// 		<li class="dropdown">
// 			<a href="index.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>{$row['username']}<b class="caret"></b></a>
// 			<ul class="dropdown-menu">
// 				<li class="divider"></li>
// 				<li>
// 					<a href="logout.php"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
// 				</li>
// 			</ul>
// 		</li>
// 	</ul>
// DELIMETER;
// 	    echo $user;
// 	}
// }



// function display_orders(){
// 	$query = query("SELECT * FROM orders");
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 		$order =<<<DELIMETER
// 		<tr>
//             <td>{$row['order_id']}</td>
//             <td>{$row['order_amount']}</td>
//             <td>{$row['order_transaction']}</td>
//             <td>{$row['order_status']}</td>
//             <td>{$row['order_currency']}</td>
//             <td>{$row['firstname']}</td>
//             <td>{$row['lastname']}</td>
//             <td>{$row['province']}</td>
//             <td>{$row['address']}</td>
//             <td>{$row['address2']}</td>
//             <td>{$row['towncity']}</td>
//             <td>{$row['postal']}</td>
//             <td>{$row['phone']}</td>
//             <td>{$row['email']}</td>
//             <td>{$row['order_date']}</td>
//             <td>{$row['order_time']}</td>
//             <td><a class="btn btn-danger" href="index.php?delete_order_id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
//         </tr>
// DELIMETER;
// 		echo $order;
// 	}
// }



// function get_reports(){
// 	$query = query("SELECT * FROM reports");
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 		$report =<<<DELIMETER
// 		<tr>
// 			<td>{$row['report_id']}</td>
// 			<td>{$row['product_id']}</td>
// 			<td>{$row['order_id']}</td>
// 			<td>{$row['product_price']}</td>
// 			<td>{$row['product_title']}</td>
// 			<td>{$row['product_quantity']}</td>
// 			<td>{$row['sub_total']}</td>
// 			<td><a class="btn btn-danger" href="index.php?delete_report_id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
// 		</tr>
// DELIMETER;
// 	echo $report;
// 	}
// }



// function get_product_in_admin(){
// 	$query = query("SELECT * FROM products");
// 	confirm($query);

// 	while($row = fetch_array($query)){

// 		$category = show_product_category_title($row['product_category_id']);

// 		$product =<<<DELIMETER
// 		<tr>
// 			<td>{$row['product_id']}</td>
// 			<td>{$row['product_title']}<br>
// 				<a href="index.php?edit_product&id={$row['product_id']}"><img width="100" src="../resources/uploads/{$row['product_image']}" alt="Product Image"></a>
// 			</td>
// 			<td>{$category}</td>
// 			<td>{$row['product_price']}</td>
// 			<td>{$row['product_in_stock']}</td>
// 			<td><a class="btn btn-danger" href="index.php?delete_product_id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
// 		</tr>
// DELIMETER;
// 		echo $product;
// 	}
// }


// function show_product_category_title($product_category_id){
// 	$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
// 	confirm($category_query);

// 	while($category_row = fetch_array($category_query)){
// 		return $category_row['cat_title'];
// 	}
// }




// function add_product(){
// 	if(isset($_POST['publish'])){
// 		$product_title 			= escape_string($_POST['product_title']);
// 		$product_category_id	= escape_string($_POST['product_category_id']);
// 		$product_price 			= escape_string($_POST['product_price']);
// 		$product_description 	= escape_string($_POST['product_description']);
// 		$short_desc 			= escape_string($_POST['short_desc']);
// 		$product_in_stock 		= escape_string($_POST['product_quantity']);
// 		$product_image		    = basename($_FILES['file']['name']);



// 		if(move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_DIRECTORY . DS . $product_image)){
// 			echo "The file " . $_FILES['file']['name'] . " has been uploaded.";
// 		}else{
// 			echo "Sorry, there was an error uploading your file. ";
// 			echo "Product Image: " . $product_image;
// 		}

// 		$query = query("INSERT INTO products (product_title, product_category_id, product_price, product_in_stock, product_desc, product_short_desc, product_image) VALUES ('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_in_stock}', '{$product_description}', '{$short_desc}', '{$product_image}') ");
// 		$last_id = last_id();
// 		confirm($query);

// 		set_message("New Product with id {$last_id} Just Added");
// 		redirect("index.php?products");
// 	}
// }



// function update_product(){
// 	if(isset($_POST['update'])){
// 		$product_title 			= escape_string($_POST['product_title']);
// 		$product_category_id 	= escape_string($_POST['product_category_id']);
// 		$product_price 			= escape_string($_POST['product_price']);
// 		$product_desc   	 	= escape_string($_POST['product_desc']);
// 		$product_short_desc 	= escape_string($_POST['product_short_desc']);
// 		$product_in_stock	    = escape_string($_POST['product_in_stock']);
// 		$product_image		    = basename($_FILES['file']['name']);
// 		//$image_temp_location    = escape_string($_FILES['file']['tmp_name']);


// 		if(empty($product_image)){
// 			$get_pic = query("SELECT product_image FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
// 			confirm($get_pic);

// 			while($pic = fetch_array($get_pic)){
// 				$product_image = $pic['product_image'];
// 			}
// 		}

// 		//move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_DIRECTORY . DS . $user_photo);


// 		if(move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_DIRECTORY . DS . $product_image)){
// 			echo "The file " . $_FILES['file']['name'] . " has been uploaded.";
// 		}else{
// 			echo "Sorry, there was an error uploading your file.";
// 		}

// 		// after SET, must have SPACE for SQL
// 		$query = "UPDATE products SET ";
// 		$query .= "product_title 			= '{$product_title}'		, ";
// 		$query .= "product_category_id 		= '{$product_category_id}'	, ";
// 		$query .= "product_price 			= '{$product_price}'		, ";
// 		$query .= "product_desc 			= '{$product_desc}'			, ";
// 		$query .= "product_short_desc 		= '{$product_short_desc}'	, ";
// 		$query .= "product_in_stock 		= '{$product_in_stock}'		, ";
// 		$query .= "product_image 			= '{$product_image}'		  ";
// 		$query .= "WHERE product_id=" . escape_string($_GET['id']);

// 		$send_update_query = query($query);
		
// 		confirm($send_update_query);
// 		set_message("Product has been Updated");
// 		redirect("index.php?products");
// 	}
// }




// function show_categories_add_product(){
// 	$query = query("SELECT * FROM categories");
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 		$categories_options =<<<DELIMETER
// 		<option value="{$row['cat_id']}">{$row['cat_title']}</option>
// DELIMETER;
// 		echo $categories_options;
// 	}
// }



// function show_categories_in_admin(){
// 	$query = query("SELECT * FROM categories");
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 		$category =<<<DELIMETER
// 		<tr>
// 			<td>{$row['cat_id']}</td>
// 			<td><a href="index.php?edit_category&id={$row['cat_id']}">{$row['cat_title']}</a></td>
// 			<td><a class="btn btn-danger" href="index.php?delete_category_id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
// 		</tr>
// DELIMETER;
// 		echo $category;
// 	}
// }

// function add_category(){
// 	if(isset($_POST['add_category'])){
// 		$cat_title = escape_string($_POST['cat_title']);

// 		$query = query("INSERT INTO categories (cat_title) VALUES ('{$cat_title}')");
// 		confirm($query);

// 		set_message("New Category Added");
// 		redirect("index.php?categories");

// 	}
// }


// function update_category(){
// 	if(isset($_POST['update_category'])){

// 		$cat_title = escape_string($_POST['cat_title']);

// 		// after SET, must have SPACE for SQL
// 		$query = "UPDATE categories SET ";
// 		$query .= "cat_title 		= '{$cat_title}'	 ";
// 		$query .= "WHERE cat_id=" . escape_string($_GET['id']);

// 		$send_update_query = query($query);
		
// 		confirm($send_update_query);
// 		set_message("Category has been Updated");
// 		redirect("index.php?categories");
// 	}
// }



// function display_users(){
// 	$query = query("SELECT * FROM users");
// 	confirm($query);

// 	while($row = fetch_array($query)){
// 		$user =<<<DELIMETER
// 		<tr>
// 			<td>{$row['user_id']}</td>
// 			<td>{$row['username']}</td>
// 			<td>{$row['email']}</td>
// 			<td><a href="index.php?edit_user&id={$row['user_id']}">
// 				<img width='100' src="../resources/uploads/{$row['user_photo']}" alt="User's Image">
// 				</a></td>
// 			<td><a class="btn btn-danger" href="index.php?delete_user_id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>

// 		</tr>
// DELIMETER;
// 		echo $user;
// 	}
// }


// function add_user(){
// 	if(isset($_POST['add_user'])){
// 		$username 		= escape_string($_POST['username']);
// 		$email			= escape_string($_POST['email']);
// 		$password 		= escape_string($_POST['password']);
// 		$user_photo		= escape_string($_FILES['file']['name']);

// 		date_default_timezone_set('America/Winnipeg');
// 		$registered_time = date('Y-m-d H:i:s');

// 		move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_DIRECTORY . DS . $user_photo);

// 		$query = query("INSERT INTO users (username, email, password, user_photo, registered_time) 
// 						VALUES ('{$username}', '{$email}', '{$password}', '{$user_photo}', '{$registered_time}' ) ");
// 		confirm($query);

// 		set_message("New User Added");

// 		redirect("index.php?users");

// 	}
// }



// function update_user(){
// 	if(isset($_POST['update_user'])){
// 		debug_to_console("update_user is called");
// 		$username 	= escape_string($_POST['username']);
// 		$email 		= escape_string($_POST['email']);
// 		$password   = escape_string($_POST['password']);
// 		$user_photo = basename($_FILES['file']['name']);

// 		if(empty($user_photo)){
// 			$get_photo = query("SELECT user_photo FROM users WHERE user_id = " . escape_string($_GET['id']) . " ");
// 			confirm($get_photo);

// 			while($row = fetch_array($get_photo)){
// 				$user_photo = $row['user_photo'];
// 			}
// 		}

// 		if(move_uploaded_file($_FILES['file']['tmp_name'], UPLOAD_DIRECTORY . DS . $user_photo)){
// 			echo "The file " . $_FILES['file']['name'] . " has been uploaded.";
// 		}else{
// 			echo "Sorry, there was an error uploading your file.";
// 		}

// 		// after SET, must have SPACE for SQL
// 		$query = "UPDATE users SET ";
// 		$query .= "username 			= '{$username}'			, ";
// 		$query .= "email 				= '{$email}'			, ";
// 		$query .= "password 			= '{$password}'			, ";
// 		$query .= "user_photo 			= '{$user_photo}'	  ";
// 		$query .= "WHERE user_id=" . escape_string($_GET['id']);

// 		$send_update_query = query($query);
		
// 		confirm($send_update_query);
// 		set_message("User has been Updated");
// 		redirect("index.php?users");

// 	}
// }



// function show_transaction_in_dashboard(){

// 	$query = query("SELECT * FROM orders");
// 	confirm($query);

// 	// get total number of rows in orders table
// 	$row_cnt = mysqli_num_rows($query);

// 	// get starting row to be shown
// 	$showrows = 8;
// 	if($row_cnt < 8){
// 		$showrows = $row_cnt;
// 		$startrow = $row_cnt - $showrows;
// 	}else{
// 		$startrow = $row_cnt - $showrows;
// 	}

// 	// get query that selects oders from 8 latest orders
// 	$new_query = query("SELECT * FROM orders LIMIT $startrow, $showrows ");
// 	confirm($new_query);

// 	while($row = fetch_array($new_query)){
// 		$order =<<<DELIMETER
// 		<tr>
// 			<td>{$row['order_id']}</td>
// 			<td>{$row['order_date']}</td>
// 			<td>{$row['order_time']}</td>
// 			<td>&#36;{$row['order_amount']}</td>
// 			<td>{$row['firstname']}</td>
// 			<td>{$row['lastname']}</td>
// 		</tr>
// DELIMETER;
// 		echo $order;
// 	}
// }



// function show_users_in_dashboard(){
// 	$query = query("SELECT * FROM users");
// 	confirm($query);

// 	$row_cnt = mysqli_num_rows($query);


// 	$showrows = 8;
// 	if($row_cnt < 8){
// 		$showrows = $row_cnt;
// 		$startrow = $row_cnt - $showrows;
// 	}else{
// 		$startrow = $row_cnt - $showrows;
// 	}

// 	$new_query = query("SELECT * FROM users LIMIT $startrow, $showrows");
// 	confirm($new_query);

// 	while($row = fetch_array($new_query)){
// 		$user =<<<DELIMETER
// 		<tr>
//             <td>{$row['user_id']}</td>
//             <td>{$row['username']}</td>
//             <td>{$row['registered_time']}</td>
//         </tr>
// DELIMETER;
// 		echo $user;
// 	}
// }









 ?>