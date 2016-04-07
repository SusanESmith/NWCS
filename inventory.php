<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Inventory</title>
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
    <h1><span class="label label-primary">Inventory</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
      <?php echo 'Please pick an option below:';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >
  <button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='queryinventory.php'"><strong>Look at Current Inventory</strong></button>
  <br><br>
  <button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='addinventory.php'"><strong>Add Inventory</strong></button>
  <br><br>
  <button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='updateinventory.php'"><strong>Update Current Inventory</strong></button>
  <br><br>
  <button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='storeIDinv.php'"><strong>Items Below Minimum Inventory Quantity</strong></button>


  </div>


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