<?php
session_start();
require_once 'netting/class.crud.php';
$db=new curd();
unset($_SESSION['admins']);
setcookie("adminsLogin", json_encode($admins), strtotime("-30 day"),"/");
header("Location:login.php");
exit();