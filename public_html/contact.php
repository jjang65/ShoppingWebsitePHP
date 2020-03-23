<?php 
require_once("../resources/config.php"); 

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';

if(isset($_POST['submit'])){

  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = EMAIL;                                  // SMTP username
    $mail->Password   = PASSWORD;                              // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('jjy2zzbai2@gmail.com', 'Mailer');
    $mail->AddReplyTo('jjy2zzbai2@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress('jjsung33@naver.com');               // Name is optional

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
  
}

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