<?php
    if($request[0]=="login" || $request[0]==""){
        if(isset($_POST['email']) AND isset($_POST['password'])){
            if(__login__()==1){
                header("Location:/admin/dashboard");
            }else{
                 header("Location:/login");
                  
            }
            die();
        }else{
            if (isset($_SESSION['user_id'])   OR  isset($_COOKIE['remember_token'])) {
                    $token = $_COOKIE['remember_token']??$_SESSION['user_id'];

                    $user = $db->fetch("SELECT * FROM users WHERE remember_token = ?", [$token]);

                    if ($user) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['permission']=$user['permission'];
                        $_SESSION['success'] = "Log in success with cookies";
                        header("Location:/admin/dashboard");
                    die();
                    }

            }
            require_once("views/admin/auth/sign-in.php");
        }
        
        die();
    }

    if($request[0]=='register'){
         if(isset($_POST['email']) AND isset($_POST['password'])){
            if(__register__()==1){
                header("Location:/admin/dashboard");
            }else{
                 header("Location:/register");
                  
            }
             die();
         }
         require_once("views/admin/auth/sign-up.php");
         die();
    }

    if($request[1]=='logout'){
        __logout__();
        header("Location:/login");
        die();
    }

    if($request[0]=='reset-password'){
         require_once("views/admin/auth/reset-password.php");
         die();
    }
?>