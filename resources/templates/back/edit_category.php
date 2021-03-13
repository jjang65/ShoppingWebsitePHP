<?php require_once("../../resources/config.php"); ?>


<?php

if(isset($_SESSION['admin']) && isset($_GET['id'])){
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM categories WHERE id= :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch();

    if(isset($_POST['update_category'])){

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query_update = "UPDATE categories SET title = :title
                            WHERE id = :id";
        $statement_update = $db->prepare($query_update);
        $statement_update->bindValue(':title', $title);
        $statement_update->bindValue(':id', $id, PDO::PARAM_INT);
        $statement_update->execute();

        set_message("Category has been Updated");
        redirect("index.php?categories");
    }
}

 ?>

<h1 class="page-header">
  Edit Category
</h1>



<div class="col-md-1">

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
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="<?= $row['title'] ?>" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="update_category" class="btn btn-primary" value="Edit Category">
        </div>

    </form>

</div>

