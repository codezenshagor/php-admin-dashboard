<?php
function insert_salary() {
    global $db;
    $employee_id = $_POST['employee_id'] ?? null;
    $basic_salary = $_POST['basic_salary'] ?? null;
    $allowance = $_POST['allowance'] ?? null;
    $deduction = $_POST['deduction'] ?? null;
    $pay_date = $_POST['pay_date'] ?? null; // date

    $id = $db->insert("INSERT INTO salaries (employee_id, basic_salary, allowance, deduction, pay_date) VALUES (?, ?, ?, ?, ?)",
                     [$employee_id, $basic_salary, $allowance, $deduction, $pay_date]);
    echo $id ? "✅ Salary inserted!" : "❌ Insert failed!";
}

function update_salary() {
    global $db;
    $id = $_POST['id'] ?? null;
    $employee_id = $_POST['employee_id'] ?? null;
    $basic_salary = $_POST['basic_salary'] ?? null;
    $allowance = $_POST['allowance'] ?? null;
    $deduction = $_POST['deduction'] ?? null;
    $pay_date = $_POST['pay_date'] ?? null; // date

    $updated = $db->update("UPDATE salaries SET employee_id=?, basic_salary=?, allowance=?, deduction=?, pay_date=? WHERE id=?",
                           [$employee_id, $basic_salary, $allowance, $deduction, $pay_date, $id]);
    echo $updated ? "✅ Salary updated!" : "❌ Update failed!";
}
?>