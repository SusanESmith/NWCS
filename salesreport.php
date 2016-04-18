<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Sales Reports</title>
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
  <div class="container">
     <div class="row">
       <div class="col-md-6 col-md-offset-3">
<?php $test=""?>
<div class="page-header" style="text-align: center">
    <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
      <br>
    <h1><span class="label label-primary">Sales Reporting</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
      <?php echo 'Please enter the following information:';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >

  <form method="post" action="salesreportquery.php" id="inventory" style="text-align:center">
    <div style="text-align:left">
    <label>Time parameter:</label>
    <select name="time"class="form-control">
      <!--drop down menu-->
      <option value="<?php echo "hourly";?>"><?php echo "hourly";?></option>
      <option value="<?php echo "daily";?>"><?php echo "daily";?></option>
      <option value="<?php echo "weekly";?>"><?php echo "weekly";?></option>
      <option value="<?php echo "monthly";?>"><?php echo "monthly";?></option>
      <option value="<?php echo "quarterly";?>"><?php echo "quarterly";?></option>
      <option value="<?php echo "yearly";?>"><?php echo "yearly";?></option>

    </select>
        <?php
        /*
        if(isset($_POST['time']))
        {
            $time = $_POST['time'];
        }
        */
        ?>
    <div class="form-group">
    <label for="storeID"><strong>Store ID: </strong></label>
  <input name="storeID" type="text" class="form-control" id="storeID" placeholder="Store Identification Number">
    </div>

    <div class="form-group">
    <label for="bDate"><strong>Beginning Date: </strong></label>
    <input name="bDate" type="date" class="form-control" id="bDate" placeholder="Beginning Date for Sales Report (yyyy-mm-dd)">
    </div>

    <div class="form-group">
    <label for="eDate"><strong>Ending Date: </strong></label>
  <input name="eDate" type="date" class="form-control" id="eDate" placeholder="Ending Date for Sales Report (yyyy-mm-dd)">
    </div>
        
    <div class="form-group">
    <label for="bTime"><strong>Beginning Time(leave blank if inapplicable): </strong></label>
  <input name="bTime" type="time" class="form-control" id="bTime" placeholder="Beginning Time for Sales Report (hh:mm)">
    </div>
        
    <div class="form-group">
    <label for="eTime"><strong>Ending Time(leave blank if inapplicable): </strong></label>
  <input name="eTime" type="time" class="form-control" id="eTime" placeholder="Ending Time for Sales Report (hh:mm)">
    </div>
   
    
    <?php
        /*
      if ($time == 'hourly')
        {
             echo "<div class=\"form-group\">
                    <label for=\"bTime\"><strong>Beginning Time: </strong></label>
                    <input name=\"bTime\" type=\"time\" class=\"form-control\" id=\"bTime\" placeholder=\"Beginning Time for Sales Report\">
                    </div>";
             echo "<div class=\"form-group\">
                    <label for=\"eTime\"><strong>Ending Time: </strong></label>
                    <input name=\"eTime\" type=\"time\" class=\"form-control\" id=\"eTime\" placeholder=\"Ending Time for Sales Report\">
                    </div>";
        }
          */

    ?>
<!--
<script type="text/javascript">
$(document).ready(function() {
    $("#time").change(function() {
        var time = $(this).val();
        $("#panel-body").html('');
        if(selVal == 'hourly') {
                $("#panel-body").append("<div class=\"form-group\"><label for=\"eTime\"><strong>Ending Time: </strong></label><input name=\"eTime\" type=\"time\" class=\"form-control\" id=\"eTime\" placeholder=\"Ending Time for Sales Report\"></div>");
                 $("#panel-body").append("<div class=\"form-group\"><label for=\"eTime\"><strong>Ending Time: </strong></label><input name=\"eTime\" type=\"time\" class=\"form-control\" id=\"eTime\" placeholder=\"Ending Time for Sales Report\"></div>");
        }
    });
});
</script>
-->
  </div>
      <label>&nbsp;</label>
      <input type="submit"class="btn btn-warning" value="Submit">
      
    </form>

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
