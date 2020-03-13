<?php require_once("../resources/config.php"); ?>

<!-- Header Section -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<link rel="stylesheet" type="text/css" href="css/mysytles.css">

    <div class="hero-wrap hero-bread" style="background-image: url('images/bg_6.jpg');">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
            <h1 class="mb-0 bread">Collection</h1>
            <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home</a></span> <span>Sign In</span></p>
          </div>
        </div>
      </div>
    </div>

<!-- Page Content -->
<div class="text-center ">
<div class="container">

</div>
    <h1 class="text-center">Sign In</h1>
    <h2 class="text-center bg-warning"><?php display_message(); ?></h2>

    <form class="div_center" action="" method="post" enctype="multipart/form-data">

        <?php echo sign_in(); ?>

        <div class="form-group"><label for="">
            username<input type="text" name="username" class="form-control"></label>
        </div>
         <div class="form-group"><label for="password">
            Password<input type="password" name="password" class="form-control"></label>
        </div>

        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" >
        </div>
    </form>
</div>


<!-- Footer Section --> 
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>