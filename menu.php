<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Main Menu</title>
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
    <h1><span class="label label-primary">Main Menu</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
      <?php echo 'What would you like to do?';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >

<button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='cashiermenu.php'"><strong>Cashier Menu      </strong><span class="glyphicon glyphicon-shopping-cart"></span></button>
<br><br>
<button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='inventory.php'"><strong>Inventory            </strong><span class="glyphicon glyphicon-tasks"></span></button>
<br><br>
<button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='orders.php'"><strong>Ordering              </strong><span class="glyphicon glyphicon-th-large"></span></button>
<br><br>
<button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='reporting.php'"><strong>Reports     </strong><span class="glyphicon glyphicon-list-alt"></span></button>
<br><br>
<button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='charge.php'"><strong>Charge Accounts       </strong> <span class="glyphicon glyphicon-user"></span></button>
<br><br>
<button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='contacts.php'"><strong>Contacts           </strong><span class="glyphicon glyphicon-envelope"></span></button>
<br><br>
<button type="button" class="btn btn-warning btn-lg btn-block" onclick="window.location.href='empprofile.php'"><strong>Employee Profile           </strong><span class="glyphicon glyphicon-leaf"></span></button>





  </div>
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
