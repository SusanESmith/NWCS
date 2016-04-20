<?php
include('loginredirect.php');
include('nwcsdatabase.php');

$empID = filter_input(INPUT_POST, 'empID');
$transID = filter_input(INPUT_POST, 'transID');

//$date = filter_input(INPUT_POST, 'transDate');

$query = "SELECT * FROM TRANSACTIONS WHERE EMPLOYEE_ID = :empID AND TRANSACTION_ID = :transID";
$statement = $db->prepare($query);
$statement->bindValue(':empID', $empID);
$statement->bindValue(':transID', $transID);
//$statement->bindValue(':date', $date);
$statement->execute();
$report = $statement->fetchAll();
$statement->closeCursor();

$query2 = "SELECT EMPLOYEE_LNAME, EMPLOYEE_FNAME FROM EMPLOYEE WHERE EMPLOYEE_ID = :empID";
$statement1 = $db->prepare($query2);
$statement1->bindValue(':empID', $empID);
//$statement->bindValue(':date', $date);
$statement1->execute();
$emp = $statement1->fetch();
$statement1->closeCursor();
//echo $emp['EMPLOYEE_LNAME'];
$_SESSION["transID"] = $transID;
?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Employee Transaction History</title>
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
    <h1><span class="label label-primary">Employee Transaction History</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-list-alt"></span>
        <?php echo " Employee Transaction History for <span style=\"color:ORANGE\">'".$empID." - ".$emp['EMPLOYEE_LNAME'].", ".$emp['EMPLOYEE_FNAME']."'</span>: ";?>
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

          <th>Transaction ID Number</th>
          <th>Transaction Total</th>
          <th>Store Location</th>
          <th>Transaction Date</th>



        </tr>
      </thead>
      <tbody>
          <?php foreach($report as $r): ?>
        <tr>
          <td><a href="transdetails.php"><?php echo $r['TRANSACTION_ID']; ?></a></td>
          <td><?php echo "$".$r['TRANSACTION_TOTAL']; ?></td>
          <td><?php echo $r['STORE_ID']; ?></td>
          <td><?php echo $r['TRANSACTION_DATE']; ?></td>

        </tr>
          <?php endforeach; ?>
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
