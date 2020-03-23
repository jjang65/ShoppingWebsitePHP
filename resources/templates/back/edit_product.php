<?php require_once("../../resources/config.php"); ?>


<?php 

set_message("Product has been Updated");


if(isset($_GET['id'])){
  $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM products WHERE id = :id";
  $statement = $db->prepare($query);
  $statement->bindValue(':id', $id, PDO::PARAM_INT);
  $statement->execute();
  $rows = $statement->fetchAll();

  foreach($rows as $row) {
    $title = $row['title'];
    $cat_id = $row['cat_id'];
    $price = $row['price'];
    $description = $row['description'];
    $short_description = $row['short_description'];
    $in_stock = $row['in_stock'];
    $image = $row['image'];

    $category_query = "SELECT * FROM categories WHERE id = $cat_id";
    $statement_cat = $db->prepare($category_query);
    $statement_cat->execute();
    $cat = $statement_cat->fetch();

    $query_all_categories = "SELECT * FROM categories";
    $statement_all_categories = $db->prepare($query_all_categories);
    $statement_all_categories->execute();
    $categories = $statement_all_categories->fetchAll();
  }
}

// When user clicks update
if(isset($_POST['update'])){

  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $cat_id = filter_input(INPUT_POST, 'cat_id', FILTER_SANITIZE_NUMBER_INT);
  $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $short_description = filter_input(INPUT_POST, 'short_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $in_stock = filter_input(INPUT_POST, 'in_stock', FILTER_SANITIZE_NUMBER_INT);

  $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

  // If the user uploaded new image file
  if ($image_upload_detected) {
    $image_filename = $_FILES['image']['name'];
    $temporary_image_path = $_FILES['image']['tmp_name'];
    $new_image_path = file_upload_path($image_filename);
    if (file_is_an_image($temporary_image_path, $new_image_path)) {
      move_uploaded_file($temporary_image_path, $new_image_path);

      $query_update = "UPDATE products SET title = :title
                                          , cat_id = :cat_id
                                          , price = :price
                                          , in_stock = :in_stock
                                          , description = :description
                                          , short_description = :short_description
                                          , image = :image 
                                   WHERE id = :id";
      $statement_update = $db->prepare($query_update);
      $bind_values = ['title' => $title
                    , 'cat_id' => $cat_id
                    , 'price' => $price
                    , 'in_stock' => $in_stock
                    , 'description' => $description
                    , 'short_description' => $short_description
                    , 'image' => $image_filename
                    , 'id' => $id ];
      $statement_update->execute($bind_values);
    } 
    // If the user did not upload new image file
  } else {

    $query_update_without_image = "UPDATE products SET title = :title
                                                      , cat_id = :cat_id
                                                      , price = :price
                                                      , in_stock = :in_stock
                                                      , description = :description
                                                      , short_description = :short_description
                                                      , id = :id
                                 WHERE id = :id";
    $statement_update = $db->prepare($query_update_without_image);
    $bind_values_without_image = ['title' => $title
                                  , 'cat_id' => $cat_id
                                  , 'price' => $price
                                  , 'in_stock' => $in_stock
                                  , 'description' => $description
                                  , 'short_description' => $short_description
                                  , 'id' => $id ];
    $statement_update->execute($bind_values_without_image);
    
  }

  set_message("Product has been Updated");
  redirect("index.php?products");
  exit();

}



?>








<div class="row">
<h1 class="page-header">
   Edit Product

</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="title" class="form-control" value="<?= $title; ?>">
       
    </div>

    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="description" id="" cols="30" rows="10" class="form-control"><?= $description ?></textarea>
    </div>

    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" step="0.01" name="price" class="form-control" size="60" value="<?= $price ?>">
      </div>
    </div>

    <div class="form-group">
           <label for="product-title">Product Short Description</label>
      <textarea name="short_description" id="" cols="30" rows="3" class="form-control"><?= $short_description ?></textarea>
    </div>


</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <!-- <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft"> -->
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
        <select name="cat_id" id="" class="form-control">
           
          <?php foreach($categories as $category): ?>

            <option value="<?= $category['id'] ?>" <?=$cat_id == $category['id'] ? ' selected="selected"' : '';?>><?= $category['title'] ?></option>

          <?php endforeach ?>

        </select>


</div>


    <!-- Product Brands-->


    <!-- <div class="form-group">
      <label for="product-title">Product Brand</label>
         <select name="product_brand" id="" class="form-control">
            <option value="">Select Brand</option>
         </select>
    </div> -->


    <div class="form-group">
      <label for="product-title">Product Quantity</label>
         <input class="form-control" type="number" name="in_stock" value="<?= $in_stock ?>">
    </div>


<!-- Product Tags -->


    <!-- <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div> -->

    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label> <br>
            <img width='200' src="../resources/uploads/<?= $image ?>" alt="<?= $image ?>">
        <input type="file" name="image">
    </div>



</aside><!--SIDEBAR-->


    
</form>
