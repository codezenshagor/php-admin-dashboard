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
        <h5>Manage Groups</h5>
        <button class="btn btn-primary float-right" data-toggle="modal" data-target="#groupModal" onclick="openAddModal()">➕ Add New Group</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Group Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $groups = $db->select("SELECT * FROM `groups`");
                foreach ($groups as $index => $group):
            ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($group['name']) ?></td>
                    <td><?= htmlspecialchars($group['description']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick='openEditModal(<?= json_encode($group) ?>)'>✏️ Edit</button>
                        <a href="?delete_group=<?= $group['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this group?')">🗑️ Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
                </div>
    </div>
</div>

<!-- Bootstrap 4 Modal -->
<div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-labelledby="groupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" id="groupForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="groupModalLabel">Add Group</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="group_id">
            <div class="form-group">
                <label for="group_name">Group Name</label>
                <input type="text" class="form-control" name="name" id="group_name" required>
            </div>
            <div class="form-group">
                <label for="group_desc">Description</label>
                <textarea class="form-control" name="description" id="group_desc"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="save_group" class="btn btn-success">💾 Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function openAddModal() {
    document.getElementById("groupForm").reset();
    document.getElementById("group_id").value = "";
    document.getElementById("groupModalLabel").innerText = "Add Group";
}

function openEditModal(group) {
    document.getElementById("group_id").value = group.id;
    document.getElementById("group_name").value = group.name;
    document.getElementById("group_desc").value = group.description;
    document.getElementById("groupModalLabel").innerText = "Edit Group";
    new bootstrap.Modal(document.getElementById('groupModal')).show();
}
</script>




<?php   require_once("views/admin/section/footer.php"); ?>
