<?php
include('nwcsdatabase.php');
$busflag=0;
$iflag=0;

 ?>

<!DOCTYPE html>
<html lang="en">

 <head>
   <title>New Charge Account Request</title>
<meta charset="utf-8">

<!--get bootstrap requirements-->
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <link href="css/bootstrap-form-helpers.min.css" rel="stylesheet" media="screen">

<script src="js/bootstrap-formhelpers.min.js"></script>

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
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-user"></span>
      <?php echo '       Please enter the following information:  ';?>

</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >

  <form method="post" action="newcharge.php" id="newcharge" style="text-align:center">
      <div style="text-align:left" >
    <label>Select a Customer Type:</label>
  </div>

      <input type="submit" name="individual" class="btn btn-warning" value="Individual"><p></p><input type="submit" name="business" class="btn btn-warning" value="Business">
      <?php $new=filter_input(INPUT_POST,'business');
       $ind=filter_input(INPUT_POST,'individual');?>
       </form>
      <?php if (isset($new)){?>
        <form method="post" action="newchargequery.php" id="newcharge" style="text-align:center">
        <!--<div method="post" name="busFlag"><?php $busflag=1;?></div>-->
        <input name="busFlag" type= "hidden"  value="<?php echo $busflag;?>">
  <div style="text-align:left" >

    <div class="form-group">
    <label for="busName"><strong>Business Name: </strong></label>
  <input name="busName" type="text" class="form-control" id="busName" placeholder="Name of Business" required>
    </div>

    <div class="form-group">
    <label for="busLname"><strong>Point of Contact Last Name: </strong></label>
  <input name="busLname" type="text" class="form-control" id="busLname" placeholder="Last name of Point of Contact" required>
    </div>

    <div class="form-group">
    <label for="busFname"><strong>Point of Contact First Name: </strong></label>
  <input name="busFname" type="text" class="form-control" id="busFname" placeholder="First name of Point of Contact" required>
    </div>

    <div class="form-group">
    <label for="busAdd"><strong>Address: </strong></label>
    <input name="busAdd" type="text" class="form-control" id="busAdd" placeholder="Business Street Address" required>
    </div>

    <div class="form-group">
    <label for="busCity"><strong>City: </strong></label>
  <input name="busCity" type="text" class="form-control" id="busCity" placeholder="City" required>
    </div>

    <div class="form-group">
    <label for="busState"><strong>State: </strong></label>
    <select name="busState" class="form-control bfh-states" data-country="US" required>

    </select>    </div>

    <div class="form-group">
    <label for="busZip"><strong>Zip Code: </strong></label>
  <input name="busZip" type="text" class="form-control" id="busZip" placeholder=" Zip Code" required>
    </div>

    <div class="form-group">
    <label for="busPhone"><strong>Phone Number: </strong></label>
  <input name="busPhone" type="text" class="input-medium bfh-phone form-control" data-format="ddd-ddd-dddd" id="busPhone" placeholder="Phone Number" required>
    </div>
    <div class="form-group">
      <label for="limit"><strong>Charge Account Limit: </strong></label>

      <div class="input-group">
      <div class="input-group-addon">$</div>
  <input name="limit" type="text" class="form-control"  id="phone" placeholder="Charge Account Limit" required>
    </div>

  </div>

</div>
      <br><br>
      <label>&nbsp;</label>
      <input type="submit" class="btn btn-warning" value="Submit">
    </form>
<?php  }
else if (isset($ind)){ ?>
  <form method="post" action="newchargequery.php" id="newcharge" style="text-align:center">
<!--<div method="post" name="iFlag"><?php $iflag=1; ?> </div>-->
<input name="iFlag" type="hidden" value="<?php echo $iflag;?>">

<div style="text-align:left" >
  <br>
  <div class="form-group">
  <label for="lastName"><strong>Customer Last Name: </strong></label>
<input name="lastName" type="text" class="form-control" id="lastName" placeholder="Last name of Customer" required>
  </div>

  <div class="form-group">
  <label for="firstName"><strong>Customer First Name: </strong></label>
<input name="firstName" type="text" class="form-control" id="firstName" placeholder="First name of Customer" required>
  </div>

  <div class="form-group">
  <label for="add"><strong>Address: </strong></label>
  <input name="add" type="text" class="form-control" id="add" placeholder="Street Address" required>
  </div>

  <div class="form-group">
  <label for="city"><strong>City: </strong></label>
<input name="city" type="text" class="form-control" id="city" placeholder="City" required>
  </div>

  <div class="form-group">
  <label for="state"><strong>State: </strong></label>
  <select name="state" class="form-control bfh-states" data-country="US" required>

  </select>
  </div>

  <div class="form-group">
  <label for="zip"><strong>Zip Code: </strong></label>
<input name="zip" type="text" class="form-control" id="zip" placeholder="Zip Code" required>
  </div>

  <div class="form-group">
  <label for="phone"><strong>Phone Number: </strong></label>
<input name="phone" type="text" class="input-medium bfh-phone form-control"  data-format="ddd-ddd-dddd" id="phone" placeholder="Phone Number" required>
  </div>

  <div class="form-group">
  <label for="limit"><strong>Charge Account Limit: </strong></label>
    <div class="input-group">
    <div class="input-group-addon">$</div>
<input name="limit" type="text" class="form-control"  id="limit" placeholder="Charge Account Limit" required>
  </div>

</div>

</div>
    <br><br>
    <label>&nbsp;</label>
    <input type="submit" class="btn btn-warning" value="Submit">
  </form>
  <?php  }?>

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
