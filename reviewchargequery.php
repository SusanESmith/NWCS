<?php
session_start();
include('nwcsdatabase.php');
$busID = $_SESSION["busID"];

$query = "SELECT ACCOUNT_ID, BUSINESS_NAME, CA.BUSINESS_ID, BUSINESS_POC_LNAME, BUSINESS_POC_FNAME, BUSINESS_ADDRESS, BUSINESS_CITY, BUSINESS_STATE, BUSINESS_ZIP, BUSINESS_POC_PHONE FROM CHARGE_ACCOUNT CA, BUSINESS B WHERE CA.BUSINESS_ID = B.BUSINESS_ID AND CA.BUSINESS_ID = :busID";
$statement = $db->prepare($query);
$statement->bindValue(':busID', $busID);
$statement->execute();
$bus = $statement->fetch();
$statement->closeCursor();
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
        <tr>
          <th>Charge Account ID Number</th>
          <th>Customer Type</th>
          <th>Business Name</th>
          <th>Business ID</th>
          <th>Customer Name</th>
          <th>Address</th>
          <th>City</th>
          <th>State</th>
          <th>Zip Code</th>
          <th>Phone</th>


        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $bus['ACCOUNT_ID']; ?></td>
          <td><?php 
                if (empty($busID))
                    echo "Individual";
                else
                    echo "Business";
              ?></td>
          <td><?php echo $bus['BUSINESS_NAME']; ?></td>
          <td><?php echo $bus['BUSINESS_ID']; ?></td>
          <td><?php echo $bus['BUSINESS_POC_FNAME']." ".$bus['BUSINESS_POC_LNAME']; ?></td>
          <td><?php echo $bus['BUSINESS_ADDRESS']; ?></td>
          <td><?php echo $bus['BUSINESS_CITY']; ?></td>
          <td><?php echo $bus['BUSINESS_STATE']; ?></td>
          <td><?php echo $bus['BUSINESS_ZIP']; ?></td>
          <td><?php echo $bus['BUSINESS_POC_PHONE']; ?></td>


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
