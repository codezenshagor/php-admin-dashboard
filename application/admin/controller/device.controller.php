<?php
     if($request[0]=='admin' AND $request[1]=='device-list'AND TOTAL==2){
        auth();

       function is_device_serial_assigned($db, $serials, $current_id = null) {
    $placeholders = implode(',', array_fill(0, count($serials), '?'));

    $query = "SELECT id FROM locations WHERE ";
    if ($current_id) {
        $query .= "id != ? AND (";
    } else {
        $query .= "(";
    }

    $conditions = [];
    foreach ($serials as $serial) {
        $conditions[] = "FIND_IN_SET(?, device_serials)";
    }
    $query .= implode(" OR ", $conditions) . ")";

    $params = $current_id ? array_merge([$current_id], $serials) : $serials;

    return $db->fetch($query, $params); // return non-empty if conflict
}

// Insert handler
if (isset($_POST['add_location'])) {
    $serials = $_POST['device_serials'];

    // Check for conflict
    if (is_device_serial_assigned($db, $serials)) {
        $_SESSION['error'] = "❌ One or more device serials are already assigned to another location.";
        header("Location:/admin/device-list");
        exit;
    }

    $serials_string = implode(',', $serials);
    $db->insert("INSERT INTO locations (office_name, branch_name, address, device_serials) VALUES (?, ?, ?, ?)", [
        $_POST['office_name'],
        $_POST['branch_name'],
        $_POST['address'],
        $serials_string
    ]);

    $_SESSION['success'] = "✅ Location added successfully.";
    header("Location:/admin/device-list");
    exit;
}

// Update handler
if (isset($_POST['update_location'])) {
    $serials = $_POST['device_serials'];
    $id = $_POST['id'];

    // Check for conflict excluding current ID
    if (is_device_serial_assigned($db, $serials, $id)) {
        $_SESSION['error'] = "❌ One or more device serials are already assigned to another location.";
        header("Location:/admin/device-list");
        exit;
    }

    $serials_string = implode(',', $serials);
    $db->update("UPDATE locations SET office_name=?, branch_name=?, address=?, device_serials=? WHERE id=?", [
        $_POST['office_name'],
        $_POST['branch_name'],
        $_POST['address'],
        $serials_string,
        $id
    ]);

    $_SESSION['success'] = "✅ Location updated successfully.";
    header("Location:/admin/device-list");
    exit;
}

// Delete handler
if (isset($_GET['delete_id'])) {
    $db->delete("DELETE FROM locations WHERE id=?", [$_GET['delete_id']]);
    $_SESSION['success'] = "✅ Location deleted successfully.";
    header("Location:/admin/device-list");
    exit;
}

         require_once("views/admin/device/device-list.php");
         die();
     }
     
?>