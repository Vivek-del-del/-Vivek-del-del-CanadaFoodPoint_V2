<?php session_start();
if(isset($_SESSION['utype'])){
echo $_SESSION['utype'];
session_destroy();
$_SESSION['utype']=array();
header("Location:index.php");
}
?> 