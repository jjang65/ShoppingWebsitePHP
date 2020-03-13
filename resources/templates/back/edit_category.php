<?php require_once("../../resources/config.php"); ?>


<?php 

if(isset($_GET['id'])){
    $query = query("SELECT * FROM categories WHERE cat_id= " . escape_string($_GET['id']) . " ");
    confirm($query);

    while($row = fetch_array($query)){
        $cat_id     = escape_string($row['cat_id']);
        $cat_title  = escape_string($row['cat_title']);

        update_category();
    }
}

 ?>

<h1 class="page-header">
  Edit Category
</h1>

<div class="col-md-4">

    <h3 class="bg-danger"><?php display_message(); ?></h3>
    
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" name="cat_title" class="form-control">
        </div>

        <div class="form-group">
            
            <input type="submit" name="update_category" class="btn btn-primary" value="Edit Category">
        </div>      

    </form>

</div>


<div class="col-md-8">

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Title</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th><?php echo $cat_id; ?></th>
                <th><?php echo $cat_title; ?></th>
            </tr>
        </tbody>

        </table>

</div>


