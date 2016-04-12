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

      <?php echo 'Cashier Transaction at Store ID: <span style=color:orange>\''.$storeID.'\'</span> by Employee ID: <span style=color:orange>\''.$empID.'\'</span>.';?>
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
  <input name="quantity" type="text" class="form-control" id="quantity" placeholder="Quantity of Item" required>
    </div>
  </div>

      <br>
      <label>&nbsp;</label>
			<input type="submit" name="enterBtn" class="btn btn-warning" value="Enter Values">
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
        $confirm=filter_input(INPUT_POST,'confirm',FILTER_VALIDATE_FLOAT);

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
    <input type="submit" name="confirm" class="btn btn-warning"value="Confirm Payment Type">

  <?php } ?>
    <br>
  </form>


    <?php

    $payment=filter_input(INPUT_POST, 'payment');
    if ($payment=="cash") {
      echo
        "<form method=\"post\" action=\"transSale.php\" id=\"transSale\" style=\"text-align:center\">
          <br>
        <div style=\"text-align:left\">


          <form class=\"form-inline\">
            <div class=\"form-group\">
              <label  for=\"cash\">Total Cash Received: </label>
            <div class=\"input-group\">
            <div class=\"input-group-addon\">$</div>
              <input type=\"text\" class=\"form-control\" id=\"cash\" placeholder=\"Total Cash Received\" onchange=\"calcChange()\" required>
            </div>
            </div>

            <form class=\"form-inline\">
              <div class=\"form-group\">
                <label  for=\"change\">Change Owed: </label>
              <div class=\"input-group\">
              <div class=\"input-group-addon\">$</div>
                <input type=\"text\" class=\"form-control\" id=\"change\" placeholder=\"Change Amount Auto here\" required disabled=\"true\">
              </div>
              </div>


          </div>
        <label>&nbsp;</label>
        <input type=\"submit\" class=\"btn btn-warning\"value=\"Process Payment\" >
      </form>";}
      else if ($payment=="card"){
        echo

          "<form method=\"post\" action=\"transSale.php\" id=\"transSale\" style=\"text-align:center\">
          <div style=\"text-align:left\">
          <form class=\"form-inline\">


            <div class=\"form-group\">
            <label for=\"card\"><strong>Credit Card Number: </strong></label>
            <input name=\"card\" type=\"text\" class=\"form-control\" id=\"card\" placeholder=\"Customer's Credit Card Number\">
            </div>

          </div>
          <label>&nbsp;</label>
          <input type=\"submit\" class=\"btn btn-warning\" value=\"Process Payment\">
        </form>";
        //$cashq='INSERT INTO PAYMENT (TRANSACTION_ID, PAYMENT_TYPE, PAYMENT_AMOUNT, CC_NUMBER) '
      }
      else if ($payment=="check"){
        echo

          "<form method=\"post\" action=\"transSale.php\" id=\"transSale\" style=\"text-align:center\">
          <div style=\"text-align:left\">
          <form class=\"form-inline\">



          <div class=\"form-group\">
          <label for=\"num\"><strong>Check Number: </strong></label>
          <input name=\"num\" type=\"text\" class=\"form-control\" id=\"num\" placeholder=\"Customer Check Number\">
          </div>

          <div class=\"form-group\">
          <label for=\"name\"><strong>Name on Check: </strong></label>
          <input name=\"name\" type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Customer's Name on Check\">
          </div>

          </div>

          <label>&nbsp;</label>
          <input type=\"submit\" class=\"btn btn-warning\" value=\"Process Payment\">
        </form>";
      }
      else if ($payment=="charge"){
        echo

          "<form method=\"post\" action=\"transSale.php\" id=\"transSale\" style=\"text-align:center\">
          <div style=\"text-align:left\">

          <form class=\"form-inline\">
          


          <div class=\"form-group\">
          <label for=\"cID\"><strong>Charge Account Number: </strong></label>
          <input name=\"cID\" type=\"text\" class=\"form-control\" id=\"cID\" placeholder=\"Charge Account Identification Number\">
          </div>

          <div class=\"form-group\">
          <label for=\"name\"><strong>Customer Name: </strong></label>
          <input name=\"name\" type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Name on Customer Charge Account\">
          </div>
          </div>

          <label>&nbsp;</label>
          <input type=\"submit\" class=\"btn btn-warning\" value=\"Process Payment\">
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
            $prodID=filter_input(INPUT_POST,'product');
            $quantity=filter_input(INPUT_POST,'quantity');






            if (isset($enterBtn)){

              $query='SELECT PRODUCT_NAME, STOCK_PRICE FROM PRODUCTS, STOCK WHERE STOCK.STORE_ID=:STOREID AND PRODUCTS.PRODUCT_ID=:PRODID AND STOCK.PRODUCT_ID=PRODUCTS.PRODUCT_ID';
              $statement3= $db->prepare($query);
              $statement3->bindValue(':STOREID', $storeID);
              $statement3->bindValue(':PRODID', $prodID);
              $statement3->execute();
              $shop = $statement3->fetch();
              $statement3->closeCursor();

              $prodName=$shop['PRODUCT_NAME'];
              $price=$shop['STOCK_PRICE'];
              $item=array("prodID"=>$prodID,"prodName"=>$prodName, "quantity"=>$quantity, "price"=>$price);

              $_SESSION['cart'][]=$item;}?>

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

<h3><span class="label label-primary"><?php echo "<strong>Total Cost: $</strong>".number_format($total, 2);?></span></h3>
    <?php if (isset($pay)||isset($confirm)){
      $tax=$total*.095;
      $cartTotal=$total+$tax;?>
      <h3><span class="label label-primary"><?php echo "<strong>Tax: $</strong>".number_format($tax, 2);?></span></h3>
        <h3><span class="label label-primary" ><?php echo "<strong>Total Amount Due: $</strong>"?> <span id="due"><?php echo number_format($cartTotal, 2); ?></span></span></h3>
<?php } ?>
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
