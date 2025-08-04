<?php
// Fetch locations
$locations = $db->select("SELECT * FROM locations");

// Fetch unassigned device serials
function get_unassigned_device_serials($db, $exclude_id = null) {
    $all = $db->select("SELECT DISTINCT col10 AS device_serial FROM attlog");
    $assigned = $db->select("SELECT device_serials FROM locations" . ($exclude_id ? " WHERE id != $exclude_id" : ""));
    $assigned_list = [];

    foreach ($assigned as $row) {
        $serials = explode(',', $row['device_serials']);
        foreach ($serials as $s) {
            $assigned_list[] = trim($s);
        }
    }

    $unassigned = [];
    foreach ($all as $row) {
        if (!in_array($row['device_serial'], $assigned_list)) {
            $unassigned[] = $row['device_serial'];
        }
    }

    return $unassigned;
}




?>