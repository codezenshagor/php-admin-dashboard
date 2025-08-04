<!DOCTYPE html>
<html lang="en">
<?php require_once("views/admin/section/css.php"); ?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Attendance Report</title>


    <?php
    $selected_location_id = $_GET['location_id'] ?? 'all';
    $from_date = $_GET['from_date'] ?? date('Y-m-d');
    $to_date = $_GET['to_date'] ?? date('Y-m-d');
    $search = $_GET['search'] ?? '';

    $locations = $db->select("SELECT * FROM locations");

    $where_clause = "1=1";
    $location_header = null;

    if ($selected_location_id !== 'all') {
        $location_info = $db->select("SELECT * FROM locations WHERE id = '{$selected_location_id}' LIMIT 1");
        if ($location_info) $location_header = $location_info[0];
        $where_clause .= " AND l.id = '{$selected_location_id}'";
    }

    $where_clause .= " AND a.attendance_date BETWEEN '{$from_date}' AND '{$to_date}'";

    if (!empty($search)) {
        $search = $search; // Optional sanitization if you have a helper
        $where_clause .= " AND (
            e.user_id = '$search' OR
            e.name  = '$search' OR
            e.email  = '$search' OR
            e.mobile  = '$search'
        )";
    }

    $att_list = $db->select("
        SELECT 
            a.*, e.id AS employee_id, e.user_id AS employee_ids, e.name AS employee_name, e.email, e.mobile,
            g.name AS group_name,
            l.office_name, l.branch_name, l.address,
            s.name AS shift_name
        FROM attendance a
        INNER JOIN employees e ON a.employee_id = e.id
        INNER JOIN `groups` g ON e.group_id = g.id
        INNER JOIN locations l ON e.location_id = l.id
        INNER JOIN shifts s ON a.shift_id = s.id
        WHERE $where_clause
        ORDER BY a.attendance_date DESC
    ");
    ?>
    <meta charset="utf-8">
</head>
<body>
<?php require_once("views/admin/section/navber.php"); ?>
<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="feather icon-home bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Dashboard HRM</h5>
                        <span>Attendance Report - All Filters Enabled</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="page-header-breadcrumb">
                    <ul class=" breadcrumb breadcrumb-title">
                        <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Dashboard HRM</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="m-2">

                        <!-- Filter Form -->
<form method="get" class="mb-4 p-3 rounded shadow-sm" style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);">
  <div class="form-row">

    <!-- Location -->
    <div class="form-group col-md-4">
      <label><strong>📍 Location</strong></label>
      <select name="location_id" class="form-control">
        <option value="all">All Locations</option>
        <?php foreach ($locations as $loc): ?>
          <option value="<?= $loc['id'] ?>" <?= ($selected_location_id == $loc['id']) ? 'selected' : '' ?>>
            <?= $loc['office_name'] ?> (<?= $loc['branch_name'] ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- From Date -->
    <div class="form-group col-sm-6 col-md-2">
      <label><strong>📅 From</strong></label>
      <input type="date" name="from_date" value="<?= $from_date ?>" class="form-control">
    </div>

    <!-- To Date -->
    <div class="form-group col-sm-6 col-md-2">
      <label><strong>📅 To</strong></label>
      <input type="date" name="to_date" value="<?= $to_date ?>" class="form-control">
    </div>

    <!-- Search -->
    <div class="form-group col-md-4">
      <label><strong>🔍 Search</strong></label>
      <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="ID, Name, Email, Mobile" class="form-control">
    </div>
  </div>

  <!-- Buttons -->
  <div class="form-row mt-2">
    <div class="col-sm-6 col-md-auto mb-2">
      <button type="submit" class="btn btn-primary btn-block">🔍 Filter</button>
    </div>

    <div class="col-sm-6 col-md-auto mb-2">
      <a href="?from_date=<?= date('Y-m-d') ?>&to_date=<?= date('Y-m-d') ?>" class="btn btn-secondary btn-block">🔄 Reset</a>
    </div>

    <div class="col-sm-12 col-md-auto">
      <button id="printBtn" class="btn btn-success btn-block no-print">🖨️ Print Table Only</button>
    </div>
  </div>
</form>

<div id="printArea">
                        <!-- Location Header -->
                        <?php if ($location_header): ?>
                            <div class="print-header d-none d-print-block mb-3">
                                <h4><?= $location_header['office_name'] ?> (<?= $location_header['branch_name'] ?>)</h4>
                                <p><?= $location_header['address'] ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- Attendance Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover bg-white shadow-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>User ID</th>
                                        <th>Name</th>
                                       
                                      
                                        <th>Group</th>
                                       
                                        <th>Shift</th>
                                        <th>Date</th>
                                        <th>In Time</th>
                                        <th>Out Time</th>
                                        <th>Duration (hrs)</th>
                                        <th>Status</th>
                                         <th>Email</th>
                                         <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($att_list && count($att_list) > 0) {
                                        $i = 1;
                                        foreach ($att_list as $row) {
                                                $total_hours = floatval($row['duration_hours']);
                                                $hours = floor($total_hours); 
                                                $minutes = round(($total_hours - $hours) * 60); 
                                                echo "<tr>
                                                        <td>{$i}</td>
                                                        <td>{$row['employee_ids']}</td>
                                                        <td>{$row['employee_name']}</td>
                                                      
                                                      
                                                        <td>{$row['group_name']}</td>
                                                     
                                                        <td>{$row['shift_name']}</td>
                                                        <td>{$row['attendance_date']}</td>
                                                        <td>{$row['in_time']}</td>
                                                        <td>{$row['out_time']}</td>
                                                       <td>{$hours} Hours {$minutes} Minutes</td>
                                                        <td><span class='badge badge-" . ($row['type'] === 'present' ? 'success' : 'secondary') . "'>" . ucfirst($row['type']) . "</span></td>
                                                       <td>{$row['email']}</td>
                                                        <td>{$row['office_name']}</td>
                                                        </tr>";
                                            $i++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='13' class='text-center text-muted'>No attendance found for the selected filters.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
 </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("views/admin/section/footer.php"); ?>
</body>
</html>

<script>
$('#printBtn').on('click', function(e) {
    e.preventDefault();

    // প্রিন্ট করার জন্য HTML সংগ্রহ
    var printContent = $('#printArea').html();

    // নতুন উইন্ডো খুলে সেই কন্টেন্ট ঢোকানো হবে
    var printWindow = window.open('', '', 'height=700,width=900');

    // প্রিন্ট উইন্ডোর জন্য HTML তৈরি
    printWindow.document.write(`
        <html>
        <head>
            <title>Attendance Report Print</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                h2 { text-align: center; margin-bottom: 5px; }
                p { text-align: center; margin-top: 0; margin-bottom: 20px; font-size: 14px; }
                table { width: 100%; border-collapse: collapse; }
                table, th, td { border: 1px solid #333; }
                th, td { padding: 8px 10px; text-align: left; font-size: 14px; }
                th { background-color: #4CAF50; color: white; }
                tr:nth-child(even) { background-color: #f2f2f2; }
                .badge-success { background-color: #28a745; color: white; padding: 3px 7px; border-radius: 4px; }
                .badge-secondary { background-color: #6c757d; color: white; padding: 3px 7px; border-radius: 4px; }
            </style>
        </head>
        <body>
            ${printContent}
        </body>
        </html>
    `);

    // ডকুমেন্ট ক্লোজ করে রেন্ডার করান
    printWindow.document.close();

    // উইন্ডোতে ফোকাস দিন এবং প্রিন্ট ডায়ালগ দেখান
    printWindow.focus();

    // প্রিন্ট চালান
    printWindow.print();

    // প্রিন্ট শেষে উইন্ডো বন্ধ করে দিন (চাইলে কমেন্ট করতে পারেন)
    printWindow.close();
});
</script>

