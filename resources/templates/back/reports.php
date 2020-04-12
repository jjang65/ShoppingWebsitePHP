<?php require_once("../../resources/config.php"); ?>
<?php 

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$query = "SELECT * FROM reports 
            JOIN products ON reports.product_id = products.id
            JOIN orders ON orders.id = reports.order_id
            WHERE reports.order_id = :id";
$statement = $db->prepare($query);
$statement->bindValue(':id', $id, PDO::PARAM_INT);
$statement->execute();
$rows = $statement->fetchAll();

 ?>

<h1 class="page-header">
   All Reports

</h1>
<?php toast_message(); ?>
<table class="table table-hover">


    <thead>

      <tr>
           <th>No</th>
           <th>Order Id</th>
           <th>Product Id</th>
           <th>Product title</th>
           <th>Product Price</th>
           <th>Product quantity</th>
           <th>Sub Total</th>

           <th>First Name</th>
           <th>Last Name</th>
           <th>Full Address</th>
           <th>Phone</th>
           <th>Delete</th>

      </tr>
    </thead>
    <tbody>

      <?php foreach($rows as $row): ?>
        <tr>
          <td><?= $row[0] ?></td>
          <td><?= $row['order_id'] ?></td>
          <td><?= $row['product_id'] ?></td>
          <td><?= $row['title'] ?></td>
          <td><?= $row['product_price'] ?></td>
          <td><?= $row['product_quantity'] ?></td>
          <td>$<?= $row['product_price'] * $row['product_quantity'] ?></td>
          <td><?= $row['firstname'] ?></td>
          <td><?= $row['lastname'] ?></td>
          <td><?= $row['address'] . ' ' . $row['address2'] . ' ' . $row['towncity'] . ' ' . $row['postal'] . ' ' . $row['province'] ?></td>
          <td><?= $row['phone'] ?></td>
          <td><a class="btn btn-danger" href="index.php?delete_report_id=<?= $row[0] ?>&order_id=<?= $id ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr> 
      <?php endforeach ?>

  </tbody>
</table>