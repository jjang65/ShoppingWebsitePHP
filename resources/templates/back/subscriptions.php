<?php require_once("../../resources/config.php"); ?>
<?php 

if(isset($_POST['add_subscription'])){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $query = "INSERT INTO subscriptions (email) VALUES (:email)";
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();

        set_message("New Subscription Added");
        redirect("index.php?subscriptions");
    }


$query_categoreis = "SELECT * FROM subscriptions";
$statement_cats = $db->prepare($query_categoreis);
$statement_cats->execute();
$rows = $statement_cats->fetchAll();


 ?>


<h1 class="page-header">
  Subscriptions
</h1>

<div class="col-md-4">

    <h3 class="bg-danger"></h3>
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Email</label>
            <input type="text" name="email" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="add_subscription" class="btn btn-primary" value="Add Subscription">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>No</th>
            <th>Email</th>
            <th>Activity</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
            </thead>


    <tbody>
        
    <?php foreach($rows as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><a href="index.php?edit_subscription&id=<?= $row['id'] ?>"><?= $row['email'] ?></a></td>
            <td><?= $row['is_active'] ?></td>
            <td><a class="btn btn-info" href="index.php?edit_subscription&id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a class="btn btn-danger" href="index.php?delete_subscription_id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
    <?php endforeach ?>

    </tbody>

        </table>

</div>


