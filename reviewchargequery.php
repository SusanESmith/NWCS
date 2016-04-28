<?php
include('loginredirect.php');

include('nwcsdatabase.php');
$one= filter_input(INPUT_POST, 'one');
$all= filter_input(INPUT_POST, 'all');
$edit=filter_input(INPUT_POST, 'edit');

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

//individual with no edit
  if (empty($BID) && !isset($edit)){
    $flag=0;

  }
  //business with no edit
elseif (!empty($BID) && !isset($edit)) {

  $query5='SELECT * FROM BUSINESS WHERE BUSINESS_ID=:BID';
  $statement5 = $db->prepare($query5);
  $statement5->bindValue(':BID', $BID);
  $statement5->execute();
  $BUSID=$statement5->fetch();
  $statement5->closeCursor();
  $flag=1;

}
//business edit
elseif (isset($edit) && !empty($BID)){
  $flag=2;
  $query6='SELECT * FROM BUSINESS WHERE BUSINESS_ID=:BID';
  $statement6 = $db->prepare($query6);
  $statement6->bindValue(':BID', $BID);
  $statement6->execute();
  $BUSID=$statement6->fetch();
  $statement6->closeCursor();
}
//individual edit
elseif (isset($edit) && empty($BID)){
  $flag=3;
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
 <link href="css/bootstrap-form-helpers.min.css" rel="stylesheet" media="screen">

<script src="js/bootstrap-formhelpers.min.js"></script>
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

        <?php if ($flag==0) { ?>
          <table class="table table-striped"style="text-align:left">

            <thead>
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
          <td><?php echo "$".$acct['CHG_ACCT_BALANCE'];?></td>
        </tr>
      </tbody>
    </table>
<?php }
        elseif ($flag==1) { ?>
          <table class="table table-striped"style="text-align:left">

            <thead>
        <tr>
          <th>Charge Account ID Number</th>
          <th>Customer Type</th>
          <th>Business Name</th>
          <th>Business ID</th>

          <th>Point of Contact</th>

          <th>Address</th>
          <th>Phone</th>
          <th>Current Account Balance</th>



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
          <td><?php echo "$".$acct['CHG_ACCT_BALANCE'];?></td>

        </tr>
      </tbody>
    </table>
<?php }
else if ($flag==2){?>
  <form method="post" action="chargeupdate.php" id="newcharge" style="text-align:center">
  <!--<div method="post" name="busFlag"><?php $busflag=1;?></div>-->
    <input name="busFlag" type= "hidden"  value="<?php echo $busflag;?>">
    <input name="busid" type= "hidden"  value="<?php echo $BID;?>">
    <input name="bacct" type= "hidden"  value="<?php echo $account;?>">
  <div style="text-align:left" >

  <div class="form-group">
  <label for="busName"><strong>Business Name: </strong></label>
  <input name="busName" value="<?php echo $BUSID['BUSINESS_NAME'];?>" type="text" class="form-control" maxlength="20" id="busName" placeholder="Name of Business" required>
  </div>

  <div class="form-group">
  <label for="busLname"><strong>Point of Contact Last Name: </strong></label>
  <input name="busLname" type="text"  value="<?php echo $BUSID['BUSINESS_POC_LNAME'];?>" class="form-control" maxlength="15" id="busLname" placeholder="Last name of Point of Contact" required>
  </div>

  <div class="form-group">
  <label for="busFname"><strong>Point of Contact First Name: </strong></label>
  <input name="busFname" type="text" value="<?php echo $BUSID['BUSINESS_POC_FNAME'];?>" class="form-control" maxlength="15" id="busFname" placeholder="First name of Point of Contact" required>
  </div>

  <div class="form-group">
  <label for="busAdd"><strong>Address: </strong></label>
  <input name="busAdd" type="text" value="<?php echo $BUSID['BUSINESS_ADDRESS'];?>" class="form-control" id="busAdd" maxlength="20" placeholder="Business Street Address" required>
  </div>

  <div class="form-group">
  <label for="busCity"><strong>City: </strong></label>
  <input name="busCity" type="text" class="form-control" value="<?php echo $BUSID['BUSINESS_CITY'];?>" maxlength="15" id="busCity" placeholder="City" required>
  </div>

  <div class="form-group">
  <label for="busState"><strong>State: </strong></label>
  <select name="busState" value="<?php echo $BUSID['BUSINESS_STATE'];?>" class="form-control bfh-states" data-country="US" required>

  </select>    </div>

  <div class="form-group">
  <label for="busZip"><strong>Zip Code: </strong></label>
  <input name="busZip" type="number" value="<?php echo $BUSID['BUSINESS_ZIP'];?>"class="form-control" id="busZip" placeholder=" Zip Code" required>
  </div>

  <div class="form-group">
  <label for="busPhone"><strong>Phone Number: </strong></label>
  <input name="busPhone" type="text" class="input-medium bfh-phone form-control" data-format="ddd-ddd-dddd" value="<?php echo $BUSID['BUSINESS_POC_PHONE'];?>" id="busPhone" placeholder="Phone Number" required>
  </div>
  <div class="form-group">
  <label for="limit"><strong>Charge Account Limit: </strong></label>
  <div class="input-group">
  <div class="input-group-addon">$</div>
  <input name="limit" type="number" pattern="[0-9]*" class="form-control"  value="<?php echo $acct['CHG_ACCT_LIMIT'];?>" id="phone" placeholder="Charge Account Limit" required>
  </div>
  <div class="form-group">
  <label for="limit"><strong>Current Charge Account Balance: </strong></label>
    <div class="input-group">
    <div class="input-group-addon">$</div>
<input name="balance"  type="text" pattern="[0-9]+([,.][0-9]+)" class="form-control"   value="<?php echo $acct['CHG_ACCT_BALANCE'];?>" id="limit" placeholder="Charge Account Limit" required>
  </div>
  <label>Account Status:</label>
  <select name="status" class="form-control">
    <!--drop down menu-->
  <span class="glyphicon glyphicon-time">
    <option value="<?php echo "Active";?>"><?php echo "ACTIVE";?></option>
    <option value="<?php echo "Inactive";?>"><?php echo "INACTIVE";?></option>

  </select>
  </div>
</div>
  </div>
  <br><br>
  <label>&nbsp;</label>
  <input type="submit" name="busedit" class="btn btn-warning" value="Submit">
  </form>

  <?php
  }
  else if ($flag==3){?>
    <form method="post" action="chargeupdate.php" id="newcharge" style="text-align:center">
  <!--<div method="post" name="iFlag"><?php $iflag=1; ?> </div>-->
  <input name="iFlag" type="hidden" value="<?php echo $iflag;?>">
  <input name="cid" type= "hidden"  value="<?php echo $customer;?>">
  <input name="acct" type= "hidden"  value="<?php echo $account;?>">

  <div style="text-align:left" >
    <br>
    <div class="form-group">
    <label for="lastName"><strong>Customer Last Name: </strong></label>
  <input name="lastName" type="text" class="form-control" value="<?php echo $CID['CUSTOMER_LNAME'];?>" maxlength="15" id="lastName" placeholder="Last name of Customer" required>
    </div>

    <div class="form-group">
    <label for="firstName"><strong>Customer First Name: </strong></label>
  <input name="firstName" type="text" class="form-control" value="<?php echo $CID['CUSTOMER_FNAME'];?>" maxlength="15" id="firstName" placeholder="First name of Customer" required>
    </div>

    <div class="form-group">
    <label for="add"><strong>Address: </strong></label>
    <input name="add" type="text" class="form-control" id="add" value="<?php echo $CID['CUSTOMER_ADDRESS'];?>"maxlength="20" placeholder="Street Address" required>
    </div>

    <div class="form-group">
    <label for="city"><strong>City: </strong></label>
  <input name="city" type="text" class="form-control" id="city" maxlength="15" value="<?php echo $CID['CUSTOMER_CITY'];?>" placeholder="City" required>
    </div>

    <div class="form-group">
    <label for="state"><strong>State: </strong></label>
    <select name="state" class="form-control bfh-states" data-country="US" value="<?php echo $CID['CUSTOMER_STATE'];?>" required>

    </select>
    </div>

    <div class="form-group">
    <label for="zip"><strong>Zip Code: </strong></label>
  <input name="zip" type="text" class="form-control" id="zip" value="<?php echo $CID['CUSTOMER_ZIP'];?>" placeholder="Zip Code" required>
    </div>

    <div class="form-group">
    <label for="phone"><strong>Phone Number: </strong></label>
  <input name="phone" type="text" value="<?php echo $CID['CUSTOMER_PHONE_NUM'];?>" class="input-medium bfh-phone form-control"  data-format="ddd-ddd-dddd" id="phone" placeholder="Phone Number" required>
    </div>

    <div class="form-group">
    <label for="limit"><strong>Charge Account Limit: </strong></label>
      <div class="input-group">
      <div class="input-group-addon">$</div>
  <input name="limit" type="number" class="form-control"   value="<?php echo $acct['CHG_ACCT_LIMIT'];?>" id="limit" placeholder="Charge Account Limit" required>
    </div>
    <div class="form-group">
    <label for="limit"><strong>Current Charge Account Balance: </strong></label>
      <div class="input-group">
      <div class="input-group-addon">$</div>
  <input name="balance" type="text" pattern="[0-9]+([,.][0-9]+)" class="form-control"   value="<?php echo $acct['CHG_ACCT_BALANCE'];?>" id="limit" placeholder="Charge Account Limit" required>
    </div>
    <label>Account Status:</label>
    <select name="status" class="form-control">
      <!--drop down menu-->
    <span class="glyphicon glyphicon-time">
      <option value="<?php echo "Active";?>"><?php echo "ACTIVE";?></option>
      <option value="<?php echo "Inactive";?>"><?php echo "INACTIVE";?></option>

    </select>

  </div>
</div>
  </div>
      <br><br>
      <label>&nbsp;</label>
      <input type="submit" name="indedit" class="btn btn-warning" value="Submit">
    </form>



<?php }?>


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
