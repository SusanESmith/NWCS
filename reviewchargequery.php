<?php
include('nwcsdatabase.php');
$one= filter_input(INPUT_POST, 'one');
$all= filter_input(INPUT_POST, 'all');

if (isset($one)){
  $account= filter_input(INPUT_POST, 'account');

  $query='SELECT * FROM CHARGE_ACCOUNT WHERE ACCOUNT_ID=:ACCT';
  $statement3 = $db->prepare($query);
  $statement3->bindValue(':ACCT', $account);
  $statement3->execute();
  $acct=$statement3->fetchAll();
  $statement3->closeCursor();
  $customer=$acct['CUSTOMER_ID'];

  $query4='SELECT * FROM CUSTOMER WHERE CUSTOMER_ID=:CID';
  $statement4 = $db->prepare($query4);
  $statement4->bindValue(':CID', $customer);
  $statement4->execute();
  $CID=$statement4->fetchAll();
  $statement4->closeCursor();
  $BID=$acct['BUSINESS_ID'];
  if (is_null($acct['BUSINESS_ID'])){
    $flag=0;
  }
else {

  $query5='SELECT * FROM BUSINESS WHERE BUSINESS_ID=:BID';
  $statement5 = $db->prepare($query4);
  $statement5->bindValue(':BID', $BID);
  $statement5->execute();
  $BUSID=$statement5->fetchAll();
  $statement5->closeCursor();
  $flag==1;
}
}
else if ($isset($all)){
  $cust= filter_input(INPUT_POST, 'custType');
if ($cust=="Individual"){
  $query2='SELECT * FROM CHARGE_ACCOUNT WHERE ACCOUNT_ID=:ACCT AND BUSINESS_ID IS NULL';
  $statement2 = $db->prepare($query2);
  $statement2->bindValue(':ACCT', $account);
  $statement2->execute();
  $acct=$statement2->fetchColumn();
  $statement2->closeCursor();
  $flag==2;
  }
  else if($cust=="Business"){
    $query3='SELECT * FROM CHARGE_ACCOUNT WHERE ACCOUNT_ID=:ACCT AND BUSINESS_ID IS NOT NULL';
    $statement1 = $db->prepare($query3);
    $statement1->bindValue(':ACCT', $account);
    $statement1->execute();
    $acct=$statement1->fetchColumn();
    $statement1->closeCursor();
    $flag==3;

    }

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
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo 'Charge Account Customer (charge acct num): ';?>
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
        <?php if ($flag==0){?>
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
          <td><?php echo $CID['CUSTOMER_ADDRESS']." ".$CID['CUSTOMER_CITY'].", ".$CID['STATE']." ".$CID['ZIP'];?></td>
          <td><?PHP echo $CID['CUSTOMER_PHONE_NUM'];?></td>
          <td><?php echo $acct['CHG_ACCT_BALANCE'];?></td>
        </tr>
<?php}
        else if ($flag==1){?>
        <tr>
          <th>Charge Account ID Number</th>
          <th>Customer Type</th>
          <th>Business Name</th>
          <th>Business ID</th>
          <th>Customer Last Name</th>
          <th>Customer First Name</th>
          <th>Address</th>
          <th>City</th>
          <th>State</th>
          <th>Zip Code</th>
          <th>Phone</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $acct['ACCOUNT_ID'];?></td>
          <td><?php echo "Business";?></td>
          <td><?php echo $BUSID['BUSINESS_NAME'];?></td>
          <td><?php echo $BUSID['BUSINESS_ID'];?></td>
          <td>Smith</td>
          <td>Bill</td>
          <td>132 Puppy Ave</td>
          <td>Clarksville</td>
          <td>TN</td>
          <td>37015</td>
          <td>931-792-1111</td>
          <td>03/18/2016</td>


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
