<?php
include('loginredirect.php');

include('nwcsdatabase.php');

$query2='SELECT * FROM BUSINESS';
$statement1 = $db->prepare($query2);
//$statement1->bindValue(':user',$var);
$statement1->execute();
$B = $statement1->fetchAll();
$statement1->closeCursor();

 ?>

<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Business Customer</title>
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
    <h1><span class="label label-primary">Business Customer Reporting</h1>
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

  <form method="post" action="businessreportquery.php" id="inventory" style="text-align:center">

    <div style="text-align:left">
      <label for="busID"><strong>Business: </strong></label>
        <select name="busID" class="form-control">
        <?php foreach ($B as $b):?>
        <option value="<?php echo $b['BUSINESS_ID'];?>"><?php echo $b['BUSINESS_ID']." - ".$b['BUSINESS_NAME'];?></option>
      <?php endforeach;  ?>
    </select>
    <br>
  </div>

      <label>&nbsp;</label>
      <input type="submit" class="btn btn-warning" value="Submit">
    </form>

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
