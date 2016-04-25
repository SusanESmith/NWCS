<?php $lifetime=60*60*24*14;
session_set_cookie_params($lifetime,'/');
session_start();
date_default_timezone_set('America/Chicago');
//echo $_SESSION['login_user'];

include('nwcsdatabase.php');
$STORE='SELECT * FROM STORE';
$statement= $db->prepare($STORE);
$statement->execute();
$STORES = $statement->fetchAll();
$statement->closeCursor();




/*<div class="alert alert-warning" role="alert">
  <span class="glyphicon glyphicon-check" aria-hidden="true"></span>
  <span class=""><strong>  Current Inventory Information for <u>Item</u>: <?php echo $curPrice['PRODUCT_NAME']." - <u>Product ID:</u> ". $prodID ?> at <u>Store</u> <?php echo $storeID ?>:</strong></span><br><br>
  <strong>Price: </strong> <?php echo "$".$curItem['STOCK_PRICE'] ?><br>
  <strong>Current Quantity: </strong> <?php echo $curItem['STOCK_QTY'] ?><br>
  <strong>Current Minimum Quantity: </strong> <?php echo $curItem['STOCK_MIN_QTY'] ?><br>
  <strong>Last Inventory Update for this Item: </strong> <?php echo $curItem['STOCK_LAST_RESTOCK'] ?><br>

</div>*/

?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>North Willow Convenience Stores</title>
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
<div class="page-header" style="text-align: center">
    <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
      <br>
    <h1><span class="label label-primary">Login Portal</h1>
</div>
<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656">

  <form method="post" action="index.php" id="empLogin" style="text-align:center">
    <div style="text-align:left">
    <div class="form-group">
    <label for="username"><strong>Employee ID: </strong></label>
  <input name="username" type="text" minlength="4" maxlength="4" pattern="[0-9]*" class="form-control" id="username" placeholder="Employee Identification Number" required title="-EMPLOYEE ID'S CONTAIN 4 NUMERIC DIGITS-">
    </div>

    <label>Store Location:</label>
    <select name="store" class="form-control">
      <?php foreach ($STORES as $s):?>
      <option value="<?php echo $s['STORE_ID'];?>"><?php echo $s['STORE_ID']." - ".$s['STORE_ADDRESS'];?></option>
    <?php endforeach;  ?>
    </select>
<br>
    <div class="form-group">
    <label for="password"><strong>Employee Password: </strong></label>
  <input name="password" type="password" minlength="15" maxlength="15" class="form-control" id="password" placeholder="Employee Password" required title="-EMPLOYEE PASSWORDS CONTAIN 15 CHARACTERS-">
    </div>
  </div>
      <label>&nbsp;</label>
			<input type="submit" class="btn btn-warning" value="Login" name="login">
		</form>
<?php
$login=filter_input(INPUT_POST, 'login');
$user=filter_input(INPUT_POST, 'username');
$store=filter_input(INPUT_POST, 'store');
$pw=filter_input(INPUT_POST, 'password');

if (isset($login)){

  $valid='SELECT EMPLOYEE_ID, EMPLOYEE_PASSWORD, POSITION_ID FROM EMPLOYEE WHERE EMPLOYEE_ID=:USER AND BINARY EMPLOYEE_PASSWORD=:PW';
  $statement1= $db->prepare($valid);
  $statement1->bindValue(':USER', $user);
  $statement1->bindValue(':PW', $pw);
  $statement1->execute();
  $validation = $statement1->fetch();
  $statement1->closeCursor();

//print_r($validation);

  if (count($validation)<2){  ?>
    <br><br>
    <div class="alert alert-warning" role="alert" style="text-align: center">
      <span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>
      <span class=""><strong>  Invalid Employee ID Number or Password.  Please try again. </strong></span><br><br>
    </div>

<?php  }
else {
  $_SESSION['start']=$user;
  $_SESSION['store']=$store;
  $_SESSION['posid']=$validation['POSITION_ID'];
  header('Location: menu.php');

}

}?>
  </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-6 col-xs-offset-4">
<br><br><h4><span class="label label-info" style="padding:10px; margin-left:57px">
<?php echo "Date: ".date("Y-m-d ")." Time: ".date("h:i:sa "); ?>
</span></h4>
  </div>
</div>
</div>
</div>
</div>

</body>
</html>
