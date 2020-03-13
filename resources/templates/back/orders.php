<?php require_once("../../resources/config.php"); ?>


<div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders

</h1>
  <h4 class="bg-danger">
     <?php display_message(); ?>
  </h4>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>No</th>
           <th>Amount</th>
           <th>Transaction</th>
           <th>Currency</th>
           <th>Status</th>
           <th>Firstname</th>
           <th>Lastname</th>
           <th>Province</th>
           <th>Address</th>
           <th>Address2</th>
           <th>Town/City</th>
           <th>Postal code</th>
           <th>Phone</th>
           <th>Email</th>
           <th>Order Date</th>
           <th>Order Time</th>
      </tr>
    </thead>
    <tbody>
        <?php display_orders(); ?>
    </tbody>
</table>
</div>
