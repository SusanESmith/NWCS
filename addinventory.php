<?php
include('nwcsdatabase.php');
/*$query='INSERT INTO STOCK (PRODUCT_ID, STORE_ID, CATEGORY_ID, STOCK_QTY, STOCK_MIN_QTY)
VALUES (:PRODUCT_ID,:STORE_ID,:CATEGORY_ID,:STOCK_QTY, :STOCK_MIN_QTY)';

$statement= $db->prepare($query);
$statement->bindValue(':PRODUCT_ID',$PRODUCT_ID);
$statement->bindValue(':STORE_ID',$STORE_ID);
$statement->bindValue(':CATEGORY_ID',$CATEGORY_ID);
$statement->bindValue(':STOCK_QTY',$STOCK_QTY);
$statement->bindValue(':STOCK_MIN_QTY',$STOCK_MIN_QTY);
$statement->execute();
$statement->closeCursor();*/

//get all categories from db
$CAT='SELECT * FROM CATEGORY';
$statement= $db->prepare($CAT);
$statement->execute();
$CATEGORIES = $statement->fetchAll();
$statement->closeCursor();

$STORE='SELECT * FROM STORE';
$statement= $db->prepare($STORE);
$statement->execute();
$STORES = $statement->fetchAll();
$statement->closeCursor();

$VENDOR='SELECT * FROM VENDOR';
$statement= $db->prepare($VENDOR);
$statement->execute();
$VENDORS = $statement->fetchAll();
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
    <h1><span class="label label-primary">Add Inventory</h1>
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

  <form method="post" action="addinvquery.php" id="inventory" style="text-align:center">

    <div style="text-align:left">
      <label>Store ID:</label>
      <select name="store" class="form-control">
        <?php foreach ($STORES as $s):?>
        <option value="<?php echo $s['STORE_ID'];?>"><?php echo $s['STORE_ID'];?></option>
      <?php endforeach;  ?>
      </select>

    <label>Vendor:</label>
    <select name="vendor" class="form-control">
      <?php foreach ($VENDORS as $v):?>
      <option value="<?php echo $v['VENDOR_ID'];?>"><?php echo $v['VENDOR_NAME'];?></option>
    <?php endforeach;  ?>
    </select>

    <label>Category:</label>
    <select name="category" class="form-control">
      <?php foreach ($CATEGORIES as $c):?>
      <option value="<?php echo $c['CATEGORY_ID'];?>"><?php echo $c['CATEGORY_NAME'];?></option>
    <?php endforeach;  ?>
    </select>


    <div class="form-group">
  <label for="minStock"><strong>Minimum Stock Quantity: </strong></label>
<input name="minStock" type="text" class="form-control" id="minStock" placeholder="Minimum Stock Quantity for this Item">
  </div>

    <div class="form-group">
    <label for="quantity"><strong>Quantity: </strong></label>
  <input name="quantity" type="text" class="form-control" id="quantity" placeholder="Quantity of Item to Add">
    </div>

    <div class="form-group">
    <label for="prodName"><strong>Product Name: </strong></label>
  <input name="prodName" type="text" class="form-control" id="prodName" placeholder="Name of New Inventory Item">
    </div>

    <form class="form-inline">
  <div class="form-group">
    <label for="price">Price:</label>
    <div class="input-group">
      <div class="input-group-addon">$</div>
      <input name="price" type="text" class="form-control" id="price" placeholder="Price of Item">
      </div>
  </div>

  <div class="form-group">
  <label for="pDesc"><strong>Product Description: </strong></label>
<input name="pDesc" type="text" class="form-control" id="pDesc" placeholder="Short Description of This Product">
  </div>

  </div>
      <label>&nbsp;</label>
      <input type="submit"  class="btn btn-warning" value="Submit">
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
