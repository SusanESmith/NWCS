

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
   <!--use bootstrap grid system to control placement of elements-->
     <div class="container">
     <div class="row">
     <div class="col-md-6 col-md-offset-3">

    <div class="page-header" style="text-align: center">
        <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
          <br>
        <h1><span class="label label-primary">Employee Profile</h1>
    </div>

    <?php $test="test"?>
    <!--panel title-->
    <div class="panel-group">
    <div class="panel panel-default">
      <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
        <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
          <?php echo 'Joe Smith';?>
        </h4>
   </div>

   <!--panel body-->
      <?php echo "<div id=\"collapse".$test."\" class=\"panel-collapse collapse in\" role=\"tabpanel\" aria-labelledby=\"heading".$test."\">";?>

        <div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656">
          <?php
            echo "<strong>Emp ID: </strong>12345"."<br><br>\n";
            echo "<strong>Emp Full Name:  </strong>Joe Smith"."<br><br>\n";
            echo "<strong>Emp Address:</strong> 100 Main Street, Clarksville, TN "."<br><br>\n";
            echo "<strong>Employee Hours:  </strong>table with hours-link to other page"."<br><br>\n";
            echo "<strong>Employee currently on the clock-y or n </strong>"."<br><br>\n";
            echo "<strong>Special notes-hidden</strong>"."<br><br>\n";
          ?>


        </div>
      </div>
    </div>


      </div>
    </div>
  </div>

  </body>
</html>
