<?php
 if($request[0]=='admin' AND $request[1]=='shift-add'AND TOTAL==2){

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_shift'])) {
                if (!empty($_POST['id'])) {
                    update_shift();
                } else {
                    insert_shift();
                }
                echo "<script>location.href=window.location.href;</script>";
                die();
            }

            if (isset($_GET['delete_shift'])) {
                $id = intval($_GET['delete_shift']);
                $db->delete("DELETE FROM shifts WHERE id=?", [$id]);
                echo "<script>location.href='?';</script>";
                 die();
            }


        require_once("views/admin/shift/add-shift.php");
        die();
 }