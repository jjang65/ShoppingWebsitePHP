<section class="ftco-section-parallax">
  <div class="parallax-img d-flex align-items-center">
    <div class="container">
      <div class="row d-flex justify-content-center py-5">
        <div class="col-md-7 text-center heading-section ftco-animate">
        	<h1 class="big">Subscribe</h1>
          <h2>Subcribe to our Newsletter</h2>
          <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-8">
              <form action="../resources/templates/front/subscribe_action.php" class="subscribe-form" method="post">
                <div class="form-group d-flex">
                  <input type="text" id="email" name="email" class="form-control" placeholder="Enter email address">
                  <input type="hidden" name="webpage_name" value="<?php echo basename($_SERVER['PHP_SELF']); ?>">
                  <input type="submit" name="subscribe" value="Subscribe" class="submit px-3">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</section>