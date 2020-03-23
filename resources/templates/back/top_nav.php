<?php require_once("../../resources/config.php"); ?>
<?php 

    if(isset($_SESSION['username'])){
        $email = filter_var($_SESSION['username']);
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $rows = $statement->fetchAll();
    }

 ?>

<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php">ADMIN CENTER</a>
    <a class="navbar-brand" href="../index.php">HOME</a>
    
</div>

    <?php foreach($rows as $row): ?>
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="index.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $row['email'] ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="divider"></li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
    <?php endforeach ?>

<!-- Top Menu Items -->
<!-- <ul class="nav navbar-right top-nav">
  <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
        <ul class="dropdown-menu">
           
            <li class="divider"></li>
            <li>
                <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>
</ul> -->

