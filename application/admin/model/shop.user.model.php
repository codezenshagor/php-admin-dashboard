<?php
    function __role_based_user_add__(){
        global $db;
        // check point 
        $check = $db->fetch("SELECT id FROM users WHERE email=?",[$_POST['email']]);
        if($check){
            $_SESSION['error']="This email: ".$_POST['email']." already add";
        }else{


            $name     = $_POST['name'] ?? '';
            $user_id  = $_POST['user_id'] ?? '';
            $role     = $_POST['role'] ?? '';
            $email    = $_POST['email'] ?? '';
            $phone    = $_POST['phone'] ?? '';
            $password = $_POST['password'] ?? '';

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
   $last_id = $db->insert(
        "INSERT INTO users (`name`, email, phone, `password`,`role`,user_id) VALUES (?, ?, ?, ?,?,?)",
        [$name, $email, $phone, $hashedPassword,$role,$user_id]
    );
      $_SESSION['success']="User add success";

        }
    }
?>