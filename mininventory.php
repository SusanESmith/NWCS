<?php   include('loginredirect.php');

include('nwcsdatabase.php');

$stID = filter_input(INPUT_POST, 'store');


$store='SELECT * FROM STORE WHERE :store=STORE_ID';
$statement= $db->prepare($store);
$statement->bindValue(':store', $stID);
$statement->execute();
$storeID = $statement->fetch();
$statement->closeCursor();


//echo $storeID['STORE_']."<br>";
$query='SELECT * FROM STOCK,PRODUCTS WHERE :store=STORE_ID and STOCK_QTY<STOCK_MIN_QTY AND STOCK.PRODUCT_ID=PRODUCTS.PRODUCT_ID';
$statement1= $db->prepare($query);
$statement1->bindValue(':store', $stID);
$statement1->execute();
$stock = $statement1->fetchAll();
$statement1->closeCursor();

$check=count($stock);




 ?>

<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Minimum Inventory Check</title>
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
    <h1><span class="label label-primary">Minimum Inventory Results</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-tasks"></span>
      <?php if ($check==0){
        echo 'All Items at Store Location <span style=color:orange>\''.$stID." - ".$storeID['STORE_ADDRESS'].'\' </span> are in Stock Above the Minimum Inventory Amount. ';?>

          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 col-md-offset-0">

      <?php }
      else{
       echo 'The Following Items are below Minimum Stock Quantity at Store Location <span style=color:orange>\''.$stID." - ".$storeID['STORE_ADDRESS'].'\' </span> and need to be reordered: ';?>
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
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Current Quantity</th>
          <th>Minimum Stock Quantity</th>


        </tr>
      </thead>
      <tbody>
        <?php foreach ($stock as $s){?>
        <tr class="danger">
        <td><?php echo $s['STORE_ID'] ?></td>
        <td><?php echo $s['PRODUCT_ID'] ?></td>
        <td><?php echo $s['PRODUCT_NAME'] ?></td>
        <td><?php echo $s['STOCK_QTY'] ?></td>
        <td><?php echo $s['STOCK_MIN_QTY'] ?></td>

      <?php } ?>

        </tr>


      </tbody>
    </table>
  </div>
    <form method="post" name="searchemp" action="ordering.php" id="minorder" style="text-align:center">
        <label><strong>Go to Order Form? </strong></label>


        <label>&nbsp;</label>
        <input type="submit" name="enterBtn"class="btn btn-warning"  value="Go">
          <?php } ?>
        <br><br>
  </div>
</div>
</div>

  </body>
  </html>




  </div>
  <p><strong><a href="inventory.php">Back to the Inventory Menu</a></strong></p>
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
