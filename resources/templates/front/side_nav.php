<?php 

	$query = "SELECT * FROM categories";
	$statement = $db->prepare($query);
	$statement->execute();
	$quotes = $statement->fetchAll();

 ?>

<!-- <div class="col-md-2">
	<p class="lead">Categories</p> -->

	<!-- get_categories function -->
	<!-- <div class="list-group">
	    <a href="#" class="list-group-item">Category 1</a>
	    <a href="#" class="list-group-item">Category 2</a>
	    <a href="#" class="list-group-item">Category 3</a>
	</div> -->

<!-- 	<?php foreach($quotes as $quote): ?>
		<div class="list-group">
		    <a href="categories.php?id=<?= $quote['id'] ?>" class="list-group-item"><?= $quote['title'] ?></a>
		</div>
	<?php endforeach ?> -->


<!-- </div> -->


     <!-- Product Categories-->

    <div class="col-md-2">
        <label for="title">Categories</label>
        <select name="cat_id" id="title" class="form-control" onchange="location = this.value;">
			<option value="" >Choose category</option>
			<option value="shop.php" >All products</option>

          <?php foreach($quotes as $quote): ?>

            <option value="categories.php?id=<?= $quote['id'] ?>" ><?= $quote['title'] ?></option>

          <?php endforeach ?>

        </select>
    </div>