<?php 
	$query = "SELECT * FROM products";
	$statement = $db->prepare($query);
	$statement->execute();
	$quotes = $statement->fetchAll();
 ?>


<section class="ftco-section bg-light">
	<div class="container">
			<div class="row justify-content-center mb-3 pb-3">
      <div class="col-md-12 heading-section text-center ftco-animate">
      	<h1 class="big">Products</h1>
        <h2 class="mb-4">Our Products</h2>
      </div>
    </div>    		
	</div>

	<div class="container-fluid">
		
			<div class="row">

				<div class="row col-md-12">

				<!-- Shopt Section Each Item -->
					<?php foreach($quotes as $quote): ?>
					<div class="col-sm col-md-6 col-lg-3 ftco-animate">
						<div class="product">
							<a href="product-single.php?id=<?= $quote['id'] ?>" class="img-prod"><img class="img-fluid" src="resources/uploads/<?= $quote['image'] ?>" alt="Colorlib Template"></a>
							<div class="text py-3 px-3">
								<h3><a href="product-single.php?id=<?= $quote['id'] ?>"><?= $quote['title'] ?></a></h3>
								<div class="d-flex">
									<div class="pricing">
			    						<p class="price"><span>&#36;<?= $quote['price'] ?></span></p>
			    					</div>
								</div>
								<hr>
								<p class="bottom-area d-flex">
									<a href="resources/cart.php?add=<?= $quote['id'] ?>" class="add-to-cart"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
								</p>
							</div>
						</div>
					</div>
					<?php endforeach ?>

				</div>
			
			</div>
	</div>
</section>