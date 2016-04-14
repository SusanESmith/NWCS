<?php
session_start();

$confirm=filter_input(INPUT_POST, 'confirm');
if (isset($confirm)){
$_SESSION['vendID']=filter_input(INPUT_POST,'vendor');}

if (isset($_SESSION['vendID'])){
  $vendorID=$_SESSION['vendID'];
}
$pid=filter_input(INPUT_GET, 'pid');
if ($pid!==NULL){
$temp=array();
$cnt=0;

foreach($_SESSION['order'] as $ca){
  if ($cnt!=$pid){
    array_push($temp,$ca);
  }$cnt++;
}
unset($_SESSION['order']);
$_SESSION['order']=$temp;
}
//$storeID=$_SESSION['store'];

$empID=$_SESSION['username'];

include('nwcsdatabase.php');
$VENDOR='SELECT * FROM VENDOR';
$statement= $db->prepare($VENDOR);
$statement->execute();
$vend = $statement->fetchAll();
$statement->closeCursor();
if (isset($vendorID)){
$PRODUCT='SELECT * FROM PRODUCTS WHERE VENDOR_ID=:VENDOR_ID';
$statement1= $db->prepare($PRODUCT);
$statement1->bindValue(':VENDOR_ID', $vendorID);
$statement1->execute();
$PRODUCTS = $statement1->fetchAll();
$statement1->closeCursor();
}

$STORE='SELECT * FROM STORE';
$statement2= $db->prepare($STORE);
$statement2->execute();
$STORES = $statement2->fetchAll();
$statement2->closeCursor();
$total=0;
$count=0;
$orderDate=date("Y-m-d");
$display="The dateeee is ".date("Y-m-d ")."and the time is ".date("h:i:sa ");




?>


<!DOCTYPE html>
<html lang="en">

 <head>
   <title>Ordering</title>
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
      <div class="col-md-6 col-md-offset-3" style="float: none; height: 100%">
        <div class="page-header" style="text-align: center">
            <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
            <br>
            <h1><span class="label label-primary">Ordering</h1>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
<?php $test=""?>

<div class="panel-group" style="text-align:center">
<div class="panel panel-default">
  <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
    <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
      <?php echo 'Please enter the following information:';?>
    </h4>
</div>

<!--panel body-->


<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >
<?php if (!isset($_SESSION['vendID'])){ ?>
  <form method="post" action="ordering.php" id="ordering" style="text-align:center">
    <div style="text-align:left">

      <label>Vendor:</label>

    <select name="vendor" class="form-control">
      <?php foreach ($vend as $v):?>
      <option value="<?php echo $v['VENDOR_ID'];?>"><?php echo $v['VENDOR_ID']." - ".$v['VENDOR_NAME'];?></option>
    <?php endforeach;  ?>
    </select>
  </div><br>
    <input type="submit" name="confirm" class="btn btn-warning" value="Confirm Vendor" id="confirm">
  </form>
  <?php }
  if (isset($_SESSION['vendID'])){
      //echo $_SESSION['vendID'];
    $vendID= filter_input(INPUT_POST, 'vendor');
    $VENDing='SELECT VENDOR_NAME FROM VENDOR WHERE VENDOR_ID=:VENDid';
    $statement4= $db->prepare($VENDing);
    $statement4->bindValue(':VENDid', $vendorID);
    $statement4->execute();
    $vendors = $statement4->fetchColumn();
    $statement4->closeCursor();
    ?>
  <form method="post" action="ordering.php" id="ordering" style="text-align:center">
    <div style="text-align:left">

      <label>Store:</label>

    <select name="store" class="form-control">
      <?php foreach ($STORES as $s):?>
      <option value="<?php echo $s['STORE_ID'];?>"><?php echo $s['STORE_ID']." - ".$s['STORE_ADDRESS'];?></option>
    <?php endforeach;  ?>
    </select>

    <label>Products Supplied by this Vendor:</label>

    <select name="prodID" class="form-control">
      <?php foreach ($PRODUCTS as $p):?>
      <option value="<?php echo $p['PRODUCT_ID'];?>"><?php echo $p['PRODUCT_ID']." - ".$p['PRODUCT_NAME']." - ".$p['PRODUCT_DESCRIPTION'];?></option>
    <?php endforeach;  ?>
    </select>

    <div class="form-group">
    <label for="quantity"><strong>Quantity of Item to be Ordered: </strong></label>
  <input name="quantity" type="number" class="form-control" id="quantity" min="1" placeholder="Quantity of Item to be Ordered" required>
    </div>

    <div class="form-group">
    <label for="orderDate"><strong>Order Date: </strong></label>
  <input name="orderDate" value="<?php echo date("Y-m-d");?>" type="date" class="form-control" id="orderDate" placeholder="Date Order is to be submitted">
    </div>
  </div>
  <label>&nbsp;</label>
  <input type="submit" name="add" class="btn btn-warning" value="Add item to Order">
</form>
<?php } ?>
  <form method="post" name="enter" action="ordering.php" id="ordeSubmit" style="text-align:center">
<br>
        <label>&nbsp;</label>
      <input type="submit" name="done" class="btn btn-warning" value="Submit Order">
    </form>

  </div>


  <p><strong><a href="orders.php">Back to the Orders Menu</a></strong></p>

  <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
  <p><strong><a href="logout.php">Click here to logout</a></strong></p>


  </div>
</div>
</div>
  <div class="col-md-6 col-md-offset-6" style="float: none; display: table-cell;">


    <div class="panel-group" style="text-align:center">
      <div class="panel panel-default">
        <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading\">"; ?>
          <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
            <?php if (!isset($vendorID)) {
              echo "Order Details: ";}
              else if (isset($vendorID)){
            echo "Order Date:<span style=\"color:ORANGE\"> '".$orderDate."'</span><br><br> Vendor: <span style=\"color:ORANGE\">'".$vendorID." - ".$vendors."'</span>";}?>
          </h4>
        </div>

        <!--panel body-->

        <div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >
          <?php
            $add=filter_input(INPUT_POST,'add', FILTER_VALIDATE_FLOAT);
            $prodID=filter_input(INPUT_POST,'prodID');
            $quantity=filter_input(INPUT_POST,'quantity');
            $store=filter_input(INPUT_POST,'store');
            $orderDate=filter_input(INPUT_POST,'orderDate');




            if (isset($add)){

              $query='SELECT  STOCK_PRICE FROM STOCK WHERE PRODUCT_ID=:PRODID  AND STORE_ID=:STOREID';
              $statement3= $db->prepare($query);
              $statement3->bindValue(':STOREID', $store);
              $statement3->bindValue(':PRODID', $prodID);
              $statement3->execute();
              $shop = $statement3->fetch();
              $statement3->closeCursor();

              $price=$shop['STOCK_PRICE'];

              $item=array("store"=>$store,"prodID"=>$prodID, "quantity"=>$quantity, "price"=>$price);

              $_SESSION['order'][]=$item;

            }?>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 col-md-offset-0">
                <!--<h3><span class="label label-primary">In stock items at (store number)</h3>-->
              <!--<p>The .table-striped class adds zebra-stripes to a table:</p>-->
                <div class="table-responsive">
            <table class="table table-striped"style="text-align:left">

              <thead>
                <tr>
                  <!--<th>Order Id Number</th>-->
                  <!--<th>Order Date</th>-->
                  <th>Store ID</th>
                  <th>Product ID</th>
                  <th>Order Quantity</th>



                </tr>
              </thead>
              <tbody>
                <?php

                if (isset($_SESSION['order'])){


              foreach($_SESSION['order'] as $c) {?>
                <tr>
                  <!--<td>1</td>-->
                  <!--<td>03/17/2016</td>-->
                  <td><?php echo $c['store'] ?></td>
                  <td><?php echo $c['prodID'] ?></td>
                  <td><?php echo $c['quantity'] ?></td>
                  <td><button class= "btn btn-warning" onclick="window.location.href='ordering.php?pid=<?php echo $count?>'">Delete Item</button></td>
                  <?php $count++;
                  //not going to output price
                  $total=$c['price']*$c['quantity']+$total;?>

                </tr>
              <?php  }?>


              </tbody>
            </table>
          </div>
          </div>
        </div><?php }?>
                </div>
                <br>

                </div>


            <?php          $done=filter_input(INPUT_POST,'done', FILTER_VALIDATE_FLOAT);
if (isset($add)||isset($done)){
              $tax=$total*.095;
              $orderTotal=$total+$tax;?>
                <h3><span class="label label-primary"><?php echo "<strong>Total Cost: $</strong>".number_format($total, 2);?></span></h3>
            <h3><span class="label label-primary"><?php echo "<strong>Tax: $</strong>".number_format($tax, 2);?></span></h3>
                <h3><span class="label label-primary" ><?php echo "<strong>Total Amount for this Order: $</strong>"?> <span id="due"><?php echo number_format($orderTotal, 2); ?></span></span></h3>
        <?php }

        if (isset($done)){
          if (count($_SESSION['order'])>0) {
            $status='true';
          } else {
            $status='false';
          }
          if ($status=='true') {
            $orderTotal=number_format($orderTotal, 2);

              $orderDate=date("Y-m-d");

            $O='INSERT INTO ORDERS
                           (VENDOR_ID, ORDER_DATE, ORDER_TOTAL)
                        VALUES
                           (:V, :ODATE,:TOTAL)';

            $statement5 = $db->prepare($O);
            $statement5->bindValue(':V', $vendorID);
            $statement5->bindValue(':ODATE', $orderDate);
            $statement5->bindValue(':TOTAL', $orderTotal);
            $statement5->execute();
            $statement5->closeCursor();

            $oID='SELECT ORDER_ID FROM ORDERS WHERE ORDER_ID=LAST_INSERT_ID()';
            $statement8= $db->prepare($oID);
            //$statement->bindValue(':POSITION', $position);
            $statement8->execute();
            $orderID=$statement8->fetchColumn();
            $statement8->closeCursor();


            foreach($_SESSION['order'] as $i){
              $tot=$i['price']*$i['quantity'];
              $td='INSERT INTO ORDER_DETAILS
                             (ORDER_ID, PRODUCT_ID, STORE_ID, ORDER_QUANTITY,ORDER_PRICE)
                          VALUES
                             (:ORDERID, :PID, :SID, :QTY, :PRICE)';

              $statement3 = $db->prepare($td);
              $statement3->bindValue(':ORDERID', $orderID);
              $statement3->bindValue(':PID', $i['prodID']);
              $statement3->bindValue(':SID', $i['store']);
              $statement3->bindValue(':QTY', $i['quantity']);
              $statement3->bindValue(':PRICE', $tot);
              $statement3->execute();
              $statement3->closeCursor();
            }
            unset($_SESSION['vendID']);
            unset($_SESSION['order']);
          }

?>
            <h4 class="panel-title" style="font-weight:bold; font-size: 150%">

              <?php echo '<br>Order Complete! Order ID Number: <span style=color:orange>\''.$orderID.'\'</span> <br>You can view this order in the \'View/Edit Current Open Orders\' page.';?>
            </h4><br><br>
        <?php  }
        ?>


        </div>

        <br><br>

      </div>

    </div>

  </div>

  <!--<div class="row">
    <div class="col-md-6 col-md-offset-3" style="text-align: center">
      <?php echo $display; ?>-->
    </div>
  </div>
</div>

</body>

</html>
