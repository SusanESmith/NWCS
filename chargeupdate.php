<?php
include('loginredirect.php');

require_once('nwcsdatabase.php');
$new=filter_input(INPUT_POST,'busedit');

if (isset($new)){
  $BUSID= filter_input(INPUT_POST, 'busid');
$BUSNAME= filter_input(INPUT_POST, 'busName');
$BUSADD= filter_input(INPUT_POST, 'busAdd');
$BUSCITY= filter_input(INPUT_POST, 'busCity');
$BUSSTATE= filter_input(INPUT_POST, 'busState');
$BUSZIP= filter_input(INPUT_POST, 'busZip');
$BUSLNAME= filter_input(INPUT_POST, 'busLname');
$BUSFNAME= filter_input(INPUT_POST, 'busFname');
$BUSPHONE= filter_input(INPUT_POST, 'busPhone');
$CLIMIT= filter_input(INPUT_POST, 'limit');
$CBAL=filter_input(INPUT_POST, 'balance');
$STATUS=filter_input(INPUT_POST,'status');
  $BACCT=filter_input(INPUT_POST, 'bacct');

$Bquery="UPDATE BUSINESS SET BUSINESS_NAME=:BNAME, BUSINESS_ADDRESS=:BADD, BUSINESS_CITY=:BCITY,
BUSINESS_STATE=:BSTATE, BUSINESS_ZIP=:BZIP, BUSINESS_POC_LNAME= :BLNAME,BUSINESS_POC_FNAME= :BFNAME,
BUSINESS_POC_PHONE=:BPHONE WHERE BUSINESS_ID=:BUSID";
$statement=$db->prepare($Bquery);
$statement->bindValue(':BUSID',$BUSID);
$statement->bindValue(':BNAME',$BUSNAME);
$statement->bindValue(':BADD',$BUSADD);
$statement->bindValue(':BCITY',$BUSCITY);
$statement->bindValue(':BSTATE',$BUSSTATE);
$statement->bindValue(':BZIP',$BUSZIP);
$statement->bindValue(':BLNAME',$BUSLNAME);
$statement->bindValue(':BFNAME',$BUSFNAME);
$statement->bindValue(':BPHONE',$BUSPHONE);
$statement->execute();
$statement->closeCursor();

$Cquery="UPDATE CHARGE_ACCOUNT SET CHG_ACCT_LIMIT=:LIM, CHG_ACCT_BALANCE=:BAL, STATUS=:STAT WHERE ACCOUNT_ID=:ACCTID";
$statement1=$db->prepare($Cquery);
$statement1->bindValue(':ACCTID',$BACCT);
$statement1->bindValue(':LIM',$CLIMIT);
$statement1->bindValue(':BAL',$CBAL);
$statement1->bindValue(':STAT',$STATUS);
$statement1->execute();
$statement1->closeCursor();
}
$inew=filter_input(INPUT_POST,'indedit');

if (isset($inew)){
$LNAME= filter_input(INPUT_POST, 'lastName');
$FNAME= filter_input(INPUT_POST, 'firstName');
$ADD= filter_input(INPUT_POST, 'add');
$CITY= filter_input(INPUT_POST, 'city');
$STATE= filter_input(INPUT_POST, 'state');
$ZIP= filter_input(INPUT_POST, 'zip');
$PHONE= filter_input(INPUT_POST, 'phone');
$CLIMIT= filter_input(INPUT_POST, 'limit');
$CBAL=filter_input(INPUT_POST, 'balance');
$STATUS=filter_input(INPUT_POST,'status');
  $CID= filter_input(INPUT_POST, 'cid');
  $ACCT=filter_input(INPUT_POST, 'acct');

$Iquery="UPDATE CUSTOMER SET  CUSTOMER_ADDRESS=:ADD, CUSTOMER_CITY=:CITY,
CUSTOMER_STATE=:STATE, CUSTOMER_ZIP=:ZIP, CUSTOMER_LNAME= :LNAME,CUSTOMER_FNAME= :FNAME,
CUSTOMER_PHONE_NUM=:PHONE WHERE CUSTOMER_ID=:CID";
$statement=$db->prepare($Iquery);
$statement->bindValue(':CID',$CID);
$statement->bindValue(':ADD',$ADD);
$statement->bindValue(':CITY',$CITY);
$statement->bindValue(':STATE',$STATE);
$statement->bindValue(':ZIP',$ZIP);
$statement->bindValue(':LNAME',$LNAME);
$statement->bindValue(':FNAME',$FNAME);
$statement->bindValue(':PHONE',$PHONE);
$statement->execute();
$statement->closeCursor();

$Cquery="UPDATE CHARGE_ACCOUNT SET CHG_ACCT_LIMIT=:LIM, CHG_ACCT_BALANCE=:BAL, STATUS=:STAT WHERE ACCOUNT_ID=:ACCTID";
$statement1=$db->prepare($Cquery);
$statement1->bindValue(':ACCTID',$ACCT);
$statement1->bindValue(':LIM',$CLIMIT);
$statement1->bindValue(':BAL',$CBAL);
$statement1->bindValue(':STAT',$STATUS);
$statement1->execute();
$statement1->closeCursor();
}
?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Page Access Restriction</title>
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
    <h1><span class="label label-primary">Charge Account Edit</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-exclamation-sign"></span>
        <?php echo 'Charge Account was successfully updated. ';?>
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


<p><strong><a href="charge.php">Back to the Charge Account Menu</a></strong></p>
        <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
      </div>
  </div>
  </div>


  </body>
  </html>




  </div>


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
