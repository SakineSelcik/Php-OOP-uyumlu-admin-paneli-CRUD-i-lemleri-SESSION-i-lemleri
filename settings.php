<?php
 ob_start();
 session_start();
 require_once 'nedmin/netting/class.crud.php';

 $db= new curd();

 $sql =$db->read("settings") ;
 $row=$sql->fetchAll(PDO::FETCH_ASSOC);

 foreach ($row as $key){
     $settings[$key["settings_key"]]=$key["settings_value"];
 }











?>