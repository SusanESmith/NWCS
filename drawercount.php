<?php
include('nwcsdatabase.php');
$STORE='SELECT * FROM STORE';
$statement1= $db->prepare($STORE);
$statement1->execute();
$STORES = $statement1->fetchAll();
$statement1->closeCursor();


 ?>
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

  <form method="post" action="drawercount.php" id="register" style="text-align:center">
  <div style="text-align:left">
    <label>Store ID:</label>
    <select name="store" class="form-control">
      <?php foreach ($STORES as $s):?>
      <option value="<?php echo $s['STORE_ID'];?>"><?php echo $s['STORE_ID']." - ".$s['STORE_ADDRESS'];?></option>
    <?php endforeach;  ?>
    </select>
  </div>
  <br>
    <input name="storebtn" type="submit"  class="btn btn-warning" id="storebtn" value="Confirm Store">

  </form>
  <?php $new=filter_input(INPUT_POST,'storebtn');
  if (isset($new)){

    $storeNum= filter_input(INPUT_POST, 'store');
    //echo $storeNum;
    $reg='SELECT REGISTER_ID FROM REGISTER WHERE :store=REGISTER.STORE_ID';
    $statement1= $db->prepare($reg);
   $statement1->bindValue(':store', $storeNum);
    $statement1->execute();
    $register = $statement1->fetchAll();
    $statement1->closeCursor();

    $mgr='SELECT MANAGER_ID FROM MANAGEMENT WHERE :store=MANAGEMENT.STORE_ID';
    $statement2= $db->prepare($mgr);
    $statement2->bindValue(':store', $storeNum);
    $statement2->execute();
    $manager = $statement2->fetchAll();
    $statement2->closeCursor();
     ?>

    <form method="post" name="reg" action="drawerquery.php" id="newemp" style="text-align:center">


<div style="text-align:left">
    <label>Register ID:</label>
    <select name="register" class="form-control">
      <?php foreach ($register as $r):?>
      <option value="<?php echo $r['REGISTER_ID'];?>"><?php echo $r['REGISTER_ID'];?></option>
    <?php endforeach;  ?>
    </select>

    <label>Manager:</label>
    <select name="manager" class="form-control">
      <?php foreach ($manager as $m):?>
      <option value="<?php echo $m['MANAGER_ID'];?>"><?php echo $m['MANAGER_ID'];?></option>
    <?php endforeach;  ?>
    </select>

      <div class="form-group">
      <label for="hundred"><strong>$ 100's: </strong></label>
    <input name="hundred" type="text" class="form-control" id="hundred" placeholder="Number of One Hundred Dollar Bills" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="fifty"><strong>$ 50's: </strong></label>
    <input name="fifty" type="text" class="form-control" id="fifty" placeholder="Number of Fifty Dollar Bills" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="twenty"><strong>$ 20's: </strong></label>
    <input name="twenty" type="text" class="form-control" id="twenty" placeholder="Number of Twenty Dollar Bills" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="ten"><strong>$ 10's: </strong></label>
    <input name="ten" type="text" class="form-control" id="ten" placeholder="Number of Ten Dollar Bills" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="five"><strong>$ 5's: </strong></label>
    <input name="five" type="text" class="form-control" id="five" placeholder="Number of Five Dollar Bills" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="one"><strong>$ 1's: </strong></label>
    <input name="one" type="text" class="form-control" id="one" placeholder="Number of One  Dollar Bills" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="quarters"><strong>25 &cent;: </strong></label>
    <input name="quarters" type="text" class="form-control" id="quarters" placeholder="Number of Quarters" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="dimes"><strong>10 &cent;: </strong></label>
    <input name="dimes" type="text" class="form-control" id="dimes" placeholder="Number of Dimes" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="nickels"><strong>5 &cent;: </strong></label>
    <input name="nickels" type="text" class="form-control" id="nickels" placeholder="Number of Nickels" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="pennies"><strong>1 &cent;: </strong></label>
    <input name="pennies" type="text" class="form-control" id="pennies" placeholder="Number of Pennies" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="checks"><strong>Checks: </strong></label>
    <input name="checks" type="text" class="form-control" id="checks" placeholder="Number of Checks" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

      <div class="form-group">
      <label for="card"><strong>Cards: </strong></label>
      <input name="card" type="text" class="form-control" id="card" placeholder="Number of Card Transactions" required data-fv-notempty-message="The Price is required.  If you don't wish to change it, use the current value.">
      </div>

    </div>
      <label>&nbsp;</label>
      <input name="store" type="hidden" class="form-control" id="store" value="<?php echo $storeNum?>">
      <input type="submit" class="btn btn-warning" value="Submit">
    </form>
<?php }?>
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
