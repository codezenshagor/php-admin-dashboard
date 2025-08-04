<!DOCTYPE html>
<html lang="en">
<?php
    require_once("views/admin/section/css.php");
?>
<head>
<title>Attendance</title>



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
<h5>Attendance HRM</h5>
<span>Add attendance list</span>
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




<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">

<!-- now start main -->
<!-- start main  -->
<div class="card">
    <div class="card-header">
        ATTENDANCE LOG
    </div>
    <div class="card-body">
        <div class="table-responsive">
       <table class="table table-bordered table-hover" id="attendanceTable">
    <thead class="bg-light">
        <tr>
            <th>User ID</th>
            <th>Date</th>
            <th>Time</th>
            <th>Verify Type</th>
            <th>State</th>
            <th>Location</th>
            <th>Add Employee</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $row):
            $dt = new DateTime($row['datetime']);
            $formatted_date = $dt->format('d-M-Y');
            $formatted_time = $dt->format('h:i A');
        ?>
        <tr>
            <td><?= $row['user_id'] ?></td>
            <td><?= $formatted_date ?></td>
            <td><?= $formatted_time ?></td>
            <td><?= $row['verify_type'] ?></td>
            <td><?= $row['state'] ?></td>
             <td><?= !empty($row['location_name']) ? $row['location_name'] : '<span class="text-danger">No Location</span>' ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary addEmployeeBtn"
                                    data-userid="<?= $row['user_id'] ?>"
                                    data-locationid="<?= isset($row['location_id']) ? $row['location_id'] : '' ?>">
                                Add
                            </button>
                        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <form id="addEmployeeForm" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add New Employee</h5>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="action" value="insert_employee">
            <input type="hidden" name="zkteco_user_id" id="modal_zkteco_id">
            <div class="form-group">
                <label>User ID</label>
                <input type="text" name="user_id" id="modal_user_id" readonly class="form-control">
            </div>
            <div class="form-group">
                <label>Employee Name</label>
                <input type="text" name="name" required class="form-control">
            </div>
            <div class="form-group">
                <label>Email (optional)</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Mobile (optional)</label>
                <input type="text" name="mobile" class="form-control">
            </div>

                   <div class="form-group col-md-6">
                            <label>Group</label>
                            <select name="group_id" id="emp_group_id" class="form-control" required>
                                <option value="">Select Group</option>
                                <?php
                                $groups = $db->select("SELECT id, name FROM `groups`");
                                foreach ($groups as $g):
                                    echo "<option value='{$g['id']}'>{$g['name']}</option>";
                                endforeach;
                                ?>
                            </select>
                        </div>

            <div class="form-group">
                <label>Location</label>
                <select name="location_id" id="locationSelect" class="form-control">
                    <option value="">-- Select Location --</option>
                    <?php
                    $locations = $db->select("SELECT id, office_name, branch_name FROM locations");
                    foreach ($locations as $loc) {
                        $loc_name = "{$loc['office_name']} - {$loc['branch_name']}";
                        echo "<option value='{$loc['id']}'>{$loc_name}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Photo (optional)</label>
                <input type="file" name="image" class="form-control-file">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>


<?php   require_once("views/admin/section/footer.php"); ?>
<script>
$(document).ready(function(){
$(".addEmployeeBtn").click(function(){
    let userId = $(this).data("userid");
    let locationId = $(this).data("locationid");

    $("#modal_user_id").val(userId);
    $("#modal_zkteco_id").val(userId);

    // Auto-select group (location)
    if(locationId){
        $('select[name="group_id"]').val(locationId);
    } else {
        $('select[name="group_id"]').val(''); // reset if no match
    }

    $("#addEmployeeModal").modal("show");
});


    $(".fillZk").click(function(e){
        e.preventDefault();
        let id = $(this).data("userid");
        $("#modal_zkteco_id").val(id);
        alert("ZK ID filled: " + id);
    });

    $("#addEmployeeForm").submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/attendance",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                alert(res);
                location.reload();
            }
        });
    });
});
</script>
