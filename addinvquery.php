<?php
$storeID = filter_input(INPUT_POST, 'store');
//$productID = filter_input(INPUT_POST, 'productID');
$quantity = filter_input(INPUT_POST, 'quantity');
$price = filter_input(INPUT_POST, 'price');
$date = date("Y-m-d");
$pDesc = filter_input(INPUT_POST, 'pDesc');
$vendor = filter_input(INPUT_POST, 'vendor');
$category=filter_input(INPUT_POST, 'category');
$minStock=filter_input(INPUT_POST, 'minStock');
$prodName=filter_input(INPUT_POST, 'prodName');
require_once('nwcsdatabase.php');
//$productName= 'test item';



//insert new inv into product table
  $queryProduct='INSERT INTO PRODUCTS
                 (PRODUCT_NAME, VENDOR_ID, CATEGORY_ID, PRODUCT_DESCRIPTION, PRODUCT_PRICE)
              VALUES
                 (:productName, :vendor, :cat, :pDesc, :price)';

  $statement = $db->prepare($queryProduct);
  $statement->bindValue(':productName', $prodName);
//  $statement->bindValue(':prodID', $productID);
   //$statement->bindValue(':productName', $productName);
 $statement->bindValue(':vendor', $vendor);
 $statement->bindValue(':cat', $category);
 $statement->bindValue(':pDesc', $pDesc);
 $statement->bindValue(':price', $price);
 $statement->execute();
$statement->closeCursor();

//$selectProdID='SELECT PRODUCT_ID FROM PRODUCTS WHERE ';
//insert new inv into stock table

$pID='SELECT PRODUCT_ID FROM PRODUCTS WHERE PRODUCT_ID=LAST_INSERT_ID()';
$statement2= $db->prepare($pID);
$statement2->execute();
$prodID= $statement2->fetchColumn();
$statement2->closeCursor();

//echo $prodID;


$queryStock = 'INSERT INTO STOCK
               (PRODUCT_ID, STORE_ID, CATEGORY_ID, STOCK_QTY, STOCK_MIN_QTY, STOCK_LAST_RESTOCK)
            VALUES
               (LAST_INSERT_ID(),:storeID, :catID,:quantity, :stockMin, :stockLastRestock)';

  $statement1 = $db->prepare($queryStock);
  $statement1->bindValue(':storeID', $storeID);
  //$statement->bindValue(':prodID', $prodID);
  //$statement->bindValue(':productName', $productName);
  $statement1->bindValue(':quantity', $quantity);
  $statement1->bindValue(':catID', $category);
  $statement1->bindValue(':stockMin', $minStock);
  //$statement1->bindValue(':price', $price);
  $statement1->bindValue(':stockLastRestock', $date);
  $statement1->execute();
  $statement1->closeCursor();



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
        <?php echo 'You have successfully added to Store <span style=color:orange>'.$storeID.'</span>\'s inventory: ';?>
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
          <th>Minimum Stock Quantity</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Date Added</th>

        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $prodID;?></td>
          <td><?php echo $prodName;?></td>
          <td><?php echo $storeID;?></td>
          <td><?php echo $minStock;?></td>
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
