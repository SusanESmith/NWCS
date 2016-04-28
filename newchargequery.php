<?php
include('loginredirect.php');
adminrights();
include('nwcsdatabase.php');
$chgDate=date("Y-m-d");
$bflag= filter_input(INPUT_POST, 'busFlag');
$iflag= filter_input(INPUT_POST, 'iFlag');


if ($bflag==1){
$BUSNAME= filter_input(INPUT_POST, 'busName');
$BUSADD= filter_input(INPUT_POST, 'busAdd');
$BUSCITY= filter_input(INPUT_POST, 'busCity');
$BUSSTATE= filter_input(INPUT_POST, 'busState');
$BUSZIP= filter_input(INPUT_POST, 'busZip');
$BUSLNAME= filter_input(INPUT_POST, 'busLname');
$BUSFNAME= filter_input(INPUT_POST, 'busFname');
$BUSPHONE= filter_input(INPUT_POST, 'busPhone');
$CLIMIT= filter_input(INPUT_POST, 'limit');
$BAL=$CLIMIT;


$cust='INSERT INTO CUSTOMER
               (CUSTOMER_LNAME, CUSTOMER_FNAME, CUSTOMER_ADDRESS, CUSTOMER_CITY, CUSTOMER_STATE, CUSTOMER_ZIP, CUSTOMER_PHONE_NUM)
            VALUES
               (:CUSTLNAME, :CUSTFNAME, :CUSTADD, :CUSTCITY, :CUSTSTATE, :CUSTZIP, :CUSTPHONE)';

$statement3 = $db->prepare($cust);
$statement3->bindValue(':CUSTLNAME', $BUSLNAME);
$statement3->bindValue(':CUSTFNAME', $BUSFNAME);
$statement3->bindValue(':CUSTADD', $BUSADD);
$statement3->bindValue(':CUSTCITY', $BUSCITY);
$statement3->bindValue(':CUSTSTATE', $BUSSTATE);
$statement3->bindValue(':CUSTZIP', $BUSZIP);
$statement3->bindValue(':CUSTPHONE', $BUSPHONE);
$statement3->execute();
$statement3->closeCursor();





$business='INSERT INTO BUSINESS
               (BUSINESS_NAME, BUSINESS_ADDRESS, BUSINESS_CITY, BUSINESS_STATE, BUSINESS_ZIP, BUSINESS_POC_LNAME, BUSINESS_POC_FNAME, BUSINESS_POC_PHONE)
            VALUES
               (:BUSNAME, :BUSADD, :BUSCITY, :BUSSTATE, :BUSZIP, :BUSLNAME, :BUSFNAME, :BUSPHONE)';

$statement1 = $db->prepare($business);
$statement1->bindValue(':BUSNAME', $BUSNAME);
$statement1->bindValue(':BUSADD', $BUSADD);
$statement1->bindValue(':BUSCITY', $BUSCITY);
$statement1->bindValue(':BUSSTATE', $BUSSTATE);
$statement1->bindValue(':BUSZIP', $BUSZIP);
$statement1->bindValue(':BUSLNAME', $BUSLNAME);
$statement1->bindValue(':BUSFNAME', $BUSFNAME);
$statement1->bindValue(':BUSPHONE', $BUSPHONE);
$statement1->execute();
$statement1->closeCursor();

$bID='SELECT BUSINESS_ID FROM BUSINESS WHERE BUSINESS_ID=LAST_INSERT_ID()';
$statement8= $db->prepare($bID);
//$statement->bindValue(':POSITION', $position);
$statement8->execute();
$busiID=$statement8->fetchColumn();
$statement8->closeCursor();

$cust='INSERT INTO CUSTOMER
               (CUSTOMER_LNAME, CUSTOMER_FNAME, CUSTOMER_ADDRESS, CUSTOMER_CITY, CUSTOMER_STATE, CUSTOMER_ZIP, CUSTOMER_PHONE_NUM)
            VALUES
               (:CUSTLNAME, :CUSTFNAME, :CUSTADD, :CUSTCITY, :CUSTSTATE, :CUSTZIP, :CUSTPHONE)';

$statement3 = $db->prepare($cust);
$statement3->bindValue(':CUSTLNAME', $BUSLNAME);
$statement3->bindValue(':CUSTFNAME', $BUSFNAME);
$statement3->bindValue(':CUSTADD', $BUSADD);
$statement3->bindValue(':CUSTCITY', $BUSCITY);
$statement3->bindValue(':CUSTSTATE', $BUSSTATE);
$statement3->bindValue(':CUSTZIP', $BUSZIP);
$statement3->bindValue(':CUSTPHONE', $BUSPHONE);
$statement3->execute();
$statement3->closeCursor();

$cID='SELECT CUSTOMER_ID FROM CUSTOMER WHERE CUSTOMER_ID=LAST_INSERT_ID()';
$statement9= $db->prepare($cID);
//$statement->bindValue(':POSITION', $position);
$statement9->execute();
$cusID=$statement9->fetchColumn();
$statement9->closeCursor();

$bcharge='INSERT INTO CHARGE_ACCOUNT
               (CUSTOMER_ID, BUSINESS_ID, CHG_ACCT_LIMIT, CHG_ACCT_BALANCE)
            VALUES
               (:CUSTID, :BUSID, :CLIMIT, :BAL)';

$statement = $db->prepare($bcharge);
$statement->bindValue(':CUSTID', $cusID);
$statement->bindValue(':BUSID', $busiID);
$statement->bindValue(':CLIMIT', $CLIMIT);
$statement->bindValue(':BAL', $BAL);
$statement->execute();
$statement->closeCursor();

$acctID='SELECT ACCOUNT_ID FROM CHARGE_ACCOUNT WHERE ACCOUNT_ID=LAST_INSERT_ID()';
$statement7= $db->prepare($acctID);
//$statement->bindValue(':POSITION', $position);
$statement7->execute();
$acctNum=$statement7->fetchColumn();
$statement7->closeCursor();

}else if ($iflag==1) {
$LNAME= filter_input(INPUT_POST, 'lastName');
$FNAME= filter_input(INPUT_POST, 'firstName');
$ADD= filter_input(INPUT_POST, 'add');
$CITY= filter_input(INPUT_POST, 'city');
$STATE= filter_input(INPUT_POST, 'state');
$ZIP= filter_input(INPUT_POST, 'zip');
$PHONE= filter_input(INPUT_POST, 'phone');
$CLIMIT= filter_input(INPUT_POST, 'limit');
$BAL=$CLIMIT;



$cust='INSERT INTO CUSTOMER
               (CUSTOMER_LNAME, CUSTOMER_FNAME, CUSTOMER_ADDRESS, CUSTOMER_CITY, CUSTOMER_STATE, CUSTOMER_ZIP, CUSTOMER_PHONE_NUM)
            VALUES
               (:CUSTLNAME, :CUSTFNAME, :CUSTADD, :CUSTCITY, :CUSTSTATE, :CUSTZIP, :CUSTPHONE)';

$statement3 = $db->prepare($cust);
$statement3->bindValue(':CUSTLNAME', $LNAME);
$statement3->bindValue(':CUSTFNAME', $FNAME);
$statement3->bindValue(':CUSTADD', $ADD);
$statement3->bindValue(':CUSTCITY', $CITY);
$statement3->bindValue(':CUSTSTATE', $STATE);
$statement3->bindValue(':CUSTZIP', $ZIP);
$statement3->bindValue(':CUSTPHONE', $PHONE);
$statement3->execute();
$statement3->closeCursor();

$cID='SELECT CUSTOMER_ID FROM CUSTOMER WHERE CUSTOMER_ID=LAST_INSERT_ID()';
$statement9= $db->prepare($cID);
//$statement->bindValue(':POSITION', $position);
$statement9->execute();
$cusID=$statement9->fetchColumn();
$statement9->closeCursor();


$icharge='INSERT INTO CHARGE_ACCOUNT
               (CUSTOMER_ID, CHG_ACCT_LIMIT, CHG_ACCT_BALANCE)
            VALUES
               (:CUSTID, :CLIMIT, :BAL)';

$statement2 = $db->prepare($icharge);
$statement2->bindValue(':CUSTID', $cusID);
$statement2->bindValue(':CLIMIT', $CLIMIT);
$statement2->bindValue(':BAL', $BAL);
$statement2->execute();
$statement2->closeCursor();

$acctID='SELECT ACCOUNT_ID FROM CHARGE_ACCOUNT WHERE ACCOUNT_ID=LAST_INSERT_ID()';
$statement8= $db->prepare($acctID);
//$statement->bindValue(':POSITION', $position);
$statement8->execute();
$acctNum=$statement8->fetchColumn();
$statement8->closeCursor();

}
 ?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Charge Account Submission</title>
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
    <h1><span class="label label-primary">Charge Account Submitted</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-user"></span>
        <?php echo "Charge Account Submitted: Account ID: <span style=color:orange>". $acctNum."</span>";?>
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
          <?php if ($bflag==1){?>
          <th>Charge Account ID Number</th>
          <th>Customer Type</th>
          <th>Business Name</th>
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
          <td><?php echo $acctNum?></td>
          <td><?php echo "Business"?></td>
          <td><?php echo $BUSNAME?></td>
          <td><?php echo $BUSLNAME?></td>
          <td><?php echo $BUSFNAME?></td>
          <td><?php echo $BUSADD?></td>
          <td><?php echo $BUSCITY?></td>
          <td><?php echo $BUSSTATE?></td>
          <td><?php echo $BUSZIP?></td>
          <td><?php echo $BUSPHONE?></td>
          <td><?php echo $chgDate?></td>



<?php }

 elseif ($iflag==1){?>
<th>Charge Account ID Number</th>
<th>Customer Type</th>
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
  <td><?php echo $acctNum?></td>
  <td><?php echo "Individual"?></td>
  <td><?php echo $LNAME?></td>
  <td><?php echo $FNAME?></td>
  <td><?php echo $ADD?></td>
  <td><?php echo $CITY?></td>
  <td><?php echo $STATE?></td>
  <td><?php echo $ZIP?></td>
  <td><?php echo $PHONE?></td>
  <td><?php echo $chgDate?></td>
<?php }?>

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
