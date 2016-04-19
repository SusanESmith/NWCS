<?php
include('nwcsdatabase.php');

$time = filter_input(INPUT_POST, 'time');
$storeID = filter_input(INPUT_POST, 'storeID');
$bDate = filter_input(INPUT_POST, 'bDate');
$eDate = filter_input(INPUT_POST, 'eDate');


//echo $storeID;

$bdatetime = $bDate;
$edatetime = $eDate;

$title="blah";


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



if ($time == 'Hourly')
{
  $b=date('Y-m-d H:00:00', strtotime($bdatetime));
  $e=date('Y-m-d H:00:00', strtotime($edatetime));
  $b=new datetime($b);
  $e=new datetime($e);

  $d1 = new DateTime($bdatetime);
  $d2 = new DateTime($edatetime);
  $array= array();
  while ($b<$e){

  $hend=clone $b;
  $hend->add(new DateInterval('PT59M'));
  //echo $hend->format('Y-m-d H:i:s')."<br>";
  $query = "SELECT DISTINCT SUM(TRANSACTION_TOTAL) FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bdatetime AND :edatetime";
  $statement = $db->prepare($query);
  $statement->bindValue(':storeID', $storeID);
  $statement->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
  $statement->bindValue(':edatetime', $hend->format('Y-m-d H:i:s'));
  $statement->execute();
  $sales = $statement->fetchColumn();
  $statement->closeCursor();

//echo $sales."<br>";
if (!empty($sales)){
  $row=array($sales,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));


}
else {  $row=array(0,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));
}
  array_push($array, $row);

  $b->add(new DateInterval('PT1H'));

  }
//  print_r($array);
    $title="Hourly";


//$d1 = new \DateTime($bdatetime);
//$d2 = new \DateTime($edatetime);
//echo $d1->diff($d2)->hours;


}
else if ($time=='Weekly'){
  $b=date('Y-m-d 00:00:00', strtotime($bdatetime));
  $e=date('Y-m-d 23:59:00', strtotime($edatetime));
  $b=new datetime($b);
  $e=new datetime($e);

  $d1 = new DateTime($bdatetime);
  $d2 = new DateTime($edatetime);
  $title="Weekly";
  $array= array();
  while ($b<$e){

  $hend=clone $b;
  $hend->add(new DateInterval('P6DT23H59M'));
  //echo $hend->format('Y-m-d H:i:s')."<br>";
  $query = "SELECT DISTINCT SUM(TRANSACTION_TOTAL) FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bdatetime AND :edatetime";
  $statement = $db->prepare($query);
  $statement->bindValue(':storeID', $storeID);
  $statement->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
  $statement->bindValue(':edatetime', $hend->format('Y-m-d H:i:s'));
  $statement->execute();
  $sales = $statement->fetchColumn();
  $statement->closeCursor();

//echo $sales."<br>";
if (!empty($sales)){
  $row=array($sales,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));


}
else {  $row=array(0,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));
}
  array_push($array, $row);

  $b->add(new DateInterval('P7D'));

  }

}
else if ($time=='Daily'){
  $title="Daily";
  $b=date('Y-m-d 00:00:00', strtotime($bdatetime));
  $e=date('Y-m-d 23:59:00', strtotime($edatetime));
  $b=new datetime($b);
  $e=new datetime($e);

  $d1 = new DateTime($bdatetime);
  $d2 = new DateTime($edatetime);

  $array= array();
  while ($b<$e){

  $hend=clone $b;
  $hend->add(new DateInterval('PT23H59M'));
  //echo $hend->format('Y-m-d H:i:s')."<br>";
  $query = "SELECT DISTINCT SUM(TRANSACTION_TOTAL) FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bdatetime AND :edatetime";
  $statement = $db->prepare($query);
  $statement->bindValue(':storeID', $storeID);
  $statement->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
  $statement->bindValue(':edatetime', $hend->format('Y-m-d H:i:s'));
  $statement->execute();
  $sales = $statement->fetchColumn();
  $statement->closeCursor();

//echo $sales."<br>";
if (!empty($sales)){
  $row=array($sales,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));


}
else {  $row=array(0,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));
}
  array_push($array, $row);

  $b->add(new DateInterval('P1D'));

  }

}
else if ($time=="Monthly"){
  $title="Monthly";
  $b=date('Y-m-d 00:00:00', strtotime($bdatetime));
  $e=date('Y-m-d 23:59:00', strtotime($edatetime));
  $b=new datetime($b);
  $e=new datetime($e);

  $d1 = new DateTime($bdatetime);
  $d2 = new DateTime($edatetime);

  $array= array();
  while ($b<$e){

  $hend=clone $b;
  $hend->add(new DateInterval('P1M'));
  $hend->modify("-1 second");
  //echo $hend->format('Y-m-d H:i:s')."<br>";
  $query = "SELECT DISTINCT SUM(TRANSACTION_TOTAL) FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bdatetime AND :edatetime";
  $statement = $db->prepare($query);
  $statement->bindValue(':storeID', $storeID);
  $statement->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
  $statement->bindValue(':edatetime', $hend->format('Y-m-d H:i:s'));
  $statement->execute();
  $sales = $statement->fetchColumn();
  $statement->closeCursor();

//echo $sales."<br>";
if (!empty($sales)){
  $row=array($sales,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));


}
else {  $row=array(0,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));
}
  array_push($array, $row);

  $b->add(new DateInterval('P1M'));

  }

}

else if ($time=="Yearly"){
  $title="Yearly";
  $b=date('Y-m-d 00:00:00', strtotime($bdatetime));
  $e=date('Y-m-d 23:59:00', strtotime($edatetime));
  $b=new datetime($b);
  $e=new datetime($e);

  $d1 = new DateTime($bdatetime);
  $d2 = new DateTime($edatetime);

  $array= array();
  while ($b<$e){

  $hend=clone $b;
  $hend->add(new DateInterval('P1Y'));
  $hend->modify("-1 second");
  //echo $hend->format('Y-m-d H:i:s')."<br>";
  $query = "SELECT DISTINCT SUM(TRANSACTION_TOTAL) FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bdatetime AND :edatetime";
  $statement = $db->prepare($query);
  $statement->bindValue(':storeID', $storeID);
  $statement->bindValue(':bdatetime', $b->format('Y-m-d H:i:s'));
  $statement->bindValue(':edatetime', $hend->format('Y-m-d H:i:s'));
  $statement->execute();
  $sales = $statement->fetchColumn();
  $statement->closeCursor();

//echo $sales."<br>";
if (!empty($sales)){
  $row=array($sales,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));


}
else {  $row=array(0,$b->format('Y-m-d H:i:s'),$hend->format('Y-m-d H:i:s'));
}
  array_push($array, $row);

  $b->add(new DateInterval('P1Y'));

  }

}
else
{
    $query = "SELECT TRANSACTION_TOTAL FROM TRANSACTIONS WHERE STORE_ID = :storeID AND TRANSACTION_DATE BETWEEN :bDate AND :eDate";
    $statement = $db->prepare($query);
    $statement->bindValue(':storeID', $storeID);
    $statement->bindValue(':bDate', $bDate);
    $statement->bindValue(':eDate', $eDate);
    $statement->execute();
    $sales = $statement->fetchColumn();
    $statement->closeCursor();
}
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
        <?php echo"<span style=color:orange>  '".$title."' </span> Sales report for Store <span style=color:orange>'".$storeID."'</span>";?>

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
          <th>Report Starting Point</th>
          <th>Report Ending Point</th>
          <th>Total Sales</th>



        </tr>
      </thead>
      <tbody>
        <?php foreach($array as $a) {?>
        <tr>
          <td><?php echo $a[1]; ?></td>
          <td><?php echo $a[2]; ?></td>
          <td><?php echo "$".$a[0]; ?></td>

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
<?php
echo "The date is ".date("Y-m-d ")."and the time is ".date("h:i:sa "); ?>

  </div>
</div>
</div>

</body>
</html>
