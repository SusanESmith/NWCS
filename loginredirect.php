<?php
session_start();
date_default_timezone_set('America/Chicago');
if (!isset($_SESSION['start'])||!isset($_SESSION['posid'])){
header('Location: index.php');
}
if ($_SESSION['posid']==102 || $_SESSION['posid']==104){
$_SESSION['admin']=false;
}
else{
  $_SESSION['admin']=true;
}

function adminrights(){
if ($_SESSION['admin']==false){
  header('Location: cashiererror.php');
}
}
?>
