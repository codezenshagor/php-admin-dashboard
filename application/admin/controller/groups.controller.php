<?php
 if($request[0]=='admin' AND $request[1]=='group-add'AND TOTAL==2){
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_group'])) {
    if (!empty($_POST['id'])) {
        update_group(); // Updates
    } else {
        insert_group(); // Inserts
    }
    echo "<script>location.href=window.location.href;</script>"; // Refresh
    die();
}

if (isset($_GET['delete_group'])) {
    $id = intval($_GET['delete_group']);
    $db->delete("DELETE FROM `groups` WHERE id=?", [$id]);
    $_SESSION['success'] = "Delete success";
    echo "<script>location.href='?';</script>";
    die();
}
         require_once("views/admin/group/group-add.php");
         die();
 }
 