<?php
session_start();
include('nwcsdatabase.php');
$id = filter_input(INPUT_POST, 'busID');
//$name = filter_input(INPUT_POST, 'busName');

$query = "SELECT * FROM BUSINESS WHERE BUSINESS_ID = :id";

$statement = $db->prepare($query);
$statement->bindValue(':id', $id);
//$statement->bindValue(':name', $name);
$statement->execute();
$business = $statement->fetch();
$statement->closeCursor();

$charge_flag = "YES";

$query2 = "SELECT ACCOUNT_ID FROM CHARGE_ACCOUNTS WHERE BUSINESS_ID = :id";
$statement2 = $db->prepare($query2);
$statement2->bindValue(':id', $id);
$statement2->execute();
$account = $statement2->fetchColumn();
$statement2->closeCursor();

if (empty($account))
{
    $charge_flag = "NO";
}

$_SESSION["busID"] = $id;
?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Business Customer Report</title>
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
    <h1><span class="label label-primary">Business Customer Report</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-list-alt"></span>
        <?php echo '<span style="color:ORANGE"> \''.$business['BUSINESS_NAME'].'\'</span> is a valued NWCS customer: ';?>
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

          <th>Business Name</th>
          <th>Business ID</th>
          <th>Business Point of Contact</th>
          <th>Business Address</th>
          <th>Business City</th>
          <th>Business State</th>
          <th>Business Zip Code</th>
          <th>Business Phone</th>
          <th>Charge Account Holder</th>



        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $business['BUSINESS_NAME']; ?></td>
          <td><?php echo $business['BUSINESS_ID']; ?></td>
          <td><?php echo $business['BUSINESS_POC_FNAME']." ".$business['BUSINESS_POC_LNAME']; ?></td>
          <td><?php echo $business['BUSINESS_ADDRESS']; ?></td>
          <td><?php echo $business['BUSINESS_CITY']; ?></td>
          <td><?php echo $business['BUSINESS_STATE']; ?></td>
          <td><?php echo $business['BUSINESS_ZIP']; ?></td>
          <td><?php echo $business['BUSINESS_POC_PHONE']; ?></td>
        <?php
            if ($charge_flag = "YES")
                echo "<td><a href=\"reviewchargequery.php\">Yes</a></td>";
            else
                echo "<td>No</td>";
        ?>

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
