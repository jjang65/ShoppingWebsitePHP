<?php require_once("../resources/config.php"); ?>

<?php 

  if(isset($_POST['submit'])){

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query_for_email = "SELECT * FROM users WHERE email = :email";
    $statement_email = $db->prepare($query_for_email);
    $statement_email->bindValue(':email', $email);
    $statement_email->execute();

    if($statement_email->rowCount() > 0) {
      $row = $statement_email->fetch();
      if(password_verify($password, $row['password'])) {
        $_SESSION['username'] = $email;
        set_message("Welcome back " . $email);
        header("Location: index.php");
        exit();
      } else {
        set_message("Your email or passwor is wrong");
      }
    } else {
      set_message("Your email or passwor is wrong");
    }
  } 

 ?>

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

      <?php toast_message(); ?>
    <form class="div_center" action="#" method="post" enctype="multipart/form-data">

        <div class="form-group"><label for="email">
            Email<input type="text" name="email" class="form-control" id="email"></label>
        </div>
         <div class="form-group"><label for="password">
            Password<input type="password" name="password" class="form-control" id="password"></label>
        </div>

        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary" >
        </div>
    </form>
</div>


<!-- Footer Section --> 
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>