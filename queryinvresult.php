<?php
include('loginredirect.php');

$prodID= filter_input(INPUT_POST, 'product');
$storeID = filter_input(INPUT_POST, 'store');

require_once('nwcsdatabase.php');
//$productName= 'test item';


$inv="SELECT * FROM STOCK WHERE PRODUCT_ID=$prodID AND STORE_ID=$storeID";
$statement2= $db->prepare($inv);
$statement2->execute();
$stock= $statement2->fetch();
$statement2->closeCursor();

$pName="SELECT PRODUCT_NAME FROM PRODUCTS WHERE PRODUCT_ID=$prodID";
$statement1= $db->prepare($pName);
$statement1->execute();
$prodName= $statement1->fetchColumn();
$statement1->closeCursor();

$CAT="SELECT CATEGORY_NAME FROM CATEGORY, PRODUCTS WHERE PRODUCT_ID=$prodID AND CATEGORY.CATEGORY_ID=PRODUCTS.CATEGORY_ID";
$statement3= $db->prepare($CAT);
$statement3->execute();
$category= $statement3->fetchColumn();
$statement3->closeCursor();

/*$pPRICE="SELECT PRODUCT_PRICE FROM PRODUCTS WHERE PRODUCT_ID=$prodID";
$statement4= $db->prepare($pPRICE);
$statement4->execute();
$price= $statement4->fetchColumn();
$statement4->closeCursor();*/




 ?>
<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Current Inventory</title>
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
    <h1><span class="label label-primary">Stock Information for the Chosen Location</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-tasks"></span>
        <?php echo "<span style=\"color:ORANGE\">'".$prodName.'\' </span>Inventory Information at Store ID Number <span style="color:ORANGE">\''.$storeID.'\'</span>: ';?>
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
          <?php if (empty($stock['STOCK_QTY'])) { ?>
            <div class="alert alert-warning" role="alert">
                <span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>
                <span class=""><h3>  This item: '<strong><?php echo $prodName?></strong>' is not in stock at Store Location '<strong><?php echo $storeID?></strong>.' </h3></span><br><br>
              <?php }
            else {?></div>
    <table class="table table-striped"style="text-align:left">

      <thead>
        <tr>

          <th>Product</th>
          <th>Product ID</th>
          <th>Category</th>
          <th>Price</th>
          <th>Quantity in stock</th>
          <th>Minimum Quantity</th>
          <th>Last Restock Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $prodName; ?></td>
          <td><?php echo $stock['PRODUCT_ID']; ?></td>
          <td><?php echo $category; ?></td>
          <td><?php echo "$".$stock['STOCK_PRICE']; ?></td>

          <td><?php if ($stock['STOCK_QTY']<$stock['STOCK_MIN_QTY']){
               echo "<span style=\"color:RED\">".$stock['STOCK_QTY']."</span>";}
           else {echo $stock['STOCK_QTY'];} ?></td>

          <td><?php echo $stock['STOCK_MIN_QTY']; ?></td>
          <td><?php echo $stock['STOCK_LAST_RESTOCK']; ?></td>
          <?php }?>
        </tr>

      </tbody>
    </table>
  </div>
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
