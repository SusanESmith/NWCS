<?php
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
$storeID=filter_input(INPUT_POST, 'store');
$currentDate = date("Y-m-d");

$cashTotal=$hundred+$fifty+$twenty+$ten+$five+$one+$quarters+$dimes+$nickels+$pennies+$checks+$card;

$productName= 'test item';

require_once('nwcsdatabase.php');

$query = 'INSERT INTO REGISTER_COUNT
               (COUNT_ID, REGISTER_ID,STORE_ID, COUNT_DATE, MANAGER_ID, EMPLOYEE_ID,HUNDRED_NUM, FIFTY_NUM,
               TWENTY_NUM, TEN_NUM, FIVE_NUM, ONE_NUM, QUARTER_NUM, DIME_NUM, NICKEL_NUM, PENNY_NUM, REGISTER_TOTAL,
                NUM_OF_CHECKS, NUM_CARD_TRANS)
            VALUES
               (:COUNT_ID, :REGISTER_ID, :STORE_ID, :COUNT_DATE,:MANAGER_ID, :EMPLOYEE_ID, :HUNDRED_NUM,
               FIFTY_NUM, :TWENTY_NUM, :TEN_NUM, :FIVE_NUM, :ONE_NUM, :QUARTER_NUM, :DIME_NUM, :NICKEL_NUM,
                :PENNY_NUM, :REGISTER_TOTAL, :NUM_OF_CHECKS, :NUM_CARD_TRANS)';

  $statement = $db->prepare($query);
  $statement->bindValue(':COUNT_ID', 3);
  $statement->bindValue(':REGISTER_ID', $regID);
  $statement->bindValue(':STORE_ID', $storeID);
  $statement->bindValue(':COUNT_DATE', $currentDate);
  //$statement->bindValue(':MANAGER_ID', $manID);
  $statement->bindValue(':MANAGER_ID', 6);
  //$statement->bindValue(':EMPLOYEE_ID', $empID);
  $statement->bindValue(':EMPLOYEE_ID', 7);
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
  $statement->bindValue(':HUNDRED_NUM', $hundred);
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
        <?php echo 'Itemized Copy of your current drawer count: ';?>
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
          <td><?php echo $cashTotal;?></td>
          <td><?php echo $checks;?></td>
          <td><?php echo $card;?></td>

          <td><?php echo $currentDate;?></td>
          <td><?php echo $regID;?></td>
          <td><?php echo $storeID;?></td>

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
