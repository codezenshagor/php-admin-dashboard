<?php
function insert_employee() {
    global $db;
    $name           = $_POST['name'] ?? null;
    $user_id        = $_POST['user_id'] ?? null;
    $group_id       = $_POST['group_id'] ?? null;
    $zkteco_user_id = $_POST['zkteco_user_id'] ?? null;
    $email          = $_POST['email'] ?? null;
    $mobile         = $_POST['mobile'] ?? null;
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = uniqid() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $filename);
        $image = "uploads/" . $filename;
    }

    // check unique user_id
    $exists = $db->fetch("SELECT id FROM employees WHERE user_id = ?", [$user_id]);
    if ($exists) {
        echo "❌ user_id already exists.";
        return;
    }

    $location_id = $_POST['location_id'] ?? null;
    $id = $db->insert("INSERT INTO employees (name, user_id, group_id, zkteco_user_id, email, mobile, image, location_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
                [$name, $user_id, $group_id, $zkteco_user_id, $email, $mobile, $image, $location_id]);

    echo $id ? "✅ Employee inserted!" : "❌ Insert failed!";
}

function update_employee() {
    global $db;
    $id             = $_POST['id'] ?? null;
    $name           = $_POST['name'] ?? null;
    $user_id        = $_POST['user_id'] ?? null;
    $group_id       = $_POST['group_id'] ?? null;
    $zkteco_user_id = $_POST['zkteco_user_id'] ?? null;
    $email          = $_POST['email'] ?? null;
    $mobile         = $_POST['mobile'] ?? null;
    $image = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $filename = uniqid() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $filename);
        $image = "uploads/" . $filename;
    }

    // check unique user_id excluding current
    $exists = $db->fetch("SELECT id FROM employees WHERE user_id = ? AND id != ?", [$user_id, $id]);
    if ($exists) {
        echo "❌ user_id already taken.";
        return;
    }

$location_id = $_POST['location_id'] ?? null;

$sql = "UPDATE employees SET name=?, user_id=?, group_id=?, zkteco_user_id=?, email=?, mobile=?, location_id=?";
$params = [$name, $user_id, $group_id, $zkteco_user_id, $email, $mobile, $location_id];

if ($image) {
    $sql .= ", image=?";
    $params[] = $image;
}
    $sql .= " WHERE id=?";
    $params[] = $id;

    $updated = $db->update($sql, $params);
    echo $updated ? "✅ Employee updated!" : "❌ Update failed!";
}

?>