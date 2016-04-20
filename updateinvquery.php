<?php
include('loginredirect.php');
include('nwcsdatabase.php');
adminrights();
$prodID=filter_input(INPUT_POST, 'prodID');
$storeID=filter_input(INPUT_POST, 'storeID');
$price=filter_input(INPUT_POST, 'price');
//$catID=filter_input(INPUT_POST, 'catID');
$stockq=filter_input(INPUT_POST, 'stock');
$stockMin=filter_input(INPUT_POST, 'stockMin');
$date=filter_input(INPUT_POST, 'date');
//$pDesc=filter_input(INPUT_POST, 'pDesc');

$select='SELECT STOCK_QTY FROM STOCK WHERE PRODUCT_ID=:PRODUCT_ID AND :STORE_ID=STORE_ID';
$statement2= $db->prepare($select);
$statement2->bindValue(':PRODUCT_ID', $prodID);
$statement2->bindValue(':STORE_ID', $storeID);
$statement2->execute();
$stock = $statement2->fetchColumn();
$statement2->closeCursor();

$addStock=$stock+$stockq;



/*$CAT='SELECT CATEGORY_ID FROM PRODUCTS, CATEGORY WHERE STOCK.CATEGORY_ID=STOCK.CATEGORY_ID';
$statement3= $db->prepare($CAT);
$statement3->execute();
$catID = $statement3->fetch();
$statement3->closeCursor();
echo $catID."<br>";*/

$query='UPDATE STOCK SET STOCK_QTY=:STOCK_QTY, STOCK_MIN_QTY=:STOCK_MIN_QTY,
STOCK_LAST_RESTOCK=:STOCK_LAST_RESTOCK
WHERE STORE_ID=:STORE_ID AND PRODUCT_ID=:PRODUCT_ID;';
$statement= $db->prepare($query);
$statement->bindValue(':PRODUCT_ID',$prodID);
$statement->bindValue(':STORE_ID',$storeID);
//$statement->bindValue(':CATEGORY_ID',$catID);
$statement->bindValue(':STOCK_QTY',$addStock);
$statement->bindValue(':STOCK_MIN_QTY',$stockMin);
$statement->bindValue(':STOCK_LAST_RESTOCK',$date);
$statement->execute();
$statement->closeCursor();



$query1='UPDATE PRODUCTS SET PRODUCT_PRICE=:PRODUCT_PRICE

WHERE PRODUCTS.PRODUCT_ID=:PRODUCT_ID;';
$statement1= $db->prepare($query1);
$statement1->bindValue(':PRODUCT_PRICE',$price);
$statement1->bindValue(':PRODUCT_ID',$prodID);
//$statement1->bindValue(':P_DESC',$pDesc);
$statement1->execute();
$statement1->closeCursor();

$PRODUCT='SELECT PRODUCT_NAME FROM PRODUCTS WHERE PRODUCT_ID=:PRODUCT_ID';
$statement= $db->prepare($PRODUCT);
$statement->bindValue(':PRODUCT_ID',$prodID);
$statement->execute();
$prodName = $statement->fetchColumn();
$statement->closeCursor();

$PRODUCTS='SELECT PRODUCT_DESCRIPTION FROM PRODUCTS WHERE PRODUCT_ID=:PRODUCT_ID';
$statement= $db->prepare($PRODUCTS);
$statement->bindValue(':PRODUCT_ID',$prodID);
$statement->execute();
$pDesc = $statement->fetchColumn();
$statement->closeCursor();



$STORES='SELECT STORE_ADDRESS FROM STORE WHERE STORE_ID=:STORE_ID';
$statement2= $db->prepare($STORES);
$statement2->bindValue(':STORE_ID',$storeID);
$statement2->execute();
$store = $statement2->fetchColumn();
$statement2->closeCursor();

 ?>

<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Update Inventory</title>
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
    <h1><span class="label label-primary">Update Inventory</h1>
</div>
<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
      <?php echo "Product Information for Item: <span style=\"color:ORANGE\">'".$prodID." - ".$prodName.'\' </span>Inventory Information updated at Store ID Number <span style="color:ORANGE">\''.$storeID." - ".$store.'\'</span>: ';?>
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
          <th>Product ID Number</th>
          <th>Product Name</th>
          <th>Store ID Number</th>
          <th>Price</th>
          <th>Item Quantity</th>
          <th>Minimum Item Quantity</th>
          <th>Date Added</th>
          <th>Product Description</th>


        </tr>
      </thead>
      <tbody>
        <tr>

          <td><?php echo $prodID ?></td>
          <td><?php echo $prodName?></td>
          <td><?php echo $storeID?></td>
          <td><?php echo "$".$price ?></td>
          <td><?php echo $addStock ?></td>
          <td><?php echo $stockMin ?></td>
          <td><?php echo $date ?></td>
          <td><?php echo $pDesc ?></td>

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
