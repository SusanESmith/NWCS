<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Employee Search</title>
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
    <h1><span class="label label-primary">Employee Search</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo 'Employee Search Results: ';?>
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
    <label><a href="">Click to see employee transaction history</a></label>
    <br><br>
    <form method="post" name="searchemp" action="empsearch.php" id="empsearch" style="text-align:center">
        <label><strong>Or Search for a different employee by entering an employee ID number: </strong></label>
        <input name="emp" type="text">

        <label>&nbsp;</label>
        <input type="submit" name="enterBtn" value="Search">
        <br><br>
    </form>
  </div>
</div>
</div>

  </body>
  </html>




  </div>
  <p><strong><a href="empprofile.php">Back to Employee Profile</a></strong></p>
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
