<?php require_once("../../resources/config.php"); ?>
<?php 

$query = "SELECT * FROM orders";
$statement = $db->prepare($query);
$statement->execute();
$rows = $statement->fetchAll();

 ?>

<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders

</h1>
  <h4 class="bg-danger">
     <?php toast_message(); ?>
  </h4>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>No</th>
           <th>Email</th>
           <th>Amount</th>
           <th>Transfer Fee</th>
           <th>Transaction</th>
           <th>Currency</th>
           <th>Status</th>
<!--            <th>First name</th>
           <th>Last name</th>
           <th>Address</th>
           <th>Address2</th>
           <th>Town/City</th>
           <th>Postal code</th>
           <th>Province</th>
           <th>Phone</th> -->
           <th>Date Time</th>
           <th>Delete</th>
           <th>Details</th>
      </tr>
    </thead>
    <tbody>
        
      <?php foreach($rows as $row): ?>
        <tr>
            <td><a href="index.php?reports&id=<?= $row['id'] ?>"><?= $row['id'] ?></a></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['amount'] ?></td>
            <td><?= $row['transfer_fee'] ?></td>
            <td><?= $row['transaction'] ?></td>
            <td><?= $row['currency'] ?></td>
            <td><?= $row['status'] ?></td>
<!--             <td><?= $row['firstname'] ?></td>
            <td><?= $row['lastname'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['address2'] ?></td>
            <td><?= $row['towncity'] ?></td>
            <td><?= $row['postal'] ?></td>
            <td><?= $row['province'] ?></td>
            <td><?= $row['phone'] ?></td> -->
            <td><?= $row['date_created'] ?></td>
            <td><a class="btn btn-danger" href="index.php?delete_order_id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
            <td><a class="btn btn-info" href="index.php?reports&id=<?= $row['id'] ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
        </tr>
      <?php endforeach ?>

    </tbody>
</table>
</div>
