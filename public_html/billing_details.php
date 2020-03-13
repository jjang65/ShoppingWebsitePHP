<?php require_once("../resources/config.php"); ?>

<?php require_once("resources/cart_functions.php"); ?>

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
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-8 ftco-animate">
				
				<?php include(TEMPLATE_FRONT . DS . "register_form.php") ?>

          </div> <!-- .col-md-8 -->
        </div>
      </div>
      </form>
    </section> <!-- .section -->

    
<!-- Footer Section -->	
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
