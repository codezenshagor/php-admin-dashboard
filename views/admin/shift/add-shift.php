<!DOCTYPE html>
<html lang="en">
<?php
    require_once("views/admin/section/css.php");
?>
<head>
<title>Add group</title>



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
<h5>Group HRM</h5>
<span>Add HRM  group</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="/admin/group-add">Group HRM</a> </li>
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

<div class="card">
    <div class="card-header">
        <h5>Manage Shifts</h5>
        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#shiftModal" onclick="openAddShiftModal()">➕ Add New Shift</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Shift Name</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>OT Start</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $shifts = $db->select("SELECT * FROM shifts");
            foreach ($shifts as $i => $shift):
            ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= htmlspecialchars($shift['name']) ?></td>
                    <td><?= date('h:i A', strtotime($shift['start_time'])) ?></td>
                    <td><?= date('h:i A', strtotime($shift['end_time'])) ?></td>
                    <td><?= date('h:i A', strtotime($shift['overtime_start'])) ?></td>
                    <td><?= htmlspecialchars($shift['description']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick='openEditShiftModal(<?= json_encode($shift) ?>)'>✏️ Edit</button>
                        <a href="?delete_shift=<?= $shift['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this shift?')">🗑️ Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
            </div>
    </div>
</div>


<!-- Shift Modal -->
<div class="modal fade" id="shiftModal" tabindex="-1" role="dialog" aria-labelledby="shiftModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" id="shiftForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="shiftModalLabel">Add Shift</h5>
          <button type="button" class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="shift_id">
            <div class="form-group">
                <label>Shift Name</label>
                <input type="text" class="form-control" name="name" id="shift_name" required>
            </div>
            <div class="form-group">
                <label>Start Time</label>
                <input type="time" class="form-control" name="start_time" id="shift_start_time" required>
            </div>
            <div class="form-group">
                <label>End Time</label>
                <input type="time" class="form-control" name="end_time" id="shift_end_time" required>
            </div>
            <div class="form-group">
                <label>Overtime Start</label>
                <input type="time" class="form-control" name="overtime_start" id="shift_overtime_start">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" id="shift_description" rows="2"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="save_shift" class="btn btn-success">💾 Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
function openAddShiftModal() {
    $('#shiftModalLabel').text("Add Shift");
    $('#shiftForm')[0].reset();
    $('#shift_id').val('');
    $('#shiftModal').modal('show');
}

function openEditShiftModal(data) {
    $('#shiftModalLabel').text("Edit Shift");
    $('#shift_id').val(data.id);
    $('#shift_name').val(data.name);
    $('#shift_start_time').val(data.start_time);
    $('#shift_end_time').val(data.end_time);
    $('#shift_overtime_start').val(data.overtime_start);
    $('#shift_description').val(data.description);
    $('#shiftModal').modal('show');
}
</script>





<?php   require_once("views/admin/section/footer.php"); ?>
