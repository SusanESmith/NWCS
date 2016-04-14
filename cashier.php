<?php
  session_start();

$pid=filter_input(INPUT_GET, 'pid');
if ($pid!==NULL){
  $temp=array();
  $cnt=0;

  foreach($_SESSION['cart'] as $ca){
    if ($cnt!=$pid){
      array_push($temp,$ca);
    }$cnt++;
  }
  unset($_SESSION['cart']);
  $_SESSION['cart']=$temp;
}
$storeID=$_SESSION['store'];

$empID=$_SESSION['username'];

  include('nwcsdatabase.php');


  $register='SELECT REGISTER_ID, STORE_ADDRESS FROM REGISTER, STORE WHERE :STORE=REGISTER.STORE_ID AND REGISTER.STORE_ID=STORE.STORE_ID';
  $statement= $db->prepare($register);
  $statement->bindValue(':STORE', $storeID);
  $statement->execute();
  $reg= $statement->fetchAll();
  $statement->closeCursor();

  $PRODUCTS='SELECT * FROM PRODUCTS, STOCK WHERE STOCK_QTY>0 AND STOCK.PRODUCT_ID=PRODUCTS.PRODUCT_ID and STOCK.STORE_ID=:STORE';
  $statement1= $db->prepare($PRODUCTS);
  $statement1->bindValue(':STORE', $storeID);
  $statement1->execute();
  $prodSelect = $statement1->fetchAll();
  $statement1->closeCursor();

  $acctID='SELECT ACCOUNT_ID, CHG_ACCT_BALANCE, CUSTOMER_LNAME, CUSTOMER_FNAME FROM CHARGE_ACCOUNT, CUSTOMER WHERE CHARGE_ACCOUNT.CUSTOMER_ID=CUSTOMER.CUSTOMER_ID';
  $statement7= $db->prepare($acctID);
  //$statement->bindValue(':POSITION', $position);
  $statement7->execute();
  $acct=$statement7->fetchAll();
  $statement7->closeCursor();

  $total=0;
  $count=0;
?>
<!DOCTYPE html>
<html lang="en">

<?php
  if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"]=array();
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

      <?php echo '</span>Cashier Transaction at Store ID: <span style=color:orange>\''.$storeID.'\'</span> by Employee ID: <span style=color:orange>\''.$empID.'\'</span>.';?>
    </h4>
</div>

<!--panel body-->
  <?php $confirm=filter_input(INPUT_POST, 'confirm');
  if (isset($confirm)){
  $_SESSION['regID']=filter_input(INPUT_POST,'register');}?>
<div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >
  <?php if (!isset($_SESSION['regID'])){ ?>
  <form method="post" action="cashier.php" id="storereg" style="text-align:center">
      <div style="text-align:left">

        <label>Register ID:</label>
        <select name="register" class="form-control">
          <?php foreach ($reg as $r):?>
          <option value="<?php echo $r['REGISTER_ID'];?>"><?php echo $r['REGISTER_ID']." - ".$r['STORE_ADDRESS'];?></option>
        <?php endforeach;  ?>
        </select>
      </div>
      <br>
        <input type="submit" name="confirm" class="btn btn-warning" value="Confirm Register to Continue" id="confirm">
      </form>
      <?php }
      if (isset($_SESSION['regID'])){
          //echo $_SESSION['regID'];
        $regID= filter_input(INPUT_POST, 'register');
        ?>
  <form method="post" name="products" action="cashier.php" id="cashiersale" style="text-align:center">
    <div style="text-align:left">
      <label>Product:</label>
      <select name="product" class="form-control">
        <?php foreach ($prodSelect as $p):?>
        <option value="<?php echo $p['PRODUCT_ID'];?>"><?php echo $p['PRODUCT_ID']." - ".$p['PRODUCT_NAME']." - ".$p['PRODUCT_DESCRIPTION'];?></option>
      <?php endforeach;  ?>
      </select>

    <div class="form-group">
    <label for="quantity"><strong>Quantity: </strong></label>
  <input name="quantity" type="number" min="0" class="form-control" id="quantity" placeholder="Quantity of Item" required>
    </div>
  </div>

      <br>
      <label>&nbsp;</label>
			<input type="submit" name="enterBtn" class="btn btn-warning" value="Add to Cart">
      <br>
      <br>
      	</form>


  <?php } ?>
    <form method="post" name="enter" action="cashier.php" id="cashierpay" style="text-align:center">

      <br><br>
        <input type="submit" name="pay" class="btn btn-warning"value="Complete Transaction">
        <br><br>
        <?php
        $pay=filter_input(INPUT_POST,'pay',FILTER_VALIDATE_FLOAT);
        $conf=filter_input(INPUT_POST,'conf',FILTER_VALIDATE_FLOAT);

        if (isset($pay)){?>
    <label>Payment Type:</label>
    <select name="payment" class="form-control">
      <!--drop down menu-->
    <option value="<?php echo "cash";?>"><?php echo "Cash";?></option>
      <option value="<?php echo "card";?>"><?php echo "Credit or Debit";?></option>
      <option value="<?php echo "check";?>"><?php echo "Check";?></option>
      <option value="<?php echo "charge";?>"><?php echo "Charge Account";?></option>
    </select>
    <br><br>
    <input type="submit" name="conf" class="btn btn-warning"value="Confirm Payment Type">

  <?php } ?>
    <br>
  </form>


    <?php

    $payment=filter_input(INPUT_POST, 'payment');
    if ($payment=="cash") {
      echo
        "<form method=\"post\" action=\"cashier.php\" id=\"transSale\" style=\"text-align:center\">
          <br>
        <div style=\"text-align:left\">


          <form class=\"form-inline\">
            <div class=\"form-group\">
              <label  for=\"cash\">Total Cash Received: </label>
            <div class=\"input-group\">
            <div class=\"input-group-addon\">$</div>
              <input type=\"number\" step=\"any\" class=\"form-control\" name=\"cash\" id=\"cash\" placeholder=\"Total Cash Received\" onchange=\"calcChange()\" required>
            </div>
            </div>

            <form class=\"form-inline\">
              <div class=\"form-group\">
                <label  for=\"change\">Change Owed: </label>
              <div class=\"input-group\">
              <div class=\"input-group-addon\">$</div>
                <input type=\"number\" min=\"0\" class=\"form-control\" id=\"change\" placeholder=\"Change Amount Auto here\" required disabled=\"true\">
              </div>
              </div>


          </div>
        <label>&nbsp;</label>
        <input type=\"submit\" class=\"btn btn-warning\"value=\"Process Payment\" name=\"done\" >
      </form>";}
      else if ($payment=="card"){
        echo

          "<form method=\"post\" action=\"cashier.php\" id=\"transSale\" style=\"text-align:center\">
          <div style=\"text-align:left\">
          <form class=\"form-inline\">


            <div class=\"form-group\">
            <label for=\"card\"><strong>Credit Card Number: </strong></label>
            <input name=\"card\" type=\"text\" pattern=\"[0-9]\" class=\"form-control\" id=\"card\" minlength=\"16\" maxlength=\"16\" placeholder=\"Customer's Credit Card Number\" title=\"-CREDIT CARD NUMBER MUST BE 16 DIGITS-\">
            </div>

          </div>
          <label>&nbsp;</label>
          <input type=\"submit\" class=\"btn btn-warning\" value=\"Process Payment\" name=\"done\">
        </form>";
        //$cashq='INSERT INTO PAYMENT (TRANSACTION_ID, PAYMENT_TYPE, PAYMENT_AMOUNT, CC_NUMBER) '
      }
      else if ($payment=="check"){
        echo

          "<form method=\"post\" action=\"cashier.php\" id=\"transSale\" style=\"text-align:center\">
          <div style=\"text-align:left\">
          <form class=\"form-inline\">



          <div class=\"form-group\">
          <label for=\"num\"><strong>Check Account Number: </strong></label>
          <input name=\"num\" type=\"text\" pattern=\".{8}\" minlength=\"7\" class=\"form-control\" id=\"num\" placeholder=\"Checking Account Number\" title=\"-CHECKING ACCOUNT MUST BE 7-8 DIGITS-\">
          </div>


          </div>

          <label>&nbsp;</label>
          <input type=\"submit\" class=\"btn btn-warning\" value=\"Process Payment\" name=\"done\">
        </form>";
      }
      else if ($payment=="charge"){?>


          <form method="post" action="cashier.php" id="transSale" style="text-align:center">
          <div style="text-align:left">

          <form class="form-inline">



          <div class="form-group">
          <label for="account"><strong>Choose a Charge Account: </strong></label>
          <select name="account" class="form-control">
            <?php foreach ($acct as $a){?>
            <option value="<?php echo $a['ACCOUNT_ID'];?>"><?php echo $a['ACCOUNT_ID']." - ". $a['CUSTOMER_LNAME'].", ". $a['CUSTOMER_FNAME'];?></option>
          <?php }?>
          </select></div>
          </div>

          <label>&nbsp;</label>
          <input type="submit" class="btn btn-warning" value="Process Payment" name="done">
        </form>
    <?php  }
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
            <?php echo 'Shopping Cart:';?> <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true">
          </h4>
        </div>

        <!--panel body-->

        <div class="panel-body" style="background-color:#C8F8FF; border:2px solid #FFC656" >
          <?php
            $enterBtn=filter_input(INPUT_POST,'enterBtn', FILTER_VALIDATE_FLOAT);
            $prodID=filter_input(INPUT_POST,'product');
            $quantity=filter_input(INPUT_POST,'quantity');






            if (isset($enterBtn)){

              $query='SELECT PRODUCT_NAME, STOCK_PRICE, STOCK_QTY FROM PRODUCTS, STOCK WHERE STOCK.STORE_ID=:STOREID AND PRODUCTS.PRODUCT_ID=:PRODID AND STOCK.PRODUCT_ID=PRODUCTS.PRODUCT_ID';
              $statement3= $db->prepare($query);
              $statement3->bindValue(':STOREID', $storeID);
              $statement3->bindValue(':PRODID', $prodID);
              $statement3->execute();
              $shop = $statement3->fetch();
              $statement3->closeCursor();

              $prodName=$shop['PRODUCT_NAME'];
              $price=$shop['STOCK_PRICE'];
              $item=array("prodID"=>$prodID,"prodName"=>$prodName, "quantity"=>$quantity, "price"=>$price);
              $SQ=$shop['STOCK_QTY'];
              if ($quantity>$SQ){?>
                <div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span class="glyphicon glyphicon-exclamation-sign"></span><strong>  Notice!  </strong><span class="glyphicon glyphicon-exclamation-sign"></span> There are only <?php echo $SQ?> of this item in stock at this store location. Please enter a valid quantity.
        </div>

            <?php  } else {

              $_SESSION['cart'][]=$item;}}?>

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
                      <th>Quantity</th>
                      <th>Price</th>
                      <th></th>


                    </tr>
                  </thead>
                  <tbody>

            <?php

            if (isset($_SESSION['cart'])){


          foreach($_SESSION['cart'] as $c) {?>
              <tr>
                <td><?php echo $c['prodID']?></td>
                <td><?php echo $c['prodName']?></td>
                <td><?php echo $c['quantity']?></td>
                <td><?php echo "$".$c['price']?></td>
                <td><button class= "btn btn-warning" onclick="window.location.href='cashier.php?pid=<?php echo $count?>'">Delete Item</button></td>
                <?php $count++;
                $total=$c['price']*$c['quantity']+$total;?>

              </tr>
            <?php  }?>



      </tbody>
    </table>
  </div>

  </div>
</div>
</div><?php }?>
        </div>
        <br>
<?php $done= filter_input(INPUT_POST, 'done');?>
<h3><span class="label label-primary"><?php echo "<strong>Total Cost: $</strong>".number_format($total, 2);?></span></h3>
    <?php if (isset($pay)||isset($conf)||isset($done)){
      $tax=$total*.095;
      $cartTotal=$total+$tax;?>
      <h3><span class="label label-primary"><?php echo "<strong>Tax: $</strong>".number_format($tax, 2);?></span></h3>
        <h3><span class="label label-primary" ><?php echo "<strong>Total Amount Due: $</strong>"?> <span id="due"><?php echo number_format($cartTotal, 2); ?></span></span></h3>
<?php }
$ccnum= filter_input(INPUT_POST, 'card');
$chk= filter_input(INPUT_POST, 'num');
$act= filter_input(INPUT_POST, 'account');
$cash=filter_input(INPUT_POST, 'cash');

if (!isset($ccnum)){$ccnum=NULL; }
if (!isset($chk)){$chk=NULL;}
if (!isset($act)){$act=NULL;}

if (isset($ccnum)){
  $type="CARD";
} elseif (isset($chk)){
  $type="CHECK";
} elseif (isset($act)){
  $type="CHARGE ACCOUNT";
} else {
  $type="CASH";
}

if (isset($done)){
  if (count($_SESSION['cart'])>0) {
    $status='true';
  } else {
    $status='false';
  }
  $cartTotal=number_format($cartTotal, 2);
if (!is_null($act)){
$balq='SELECT CHG_ACCT_BALANCE FROM CHARGE_ACCOUNT WHERE ACCOUNT_ID=:AI';
$statement11=$db->prepare($balq);
$statement11->bindValue(':AI', $act);
$statement11->execute();
$chgbal=$statement11->fetchColumn();
$statement11->closeCursor();
if ($chgbal<$cartTotal){?>
  <br>
  <div class="alert alert-warning alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<span class="glyphicon glyphicon-exclamation-sign"></span><strong>  Notice!  </strong><span class="glyphicon glyphicon-exclamation-sign"></span> The chosen account has a balance of <?php echo $chgbal?> and the purchase total is <?php echo $cartTotal?>.  Please choose another method of payment.
</div>
<?php $status="false";}

else {$status="true";}

}
if ($status=="true"){
  $tDate=date('Y-m-d');

  $t='INSERT INTO TRANSACTIONS
                 (CASHIER_SHIFT_ID, TRANSACTION_DATE, STORE_ID, TRANSACTION_TOTAL)
              VALUES
                 (:CSI, :TDATE, :STORE, :TOTAL)';

  $statement5 = $db->prepare($t);
  $statement5->bindValue(':CSI', 1);
  $statement5->bindValue(':TDATE', $tDate);
  $statement5->bindValue(':STORE', $storeID);
  $statement5->bindValue(':TOTAL', $cartTotal);
  $statement5->execute();
  $statement5->closeCursor();

  $tID='SELECT TRANSACTION_ID FROM TRANSACTIONS WHERE TRANSACTION_ID=LAST_INSERT_ID()';
  $statement8= $db->prepare($tID);
  //$statement->bindValue(':POSITION', $position);
  $statement8->execute();
  $transID=$statement8->fetchColumn();
  $statement8->closeCursor();

foreach($_SESSION['cart'] as $i){
  $tot=$i['price']*$i['quantity'];
  $td='INSERT INTO TRANSACTION_DETAILS
                 (TRANSACTION_ID, PRODUCT_ID, TRANS_PROD_QTY, STOCK_PRICE,TRANS_PROD_TOTAL)
              VALUES
                 (:TID, :PID, :QTY, :PRICE, :TOTAL)';

  $statement3 = $db->prepare($td);
  $statement3->bindValue(':TID', $transID);
  $statement3->bindValue(':PID', $i['prodID']);
  $statement3->bindValue(':QTY', $i['quantity']);
  $statement3->bindValue(':PRICE', $i['price']);
  $statement3->bindValue(':TOTAL', $tot);
  $statement3->execute();
  $statement3->closeCursor();

  $remove='UPDATE STOCK SET STOCK_QTY=STOCK_QTY-:QTY WHERE STORE_ID=:STORE AND PRODUCT_ID=:PRODUCT';
  $statement0 = $db->prepare($remove);
  $statement0->bindValue(':QTY', $i['quantity']);
  $statement0->bindValue(':STORE', $storeID);
  $statement0->bindValue(':PRODUCT', $i['prodID']);
  $statement0->execute();
  $statement0->closeCursor();

}
$td='INSERT INTO PAYMENT
               (TRANSACTION_ID, ACCOUNT_ID, PAYMENT_TYPE, PAYMENT_AMOUNT,CHECK_NUM, CC_NUMBER)
            VALUES
               (:TID, :AID, :TYPE, :AMOUNT, :CHNUM, :CC)';

$statement4 = $db->prepare($td);
$statement4->bindValue(':TID', $transID);
$statement4->bindValue(':CC', $ccnum);
$statement4->bindValue(':CHNUM', $chk);
$statement4->bindValue(':AID', $act);
$statement4->bindValue(':AMOUNT', $cartTotal);
$statement4->bindValue(':TYPE', $type);

$statement4->execute();
$statement4->closeCursor();

if (!is_null($act)){
$tID='UPDATE CHARGE_ACCOUNT SET CHG_ACCT_BALANCE = CHG_ACCT_BALANCE-:CTOTAL WHERE ACCOUNT_ID=:ACCTID';
$statement9= $db->prepare($tID);
$statement9->bindValue(':CTOTAL', $cartTotal);
$statement9->bindValue(':ACCTID', $act);
//$statement->bindValue(':POSITION', $position);
$statement9->execute();
$statement9->closeCursor();
}
unset($_SESSION['cart']);
unset($_SESSION['regID']);
?>
<h4 class="panel-title" style="font-weight:bold; font-size: 150%">

  <?php echo '<br>Transaction Complete! Transaction ID Number: <span style=color:orange>\''.$transID.'\'</span> <br>Thank you for your business and come again soon!';?>
</h4>
<?php }
}




?>

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
<script>
function calcChange(){
var cash=document.getElementById("cash").value;
var total=document.getElementById("due").innerHTML;
var change=Number(cash)-Number(total);

console.log(cash);
console.log(total);
console.log(change);

document.getElementById("change").value=change.toFixed(2);
}
</script>


</html>
