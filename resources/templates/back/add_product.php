<?php require_once("../../resources/config.php"); ?>
<?php 

use \Gumlet\ImageResize;

if(isset($_POST['publish'])){

  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $cat_id = filter_input(INPUT_POST, 'cat_id', FILTER_SANITIZE_NUMBER_INT);
  $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
  $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $short_description = filter_input(INPUT_POST, 'short_description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $in_stock = filter_input(INPUT_POST, 'in_stock', FILTER_SANITIZE_NUMBER_INT);

  $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

  // If the user uploaded new image file
  if ($image_upload_detected) {
    echo "if statement executed";
    $image_filename = $_FILES['image']['name'];
    $temporary_image_path = $_FILES['image']['tmp_name'];
    $new_image_path = file_upload_path($image_filename);
    if (file_is_an_image($temporary_image_path, $new_image_path)) {
      move_uploaded_file($temporary_image_path, $new_image_path);

      // Resize image
      $image = new ImageResize($new_image_path);
      $image->resizeToWidth(450);
      $image->save($new_image_path . '_medium.ext');
      $image_filename = $image_filename . '_medium.ext';

      $query_insert = "INSERT INTO products (title, cat_id, price, in_stock, description, short_description, image) VALUES (:title, :cat_id, :price, :in_stock, :description, :short_description, :image)";
      $statement_insert = $db->prepare($query_insert);
      $bind_values = [ 'title' => $title
                    , 'cat_id' => $cat_id
                    , 'price' => $price
                    , 'in_stock' => $in_stock
                    , 'description' => $description
                    , 'short_description' => $short_description
                    , 'image' => $image_filename ];
      $statement_insert->execute($bind_values);

      set_message("Product has been added");
      redirect("index.php?products");
      exit();


    } else {
      set_message("File format should be jpg, jpeg, gif, or png");
      redirect("index.php?products");
    }
    // If the user did not upload new image file
  } else {
    echo "else executed";
    $query_insert = "INSERT INTO products (title, cat_id, price, in_stock, description, short_description) VALUES (:title, :cat_id, :price, :in_stock, :description, :short_description)";
    $statement_insert = $db->prepare($query_insert);
    $bind_values_without_image = ['title' => $title
                                  , 'cat_id' => $cat_id
                                  , 'price' => $price
                                  , 'in_stock' => $in_stock
                                  , 'description' => $description
                                  , 'short_description' => $short_description ];
    $statement_insert->execute($bind_values_without_image);

    set_message("Product has been added");
    redirect("index.php?products");
    exit();
    
  }
}

$query = "SELECT * FROM categories";
$statement = $db->prepare($query);
$statement->execute();
$rows = $statement->fetchAll();

 ?>

<h1 class="page-header">
   Add Product
</h1>
               

<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

    <!-- Product Title-->
    <div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="title" class="form-control">
       
    </div>

    <!-- Product Description-->
    <div class="form-group">
      <label for="product-title">Product Description</label>
      <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>


    <!-- Product Price-->
    <div class="form-group row">
      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" step="0.01"  name="price" class="form-control" size="60">
      </div>
    </div>

    <!-- Product Short Description-->
    <div class="form-group">
      <label for="product-title">Product Short Description</label>
      <textarea name="short_description" id="" cols="30" rows="3" class="form-control"></textarea>
    </div>




    
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">
     
     <div class="form-group">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>

     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
        <select name="cat_id" id="" class="form-control">
            <option value="">Select Category</option>
            
            <?php foreach($rows as $row): ?>
              <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
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

    <!-- Product Quantity-->

    <div class="form-group">
      <label for="product-title">Product Quantity</label>
         <input class="form-control" type="number" name="in_stock">
    </div>


<!-- Product Tags -->


    <!-- <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div> -->

    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="image">
      
    </div>



</aside><!--SIDEBAR-->

</form>



                
