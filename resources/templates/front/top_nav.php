<?php 
if(isset($_SESSION['username'])) {
	$email = $_SESSION['username'];
	$query = "SELECT role FROM users WHERE email = :email";
	$statement = $db->prepare($query);
	$statement->bindValue(':email', $email);
	$statement->execute();
	$role = $statement->fetch();
}


 ?>
	<div class="container">
	  <a class="navbar-brand" href="index.php">Modist</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="oi oi-menu"></span> Menu
	  </button>

	  <div class="collapse navbar-collapse" id="ftco-nav">
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	      <li class="nav-item dropdown">
	      <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
	      <div class="dropdown-menu" aria-labelledby="dropdown04">
	      	<a class="dropdown-item" href="shop.php">Shop</a>
	        <a class="dropdown-item" href="cart.php">Cart</a>
	        <a class="dropdown-item" href="checkout.php">Checkout</a>
	      </div>
	    </li>
	      <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
	      <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
	      <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
	      <li class="nav-item cta cta-colored"><a href="cart.php" class="nav-link"><span class="icon-shopping_cart"></span></a></li>
	      <?php if(!isset($_SESSION['username'])): ?>
	      	<li class="nav-item"><a href="sign_in.php" class="nav-link">Sign In</a></li>
	      <?php endif ?>
	      <?php if(isset($_SESSION['username'])): ?>
	      	<li class="nav-item"><a href="logout.php" class="nav-link">Log out</a></li>
	      <?php endif ?>
	      <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
	      <?php if(isset($_SESSION['username']) && $role['role'] === 'admin'): ?>
	      	<li class="nav-item"><a href="admin" class="nav-link">Admin</a></li>
	      <?php endif ?>
	    </ul>
	  </div>
	</div>