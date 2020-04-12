<?php require_once("../../resources/config.php"); ?>
<?php 



if(!isset($_GET['sort'])) {

    $query = "SELECT * FROM products";
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();

} else {

  $sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if($sort === 'AtoZ') {
    $query = "SELECT * FROM products ORDER BY title";
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
  } elseif($sort === 'ZtoA') {
    $query = "SELECT * FROM products ORDER BY title DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
  } elseif($sort === 'highest') {
    $query = "SELECT * FROM products ORDER BY price DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
  } elseif($sort === 'lowest') {
    $query = "SELECT * FROM products ORDER BY price";
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
  } elseif($sort === 'latest') {
    $query = "SELECT * FROM products ORDER BY id DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
  } elseif($sort === 'oldest') {
    $query = "SELECT * FROM products ORDER BY id";
    $statement = $db->prepare($query);
    $statement->execute();
    $items = $statement->fetchAll();
  }
}

 ?>


<h1 class="page-header">All Products<a class="btn btn-primary pull-right" href="index.php?add_product">Add Product</a></h1>

<!-- Sort selection buttons -->
<div class="btn-group col-md-12 mb-3">
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle sort" data-toggle="dropdown">
      Name <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="index.php?products&sort=AtoZ" class="sort">A - Z</a></li>
      <li><a href="index.php?products&sort=ZtoA" class="sort">Z - A</a></li>
    </ul>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle sort" data-toggle="dropdown">
      Price <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="index.php?products&sort=highest" class="sort">Highest</a></li>
      <li><a href="index.php?products&sort=lowest" class="sort">Lowest</a></li>
    </ul>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-primary dropdown-toggle sort" data-toggle="dropdown">
      Time <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" role="menu">
      <li><a href="index.php?products&sort=latest" class="sort">Latest</a></li>
      <li><a href="index.php?products&sort=oldest" class="sort">Oldest</a></li>
    </ul>
  </div>
</div>

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

  <?php foreach($items as $item): ?>        

    <?php 

      $cat_id = $item['cat_id'];
      $category_query = "SELECT * FROM categories WHERE id = :cat_id";
      $statement_cat = $db->prepare($category_query);
      $statement_cat->bindValue(':cat_id', $cat_id, PDO::PARAM_INT);
      $statement_cat->execute();
      $quote = $statement_cat->fetch();

     ?>

    <tr>
      <td><?= $item['id'] ?></td>
      <td><?= $item['title'] ?><br>
        <a href="index.php?edit_product&id=<?= $item['id'] ?>">
          <?php if(isset($item['image'])): ?>
            <img width="100" src="../resources/uploads/<?= $item['image'] ?>" alt="Product Image">
          <?php endif ?>
        </a>
      </td>
      <td><?= $quote['title'] ?></td>
      <td><?= $item['price'] ?></td>
      <td><?= $item['in_stock'] ?></td>
      <td><a class="btn btn-info" href="index.php?edit_product&id=<?= $item['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
      <td><a class="btn btn-danger" href="index.php?delete_product_id=<?= $item['id'] ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>

  <?php endforeach ?>

    </tbody>
</table>






