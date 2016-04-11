<?php
include('nwcsdatabase.php');
$query='SELECT * FROM VENDOR';
$statement1= $db->prepare($query);
$statement1->execute();
$vend= $statement1->fetchAll();
$statement1->closeCursor();

$query2='SELECT * FROM PRODUCTS';
$statement2= $db->prepare($query2);
$statement2->execute();
$products= $statement2->fetchAll();
$statement2->closeCursor();
 ?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Vendors</title>
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
             <h1><span class="label label-primary">Vendors Information</h1>
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-10 col-md-offset-1">
           <div class="panel-group" style="text-align:center">
             <div class="panel panel-default">
                <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading".$test."\">";?>
                  <h4 class="panel-title" style="font-weight:bold; font-size: 150%">
                    <?php echo 'These are the vendors associated with NWCS: ';?>
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
                                <th>Vendor ID</th>
                                <th>Vendor Name</th>
                                <th>Vendor Phone</th>
                                <th>Vendor Address</th>
                                <th>Vendor City</th>
                                <th>Vendor State</th>
                                <th>Vendor Zip Code</th>

                                <th>Vendor Products</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($vend as $v){?>
                              <tr>
                                <td><?php echo $v['VENDOR_ID']?></td>
                                <td><?php echo $v['VENDOR_NAME']?></td>
                                <td><?php echo $v['VENDOR_POC_PHONE']?></td>
                                <td><?php echo $v['VENDOR_ADDRESS']?></td>
                                <td><?php echo $v['VENDOR_CITY']?></td>
                                <td><?php echo $v['VENDOR_STATE']?></td>
                                <td><?php echo $v['VENDOR_ZIP']?></td>
                                <td>
                                  <div class="dropdown" class="form-control">
                                    <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown">Vendor Products
 <span class="caret"></span></button>
  <ul class="dropdown-menu" style="height:auto;max-height:300px; overflow-x:hidden;">
                                <?php

                                foreach ($products as $p){
                                  if ($p['VENDOR_ID']==$v['VENDOR_ID']){
                                  ?>
                                  <li><?php echo $p['PRODUCT_NAME']." - ".$p['PRODUCT_DESCRIPTION']?></li>

                                    <?php }}?></ul></div></td><?php } ?>









                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <p><strong><a href="contacts.php">Back to the Contacts Menu</a></strong></p>
              <p><strong><a href="menu.php">Back to the Main Menu</a></strong></p>
              <p><strong><a href="logout.php">Click here to logout</a></strong></p>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="panel-group" style="text-align:center">
            <div class="panel panel-default">
              <?php echo "<div class=\"panel-heading\" role=\"tab\" id=\"heading\">";?>
                <h4 class="panel-title" style="font-weight:bold; font-size: 150%; ">
                  <?php echo 'Or Add a New Vendor:';?>
                </h4>
              </div>
              <!--panel body-->
              <div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >
                <form method="post" name="newvendor" action="vendors.php" id="newvendor" style="text-align:center">
                  <input type="submit" name="newvendor" class="btn btn-warning" value="Add Form">
                  <br><br>
                  <?php $new=filter_input(INPUT_POST,'newvendor');
                  if (isset($new)){?>
					</form>
					<form method="post" name="newvendor" action="addvendor.php" id="newemp" style="text-align:center">
                    <div style="text-align:left">
                    <div class="form-group">
                    <label for="name"><strong>Vendor Name: </strong></label>
                  <input name="name" type="text" class="form-control" id="name" placeholder="Vendor Name">
                    </div>

                  <div class="form-group">
                    <label for="vphone"><strong>Vendor Phone: </strong></label>
                  <input name="vphone" type="text" class="input-medium bfh-phone; form-control" data-country="US" id="vphone" placeholder="Vendor Phone Number">
                    </div>

					<div class="form-group">
                      <label for="vaddress"><strong>Vendor Address: </strong></label>
                    <input name="vaddress" type="text" class="form-control" id="vaddress" placeholder="Vendor Street Address">
                      </div>

                      <div class="form-group">
                        <label for="vcity"><strong>Vendor City: </strong></label>
                      <input name="vcity" type="text" class="form-control" id="vcity" placeholder="Vendor City">
                        </div>

                        <div class="form-group">
                          <label for="vstate"><strong>Vendor State: </strong></label>
                        <input name="vstate" type="text" class="form-control" id="vstate" placeholder="Vendor State">
                          </div>

                          <div class="form-group">
                            <label for="vzip"><strong>Vendor Zip Code: </strong></label>
                          <input name="vzip" type="text" class="form-control" id="vzip" placeholder="Vendor Zip Code">
                            </div>



                  </div>
				  <input type="submit" name="newvendor" class="btn btn-warning" value="Click Here to Add New Vendor">
                </form>
                
                  
                <?php  }?>
              </div>
              <br><br>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-md-offset-3" style="text-align: center">
          <?php echo "The date is ".date("Y-m-d ")."and the time is ".date("h:i:sa "); ?>
        </div>
      </div>
    </div>
  </body>
</html>
