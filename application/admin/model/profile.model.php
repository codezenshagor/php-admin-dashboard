<?php
function __update_profile__() {
    global $db;

    $user_id = $_SESSION['user_id'] ?? 0;
    if (!$user_id) {
        echo "Unauthorized.";
        return;
    }

    $name  = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';

    // ✅ Check if email is unique (excluding current user)
    $check = $db->query("SELECT id FROM users WHERE email = ? AND id != ?", [$email, $user_id]);
    if ($check->rowCount() > 0) {
        echo "❌ This email is already taken by another user.";
        return;
    }

    // ✅ Profile image upload (optional)
    $profile_image = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
        $filename = uniqid() . "_" . $_FILES['profile_image']['name'];
        move_uploaded_file($_FILES['profile_image']['tmp_name'], "uploads/" . $filename);
        $profile_image = "uploads/" . $filename;
    }

    // ✅ Handle password change
   $current_password = $_POST['current_password'] ?? '';
     $new_password     = $_POST['new_password'] ?? '';
   
     $change_password = false;

    if ($current_password && $new_password) {
        $stmt = $db->query("SELECT password FROM users WHERE id = ?", [$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($current_password, $user['password'])) {
            $change_password = true;
            $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        } else {
              $_SESSION['error']="Current password is incorrect.";
            return;
        }
    }

    // ✅ Build update query
    $sql = "UPDATE users SET name=?, phone=?, email=?";
    $params = [$name, $phone, $email];

    if ($profile_image) {
        $sql .= ", profile_image=?";
        $params[] = $profile_image;
    }

    if ($change_password) {
        $sql .= ", password=?";
        $params[] = $hashed_password;
    }

    $sql .= " WHERE id=?";
    $params[] = $user_id;

    $db->update($sql, $params);
    $_SESSION['success']="Profile updated successfully!";
   
}


function __get_profile_data__() {
    global $db;

    $user_id = $_SESSION['user_id'] ?? 0;
    if (!$user_id) return null;

    $stmt = $db->query("SELECT name, phone, email, profile_image FROM users WHERE id = ?", [$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user ?: null;
}