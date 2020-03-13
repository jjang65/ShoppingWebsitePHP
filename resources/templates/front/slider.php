<?php 

    require_once(__DIR__ . DIRECTORY_SEPARATOR . "../../connect.php");

    $query = "SELECT * FROM products";
    $row_count_statement = $db->prepare($query);
    $row_count_statement->execute();

    // get total number of rows in orders table
    $row_cnt = $row_count_statement->rowCount();

    // get starting row to be shown
    $showrows = 6;
    if($row_cnt < 6){
        $showrows = $row_cnt;
        $startrow = $row_cnt - $showrows;
    }else{
        $startrow = $row_cnt - $showrows;
    }

    // get query that selects oders from 8 latest orders
    $new_query = "SELECT * FROM products LIMIT $startrow, $showrows ";
    $statement = $db->prepare($new_query);  
    $statement->execute();
    $quotes = $statement->fetchAll();

 ?>


<section class="ftco-section ftco-product">
    	<div class="container">
    		<div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<h1 class="big">Trending</h1>
            <h2 class="mb-4">Trending</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="product-slider owl-carousel ftco-animate">


        <?php foreach($quotes as $quote): ?>
        <div class="item">
            <div class="product">
                <a href="product-single.php?id=<?= $quote['id'] ?>" class="img-prod"><img class="img-fluid" src="resources/uploads/<?= $quote['image'] ?>" alt="Colorlib Template">
            </a>
                <div class="text pt-3 px-3">
                    <h3><a href="product-single.php?id=<?= $quote['id'] ?>"><?= $quote['title'] ?></a></h3>
                    <div class="d-flex">
                        <div class="pricing">
                            <p class="price"><span class="price-sale">&#36;<?= $quote['price'] ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach ?>


    				</div>
    			</div>
    		</div>
    	</div>
    </section>