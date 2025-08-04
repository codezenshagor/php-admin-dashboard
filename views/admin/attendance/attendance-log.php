<!DOCTYPE html>
<html lang="en">
<?php
    require_once("views/admin/section/css.php");
?>
<head>
<title>Admindek | Admin Template</title>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
<meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
<meta name="author" content="colorlib" />

<link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">


</head>


<body>
<?php   require_once("views/admin/section/navber.php"); ?>
<div class="pcoded-content">

<div class="page-header card">
<div class="row align-items-end">
<div class="col-lg-8">
<div class="page-header-title">
<i class="feather icon-home bg-c-blue"></i>
<div class="d-inline">
<h5>Attendance Log</h5>
<span>All employee attendance log</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="#!">Dashboard CRM</a> </li>
</ul>
</div>
</div>
</div>
</div>

<!-- start main  -->


<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">

<div class="s">
    <h4 class="my-3">Attendance Logs</h4>

    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-2">
            <input type="number" name="user_id" class="form-control" placeholder="User ID" value="<?= htmlspecialchars($userIdFilter) ?>">
        </div>
        <div class="col-md-3">
            <select name="location_id" class="form-control">
                <option value="">All Locations</option>
                <?php
                $locations = $db->select("SELECT id, CONCAT(office_name, ' - ', branch_name) AS location_name FROM locations");
                foreach ($locations as $loc):
                ?>
                    <option value="<?= $loc['id'] ?>" <?= $locationFilter == $loc['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($loc['location_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="start_date" class="form-control" value="<?= htmlspecialchars($startDate) ?>">
        </div>
        <div class="col-md-2">
            <input type="date" name="end_date" class="form-control" value="<?= htmlspecialchars($endDate) ?>">
        </div>
        <div class="col-md-3">
            <button class="btn btn-primary">Filter</button>
            <a href="?page=1" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>SL</th>
                    <th>Log ID</th>
                    <th>User ID</th>
                    <th>Employee Name</th>
                    <th>Date & Time</th>
                    <th>Verify Type</th>
                    <th>State</th>
                    <th>Device Serial</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($logs)): ?>
                    <?php $sl = ($page - 1) * $recordsPerPage + 1; ?>
                    <?php foreach ($logs as $log): ?>
                        <?php $dt = explode(' ', $log['datetime']); ?>
                        <tr>
                            <td><?= $sl++ ?></td>
                            <td><?= htmlspecialchars($log['log_id']) ?></td>
                            <td><?= htmlspecialchars($log['user_id']) ?></td>
                            <td>
                                <?= $log['employee_name'] ? htmlspecialchars($log['employee_name']) : '<span class="text-danger fw-bold">Not Found</span>' ?>
                            </td>
                            <td><?= htmlspecialchars($dt[0]) ?> <span style='font-weight:bold;'><?= htmlspecialchars($dt[1]) ?></span></td>
                            <td><?= htmlspecialchars($log['verify_type']) ?></td>
                            <td><?= htmlspecialchars($log['state']) ?></td>
                            <td><?= htmlspecialchars($log['device_serial']) ?></td>
                            <td><?= htmlspecialchars($log['location_name']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-danger">No attendance logs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                <li class="page-item <?= $page == $p ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $p ?>&user_id=<?= urlencode($userIdFilter) ?>&location_id=<?= urlencode($locationFilter) ?>&start_date=<?= urlencode($startDate) ?>&end_date=<?= urlencode($endDate) ?>">
                        <?= $p ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>




<?php   require_once("views/admin/section/footer.php"); ?>