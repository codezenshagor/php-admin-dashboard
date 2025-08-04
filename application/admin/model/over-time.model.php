<?php
function insert_overtime() {
    global $db;
    $employee_id = $_POST['employee_id'] ?? null;
    $shift_id = $_POST['shift_id'] ?? null;
    $overtime_hours = $_POST['overtime_hours'] ?? null;
    $overtime_date = $_POST['overtime_date'] ?? null; // date
    $rate_per_hour = $_POST['rate_per_hour'] ?? null;

    $id = $db->insert("INSERT INTO overtime (employee_id, shift_id, overtime_hours, overtime_date, rate_per_hour) VALUES (?, ?, ?, ?, ?)",
                     [$employee_id, $shift_id, $overtime_hours, $overtime_date, $rate_per_hour]);
    echo $id ? "✅ Overtime inserted!" : "❌ Insert failed!";
}

function update_overtime() {
    global $db;
    $id = $_POST['id'] ?? null;
    $employee_id = $_POST['employee_id'] ?? null;
    $shift_id = $_POST['shift_id'] ?? null;
    $overtime_hours = $_POST['overtime_hours'] ?? null;
    $overtime_date = $_POST['overtime_date'] ?? null;
    $rate_per_hour = $_POST['rate_per_hour'] ?? null;

    $updated = $db->update("UPDATE overtime SET employee_id=?, shift_id=?, overtime_hours=?, overtime_date=?, rate_per_hour=? WHERE id=?",
                           [$employee_id, $shift_id, $overtime_hours, $overtime_date, $rate_per_hour, $id]);
    echo $updated ? "✅ Overtime updated!" : "❌ Update failed!";
}
?>