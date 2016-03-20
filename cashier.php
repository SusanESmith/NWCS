<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php
  if (!isset($_SESSION["arrayID"])) {
    $_SESSION["arrayID"]=array();
  }
  if (!isset($_SESSION["arrayQ"])) {
    $_SESSION["arrayQ"]=array();
  }
?>

 <head>
   <title>Cashier Process</title>
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
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 col-md-offset-3" style="float: none; height: 100%">
        <div class="page-header" style="text-align: center">
            <h1 style="padding-right:15px"><strong><span class= "label label-warning">North Willow Convenience Stores</span></strong></h1>
            <br>
            <h1><span class="label label-primary">Cashier Process</h1>
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

      <?php echo 'Cashier Transaction:';?>
    </h4>
</div>

<!--panel body-->

<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >

  <form method="post" name="products" action="cashier.php" id="cashiersale" style="text-align:center">
      <label><strong>Product ID: </strong></label>
    	<input name="prodID" type="text">
      <br><br>
      <label><strong>Quantity: </strong></label>
    	<input name="quantity" type="text">
      <br><br>

      <br>
      <label>&nbsp;</label>
			<input type="submit" name="enterBtn" value="Enter Values">
      <br>

	</form>
    <form method="post" name="enter" action="cashier.php" id="cashierpay" style="text-align:center">
      <br>
    <input type="submit" name="pay" value="Complete Transaction">
        <br><br>
        <?php
        $pay=filter_input(INPUT_POST,'pay',FILTER_VALIDATE_FLOAT);


        if (isset($pay)){?>
    <label>Payment Type:</label>
    <select name="payment">
      <!--drop down menu-->
    <option value="<?php echo "cash";?>"><?php echo "Cash";?></option>
      <option value="<?php echo "card";?>"><?php echo "Credit or Debit";?></option>
      <option value="<?php echo "check";?>"><?php echo "Check";?></option>
      <option value="<?php echo "charge";?>"><?php echo "Charge Account";?></option>
    </select>
    <br><br>
    <input type="submit" name="confirm" value="Confirm Payment Type">

  <?php } ?>
    <br>
  </form>


    <?php

    $payment=filter_input(INPUT_POST, 'payment');
    if ($payment=="cash") {
      echo
        "<form method=\"post\" action=\"transSale.php\" id=\"transSale\" style=\"text-align:center\">
          <br>
        <label><strong>Total Payment: </strong></label>
        <input name=\"cash\" type=\"text\">
        <br><br>
        <label><strong>Total Cash Received: </strong></label>
        <input name=\"quarters\" type=\"text\">
        <br><br>
        <label><strong>Changed Owed: </strong></label>
        <input name=\"quarters\" type=\"text\">
        <br><br>
        <label>&nbsp;</label>
        <input type=\"submit\" value=\"Process Payment\">
      </form>";}
      else if ($payment=="card"){
        echo

          "<form method=\"post\" action=\"transSale.php\" id=\"transSale\" style=\"text-align:center\">
          <label><strong>Total Payment: </strong></label>
          <input name=\"card\" type=\"text\">
          <br><br>
          <label><strong>Card Number: </strong></label>
          <input name=\"card\" type=\"text\">
          <br><br>

          <label>&nbsp;</label>
          <input type=\"submit\" value=\"Process Payment\">
        </form>";
      }
      else if ($payment=="check"){
        echo

          "<form method=\"post\" action=\"transSale.php\" id=\"transSale\" style=\"text-align:center\">
          <label><strong>Check Amount: </strong></label>
          <input name=\"checkAmount\" type=\"text\">
          <br><br>
          <label><strong>Check Number: </strong></label>
          <input name=\"checkNum\" type=\"text\">
          <br><br>
          <label><strong>Name on Check: </strong></label>
          <input name=\"name\" type=\"text\">
          <br><br>
          <label><strong>Phone Number: </strong></label>
          <input name=\"phone\" type=\"text\">
          <br><br>

          <label>&nbsp;</label>
          <input type=\"submit\" value=\"Process Payment\">
        </form>";
      }
      else if ($payment=="charge"){
        echo

          "<form method=\"post\" action=\"transSale.php\" id=\"transSale\" style=\"text-align:center\">
          <label><strong>Charge Amount: </strong></label>
          <input name=\"chargeAmount\" type=\"text\">
          <br><br>
          <label><strong>Charge Account ID Number: </strong></label>
          <input name=\"checkNum\" type=\"text\">
          <br><br>
          <label><strong>Name on Account: </strong></label>
          <input name=\"name\" type=\"text\">
          <br><br>

          <label>&nbsp;</label>
          <input type=\"submit\" value=\"Process Payment\">
        </form>";
      }
    ?>


  </div>

  <p><strong><a href="cashiermenu.php">Back to the Cashier Menu</a></strong></p>

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
            <?php echo 'Shopping Cart:';?>
          </h4>
        </div>

        <!--panel body-->

        <div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >
          <?php
            $enterBtn=filter_input(INPUT_POST,'enterBtn', FILTER_VALIDATE_FLOAT);
            $prodID=filter_input(INPUT_POST,'prodID');
            $quantity=filter_input(INPUT_POST,'quantity');


            if (isset($enterBtn)){
              array_push($_SESSION["arrayID"], $prodID);
              array_push($_SESSION["arrayQ"], $quantity);
              for($i = 0; $i < count($_SESSION["arrayID"]); $i++) {
                echo "<label>Item:</label> ".$_SESSION["arrayID"][$i]."         "."<button>Delete Item</button>";
                echo "<br>";
              }
            }
          ?>
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

</body>
</html>
