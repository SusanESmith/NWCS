<?php
include('loginredirect.php');

include('nwcsdatabase.php');

$time = filter_input(INPUT_POST, 'time');
$storeID = filter_input(INPUT_POST, 'storeID');
$bDate = filter_input(INPUT_POST, 'bDate');
$eDate = filter_input(INPUT_POST, 'eDate');


//echo $storeID;

$bdatetime = $bDate;
$edatetime = $eDate;



//roundTime($d1,$precision);
//roundTime($d2,$precision);
//$s= $d1->diff($d2)->s;
//$h= $d1->diff($d2)->h;
//$d= $d1->diff($d2)->d;
//$w= $d1->diff($d2)->W;
//$m= $d1->diff($d2)->m;
//$y= $d1->diff($d2)->y;

/*echo $s."<br>";
echo $h."<br>";
echo $d."<br>";
//echo $w."<br>";
echo $m."<br>";
echo $y."<br>";*/




  $b=date('Y-m-d H:00:00', strtotime($bdatetime));
  $e=date('Y-m-d H:59:59', strtotime($edatetime));
  $b=new datetime($b);
  $e=new datetime($e);

  $d1 = new DateTime($bdatetime);
  $d2 = new DateTime($edatetime);
  //$array= array();
  //while ($b<$e){

  //$hend=clone $b;
  //$hend->add(new DateInterval('PT59M'));
  //echo $hend->format('Y-m-d H:i:s')."<br>";

  $query = "SELECT * FROM REGISTER_COUNT WHERE STORE_ID = :storeID AND COUNT_DATE BETWEEN :bdatetime AND :edatetime";
  $statement = $db->prepare($query);
  $statement->bindValue(':storeID', $storeID);
  $statement->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
  $statement->bindValue(':edatetime', $e->format('Y-m-d H:i:s'));
  $statement->execute();
  $sales = $statement->fetchAll();
  $statement->closeCursor();



  /*$query = "SELECT DISTINCT SUM(TRANSACTION_TOTAL) FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bdatetime AND :edatetime";
  $statement = $db->prepare($query);
  $statement->bindValue(':storeID', $storeID);
  $statement->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
  $statement->bindValue(':edatetime', $hend->format('Y-m-d H:i:s'));
  $statement->execute();
  $sales = $statement->fetchColumn();
  $statement->closeCursor();*/

//echo $sales."<br>";

?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Sales Report</title>
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
  <div class="container">
     <div class="row">
       <div class="col-md-10 col-md-offset-1">
<?php $test=""?>
<div class="page-header" style="text-align: center">
    <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
      <br>
    <h1><span class="label label-primary">Sales Report</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>

    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-list-alt"></span>
        <?php echo"Store:<span style=color:orange>  '".$storeID."' </span> register counts from <span style=color:orange>'".$b->format('Y-m-d')."'</span> to <span style=color:orange>'".$e->format('Y-m-d')."'</span>";?>

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
          <th>Register Count Date/Time</th>

          <th>Register Count</th>

          <th>Manager</th>



        </tr>
      </thead>
      <tbody>
        <?php foreach($sales as $s) {
          $man=$s['MANAGER_ID'];

          $query2 = "SELECT EMPLOYEE_ID FROM MANAGEMENT WHERE MANAGER_ID = :MAN ";
          $statement1 = $db->prepare($query2);
          $statement1->bindValue(':MAN', $man);
          //$statement1->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
          //$statement1->bindValue(':edatetime', $e->format('Y-m-d H:i:s'));
          $statement1->execute();
          $MID = $statement1->fetchColumn();
          $statement1->closeCursor();

        $emp=$MID;
          $query3 = "SELECT EMPLOYEE_LNAME, EMPLOYEE_FNAME FROM EMPLOYEE WHERE EMPLOYEE_ID = :eid ";
          $statement2 = $db->prepare($query3);
          $statement2->bindValue(':eid', $emp);
          //$statement1->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
          //$statement1->bindValue(':edatetime', $e->format('Y-m-d H:i:s'));
          $statement2->execute();
          $eid= $statement2->fetch();
          $statement2->closeCursor();

    ?>

        <tr>
          <td><?php echo $s['COUNT_DATE']; ?></td>
          <td><?php echo "$".$s['REGISTER_TOTAL']; ?></td>
          <td><?php echo $eid['EMPLOYEE_LNAME'].", ".$eid['EMPLOYEE_FNAME']; ?></td>

        </tr>
        <?php } ?>
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
