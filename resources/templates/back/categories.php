<?php require_once("../../resources/config.php"); ?>
<?php 

if(isset($_POST['add_category'])){
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $query = "INSERT INTO categories (title) VALUES (:title)";
        $statement = $db->prepare($query);
        $statement->bindValue(':title', $title);
        $statement->execute();

        set_message("New Category Added");
        redirect("index.php?categories");
    }


$query_categoreis = "SELECT * FROM categories";
$statement_cats = $db->prepare($query_categoreis);
$statement_cats->execute();
$rows = $statement_cats->fetchAll();


 ?>


<h1 class="page-header">
  Product Categories
</h1>

<div class="col-md-4">

    <h3 class="bg-danger"></h3>
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
            </thead>


    <tbody>
        
    <?php foreach($rows as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><a href="index.php?edit_category&id=<?= $row['id'] ?>"><?= $row['title'] ?></a></td>
            <td><a class="btn btn-info" href="index.php?edit_category&id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
            <td><a class="btn btn-danger" href="index.php?delete_category_id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
    <?php endforeach ?>

    </tbody>

        </table>

</div>


