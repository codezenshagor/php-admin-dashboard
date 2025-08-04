<?php
if($request[0]=='admin' AND $request[1]=='new-user' AND TOTAL==2){
    if (isset($_POST['action']) && $_POST['action'] == 'insert_employee') {
        insert_employee(); // insert function
        die();
    }

    // Only those who are NOT assigned yet
$sql = "
SELECT 
    attlog.id AS log_id,
    attlog.user_id,
    attlog.datetime,
    attlog.verify_type,
    attlog.state,
    attlog.col10 AS device_serial,
    emp.name AS employee_name,
    emp.id AS employee_id,
    emp.zkteco_user_id,
    CONCAT(loc.office_name, ' - ', loc.branch_name) AS location_name,
    loc.id AS location_id
FROM attlog
LEFT JOIN employees AS emp ON attlog.user_id = emp.user_id
LEFT JOIN locations AS loc ON FIND_IN_SET(attlog.col10, loc.device_serials)
WHERE emp.id IS NULL
GROUP BY attlog.user_id
ORDER BY attlog.datetime DESC
";


    $logs = $db->select($sql);
    require_once("views/admin/attendance/attendance.php");
    die();
}

if($request[0]=='admin' AND $request[1]=='att-log' AND TOTAL==2){

 $recordsPerPage = 100;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Get filters
$userIdFilter = isset($_GET['user_id']) ? $_GET['user_id'] : '';
$locationFilter = isset($_GET['location_id']) ? $_GET['location_id'] : '';
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : '';

// Build filter conditions
$conditions = [];
if (!empty($userIdFilter)) {
    $conditions[] = "attlog.user_id = '".intval($userIdFilter)."'";
}
if (!empty($locationFilter)) {
    $conditions[] = "loc.id = '".intval($locationFilter)."'";
}
if (!empty($startDate)) {
    $conditions[] = "DATE(attlog.datetime) >= '".$startDate."'";
}
if (!empty($endDate)) {
    $conditions[] = "DATE(attlog.datetime) <= '".$endDate."'";
}
$whereSQL = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : '';

// Total records
$sqlCount = "SELECT COUNT(*) as total FROM attlog
LEFT JOIN locations AS loc ON FIND_IN_SET(attlog.col10, loc.device_serials)
$whereSQL";
$totalResult = $db->select($sqlCount);
$totalRecords = $totalResult ? (int)$totalResult[0]['total'] : 0;
$totalPages = ceil($totalRecords / $recordsPerPage);

// Main data query
$sql = "
SELECT 
    attlog.id AS log_id,
    attlog.user_id,
    attlog.datetime,
    attlog.verify_type,
    attlog.state,
    attlog.col10 AS device_serial,
    emp.name AS employee_name,
    emp.id AS employee_id,
    emp.zkteco_user_id,
    CONCAT(loc.office_name, ' - ', loc.branch_name) AS location_name,
    loc.id AS location_id
FROM attlog
LEFT JOIN employees AS emp ON attlog.user_id = emp.user_id
LEFT JOIN locations AS loc ON FIND_IN_SET(attlog.col10, loc.device_serials)
$whereSQL
ORDER BY attlog.datetime DESC
LIMIT $offset, $recordsPerPage
";

$logs = $db->select($sql);
    require_once("views/admin/attendance/attendance-log.php");
die();
}


?>