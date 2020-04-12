<?php 

require_once("../resources/config.php"); 

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$query = "SELECT * FROM products WHERE cat_id = :id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$quotes_prods = $statement->fetchAll();

?>

<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>


	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Collection</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Product</span></p>
          </div>
        </div>
      </div>
    </div>
		
		<section class="ftco-section bg-light">
    	<div class="container-fluid">
            <div class="row">
                
                <!-- Categories -->
                <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?>

            <div class="row col-md-9">

              <?php foreach($quotes_prods as $quote): ?>
                <div class="col-sm col-md-6 col-lg-3 ftco-animate">
                  <div class="product">
                    <a href="product-single.php?id=<?= $quote['id'] ?>" class="img-prod">
                      <?php if(isset($quote['image'])): ?>
                        <img class="img-fluid" src="resources/uploads/<?= $quote['image'] ?>" alt="Colorlib Template">
                      <?php endif ?>
                    </a>
                    <div class="text py-3 px-3">
                      <h3><a href="product-single.php?id=<?= $quote['id'] ?>"><?= $quote['title'] ?></a></h3>
                      <div class="d-flex">
                        <div class="pricing">
                          <p class="price"><span class="price-sale">&#36;<?= $quote['price'] ?></span></p>
                        </div>
                      </div>
                      <hr>
                      <p class="bottom-area d-flex">
                        <a href="cart.php?add=<?= $quote['id'] ?>" class="add-to-cart"><span>Add to cart <i class="ion-ios-add ml-1"></i></span></a>
                      </p>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>

            </div>
        	</div>
        </div>
    </section>

		

<!-- Footer Section --> 
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>