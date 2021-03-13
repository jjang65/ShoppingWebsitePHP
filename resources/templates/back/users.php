<?php

require_once("../../resources/config.php");

$query = "SELECT * FROM users";
$statement = $db->prepare($query);
$statement->execute();
$rows = $statement->fetchAll();

?>

<div class="col-lg-12">
    <h1 class="page-header">
        Users<a class="btn btn-primary pull-right" href="index.php?add_user">Add User</a>
    </h1>
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>User Number</th>
                    <th>Email</th>
                    <th>User Photo</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($rows as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td>
                        <a href="index.php?edit_user&id=<?= $row['id'] ?>">
                            <?php if(isset($row['photo'])): ?>
                                <img width='100' src="../resources/uploads/<?= $row['photo']?>" alt="User Image">
                            <?php endif ?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-info" href="index.php?edit_user&id=<?= $row['id'] ?>">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="index.php?delete_user_id=<?= $row['id'] ?>">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table> <!--End of Table-->
    </div>
</div>
