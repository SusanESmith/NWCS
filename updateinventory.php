<?php
/*$query='UPDATE STOCK SET PRODUCT_ID=$PRODUCT_ID, STORE_ID=$STORE_ID, PRICE=$PRICE, CATEGORY_ID=$CATEGORY_ID, STOCK_QTY=$STOCK_QTY,STOCK_MIN_QTY=$STOCK_MIN_QTY, DATE=$DATE
VALUES (:PRODUCT_ID,:STORE_ID,:CATEGORY_ID,:STOCK_QTY, :STOCK_MIN_QTY, :DATE)
WHERE STOCK.STORE_ID=STORE.STORE_ID AND PRODUCT.PRODUCT_ID=STOCK.PRODUCT_ID;';
$statement= $db->prepare($query);
$statement->bindValue(':PRODUCT_ID',$PRODUCT_ID);
$statement->bindValue(':STORE_ID',$STORE_ID);
$statement->bindValue(':CATEGORY_ID',$CATEGORY_ID);
$statement->bindValue(':STOCK_QTY',$STOCK_QTY);
$statement->bindValue(':STOCK_MIN_QTY',$STOCK_MIN_QTY);
$statement->bindValue(':DATE',$DATE);
$statement->execute();
$statement->closeCursor();*/

include('nwcsdatabase.php');
$PRODUCT='SELECT * FROM PRODUCTS';
$statement= $db->prepare($PRODUCT);
$statement->execute();
$PRODUCTS = $statement->fetchAll();
$statement->closeCursor();

$STORES='SELECT * FROM STORE';
$statement= $db->prepare($STORES);
$statement->execute();
$store = $statement->fetchAll();
$statement->closeCursor();
 ?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Update Inventory</title>
<meta charset="utf-8">

<!--get bootstrap requirements-->
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
       <div class="col-md-6 col-md-offset-3">
<?php $test=""?>
<div class="page-header" style="text-align: center">
    <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
      <br>
    <h1><span class="label label-primary">Update Inventory</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo 'Please enter the following information:';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >

  <form method="post" action="updateinvquery.php" id="inventory" style="text-align:center">
      <div style="text-align:left">
        <label>Product:</label>
        <select name="prodID" class="form-control">
          <?php foreach ($PRODUCTS as $p):?>
          <option value="<?php echo $p['PRODUCT_ID'];?>"><?php echo $p['PRODUCT_ID']." - ".$p['PRODUCT_NAME']." - ".$p['PRODUCT_DESCRIPTION'];?></option>
        <?php endforeach;  ?>
        </select>

        <label>Store ID:</label>
        <select name="storeID" class="form-control">
          <?php foreach ($store as $s):?>
          <option value="<?php echo $s['STORE_ID'];?>"><?php echo $s['STORE_ID']." - ".$s['STORE_ADDRESS'];?></option>
        <?php endforeach;  ?>
        </select>

        <form class="form-inline">
          <div class="form-group">
            <label for="price">Price: </label>
            <div class="input-group">
              <div class="input-group-addon">$</div>
              <input name="price" type="text" class="form-control" id="price" placeholder="Price of Item">
            </div>
          </div>

          <div class="form-group">
          <label for="stock"><strong>Add to Current Quantity: </strong></label>
          <input name="stock" type="text" class="form-control" id="stock" placeholder="Add Quantity to Current Stock">
          </div>

        <div class="form-group">
      <label for="min"><strong>Minimum Quantity: </strong></label>
      <input name="stockMin" type="text" class="form-control" id="min" placeholder="Minimum Item Quantity to be in Stock">
        </div>

        <div class="form-group">
      <label for="pDesc"><strong>Product Description: </strong></label>
      <input name="pDesc" type="text" class="form-control" id="pDesc" placeholder="Description of Product">
        </div>

        <div class="form-group">
      <label for="date"><strong>Date: </strong></label>
      <input name="date" value ="<?php echo date("Y-m-d");?>" type="date" class="form-control" id="date" placeholder="Date of Inventory Update">
        </div>
      </div>
      <label>&nbsp;</label>
      <input type="submit" class="btn btn-warning" value="Submit">
    </form>

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
