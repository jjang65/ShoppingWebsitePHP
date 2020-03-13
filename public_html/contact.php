<?php 
require_once("../resources/config.php"); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require("../vendor/phpmailer/phpmailer/src/Exception.php");
// require("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
// require("../vendor/phpmailer/phpmailer/src/SMTP.php");

// Load Composer's autoloader
require '../vendor/autoload.php';
?>


<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
		
		<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Contact Us</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Contact</span></p>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section contact-section bg-light">
      <div class="container">
        <h3 class="text-center bg-warning"><?php display_message(); ?></h3>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form class="bg-white p-5 contact-form" method="post">

              <?php send_message(); ?>

              <div class="form-group">
                <input name="name" type="text" class="form-control" placeholder="Your Name">
              </div>
              <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Your Email">
              </div>
              <div class="form-group">
                <input name="subject" type="text" class="form-control" placeholder="Subject">
              </div>
              <div class="form-group">
                <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <button name="submit" class="btn btn-primary py-3 px-5">Send Message</button>
              </div>

            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<div id="map" class="bg-white"></div>
          </div>

        </div>

        <?php include(TEMPLATE_FRONT . DS . "googlemap.php"); ?>

        <?php include(TEMPLATE_FRONT . DS . "contact_info.php"); ?>

      </div>
    </section>
		
		<?php include(TEMPLATE_FRONT . DS . "subscribe.php"); ?>

<!-- Footer Section --> 
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>