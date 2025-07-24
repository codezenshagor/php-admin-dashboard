<?php
 if($request[0]=='admin' AND $request[1]=='dashboard'AND TOTAL==2){
        auth();
         require_once("views/admin/dashboard/dashboard.php");
         die();
 }