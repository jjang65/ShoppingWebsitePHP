<?php 

	$query = "SELECT * FROM categories";
	$statement = $db->prepare($query);
	$statement->execute();
	$quotes = $statement->fetchAll();

 ?>

<div class="col-md-2">
	<p class="lead">Categories</p>

	<!-- get_categories function -->
	<!-- <div class="list-group">
	    <a href="#" class="list-group-item">Category 1</a>
	    <a href="#" class="list-group-item">Category 2</a>
	    <a href="#" class="list-group-item">Category 3</a>
	</div> -->

	<?php foreach($quotes as $quote): ?>
		<div class="list-group">
		    <a href="categories.php?id=<?= $quote['id'] ?>" class="list-group-item"><?= $quote['title'] ?></a>
		</div>
	<?php endforeach ?>
</div>