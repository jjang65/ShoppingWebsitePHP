<?php require_once("../resources/config.php"); ?>

<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<script src="js/formValidate.js"></script>
<link rel="stylesheet" type="text/css" href="css/mysytles.css">
		
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
    <?php toast_message(); ?>
		
	<section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-8 ftco-animate">
				
				<?php include(TEMPLATE_FRONT . DS . "register_form.php") ?>

          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->

    
<!-- Footer Section -->	
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
