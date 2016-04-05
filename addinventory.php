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
    <div class="form-group">
    <label for="storeID"><strong>Store ID: </strong></label>
  <input name="sID" type="text" class="form-control" id="storeID" placeholder="Store ID">
    </div>
    <div class="form-group">
    <label for="productID"><strong>Product ID Number: </strong></label>
  <input name="pID" type="text" class="form-control" id="productID" placeholder="Product ID">
    </div>
    <div class="form-group">
    <label for="quantity"><strong>Quantity: </strong></label>
  <input name="quantity" type="text" class="form-control" id="quantity" placeholder="Quantity of Item to Add">
    </div>
    <form class="form-inline">
  <div class="form-group">
    <label for="price">Price:</label>
    <div class="input-group">
      <div class="input-group-addon">$</div>
      <input type="text" class="form-control" id="price" placeholder="Price of Item">
      </div>
  </div>
  
    <div class="form-group">
    <label for="date"><strong>Date: </strong></label>
  <input name="date" type="date" class="form-control" id="date" placeholder="Date of Item Added">
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
