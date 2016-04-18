<?php

include('nwcsdatabase.php');
$one= filter_input(INPUT_POST, 'one');
$all= filter_input(INPUT_POST, 'all');

$account= filter_input(INPUT_POST, 'account');

$flag=-1;

  $query='SELECT * FROM CHARGE_ACCOUNT WHERE ACCOUNT_ID=:ACCT';
  $statement3 = $db->prepare($query);
  $statement3->bindValue(':ACCT', $account);
  $statement3->execute();
  $acct=$statement3->fetch();
  $statement3->closeCursor();
  $customer=$acct['CUSTOMER_ID'];



  $query4='SELECT * FROM CUSTOMER WHERE CUSTOMER_ID=:CID';
  $statement4 = $db->prepare($query4);
  $statement4->bindValue(':CID', $customer);
  $statement4->execute();
  $CID=$statement4->fetch();
  $statement4->closeCursor();
  $BID=$acct['BUSINESS_ID'];



  $query1='SELECT PAYMENT_TYPE FROM PAYMENT WHERE ACCOUNT_ID=:ACCT';
  $statement1 = $db->prepare($query1);
  $statement1->bindValue(':ACCT', $account);
  $statement1->execute();
  $pay=$statement1->fetchColumn();
  $statement3->closeCursor();

  if (empty($BID)){
    $flag=0;

  }
else {

  $query5='SELECT * FROM BUSINESS WHERE BUSINESS_ID=:BID';
  $statement5 = $db->prepare($query5);
  $statement5->bindValue(':BID', $BID);
  $statement5->execute();
  $BUSID=$statement5->fetch();
  $statement5->closeCursor();
  $flag=1;

}


 ?>


<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Review a Charge Account</title>
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
    <h1><span class="label label-primary">Review a Charge Account</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"> <span class="glyphicon glyphicon-user"></span>
        <?php if ($flag==0) {echo "       Charge Account Customer <span style=color:orange>".$acct['ACCOUNT_ID']." - ".$CID['CUSTOMER_LNAME'].", ".$CID['CUSTOMER_FNAME']."</span>: ";}?>
        <?php if ($flag==1) {echo "       Charge Account Customer <span style=color:orange>".$acct['ACCOUNT_ID']." - ".$BUSID['BUSINESS_NAME']."</span>: ";}?>

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
        <?php if ($flag==0) { ?>
        <tr>
          <th>Charge Account ID Number</th>
          <th>Customer Type</th>
          <th>Customer Name</th>
          <th>Address</th>
          <th>Phone</th>
          <th>Current Account Balance:</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $acct['ACCOUNT_ID'];?></td>
          <td><?php echo "Individual";?></td>
          <td><?php echo $CID['CUSTOMER_LNAME'].", ".$CID['CUSTOMER_FNAME'];?></td>
          <td><?php echo $CID['CUSTOMER_ADDRESS']." ".$CID['CUSTOMER_CITY'].", ".$CID['CUSTOMER_STATE']." ".$CID['CUSTOMER_ZIP'];?></td>
          <td><?PHP echo $CID['CUSTOMER_PHONE_NUM'];?></td>
          <td><?php echo $acct['CHG_ACCT_BALANCE'];?></td>
        </tr>
<?php }
        else { ?>
        <tr>
          <th>Charge Account ID Number</th>
          <th>Customer Type</th>
          <th>Business Name</th>
          <th>Business ID</th>

          <th>Point of Contact</th>

          <th>Address</th>
          <th>Phone</th>



        </tr>
      </thead>
      <tbody>
        <tr>

          <td><?php echo $acct['ACCOUNT_ID'];?></td>
          <td><?php echo "Business";?></td>
          <td><?php echo $BUSID['BUSINESS_NAME'];?></td>
          <td><?php echo $BUSID['BUSINESS_ID'];?></td>
          <td><?php echo $CID['CUSTOMER_LNAME'].", ".$CID['CUSTOMER_FNAME'];?></td>
          <td><?php echo $CID['CUSTOMER_ADDRESS']." ".$CID['CUSTOMER_CITY'].", ".$CID['CUSTOMER_STATE']." ".$CID['CUSTOMER_ZIP'];?></td>
          <td><?PHP echo $CID['CUSTOMER_PHONE_NUM'];?></td>

        </tr>
<?php } ?>

      </tbody>
    </table>
  </div>
  </div>
</div>
</div>

  </body>
  </html>




  </div>
  <p><strong><a href="charge.php">Back to the Charge Account Menu</a></strong></p>
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
