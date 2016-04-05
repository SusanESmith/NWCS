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
                              <tr>
                                <td>V42</td>
                                <td>Ed's Beer</td>
                                <td>931-324-1010</td>
                                <td>100 Beer Way</td>
                                <td>Clarksville</td>
                                <td>TN</td>
                                <td>37221</td>
                                <td>beer</td>
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
                  <input type="submit" name="newvendor" value="Add Form">
                  <br><br>
                  <?php $new=filter_input(INPUT_POST,'newvendor');
                  if (isset($new)){?>
                    <label><strong>Vendor Name: </strong></label>
                    <input name="Name" type="text">
                    <br><br>
                    <label><strong>Vendor phone: </strong></label>
                    <input name="vphone" type="text">
                    <br><br>
                    <label><strong>Vendor Address: </strong></label>
                    <input name="vaddress" type="text">
                    <br><br>
                    <label><strong>Vendor City: </strong></label>
                    <input name="vcity" type="text">
                    <br><br>
                    <label><strong>Vendor State: </strong></label>
                    <input name="vstate" type="text">
                    <br><br>
                    <label><strong>Vendor Zip Code: </strong></label>
                    <input name="vzip" type="text">
                    <br><br>
                    <label><strong>Vendor Items: </strong></label>
                    <input name="vitems" type="text">
                    <br><br>
                </form>
                <form method="post" name="newvendor" action="addvendor.php" id="newvendor" style="text-align:center">
                  <input type="submit" name="newvendor" value="Click Here to Add New Vendor">
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
