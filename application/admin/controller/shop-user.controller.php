<?php
 if($request[0]=='admin' AND $request[1]=='shop-user'AND TOTAL==2){
   if(isset($_POST['role_add'])){
      print_r($_POST);
      __role_based_user_add__();
      header("Location:/admin/shop-user");
      die();
   }
    require_once("views/admin/shop-user/shop-user.php");
    die();
 }

  if($request[0]=='admin' AND $request[1]=='select-employee'AND TOTAL==2){
    if(isset($_POST['user_id'])){
      $user_id = $_POST['user_id'];
       $exists = $db->fetch("SELECT * FROM employees WHERE user_id = ?", [$user_id]);
       echo json_encode($exists);
    }
    die();
 }

  if($request[0]=='admin' AND $request[1]=='shop-user-list'AND TOTAL==2){
   if(isset($_POST['role_add'])){
      print_r($_POST);
      __role_based_user_add__();
      header("Location:/admin/shop-user");
      die();
   }
    require_once("views/admin/shop-user/shop-user-list.php");
    die();
 }
