<?php require_once("../resources/config.php"); ?>

<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<script src="js/singlepageValidate.js" type="text/javascript"></script>

	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Product Single</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span class="mr-2"><a href="index.html">Product</a></span> <span>Product Single</span></p>
          </div>
        </div>
      </div>
    </div>
		
    <?php 

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM products WHERE id = :id ";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $quotes = $statement->fetchAll();

    ?>


    <?php foreach($quotes as $quote): ?>
	<section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
    			<div class="col-lg-6 mb-5 ftco-animate">
    				<!-- <a href="images/bigger_image.jpg" class="image-popup"> -->
    				<img src="resources/uploads/<?= $quote['image']; ?>" class="img-fluid" alt="Colorlib Template">
    				<!-- </a> -->
    			</div>
    			<div class="col-lg-6 product-details pl-md-5 ftco-animate">
    				<h3><?= $quote['title']; ?></h3>
    				<p class="price"><span>&#36;<?= $quote['price']; ?></span></p>
    				<p><?= $quote['short_description']; ?></p>
    				<p><?= $quote['description']; ?></p>
					<div class="row mt-4">
						<!-- <div class="col-md-6">
							<div class="form-group d-flex">
					        	<div class="select-wrap">
		                  		  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
				                  <select name="" id="" class="form-control">
				                  	<option value="">Small</option>
				                    <option value="">Medium</option>
				                    <option value="">Large</option>
				                    <option value="">Extra Large</option>
			                	  </select>
			               		</div>
			            	</div>
						</div> -->

						<form action="cart.php" method="get">
							<div class="w-100"></div>
							<div class="input-group col-md-8 d-flex mb-4">

								<!-- Hidden product_id to be passed though url -->
				             	<input type="hidden" id="id" name="id" value="<?= $quote['id']; ?>" />

								<!-- Minus Button -->
				             	<span class="input-group-btn mr-2">
				                	<button id="minus_button" type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
				                   		<i class="ion-ios-remove"></i>
				                	</button>
				            	</span>
				            	<!-- Item Quantity -->
				             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">				         
				             	<!-- Plus Button -->
				             	<span class="input-group-btn ml-2">
				                	<button id="plus_button" type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
				                     	<i class="ion-ios-add"></i>
				                 	</button>
				             	</span>
				             
				          	</div>
				          	<!-- <p><a href="cart.php" class="btn btn-primary py-3 px-5">Add to Cart</a></p> -->
				          	<button type="submit">Add to Cart</button>
			          	</form>
		          	</div>

          	
    			</div>
    		</div>
    	</div>
    </section>
<?php endforeach ?>


<!-- Footer Section --> 
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>