<?php require_once("../../resources/config.php"); ?>

<?php add_category(); ?>

<h1 class="page-header">
  Product Categories
</h1>

<div class="col-md-4">

    <h3 class="bg-danger"><?php display_message(); ?></h3>
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" name="cat_title" class="form-control">
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
            <th>Title (Edit)</th>
        </tr>
            </thead>


    <tbody>
        <?php echo show_categories_in_admin(); ?>
    </tbody>

        </table>

</div>


