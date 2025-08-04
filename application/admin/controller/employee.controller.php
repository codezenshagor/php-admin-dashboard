<?php
 if($request[0]=='admin' AND $request[1]=='user-add'AND TOTAL==2){
    // Insert/Update Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_employee'])) {
    if (!empty($_POST['id'])) {
        update_employee();
    } else {
        insert_employee();
    }
    header("Location:/admin/user-add");
    die();
}

if (isset($_GET['delete_employee'])) {
    $id = intval($_GET['delete_employee']);
    $db->delete("DELETE FROM employees WHERE id=?", [$id]);
      $_SESSION['success']="Delete success";
       header("Location:/admin/user-add");
    die();
}
        require_once("views/admin/employee/add-employee.php");
         die();
 }

 if($request[0]=='admin' AND $request[1]=='assign-shift-ajax'AND TOTAL==2){
    $employee_id = $_POST['employee_id'];
$shift_id = $_POST['shift_id'];

$exists = $db->select("SELECT * FROM shift_assign WHERE employee_id = ?", [$employee_id]);

if ($exists) {
    echo "❌ Already assigned!";
} else {
    $inserted = $db->insert("INSERT INTO shift_assign (employee_id, shift_id) VALUES (?, ?)", [$employee_id, $shift_id]);
    echo $inserted ? "✅ Shift assigned!" : "❌ Failed to assign!";
}
 die();
 }

  if($request[0]=='admin' AND $request[1]=='remove-shift-ajax'AND TOTAL==2){
    $employee_id = $_POST['employee_id'];
$deleted = $db->delete("DELETE FROM shift_assign WHERE employee_id = ?", [$employee_id]);

echo $deleted ? "✅ Shift removed!" : "❌ Failed to remove!";
    die();
 }