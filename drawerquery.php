<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Cash Register Drawer Count</title>
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
    <h1><span class="label label-primary">Cash Register Drawer Count</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
        <?php echo 'Itemized Copy of your current drawer count: ';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >






  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-md-offset-0">
        <!--<h3><span class="label label-primary">In stock items at (store number)</h3>-->
      <!--<p>The .table-striped class adds zebra-stripes to a table:</p>-->
    <table class="table table-striped"style="text-align:left">

      <thead>
        <tr>

          <th>One Hundred dollar bills</th>
          <th>Fifty dollar bills</th>
          <th>Twenty dollar bills</th>
          <th>Ten dollar bills</th>
          <th>Five dollar bills</th>
          <th>One dollar bills</th>
          <th>Quarters</th>
          <th>Dimes</th>
          <th>Nickels</th>
          <th>Pennies</th>
          <th>Total Cash Amount</th>

          <th>Number of checks</th>
          <th>Number of Card Transactions</th>
          <th>Date</th>




        </tr>
      </thead>
      <tbody>
        <tr>
          <td>5</td>
          <td>0</td>
          <td>3</td>
          <td>5</td>
          <td>2</td>
          <td>1</td>
          <td>4</td>
          <td>2</td>
          <td>5</td>
          <td>7</td>
          <td>622.52</td>
          <td>5</td>
          <td>5</td>
          <td>03/18/2016</td>

        </tr>

      </tbody>
    </table>
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
