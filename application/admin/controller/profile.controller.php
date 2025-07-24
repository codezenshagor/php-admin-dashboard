<?php
 if($request[0]=='admin' AND $request[1]=='profile'AND TOTAL==2){
         require_once("views/admin/profile/profile.php");
         die();
 }
 

  if($request[0]=='admin' AND $request[1]=='update-profile'AND TOTAL==2){
         if(isset($_POST)){
            __update_profile__();
         }
         header("Location:/admin/profile");
         die();
 }
?>