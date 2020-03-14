<?php require_once("../resources/config.php"); ?>

<?php 

  if(isset($_POST['submit'])){

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $query = "SELECT * FROM users WHERE email = :email AND password = :password";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $row = $statement->fetch();
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
    <?php if(isset($row) && ($row['email'] === null || $row['email'] === "")): ?>
      <!-- <h2 class="text-center bg-warning">Your email or passwor is wrong</h2> -->
      <?php set_message("Your email or passwor is wrong"); ?>
      <?php toast_message(); ?>
    <?php elseif(isset($row) && isset($email)): ?>
      <?php $_SESSION['username'] = $email; set_message("Login successful"); header("Location: index.php");?>
    <?php endif ?>

    <form class="div_center" action="" method="post" enctype="multipart/form-data">

        <div class="form-group"><label for="">
            Email<input type="text" name="email" class="form-control"></label>
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