<?php
function __register__() {
    global $db;

    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $phone    = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if email already exists
    $exists = $db->fetch("SELECT id FROM users WHERE email = ?", [$email]);
    if ($exists) {
        $_SESSION['error']="Email already exist";
        return 0;
        die();
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
   $last_id = $db->insert(
        "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)",
        [$name, $email, $phone, $hashedPassword]
    );
         $_SESSION['user_id'] = $last_id;
        $_SESSION['success']="Register sucess";
        return 1;
        die();
}


function __login__() {
    global $db;

    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']); // checkbox

    // Fetch user
    $user = $db->fetch("SELECT * FROM users WHERE email = ?", [$email]);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];

        // If remember me is checked
        if ($remember) {
            $token = bin2hex(random_bytes(32));
            setcookie('remember_token', $token, time() + (86400 * 30), '/'); // 30 days

            // Store token in DB
            $db->update("UPDATE users SET remember_token=? WHERE id=?", [$token, $user['id']]);
        }
        $_SESSION['success']="Log in sucess";
        return 1;
    } else {
        $_SESSION['error']="User name or password wrong";;
        return 0;
    }
    die();
}





function __logout__() {
    global $db;
    $user_id = $_SESSION['user_id'] ?? null;

    // Remove token from database
    if ($user_id) {
        $db->update("UPDATE users SET remember_token=NULL WHERE id=?", [$user_id]);
    }
    // Clear session and cookie
    session_unset();
    session_destroy();
    setcookie("remember_token", "", time() - 3600, "/");
    $_SESSION['success']="Log out success";
}




?>