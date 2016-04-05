<?php
$storeID = filter_input(INPUT_POST, 'storeID');
$productID = filter_input(INPUT_POST, 'productID');
$quantity = filter_input(INPUT_POST, 'quantity');
$price = filter_input(INPUT_POST, 'price');
$date = filter_input(INPUT_POST, 'orderDate');
$productName= 'test item';

require_once('nwcsdatabase.php');

$query = 'INSERT INTO addInvTest
               (storeID, productID, productName, quantity, price, date)
            VALUES
               (:storeID, :productID,:productName, :quantity, :price,:orderDate)';

  $statement = $db->prepare($query);
  $statement->bindValue(':storeID', $storeID);
  $statement->bindValue(':productID', $productID);
  $statement->bindValue(':productName', $productName);

  $statement->bindValue(':quantity', $quantity);
  $statement->bindValue(':price', $price);
  $statement->bindValue(':orderDate', $date);

  $statement->execute();
  $statement->closeCursor();
 ?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Add Inventory</title>
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
    <h1><span class="label label-primary">Add Inventory</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo 'You have successfully added to Store '.$storeID.' inventory: ';?>
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
          <th>Product ID Number</th>
          <th>Product Name</th>
          <th>Store ID Number</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Date Added</th>

        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $productID;?></td>
          <td><?php echo $productName;?></td>
          <td><?php echo $storeID;?></td>
          <td><?php echo $quantity;?></td>
          <td><?php echo '$'.$price;?></td>
          <td><?php echo $date;?></td>

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
  <p><strong><a href="inventory.php">Back to the Inventory Menu</a></strong></p>
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
