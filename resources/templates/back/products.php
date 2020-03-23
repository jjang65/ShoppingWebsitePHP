<?php require_once("../../resources/config.php"); ?>
<?php 

$query = "SELECT * FROM products";
$statement = $db->prepare($query);
$statement->execute();
$rows = $statement->fetchAll();

 ?>


<h1 class="page-header">All Products<a class="btn btn-primary pull-right" href="index.php?add_product">Add Product</a></h1>

<h3 class="bg-danger"></h3>
<table class="table table-hover">
    <thead>
      <tr>
         <th>Id</th>
         <th>Title</th>
         <th>Category</th>
         <th>Price</th>
         <th>Quantity</th>
         <th>Edit</th>
         <th>Delete</th>
      </tr>
    </thead>
    <tbody>

  <?php foreach($rows as $row): ?>        

    <?php 

      $cat_id = $row['cat_id'];
      $category_query = "SELECT * FROM categories WHERE id = :cat_id";
      $statement_cat = $db->prepare($category_query);
      $statement_cat->bindValue(':cat_id', $cat_id, PDO::PARAM_INT);
      $statement_cat->execute();
      $quote = $statement_cat->fetch();

     ?>

    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['title'] ?><br>
        <a href="index.php?edit_product&id=<?= $row['id'] ?>"><img width="100" src="../resources/uploads/<?= $row['image'] ?>" alt="Product Image"></a>
      </td>
      <td><?= $quote['title'] ?></td>
      <td><?= $row['price'] ?></td>
      <td><?= $row['in_stock'] ?></td>
      <td><a class="btn btn-info" href="index.php?edit_product&id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
      <td><a class="btn btn-danger" href="index.php?delete_product_id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>

  <?php endforeach ?>

    </tbody>
</table>






