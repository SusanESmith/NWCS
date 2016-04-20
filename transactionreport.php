<?php
include('loginredirect.php');

include('nwcsdatabase.php');

$query2='SELECT * FROM EMPLOYEE';
$statement1 = $db->prepare($query2);
//$statement1->bindValue(':user',$var);
$statement1->execute();
$emp = $statement1->fetchAll();
$statement1->closeCursor();


 ?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Transactions</title>
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
    <h1><span class="label label-primary">Transaction Reporting</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-list-alt"></span>
      <?php echo 'Please enter the following information:';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >

  <form method="post" action="transactionreport.php" id="inventory" style="text-align:center">

    <div style="text-align:left">
    <div class="form-group">
    <label for="empID"><strong>Employee ID: </strong></label>
      <select name="empID" class="form-control">
      <?php foreach ($emp as $s):?>
      <option value="<?php echo $s['EMPLOYEE_ID']?>"><?php echo $s['EMPLOYEE_ID']." - ".$s['EMPLOYEE_LNAME'].", ".$s['EMPLOYEE_FNAME'];?></option>
    <?php endforeach;  ?>
  </select>
  <label>&nbsp;</label>
</div></div>

  <input type="submit" name="e" class="btn btn-warning" value="Select Employee">
</form>
<?php
$eid=filter_input(INPUT_POST, 'e');
if(isset($eid)){

$empID=filter_input(INPUT_POST, 'empID');
//echo $empID;
  $query='SELECT * FROM TRANSACTIONS WHERE EMPLOYEE_ID=:EID';
  $statement = $db->prepare($query);
  $statement->bindValue(':EID',$empID);
  $statement->execute();
  $t= $statement->fetchAll();
  $statement->closeCursor();
 ?>
<form method="post" action="transreportquery.php" id="inventory" style="text-align:center">
<div style="text-align:left">
    <div class="form-group">
    <label for="transID"><strong>Transaction ID: </strong></label>
      <select name="transID" class="form-control">
    <?php foreach ($t as $tr):?>
    <option value="<?php echo $tr['TRANSACTION_ID'];?>"><?php echo $tr['TRANSACTION_ID'];?></option>
  <?php endforeach;  ?>
</select>
    </div>


  </div>
<input type="text" value="<?php echo $empID?>" name="empID" hidden="true">
      <br><br>
      <label>&nbsp;</label>
      <input type="submit" class="btn btn-warning" value="Submit">
    </form>
<?php } ?>
  </div>
  <p><strong><a href="reporting.php">Back to the Reporting Menu</a></strong></p>
  <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
  <p><strong><a href="logout.php">Click here to logout</a></strong></p>



  </div>
</div>

  </div>
</div>
</div>
<div style="text-align:center">
<h4><span class="label label-info" style="padding:10px;">
<?php echo "Date: ".date("Y-m-d ")." Time: ".date("h:i:sa "); ?>
</span></h4>

</div>
</body>
</html>
