<?php require_once("../../resources/config.php"); ?>


<?php

if(isset($_SESSION['admin']) && isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM subscriptions WHERE id= :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch();

    if(isset($_POST['update_subscription'])){

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query_update = "UPDATE subscriptions SET email = :email
                            WHERE id = :id";
        $statement_update = $db->prepare($query_update);
        $statement_update->bindValue(':email', $email);
        $statement_update->bindValue(':id', $id, PDO::PARAM_INT);
        $statement_update->execute();

        set_message("Subscription has been Updated");
        redirect("index.php?subscriptions");
    }
}

 ?>

<h1 class="page-header">
  Edit Subscription
</h1>



<div class="col-md-2">

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
            </tr>
        </thead>

            <tbody>
                <tr>
                    <th><?= $row['id']; ?></th>
                </tr>
            </tbody>

        </table>

</div>

<div class="col-md-4">

    <form action="#" method="post">

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" value="<?= $row['email'] ?>" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="update_subscription" class="btn btn-primary" value="Edit Subscription">
        </div>

    </form>

</div>

