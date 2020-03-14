<?php require_once("../resources/config.php"); ?>

<!-- Header Section -->
    <?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

	<!-- Main Image Section -->
	<?php include(TEMPLATE_FRONT . DS . "main_image.php") ?>

        <?php toast_message(); ?>
    
    <!-- Slider Section -->
    <?php include(TEMPLATE_FRONT . DS . "slider.php") ?>

  
    <!-- Products In Index Section -->
    <?php include(TEMPLATE_FRONT . DS . "products_in_index.php") ?>

    
    <!-- Service Section -->
    <?php include(TEMPLATE_FRONT . DS . "service.php"); ?>

    
	<!-- Subscribe Section -->	
	<?php include(TEMPLATE_FRONT . DS . "subscribe.php"); ?>

<!-- Footer Section -->	
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>