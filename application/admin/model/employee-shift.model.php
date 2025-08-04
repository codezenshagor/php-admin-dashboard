<?php
function assign_shifts_to_employee() {
    global $db;

    $employee_id = $_POST['employee_id'] ?? null;
    $shift_ids = $_POST['shift_ids'] ?? []; // expect array of shift IDs from form (e.g. multiple select)

    if (!$employee_id || !is_array($shift_ids)) {
        echo "❌ Invalid input.";
        return;
    }

    // প্রথমে পুরনো শিফট ডিলিট করে দিবে
    $db->delete("DELETE FROM employee_shifts WHERE employee_id = ?", [$employee_id]);

    // শিফট গুলো আবার ইনসার্ট করবে
    foreach ($shift_ids as $shift_id) {
        $db->insert("INSERT INTO employee_shifts (employee_id, shift_id) VALUES (?, ?)", [$employee_id, $shift_id]);
    }

    echo "✅ Shifts assigned to employee successfully!";
}

?>