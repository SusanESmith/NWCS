<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Register Count</title>
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
    <h1><span class="label label-primary">Register Count</h1>
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

  <form method="post" action="drawerquery.php" id="register" style="text-align:center">

      <br><br>
      <label><strong>One Hundred Dollar Bills: </strong></label>
      <input name="hundred" type="text">
      <br><br>
      <label><strong>Fifty Dollar Bills: </strong></label>
      <input name="fifty" type="text">
      <br><br>
      <label><strong>Twenty Dollar Bills: </strong></label>
      <input name="twenty" type="text">
      <br><br>
      <label><strong>Ten Dollar Bills: </strong></label>
      <input name="ten" type="text">
      <br><br>
      <label><strong>Five Dollar Bills: </strong></label>
      <input name="five" type="text">
      <br><br>
      <label><strong>One Dollar Bills: </strong></label>
      <input name="one" type="text">
      <br><br>
      <label><strong>Quarters: </strong></label>
      <input name="quarters" type="text">
      <br><br>
      <label><strong>Dimes: </strong></label>
      <input name="dimes" type="text">
      <br><br>
      <label><strong>Nickels: </strong></label>
      <input name="nickels" type="text">
      <br><br>
      <label><strong>Pennies: </strong></label>
      <input name="pennies" type="text">
      <br><br>
      <label><strong>Number of Checks: </strong></label>
      <input name="checks" type="text">
      <br><br>
      <label><strong>Number of Card Transactions: </strong></label>
      <input name="card" type="text">
      <br><br>
      <label><strong>Register ID Number: </strong></label>
      <input name="register" type="text">
      <br><br>
      <label><strong>Store ID Number: </strong></label>
      <input name="store" type="text">
      <br><br>
      <br><br>
      <label>&nbsp;</label>
      <input type="submit" value="Submit">
    </form>

  </div>
  <p><strong><a href="cashiermenu.php">Back to the Cashier Menu</a></strong></p>
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
