<?php
function insert_shop() {
    global $db;

    $shop_name   = $_POST['shop_name'] ?? null;
    $owner_name  = $_POST['owner_name'] ?? null;
    $phone       = $_POST['phone'] ?? null;
    $email       = $_POST['email'] ?? null;
    $address     = $_POST['address'] ?? null;
    $status      = $_POST['status'] ?? 'active';

    $id = $db->insert(
        "INSERT INTO shops (shop_name, owner_name, phone, email, address, status) VALUES (?, ?, ?, ?, ?, ?)",
        [$shop_name, $owner_name, $phone, $email, $address, $status]
    );

    echo $id ? "✅ Shop inserted successfully!" : "❌ Failed to insert shop!";
}

function update_shop() {
    global $db;

    $id          = $_POST['id'] ?? null;
    $shop_name   = $_POST['shop_name'] ?? null;
    $owner_name  = $_POST['owner_name'] ?? null;
    $phone       = $_POST['phone'] ?? null;
    $email       = $_POST['email'] ?? null;
    $address     = $_POST['address'] ?? null;
    $status      = $_POST['status'] ?? 'active';

    $updated = $db->update(
        "UPDATE shops SET shop_name = ?, owner_name = ?, phone = ?, email = ?, address = ?, status = ? WHERE id = ?",
        [$shop_name, $owner_name, $phone, $email, $address, $status, $id]
    );

    echo $updated ? "✅ Shop updated successfully!" : "❌ Failed to update shop!";
}
?>
