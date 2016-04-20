<?php
include('loginredirect.php');
adminrights();
require_once('nwcsdatabase.php');
$hundred = filter_input(INPUT_POST, 'hundred');
$fifty = filter_input(INPUT_POST, 'fifty');
$twenty = filter_input(INPUT_POST, 'twenty');
$ten = filter_input(INPUT_POST, 'ten');
$five = filter_input(INPUT_POST, 'five');
$one = filter_input(INPUT_POST, 'one');
$quarters = filter_input(INPUT_POST, 'quarters');
$dimes = filter_input(INPUT_POST, 'dimes');
$nickels = filter_input(INPUT_POST, 'nickels');
$pennies = filter_input(INPUT_POST, 'pennies');
$checks = filter_input(INPUT_POST, 'checks');
$card = filter_input(INPUT_POST, 'card');
$regID=filter_input(INPUT_POST, 'register');
$store=filter_input(INPUT_POST, 'store');
$manager=filter_input(INPUT_POST, 'manager');


$currentDate = date("Y-m-d");

$q=$quarters*.25;
$d=$dimes*.1;
$n=$nickels*.05;
$p=$pennies*.01;
$hun=$hundred*100;
$fif=$fifty*50;
$twe=$twenty*20;
$te=$ten*10;
$fiv=$five*5;


$cashTotal=$hun+$fif+$twe+$te+$fiv+$one+$q+$d+$n+$p+$checks+$card;

$emp='SELECT EMPLOYEE_ID FROM MANAGEMENT WHERE MANAGEMENT.MANAGER_ID=:manager';
$statement2= $db->prepare($emp);
$statement2->bindValue(':manager', $manager);
$statement2->execute();
$empID = $statement2->fetchColumn();
$statement2->closeCursor();



//$productName= 'test item';



$query = 'INSERT INTO REGISTER_COUNT
               (REGISTER_ID,STORE_ID, COUNT_DATE, MANAGER_ID, EMPLOYEE_ID,HUNDRED_NUM, FIFTY_NUM,
               TWENTY_NUM, TEN_NUM, FIVE_NUM, ONE_NUM, QUARTER_NUM, DIME_NUM, NICKEL_NUM, PENNY_NUM, REGISTER_TOTAL,
                NUM_OF_CHECKS, NUM_CARD_TRANS)
            VALUES
               ( :REGISTER_ID, :STORE_ID, :COUNT_DATE,:MANAGER_ID, :EMPLOYEE_ID, :HUNDRED_NUM,
               :FIFTY_NUM, :TWENTY_NUM, :TEN_NUM, :FIVE_NUM, :ONE_NUM, :QUARTER_NUM, :DIME_NUM, :NICKEL_NUM,
                :PENNY_NUM, :REGISTER_TOTAL, :NUM_OF_CHECKS, :NUM_CARD_TRANS)';

  $statement = $db->prepare($query);

  $statement->bindValue(':REGISTER_ID', $regID);
  $statement->bindValue(':STORE_ID', $store);
  $statement->bindValue(':COUNT_DATE', $currentDate);
  $statement->bindValue(':MANAGER_ID', $manager);
  $statement->bindValue(':EMPLOYEE_ID', $empID);
  $statement->bindValue(':HUNDRED_NUM', $hundred);
  $statement->bindValue(':FIFTY_NUM', $fifty);
  $statement->bindValue(':TWENTY_NUM', $twenty);
  $statement->bindValue(':TEN_NUM', $ten);
  $statement->bindValue(':FIVE_NUM', $five);
  $statement->bindValue(':ONE_NUM', $one);
  $statement->bindValue(':QUARTER_NUM', $quarters);
  $statement->bindValue(':DIME_NUM', $dimes);
  $statement->bindValue(':NICKEL_NUM', $nickels);
  $statement->bindValue(':PENNY_NUM', $pennies);
  $statement->bindValue(':REGISTER_TOTAL', $cashTotal);
  $statement->bindValue(':NUM_OF_CHECKS', $checks);
  $statement->bindValue(':NUM_CARD_TRANS', $card);
  $statement->execute();
  $statement->closeCursor();
 ?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Cash Register Drawer Count</title>
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
  <div class="container-fluid">
     <div class="row">
       <div class="col-md-10 col-md-offset-1">
<?php $test=""?>
<div class="page-header" style="text-align: center">
    <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
      <br>
    <h1><span class="label label-primary">Cash Register Drawer Count</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo 'Itemized Copy of Register Number <span style=color:orange>\''.$regID.'\' </span>at Store Number <span style=color:orange>\''.$store.'\'</span>:';?>
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

          <th>One Hundred dollar bills</th>
          <th>Fifty dollar bills</th>
          <th>Twenty dollar bills</th>
          <th>Ten dollar bills</th>
          <th>Five dollar bills</th>
          <th>One dollar bills</th>
          <th>Quarters</th>
          <th>Dimes</th>
          <th>Nickels</th>
          <th>Pennies</th>
          <th>Total Cash Amount</th>

          <th>Number of checks</th>
          <th>Number of Card Transactions</th>
          <th>Date</th>
          <th>Register ID</th>
          <th>Store ID</th>



        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $hundred;?></td>
          <td><?php echo $fifty;?></td>
          <td><?php echo $twenty;?></td>
          <td><?php echo $ten;?></td>
          <td><?php echo $five;?></td>
          <td><?php echo $one;?></td>
          <td><?php echo $quarters;?></td>
          <td><?php echo $dimes;?></td>
          <td><?php echo $nickels;?></td>
          <td><?php echo $pennies;?></td>
          <td><?php echo '$'.$cashTotal;?></td>
          <td><?php echo $checks;?></td>
          <td><?php echo $card;?></td>

          <td><?php echo $currentDate;?></td>
          <td><?php echo $regID;?></td>
          <td><?php echo $store;?></td>

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
  <p><strong><a href="cashier.php">Back to the Cashier Menu</a></strong></p>
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
