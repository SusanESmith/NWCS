<?php
require_once('nwcsdatabase.php');

$query = "SELECT T.TRANSACTION_ID, P.PRODUCT_NAME, TRANS_PROD_TOTAL, TRANSACTION_TOTAL, STORE_ID, TRANSACTION_TYPE, T.TRANSACTION_DATE
FROM TRANSACTIONS T, TRANSACTION_DETAILS TD, PRODUCTS P 
WHERE P.PRODUCT_ID = T.PRODUCT.ID
AND T.TRANSACTION_ID = TD.TRANSACTION_ID
AND EMPLOYEE_ID = 1001";

$statement = $db->prepare($query);
$statement->execute();
$transaction = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Transaction Details</title>
<meta charset="utf-8">

<!--get bootstrap requirements-->
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <meta name="viewport" content="width=device-width, initial-scale=1">
<!--background-->
<style>
 body{
   background-color: #4C99B6;
 }
</style>
</head>


<body>
  <div class="container">
     <div class="row">
       <div class="col-md-10 col-md-offset-1">
<?php $test=""?>
<div class="page-header" style="text-align: center">
    <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
      <br>
    <h1><span class="label label-primary">Transaction Details</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo 'Transaction Details for (transaction num):';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >






  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
        <!--<h3><span class="label label-primary">In stock items at (store number)</h3>-->
      <!--<p>The .table-striped class adds zebra-stripes to a table:</p>-->
        <div class="table-responsive">
    <table class="table table-striped"style="text-align:left">

      <thead>
        <tr>
          <th>Transaction ID</th>
          <th>Product</th>
          <th>Price</th>
          <th>Transaction Total</th>
          <th>Store ID</th>
          <th>Transaction Type</th>
          <th>Transaction Date</th>
        </tr>
      </thead>
      <tbody>
	  <?php foreach ($transaction as $t) { ?>
        <tr>
          <td><a href="transdetails.php"><?php echo $t['TRANSACTION_ID'] ?></a></td>
          <td><?php echo $t['PRODUCT_NAME'] ?></td>
          <td><?php echo $t['TRANS_PROD_TOTAL'] ?></td>
          <td><?php echo $t['TRANSACTION_TOTAL'] ?></td>
          <td><?php echo $t['STORE_ID'] ?></td>
          <td><?php echo $t['TRANSACTION_TYPE'] ?></td>
          <td><?php echo $t['TRANSACTION_DATE'] ?></td>
        </tr>
	  <?php } ?>
      </tbody>
    </table>
  </div>
  </div>
</div>
</div>

  </body>
  </html>




  </div>
  <p><strong><a href="empprofile.php">Back to the Employee Profile</a></strong></p>
  <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
  <p><strong><a href="logout.php">Click here to logout</a></strong></p>


  </div>
</div>
<?php
echo "The date is ".date("Y-m-d ")."and the time is ".date("h:i:sa "); ?>

  </div>
</div>
</div>

</body>
</html>
