<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Employee Profile</title>
<meta charset="utf-8">

<!--get bootstrap requirements-->
 <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
      <?php echo 'Susie Jones';?>
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
        <td>E1001</td>
        <td>Susie Jones</td>
        <td>101 Maynard Way</td>
        <td>Clarksville</td>
        <td>TN</td>
        <td>37015</td>
        <td>931-444-1000</td>
        <td>S22</td>



      </tr>


    </tbody>
  </table>
</div>
    <label><a href="emptranshistory.php">Click to see employee transaction history</a></label>
  <br><br>



  </div>


  <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
  <p><strong><a href="logout.php">Click here to logout</a></strong></p>

  </div>
</div>

<div class="col-md-6 col-md-offset-6" style="float: none; display: table-cell;">


  <div class="panel-group" style="text-align:center">
    <div class="panel panel-default">
      <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading\">";?>
        <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
          <?php echo 'New Employee:';?>
        </h4>
      </div>

      <!--panel body-->

      <div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >

          <div class="form-group">
          <label for="emp"><strong>Or Search for a different employee by entering an employee ID number: </strong></label>
              <br>
        <input name="emp" type="text"  id="newemp" >
        <button type="button" class="btn btn-warning" onclick="window.location.href='empsearch.php'"><strong>Search</strong></button>
        <br><br>
          </div>





          <form method="post" name="newemp" action="empprofile.php" id="newemp" style="text-align:center">

            <div class="form-group">
            <label for="newemp"><strong>Or add a new employee by entering an employee ID number: </strong></label>
              <br>
          <input name="newemp" type="submit"  class="btn btn-warning" id="newemp" value="Add New Employee">


            </div>

            <?php $new=filter_input(INPUT_POST,'newemp');
            if (isset($new)){?>
              <div style="text-align:left">
              <div class="form-group">
              <label for="lName"><strong>Last Name: </strong></label>
            <input name="lName" type="text" class="form-control" id="lName" placeholder="Employee Last Name">
              </div>

              <div class="form-group">
              <label for="fName"><strong>First Name: </strong></label>
            <input name="fName" type="text" class="form-control" id="fName" placeholder="Employee First Name">
              </div>

              <div class="form-group">
              <label for="add"><strong>Address: </strong></label>
            <input name="add" type="text" class="form-control" id="add" placeholder="Employee Street Address">
              </div>

              <div class="form-group">
              <label for="city"><strong>City: </strong></label>
            <input name="city" type="text" class="form-control" id="city" placeholder="Employee City">
              </div>

              <div class="form-group">
              <label for="state"><strong>State: </strong></label>
            <input name="state" type="text" class="form-control" id="state" placeholder="Employee State">
              </div>

              <div class="form-group">
              <label for="zip"><strong>Zip Code: </strong></label>
            <input name="zip" type="text" class="form-control" id="zip" placeholder="Employee Zip Code">
              </div>

              <div class="form-group">
              <label for="phone"><strong> Phone Number: </strong></label>
            <input name="phone" type="text" class="input-medium bfh-phone; form-control" data-country="US" id="phone" placeholder="Employee Phone Number">
              </div>
        </div>

          </form>
          <form method="post" name="newemp" action="addemployee.php" id="newemp" style="text-align:center">
            <input type="submit" name="newemp" class="btn btn-warning" value="Add New Employee">
          </form>
      <?php  }?>

      </div>

      <br><br>

    </div>
  </div>

</div>
</div>
<div class="row">
<div class="col-md-6 col-md-offset-3" style="text-align: center">
<?php
echo "The date is ".date("Y-m-d ")."and the time is ".date("h:i:sa "); ?>

  </div>
</div>
</div>

</body>
</html>
