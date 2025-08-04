<?php
function insert_group() {
    global $db;
    $name = $_POST['name'] ?? null;
    $description = $_POST['description'] ?? null;

    $id = $db->insert("INSERT INTO `groups` (name, description) VALUES (?, ?)", [$name, $description]);
        $_SESSION['success']="✅ Group insert success!";
}

function update_group() {
    global $db;
    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? null;
    $description = $_POST['description'] ?? null;

    $updated = $db->update("UPDATE `groups` SET name=?, description=? WHERE id=?", [$name, $description, $id]);
    $_SESSION['success']="✅ Group updated!";
}

?>