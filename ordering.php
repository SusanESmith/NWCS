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

  <form method="post" action="ordering.php" id="ordering" style="text-align:center">
    <div style="text-align:left">
    <div class="form-group">
    <label for="orderDate"><strong>Order Date: </strong></label>
  <input name="orderDate" type="text" class="form-control" id="orderDate" placeholder="Date Order is to be submitted">
    </div>

    <div class="form-group">
    <label for="storeID"><strong>Store ID: </strong></label>
  <input name="storeID" type="text" class="form-control" id="storeID" placeholder="Store Identiification Number">
    </div>

    <div class="form-group">
    <label for="prodID"><strong>Product ID: </strong></label>
  <input name="prodID" type="text" class="form-control" id="prodID" placeholder="Product Identification Number">
    </div>

    <div class="form-group">
    <label for="quantity"><strong>Quantity of Item to be Ordered: </strong></label>
  <input name="quantity" type="text" class="form-control" id="quantity" placeholder="Quantity of Item to be Ordered">
    </div>
  </div>
      <label>&nbsp;</label>
      <input type="submit" class="btn btn-warning" value="Add item to Order">

      <label>&nbsp;</label>
      <input type="submit" class="btn btn-warning" value="Submit Order">
    </form>

  </div>
  <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
  <p><strong><a href="logout.php">Click here to logout</a></strong></p>


  </div>
</div>
</div>
  <div class="col-md-6 col-md-offset-6" style="float: none; display: table-cell;">


    <div class="panel-group" style="text-align:center">
      <div class="panel panel-default">
        <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading\">";?>
          <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
            <?php echo 'Order Details:';?>
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
                  <th>Order Id Number</th>
                  <th>Order Date</th>
                  <th>Store ID</th>
                  <th>Product ID</th>
                  <th>Quantity</th>



                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>03/17/2016</td>
                  <td>S12</td>
                  <td>N3312</td>
                  <td>20</td>


                </tr>


              </tbody>
            </table>
          </div>
          </div>
        </div>
        </div>

        </div>

        <br><br>

      </div>
    </div>

  </div>
</div>

<div class="row">
  <div class="col-md-6 col-md-offset-3" style="text-align: center">
<?php
echo "The date is ".date("Y-m-d ")."and the time is ".date("h:i:sa "); ?>
</div>
  </div>
</div>
</div>
</div>

</body>
</html>
