<?php

require_once("../../resources/config.php");

// Check if user is logged in && user is admin
if(!isset($_SESSION['username'])) {
    set_message("Please login first.");
    header("Location: ./../index.php");
    exit();
} else {
    if (!is_admin($db, $_SESSION['username'])) {
        set_message("Invalid access");
        header("Location: ./../index.php");
        exit();
    } else {
        $email = filter_var($_SESSION['username']);
        $query = "SELECT * FROM users WHERE email = :email";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $row = $statement->fetch();
        $_SESSION['admin'] = $row['email'];
    }
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
    <?php if (isset($_SESSION['admin'])): ?>
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="index.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $email ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="divider"></li>
                    <li>
                        <a href="logout.php"><i class="fa fa-fw fa-power-off"></i>Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
    <?php endif ?>
