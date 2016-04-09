<?php $lifetime=60*60*24*14;
session_set_cookie_params($lifetime,'/');
session_start();
$username="Employee ID";
$_SESSION['login_user']=$username;
//echo $_SESSION['login_user'];

include('nwcsdatabase.php');
$STORE='SELECT * FROM STORE';
$statement= $db->prepare($STORE);
$statement->execute();
$STORES = $statement->fetchAll();
$statement->closeCursor();
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

  <form method="post" action="menu.php" id="empLogin" style="text-align:center">
    <div style="text-align:left">
    <div class="form-group">
    <label for="username"><strong>Employee ID: </strong></label>
  <input name="username" type="text" class="form-control" id="username" placeholder="Employee Identification Number">
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
  <input name="password" type="password" class="form-control" id="password" placeholder="Employee Password">
    </div>
  </div>
      <label>&nbsp;</label>
			<input type="submit" class="btn btn-warning" value="Login">
		</form>

  </div>
  </div>
</div>
<?php
echo "The date is ".date("Y-m-d ")."and the time is ".date("h:i:sa "); ?>

  </div>
</div>
</div>

</body>
</html>
