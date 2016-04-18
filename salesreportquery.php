<?php
include('nwcsdatabase.php');

$time = filter_input(INPUT_POST, 'time');
$storeID = filter_input(INPUT_POST, 'storeID');
$bDate = filter_input(INPUT_POST, 'bDate');
$eDate = filter_input(INPUT_POST, 'eDate');
$bTime = filter_input(INPUT_POST, 'bTime');
$eTime = filter_input(INPUT_POST, 'eTime');

$bTime = $bTime.':00';
$eTime = $eTime.':00';

$bdatetime = $bDate.' '.$bTime;
$edatetime = $eDate.' '.$eTime;

if ($time == 'hourly')
{
    $query = "SELECT SUM(TRANSACTION_TOTAL) FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bdatetime AND :edatetime";
    $statement = $db->prepare($query);
    $statement->bindValue(':storeID', $storeID);
    $statement->bindValue(':bdatetime', $bdatetime);
    $statement->bindValue(':edatetime', $edatetime);
    $statement->execute();
    $sales = $statement->fetchColumn();
    $statement->closeCursor();
    //echo $sales;
}
else
{
    $query = "SELECT SUM(TRANSACTION_TOTAL) FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bDate AND :eDate";
    $statement = $db->prepare($query);
    $statement->bindValue(':storeID', $storeID);
    $statement->bindValue(':bDate', $bDate);
    $statement->bindValue(':eDate', $eDate);
    $statement->execute();
    $sales = $statement->fetchColumn();
    $statement->closeCursor();
}
?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Sales Report</title>
<meta charset="utf-8">

<!--get bootstrap requirements-->
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <meta name="viewport" content="width=device-width, initial-scale=1">
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
       <div class="col-md-10 col-md-offset-1">
<?php $test=""?>
<div class="page-header" style="text-align: center">
    <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
      <br>
    <h1><span class="label label-primary">Sales Report</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
<<<<<<< HEAD
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo '(Time - '.$time.')Sales report for Store ('.$storeID.'): ';?>
=======
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-list-alt"></span>
        <?php echo ' (Time -weekly)Sales report for Store (store ID): ';?>
>>>>>>> origin/master
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >






  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
        <!--<h3><span class="label label-primary">In stock items at (store number)</h3>-->
      <!--<p>The .table-striped class adds zebra-stripes to a table:</p>-->
        <div class="table-responsive">
    <table class="table table-striped"style="text-align:left">

      <thead>
        <tr>
          <th>Beginning Date</th>
          <th>Ending Date</th>
          <th>Total Sales</th>



        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $bDate ?></td>
          <td><?php echo $eDate ?></td>
          <td><?php echo "$".$sales ?></td>

        </tr>
      </tbody>
    </table>
  </div>
  </div>
</div>
</div>

  </body>
  </html>




  </div>
  <p><strong><a href="reporting.php">Back to the Reporting Menu</a></strong></p>
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
