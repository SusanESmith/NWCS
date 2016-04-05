<!DOCTYPE html>
<html lang="en">

 <head>
   <title>New Charge Account Request</title>
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
    <h1><span class="label label-primary">New Charge Account Request</h1>
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

  <form method="post" action="newchargequery.php" id="reviewcharge" style="text-align:center">
      <div style="text-align:left" >
    <label>Customer Type:</label>
    <select name="custType" class="form-control">
      <!--drop down menu-->
      <option value="<?php echo "Individual";?>"><?php echo "Individual";?></option>
      <option value="<?php echo "Business";?>"><?php echo "Business";?></option>
    </select>

    <div class="form-group">
    <label for="busName"><strong>Business Name: </strong></label>
  <input name="busName" type="text" class="form-control" id="busName" placeholder="Name of Business">
    </div>

    <div class="form-group">
    <label for="custLName"><strong>Last Name: </strong></label>
  <input name="custLName" type="text" class="form-control" id="custLName" placeholder="Last name of Customer/Point of Contact">
    </div>

    <div class="form-group">
    <label for="custFName"><strong>First Name: </strong></label>
  <input name="custFName" type="text" class="form-control" id="custFName" placeholder="First name of Customer/Point of Contact">
    </div>

    <div class="form-group">
    <label for="address"><strong>Address: </strong></label>
    <input name="address" type="text" class="form-control" id="address" placeholder="Business/Individual Address">
    </div>

    <div class="form-group">
    <label for="city"><strong>City: </strong></label>
  <input name="city" type="text" class="form-control" id="city" placeholder="Business/Individual City">
    </div>

    <div class="form-group">
    <label for="state"><strong>State: </strong></label>
  <input name="state" type="text" class="form-control" id="state" placeholder="Business/Individual State">
    </div>

    <div class="form-group">
    <label for="zip"><strong>Zip Code: </strong></label>
  <input name="zip" type="text" class="form-control" id="zip" placeholder="Business/Individual Zip Code">
    </div>

    <div class="form-group">
    <label for="custPhone"><strong>Customer Phone Number: </strong></label>
  <input name="custPhone" type="text" class="input-medium bfh-phone; form-control" data-country="US" id="custPhone" placeholder="Phone Number">
    </div>

    <div class="form-group">
    <label for="date"><strong>Date of Request: </strong></label>
  <input name="date" type="date" class="form-control" id="date" placeholder="date">
    </div>
</div>
      <br><br>
      <label>&nbsp;</label>
      <input type="submit" class="btn btn-warning" value="Submit">
    </form>

  </div>
  <p><strong><a href="charge.php">Back to the Charge Accounts Menu</a></strong></p>
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
