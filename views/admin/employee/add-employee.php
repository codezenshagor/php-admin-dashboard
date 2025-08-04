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
<style>
select.form-control, select.form-control:focus, select.form-control:hover {
    border-top: none;
    border-right: none;
    border-left: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    width: 100% !important;
}

#emp_group_id {
    background-color: #ffe4e1 !important;
    border: 1px solid #ff1493 !important;
    color: #444 !important;
    font-weight: 600 !important;
    padding: 6px !important;
    border-radius: 4px !important;
}

#shift_id_error, 
#emp_group_id_error {
    color: red !important;
    font-size: 0.9rem !important;
    margin-top: 4px !important;
}

</style>

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
<h5>Dashboard CRM</h5>
<span>lorem ipsum dolor sit amet, consectetur adipisicing elitsss</span>
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

<!-- now start main -->
<style>
    .table td, .table th {
        padding: 0.4rem;
        font-size: 13px;
        vertical-align: middle;
    }
    .table img {
        width: 35px;
        height: 35px;
        object-fit: cover;
    }
    .card-header h5 {
        font-size: 16px;
        margin-bottom: 0;
    }
    .btn-sm {
        font-size: 12px;
        padding: 2px 6px;
    }
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 12px;
        }
        .btn {
            font-size: 11px;
            padding: 4px 8px;
        }
        .card-header h5 {
            font-size: 14px;
        }
    }
</style>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Manage Employees</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#employeeModal" onclick="openAddEmployee()">Add Employee</button>
    </div>

    <div class="card-body">
        <select id="locationFilter" class="form-control form-control-sm mb-2">
            <option value="">Filter by Location</option>
            <?php foreach ($locations as $loc): ?>
                <option value="<?= $loc['id'] ?>"><?= $loc['office_name'] ?></option>
            <?php endforeach; ?>
        </select>

        <input type="text" id="employeeSearch" class="form-control form-control-sm mb-2" placeholder="Search by name, user ID, email, or mobile">

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="employeeTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>User ID</th>
                        <th>Group</th>
                        <th>Location</th>
                        <th>Contact</th>
                      
                        <th>Shift</th>
                        <th>Shift Action</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $employees = $db->select("SELECT e.*, g.name as group_name, l.office_name as location_name 
                    FROM employees e 
                    LEFT JOIN `groups` g ON e.group_id = g.id 
                    LEFT JOIN locations l ON e.location_id = l.id");

                foreach ($employees as $i => $emp):
                    $shifts = $db->select("SELECT s.* FROM shift_assign sa 
                                            JOIN shifts s ON sa.shift_id = s.id 
                                            WHERE sa.employee_id = ?", [$emp['id']]);
                    $shiftText = '';
                    $hasShift = count($shifts) > 0;
                    foreach ($shifts as $s) {
                        $shiftText .= "<b>{$s['name']}</b><br>";
                        $shiftText .= "<span class='text-success'>Start:</span> " . date("h:i A", strtotime($s['start_time'])) . "<br>";
                        $shiftText .= "<span class='text-danger'>End:</span> " . date("h:i A", strtotime($s['end_time'])) . "<hr style='margin:4px 0'>";
                    }
                ?>
                    <tr data-location-id="<?= $emp['location_id'] ?>">
                        <td><?= $i + 1 ?></td>
                        <td><?php if ($emp['image']): ?><img src="../<?= $emp['image'] ?>" class="rounded"><?php endif; ?></td>
                        <td><?= htmlspecialchars($emp['name']) ?></td>
                        <td><?= htmlspecialchars($emp['user_id']) ?></td>
                        <td><?= htmlspecialchars($emp['group_name']) ?></td>
                        <td><?= htmlspecialchars($emp['location_name']) ?></td>
                        <td><?= htmlspecialchars($emp['email']) ?><br><?= htmlspecialchars($emp['mobile']) ?></td>
                       
                        <td><?= $shiftText ?: '<span class="text-muted">No Shift</span>' ?></td>
                        <td>
                            <?php if ($hasShift): ?>
                                <button class="btn btn-danger btn-sm removeShiftBtn" data-id="<?= $emp['id'] ?>">Remove</button>
                            <?php else: ?>
                                <button class="btn btn-success btn-sm assignShiftBtn" data-id="<?= $emp['id'] ?>" data-name="<?= htmlspecialchars($emp['name']) ?>">Assign</button>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick='openEditEmployee(<?= json_encode($emp) ?>)'>Edit</button>
                            <a href="?delete_employee=<?= $emp['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete employee?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- shift assign modal start -->
 <div class="modal fade" id="shiftModal" tabindex="-1" aria-labelledby="shiftModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="assignShiftForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Assign Shift to <span id="employeeName"></span></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="employee_id" id="employeeId">
            <div class="mb-3">
                <label for="shift_id" class="form-label">Select Shift</label>
                <select name="shift_id" id="shift_id" class="form-select" required>
                    <option value="">-- Select --</option>
                    <?php
                    $shifts = $db->select("SELECT * FROM shifts");
                    foreach ($shifts as $shift):
                        echo "<option value='{$shift['id']}'>{$shift['name']} ({$shift['start_time']} - {$shift['end_time']})</option>";
                    endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Assign</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

 <!-- shift assign modal end -->
<!-- Modal -->
<!-- Bootstrap 5 Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="post" enctype="multipart/form-data" id="employeeForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="employeeModalLabel">Add Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="emp_id">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="emp_name" class="form-label">Name</label>
              <input type="text" name="name" id="emp_name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="emp_user_id" class="form-label">User ID</label>
              <input type="text" name="user_id" id="emp_user_id" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="emp_group_id" class="form-label">Group</label>
              <select name="group_id" id="emp_group_id" class="form-select" required>
                <option value="" selected disabled>Select Group</option>
                <?php
                $groups = $db->select("SELECT id, name FROM `groups`");
                foreach ($groups as $g):
                  echo "<option value='{$g['id']}'>{$g['name']}</option>";
                endforeach;
                ?>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="emp_location_id" class="form-label">Location</label>
              <select name="location_id" id="emp_location_id" class="form-select" required>
                <option value="" selected disabled>Select Location</option>
                <?php
                $locations = $db->select("SELECT id, office_name FROM locations");
                foreach ($locations as $loc) {
                  echo "<option value='{$loc['id']}'>{$loc['office_name']}</option>";
                }
                ?>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="emp_zkteco_id" class="form-label">ZKTeco User ID</label>
              <input type="text" name="zkteco_user_id" id="emp_zkteco_id" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
              <label for="emp_email" class="form-label">Email</label>
              <input type="email" name="email" id="emp_email" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
              <label for="emp_mobile" class="form-label">Mobile</label>
              <input type="text" name="mobile" id="emp_mobile" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
              <label for="emp_image" class="form-label">Image</label>
              <input type="file" name="image" id="emp_image" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="save_employee" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>


<?php   require_once("views/admin/section/footer.php"); ?>

<script>
function openAddEmployee() {
    $('#employeeModalLabel').text("Add Employee");
    $('#employeeForm')[0].reset();
    $('#emp_id').val('');
    $('#employeeModal').modal('show');
}

function openEditEmployee(emp) {
    $('#employeeModalLabel').text("Edit Employee");
    $('#emp_id').val(emp.id);
    $('#emp_name').val(emp.name);
    $('#emp_location_id').val(emp.location_id);
    $('#emp_user_id').val(emp.user_id);
    $('#emp_group_id').val(emp.group_id);
    $('#emp_zkteco_id').val(emp.zkteco_user_id);
    $('#emp_email').val(emp.email);
    $('#emp_mobile').val(emp.mobile);
    $('#employeeModal').modal('show');
}

$(document).ready(function () {
    $('#employeeSearch').on("keyup", function () {
        let value = $(this).val().toLowerCase();
        $("#employeeTable tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

<script>
    $(document).ready(function () {
    $('#employeeSearch, #locationFilter').on("input change", function () {
        let keyword = $('#employeeSearch').val().toLowerCase();
        let locationId = $('#locationFilter').val();

        $("#employeeTable tbody tr").filter(function () {
            let rowText = $(this).text().toLowerCase();
            let matchText = rowText.indexOf(keyword) > -1;

            let matchLoc = true;
            if (locationId) {
                let rowLoc = $(this).data("location-id");
                matchLoc = rowLoc == locationId;
            }

            $(this).toggle(matchText && matchLoc);
        });
    });
});

</script>

<script>
$(document).ready(function() {
    // Open modal and set employee data
    $('.assignShiftBtn').click(function() {
        const empId = $(this).data('id');
        const empName = $(this).data('name');
        $('#employeeId').val(empId);
        $('#employeeName').text(empName);
        $('#shiftModal').modal('show');
    });

    // Submit assign shift form via AJAX
    $('#assignShiftForm').submit(function(e) {
        e.preventDefault();
        $.post('/admin/assign-shift-ajax', $(this).serialize(), function(response) {
            alert(response);
            location.reload();
        });
    });

    // Remove shift
    $('.removeShiftBtn').click(function() {
        if (!confirm("Are you sure to remove shift?")) return;
        const empId = $(this).data('id');
        $.post('/admin/remove-shift-ajax', { employee_id: empId }, function(response) {
            alert(response);
            location.reload();
        });
    });
});
</script>
<script>
    $(document).ready(function() {
  // Close modal on clicking any element with data-bs-dismiss="modal"
  $('[data-bs-dismiss="modal"]').on('click', function() {
    $('#shiftModal').modal('hide');
  });

  // Alternatively, if you want to close modal after form submission (for example)
  $('#assignShiftForm').on('submit', function(e) {
    e.preventDefault();
    // ... your form handling logic here ...
    // Close the modal manually:
    $('#shiftModal').modal('hide');
  });
});

</script>