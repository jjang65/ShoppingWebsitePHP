<?php require_once("../../resources/config.php"); ?>


<?php 

    if(isset($_GET['id'])){
        $query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
        confirm($query);

        while($row = fetch_array($query)){
            $product_title          = escape_string($row['product_title']);
            $product_category_id    = escape_string($row['product_category_id']);
            $product_price          = escape_string($row['product_price']);
            $product_desc           = escape_string($row['product_desc']);
            $product_short_desc     = escape_string($row['product_short_desc']);
            $product_in_stock       = escape_string($row['product_in_stock']);
            $product_image          = escape_string($row['product_image']);

            update_product();
        }
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
        <input type="text" name="product_title" class="form-control" value="<?php echo $product_title; ?>">
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_desc" id="" cols="30" rows="10" class="form-control"><?php echo $product_desc; ?></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60" value="<?php echo $product_price; ?>">
      </div>
    </div>

    <div class="form-group">
           <label for="product-title">Product Short Description</label>
      <textarea name="product_short_desc" id="" cols="30" rows="3" class="form-control"><?php echo $product_short_desc; ?></textarea>
    </div>


</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
          <hr>
        <select name="product_category_id" id="" class="form-control">
            <option value="<?php echo $product_category_id; ?>"><?php echo show_product_category_title($product_category_id); ?></option>
           <?php show_categories_add_product(); ?>
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
         <input class="form-control" type="number" name="product_in_stock" value="<?php echo $product_in_stock; ?>">
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
            <img width='200' src="../resources/uploads/<?php echo $product_image; ?>" alt="">
        <input type="file" name="file">
    </div>



</aside><!--SIDEBAR-->


    
</form>
