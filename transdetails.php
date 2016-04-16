<!DOCTYPE html>
<?php
session_start();
include('nwcsdatabase.php');
$transID = $_SESSION["transID"];
//echo $_SESSION["transID"];

/*
$query = "SELECT * FROM TRANSACTION_DETAILS WHERE TRANSACTION_ID = :transID";

$statement = $db->prepare($query);
$statement->bindValue(':transID', $transID);
$statement->execute();
$transaction = $statement->fetchAll();
$statement->closeCursor();
*/

$query2 = "SELECT * FROM TRANSACTIONS WHERE TRANSACTION_ID = :transID";
$statement2 = $db->prepare($query2);
$statement2->bindValue(':transID', $transID);
$statement2->execute();
$details = $statement2->fetch();
$statement2->closeCursor();

$query3 = "SELECT TD.PRODUCT_ID, PRODUCT_NAME, TRANS_PROD_TOTAL, TRANS_PROD_QTY FROM NWCS.TRANSACTIONS T, NWCS.PRODUCTS P, NWCS.TRANSACTION_DETAILS TD WHERE P.PRODUCT_ID = TD.PRODUCT_ID AND TD.TRANSACTION_ID = T.TRANSACTION_ID AND T.TRANSACTION_ID = :transID";
$statement3 = $db->prepare($query3);
$statement3->bindValue(':transID', $transID);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();

?>
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
          <th>Transaction Type</th>
          <th>Store ID</th>
          <th>Transaction Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $transID ?></td>
          <td><?php
                foreach($products as $p)
                {
                    echo $p['PRODUCT_NAME']." x".$p['TRANS_PROD_QTY']."<br>";
                }
              ?></td>
          <td><?php                 
              foreach($products as $p)
                {
                    echo $p['TRANS_PROD_TOTAL']."<br>";
                } 
              ?></td>
          <td><?php echo $details['TRANSACTION_TOTAL']; ?></td>
          <td>Card</td>
          <td><?php echo $details['STORE_ID']; ?></td>
          <td><?php echo $details['TRANSACTION_DATE']; ?></td>
        </tr>

        </tr>
      </tbody>
    </table>
  </div>
  </div>
</div>
</div>

  </body>
  </html>




  </div>
  <p><strong><a href="reporting.php">Back to the Reporting Menu</a></strong></p>
  <p><strong><a href="empprofile.php">Back to the Employee Profile Menu</a></strong></p>

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
