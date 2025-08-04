<?php
function insert_shift() {
    global $db;
    $name = $_POST['name'] ?? null;
    $start_time = $_POST['start_time'] ?? null;  // e.g. "09:00:00"
    $end_time = $_POST['end_time'] ?? null;      // e.g. "18:00:00"
    $overtime_start = $_POST['overtime_start'] ?? null; // e.g. "18:00:00"
    $description = $_POST['description'] ?? null;

    $id = $db->insert("INSERT INTO shifts (name, start_time, end_time, overtime_start, description) VALUES (?, ?, ?, ?, ?)",
                     [$name, $start_time, $end_time, $overtime_start, $description]);
    echo $id ? "✅ Shift inserted!" : "❌ Insert failed!";
}

function update_shift() {
    global $db;
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $start_time = $_POST['start_time'] ?? null;
    $end_time = $_POST['end_time'] ?? null;
    $overtime_start = $_POST['overtime_start'] ?? null;
    $description = $_POST['description'] ?? null;

    $updated = $db->update("UPDATE shifts SET name=?, start_time=?, end_time=?, overtime_start=?, description=? WHERE id=?",
                           [$name, $start_time, $end_time, $overtime_start, $description, $id]);
    echo $updated ? "✅ Shift updated!" : "❌ Update failed!";
}

?>