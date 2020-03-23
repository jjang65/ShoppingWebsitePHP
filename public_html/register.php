<?php require_once("../resources/config.php"); ?>

<?php require_once("resources/cart_functions.php"); ?>

<script src="js/formValidateForRegister.js?2" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/mysytles.css">

<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
		
	<div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Register</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Register</span></p>
          </div>
        </div>
      </div>
    </div>
    <h3 class="text-center bg-danger"><?php toast_message(); ?></h3>
    
	<section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-5 ftco-animate">
				
				    <form id="registerform" action="../resources/templates/front/register_process.php" class="billing-form bg-light p-3 p-md-5" method="post">
              <h3 class="mb-4 billing-heading">Register</h3>
              <div class="row align-items-end">
                
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="text" class="form-control">
                    <p class="RegisterError error" id="email_error">* Required field</p>
                    <p class="RegisterError error" id="emailformat_error">* Invalid email address</p>
                    <!-- <p class="RegisterError error" id="emailformat_error">* Existing email</p> -->
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password" class="form-control">
                    <p class="RegisterError error" id="password_error">* Required field</p>
                    <p class="RegisterError error" id="password_length_error">* Password length should be at least 8</p>
                    <p class="RegisterError error" id="password_complex_error">* Password must contain at least one lowercase character, uppercase character, and a number.</p>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="confirm">Password Confirm</label>
                    <input id="confirm" name="confirm" type="password" class="form-control">
                    <p class="RegisterError error" id="confirm_error">* Required field</p>
                    <p class="RegisterError error" id="confirm_matched_error">* Password and password confirm should be matched</p>
                  </div>
                </div>
                <div class="w-100"></div>

                <div class="col-md-6">
                  <div class="form-group">
                    <p class="text-center"><button type="reset" class="btn btn-primary py-3 px-4">Clear</button></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <p class="text-center"><button type="submit" class="btn btn-primary py-3 px-4">Register</button></p>
                  </div>
                </div>

                <input type="hidden" name="submit" value="submit">

                <div class="col-md-3"><!-- 
                  <button class="btn-warning radius" type="reset" id="clear">Clear Billing Details</button> -->
                </div>
              </div>
            </form>

          </div> <!-- .col-md-8 -->
        </div>
      </div>
      </form>
    </section> <!-- .section -->

    
<!-- Footer Section -->	
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>