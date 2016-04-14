<?php
require_once('nwcsdatabase.php');
//$id = filter_input(INPUT_POST, 'id');
$phone = filter_input(INPUT_POST, 'sphone');
$address = filter_input(INPUT_POST, 'saddress');
$city = filter_input(INPUT_POST, 'scity');
$state = filter_input(INPUT_POST, 'sstate');
$zip = filter_input(INPUT_POST, 'szip');
$emp=filter_input(INPUT_POST,'storeManager');

$position = 101;

$query = "INSERT INTO STORE(STORE_PHONE, STORE_ADDRESS, STORE_CITY, STORE_STATE, STORE_ZIP) VALUES(:phone, :address, :city, :state, :zip)";
$statement = $db->prepare($query);

$statement->bindValue(':phone', $phone);
$statement->bindValue(':address', $address);
$statement->bindValue(':city', $city);
$statement->bindValue(':state', $state);
$statement->bindValue(':zip', $zip);
$statement->execute();
$statement->closeCursor();

$query2 = "SELECT STORE_ID FROM STORE WHERE STORE_ID=LAST_INSERT_ID()";
$statement2 = $db->prepare($query2);
$statement2->execute();
$storeID = $statement2->fetchColumn();
$statement2->closeCursor();
//ECHO $storeID;
//echo $emp;

/*$query3 = "SELECT EMPLOYEE_ID FROM EMPLOYEE WHERE EMPLOYEE_FNAME = :fname AND EMPLOYEE_LNAME = :lname";
$statement3 = $db->prepare($query3);
$statement3->bindValue(':fname', $fname);
$statement3->bindValue(':lname', $lname);
$statement3->execute();
$empID = $statement3->fetchColumn();
$statement3->closeCursor();*/

$query3 = "SELECT EMPLOYEE_FNAME, EMPLOYEE_LNAME, MANAGER_ID FROM EMPLOYEE, MANAGEMENT WHERE EMPLOYEE.EMPLOYEE_ID=:EMPLOYEE_ID AND EMPLOYEE.EMPLOYEE_ID=MANAGEMENT.EMPLOYEE_ID";
$statement3 = $db->prepare($query3);
$statement3->bindValue(':EMPLOYEE_ID', $emp);
$statement3->execute();
$empID = $statement3->fetch();
$statement3->closeCursor();
//echo $empID['MANAGER_ID'];

$query4 = "INSERT INTO MANAGEMENT(STORE_ID, EMPLOYEE_ID) VALUES( :storeID, :empID)";
$statement4 = $db->prepare($query4);
$statement4->bindValue(':storeID', $storeID);
$statement4->bindValue(':empID', $emp);
//$statement4->bindValue(':manID', $empID['MANAGER_ID']);
$statement4->execute();
$statement4->closeCursor();

$query5 = "INSERT INTO EMPLOYEE_STORE(POSITION_ID, STORE_ID, EMPLOYEE_ID) VALUES(:posID, :storeID, :empID)";
$statement5 = $db->prepare($query5);
$statement5->bindValue(':storeID', $storeID);
$statement5->bindValue(':empID', $emp);
$statement5->bindValue(':posID', $position);
$statement5->execute();
$statement5->closeCursor();

/*$query5 = "UPDATE EMPLOYEE_STORE SET STORE_ID = :storeID WHERE EMPLOYEE_ID = :empID";
$statement5 = $db->prepare($query5);
$statement5->bindValue(':storeID', $storeID);
$statement5->bindValue(':empID', $emp);
$statement5->execute();
$statement5->closeCursor();*/

/*
$query6 = "UPDATE EMPLOYEE SET POSITION_ID = 101 WHERE EMPLOYEE_ID = :empID";
$statement6 = $db->prepare($query6);
$statement6->bindValue(':empID', $empID);
$statement6->execute();
$statement6->closeCursor();
*/

?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Store Added</title>
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
    <h1><span class="label label-primary">Store Added</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo 'This store has successfully been added to the NWCS database: ';?>
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
          <th>Store ID</th>
          <th>Store Phone</th>
          <th>Store Manager</th>
          <th>Store Address</th>
          <th>Store City</th>
          <th>Store State</th>
          <th>Store ZIP</th>




        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $storeID; ?></td>
          <td><?php echo $phone; ?></td>
          <td><?php echo $empID['EMPLOYEE_LNAME'].", ".$empID['EMPLOYEE_FNAME']; ?></td>
          <td><?php echo $address; ?></td>
          <td><?php echo $city; ?></td>
          <td><?php echo $state; ?></td>
          <td><?php echo $zip; ?></td>
        </tr>


      </tbody>
    </table>
  </div>

    <br><br>

  </div>
</div>
</div>

  </body>
  </html>




  </div>
  <p><strong><a href="stores.php">Back to Store Contacts</a></strong></p>
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
