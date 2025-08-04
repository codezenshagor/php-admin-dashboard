<?php
 if($request[0]=='admin' AND $request[1]=='shop'AND TOTAL==2){
    $editData = null; // ✅ Define early to prevent undefined variable

if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $db->delete("DELETE FROM shops WHERE id=?",[$_GET['delete']]);
     $_SESSION['success']="Delete success";
     header("Location:/admin/shop");
     exit();

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    ob_start();
    if (!empty($_POST['id'])) {
        update_shop();
     $_SESSION['success']="Update success";
     header("Location:/admin/shop");
     exit();
    } else {
        insert_shop();
             $_SESSION['success']="Insert success";
     header("Location:/admin/shop");
     exit();
    }
   
}

// Get shop to edit
if (isset($_GET['edit'])) {
    $editId = intval($_GET['edit']);
    $editData = $db->fetch('SELECT * FROM shops WHERE id = ?', [$editId]);
}
        require_once("views/admin/shop/shop.php");
        die();
 }
 ?>