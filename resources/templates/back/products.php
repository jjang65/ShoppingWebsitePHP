<?php require_once("../../resources/config.php"); ?>


<h1 class="page-header">
   All Products

</h1>
<h3 class="bg-danger"><?php display_message(); ?></h3>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>Title (Edit)</th>
           <th>Category</th>
           <th>Price</th>
           <th>Quantity</th>
      </tr>
    </thead>
    <tbody>

      <?php get_product_in_admin(); ?>
      

    </tbody>
</table>






