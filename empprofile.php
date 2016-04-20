<?php
include('loginredirect.php');

$user=$_SESSION['start'];
include('nwcsdatabase.php');

$pos='SELECT * FROM POSITIONS';
$statement= $db->prepare($pos);
$statement->execute();
$position = $statement->fetchAll();
$statement->closeCursor();

$stores='SELECT * FROM STORE';
$statement1= $db->prepare($stores);
$statement1->execute();
$store = $statement1->fetchAll();
$statement1->closeCursor();

$emp='SELECT EMPLOYEE_ID,EMPLOYEE_LNAME, EMPLOYEE_FNAME FROM EMPLOYEE';
$statement2= $db->prepare($emp);
$statement2->execute();
$searchemp = $statement2->fetchAll();
$statement2->closeCursor();



$query = "SELECT E.EMPLOYEE_ID, EMPLOYEE_LNAME, EMPLOYEE_FNAME, EMPLOYEE_ADDRESS, EMPLOYEE_CITY, EMPLOYEE_STATE, EMPLOYEE_ZIP, EMPLOYEE_PHONE, ES.STORE_ID
FROM EMPLOYEE E, EMPLOYEE_STORE ES
WHERE E.EMPLOYEE_ID = ES.EMPLOYEE_ID
AND E.EMPLOYEE_ID = :user";
$statement = $db->prepare($query);
$statement->bindValue(':user',$user);
$statement->execute();
$profile = $statement->fetch(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>

<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Employee Profile</title>
<meta charset="utf-8">

<!--get bootstrap requirements-->
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
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
       <div class="col-md-6 col-md-offset-3"style="float: none; height: 100%">
<?php $test=""?>
<div class="page-header" style="text-align: center">
    <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
      <br>
    <h1><span class="label label-primary">Employee Profile</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-leaf"></span>
      <?php echo 'Details for Employee: <span style="color:ORANGE">'.$profile['EMPLOYEE_LNAME'].", ".$profile['EMPLOYEE_FNAME'].'</span>';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >
  <div class="table-responsive">
  <table class="table table-striped"style="text-align:left">

    <thead>
      <tr>
        <th>Employee ID Number</th>
        <th>Employee Name</th>
        <th>Employee Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Phone</th>
        <th>Current Store Location</th>



      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $profile['EMPLOYEE_ID']; ?></td>
        <td><?php echo $profile['EMPLOYEE_FNAME']." ".$profile['EMPLOYEE_LNAME']; ?></td>
        <td><?php echo $profile['EMPLOYEE_ADDRESS']; ?></td>
        <td><?php echo $profile['EMPLOYEE_CITY']; ?></td>
        <td><?php echo $profile['EMPLOYEE_STATE']; ?></td>
        <td><?php echo $profile['EMPLOYEE_ZIP']; ?></td>
        <td><?php echo $profile['EMPLOYEE_PHONE']; ?></td>
        <td><?php echo $profile['STORE_ID']; ?></td>



      </tr>
    </tbody>
  </table>
</div>
    <label><a href="emptranshistory.php?emp=<?php echo $profile['EMPLOYEE_ID'];?>">Click to see employee transaction history</a></label>
  <br><br>



  </div>


  <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
  <p><strong><a href="logout.php">Click here to logout</a></strong></p>

  </div>
</div>

<div class="col-md-3 col-md-offset-5" style="float: none; display: table-cell;">

  <?php if ($_SESSION['admin']==true){?>

  <div class="panel-group" style="text-align:center">
  <div class="panel panel-default">
      <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading\">";?>
        <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
          <?php echo 'New Employee:';?>
        </h4>
      </div>

      <!--panel body-->

      <div class="panel-body"  style="background-color:#C8F8FF; border:2px solid #FFC656" >
        <form method="post" name="searchemp" action="empsearch.php" id="empsearch" style="text-align:center">
          <br>
          <label>Or Search for a different employee:</label>
          <select name="emp" class="form-control">
            <?php foreach ($searchemp as $s):?>
            <option value="<?php echo $s['EMPLOYEE_ID'];?>"><?php echo $s['EMPLOYEE_ID']." - ".$s['EMPLOYEE_LNAME'].", ".$s['EMPLOYEE_FNAME'];?></option>
          <?php endforeach;  ?>
          </select>
          <br>
            <label>&nbsp;</label>
            <input type="submit" name="enterBtn" class="btn btn-warning" value="Search">
            <br><br>
        </form>


           <form method="post" name="newemp" action="empprofile.php" id="newemp" style="text-align:center">

            <div class="form-group">
            <label for="newemp"><strong>Or add a new employee: </strong></label>
              <br>
          <input name="newemp" type="submit"  class="btn btn-warning" id="newemp" value="Add Form">



            </div>




            <?php $new=filter_input(INPUT_POST,'newemp');
            if (isset($new)){?>
            </form>
            <form method="post" name="newemp" action="addemployee.php" id="newemp" style="text-align:center">

              <div style="text-align:left">


                <label>Employee Position:</label>


                <select name="pos" class="form-control">
                  <?php foreach ($position as $p):?>
                  <option value="<?php echo $p['POSITION_ID'];?>"><?php echo $p['POSITION_NAME'];?></option>
                <?php endforeach;  ?>
                </select>

                  <label>Assign Employee to a Current Store Location:</label>
                <select name="store" class="form-control">
                  <?php foreach ($store as $s):?>
                  <option value="<?php echo $s['STORE_ID'];?>"><?php echo $s['STORE_ID']." - ".$s['STORE_ADDRESS'];?></option>
                <?php endforeach;  ?>
                </select>

              <div class="form-group">
              <label for="lName"><strong>Last Name: </strong></label>
            <input name="lName" type="text" class="form-control" id="lName" placeholder="Employee Last Name" required>
              </div>

              <div class="form-group">
              <label for="fName"><strong>First Name: </strong></label>
            <input name="fName" type="text" class="form-control" id="fName" placeholder="Employee First Name" required>
              </div>

              <div class="form-group">
              <label for="add"><strong>Address: </strong></label>
            <input name="add" type="text" class="form-control" id="add" placeholder="Employee Street Address" required>
              </div>

              <div class="form-group">
              <label for="city"><strong>City: </strong></label>
            <input name="city" type="text" class="form-control" id="city" placeholder="Employee City" required>
              </div>

              <div class="form-group">
              <label for="state"><strong>State: </strong></label>
              <select name="state" id="storeState" placeholder="Store State" class="form-control bfh-states" data-country="US" required>
              </select>     </div>

              <div class="form-group">
              <label for="zip"><strong>Zip Code: </strong></label>
            <input name="zip" type="text" class="form-control" id="zip" placeholder="Employee Zip Code" required>
              </div>

              <div class="form-group">
              <label for="phone"><strong> Phone Number: </strong></label>
            <input name="phone" type="text" class="input-medium bfh-phone form-control" data-format="ddd-ddd-dddd" id="phone" placeholder="Employee Phone Number" required>
          </div>

          <div class="form-group">
          <label for="pword"><strong> Employee Password: </strong></label>
        <input name="pword" type="text" class="form-control" id="pword" minlength="15" maxlength="15" placeholder="Set Employee Password" required title="-EMPLOYEE PASSWORDS MUST BE 15 CHARACTERS IN LENGTH-">
          </div>
        </div>


            <input type="submit" name="newemp" class="btn btn-warning" value="Add New Employee">
          </form>
      <?php  }}?>

      </div>

      <br><br>

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
