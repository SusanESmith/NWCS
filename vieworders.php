<?php
include('loginredirect.php');
include('nwcsdatabase.php');

$query2='SELECT * FROM ORDERS, VENDOR WHERE ORDER_RECEIVED_DATE IS NULL AND ORDERS.VENDOR_ID=VENDOR.VENDOR_ID';
$statement= $db->prepare($query2);
$statement->execute();
$orders= $statement->fetchAll();
$statement->closeCursor();

$date=date('Y-m-d');


 ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Current Orders</title>
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
             <h1><span class="label label-primary">Incoming Orders:</h1>
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-10 col-md-offset-1">
           <div class="panel-group" style="text-align:center">
             <div class="panel panel-default">
                <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
                  <h4 class="panel-title" style="font-weight:bold; font-size: 150%"><span class="glyphicon glyphicon-th-large"></span>
                    <?php echo 'Current Open Orders: ';?>
                  </h4>
                </div>

                 <!--panel body-->

                <div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >

                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12 col-md-offset-0">
                        <!--<h3><span class="label label-primary">In stock items at (store number)</h3>-->
                      <!--<p>The .table-striped class adds zebra-stripes to a table:</p>-->
                        <div class="table-responsive table-condensed">
                          <table class="table table-striped"style="text-align:left">
                            <thead>
                              <tr>
                                <th>Order ID</th>
                                <th>Order Details</th>

                                <th>Date of Order</th>

                                <th>Order Total</th>
                                <th>Vendor Name</th>
                                <th>Receive this Order Now?</th>

                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($orders as $o){

                                $query3='SELECT * FROM ORDER_DETAILS, PRODUCTS, STORE WHERE ORDER_ID=:ORDERID AND ORDER_DETAILS.PRODUCT_ID=PRODUCTS.PRODUCT_ID AND ORDER_DETAILS.STORE_ID=STORE.STORE_ID';
                                $statement4= $db->prepare($query3);
                                $statement4->bindValue('ORDERID', $o['ORDER_ID']);
                                $statement4->execute();
                                $prod= $statement4->fetchAll();
                                $statement4->closeCursor();


                                ?>
                              <tr>
                                <td><?php echo $o['ORDER_ID']?></td>
                                <td>
                                  <div class="alert alert-warning" role="alert">

                              <?php

                              foreach ($prod as $p){

                                ?>
                                <?php echo "<span class=\"glyphicon glyphicon-grain\" aria-hidden=\"true\"></span> <strong> Product: </strong>".$p['PRODUCT_ID']." - ".$p['PRODUCT_NAME']." - ".$p['PRODUCT_DESCRIPTION']." <strong> Quantity: </strong> ".$p['ORDER_QUANTITY']."   <strong> Store: </strong>".$p['STORE_ID']." - ".trim($p['STORE_ADDRESS']);?>
                                    <br>
                                  <?php }?></div></td>
                                <td><?php echo $o['ORDER_DATE']?></td>
                                <td><?php echo "$".$o['ORDER_TOTAL']?></td>
                                <td><?php echo $o['VENDOR_NAME']?></td>
                                <td><button class= "btn btn-warning" onclick="window.location.href='vieworders.php?oID=<?php echo $o['ORDER_ID']?>'">Receive this Order</button></td>


                                <?php }


                                $oID=filter_input(INPUT_GET,'oID');
                                  if(isset($oID)){
                                    $update='UPDATE ORDERS SET ORDER_RECEIVED_DATE=:RECDATE WHERE ORDER_ID=:ORDERID';
                                    $statement6= $db->prepare($update);
                                    $statement6->bindValue(':ORDERID', $oID);
                                    $statement6->bindValue(':RECDATE', $date);
                                    $statement6->execute();

                                    $statement6->closeCursor();

                                  }
                                ?>






                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <p><strong><a href="orders.php">Back to the Orders Menu</a></strong></p>
              <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
              <p><strong><a href="logout.php">Click here to logout</a></strong></p>
            </div>
          </div>
        </div>
      </div>
      <br>


    </div>
    <div style="text-align:center">
    <h4><span class="label label-info" style="padding:10px;">
    <?php echo "Date: ".date("Y-m-d ")." Time: ".date("h:i:sa "); ?>
    </span></h4>

    </div>
  </body>
</html>
