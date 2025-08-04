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
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">


<!-- now start main -->
<div class="card">
  <div class="card-header">
    <h4>All User List</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $all_users = $db->select("SELECT * FROM users ORDER BY id DESC");
            if ($all_users):
              $i = 1;
              foreach ($all_users as $user):
          ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['phone']) ?></td>
            <td><span class="badge badge-info"><?= htmlspecialchars($user['role']) ?></span></td>
            <td><?= date("Y-m-d", strtotime($user['created_at'])) ?></td>
            <td>
              <button 
                class="btn btn-sm btn-warning editBtn" 
                data-id="<?= $user['id'] ?>" 
                data-name="<?= htmlspecialchars($user['name']) ?>" 
                data-email="<?= htmlspecialchars($user['email']) ?>" 
                data-phone="<?= htmlspecialchars($user['phone']) ?>" 
                data-role="<?= htmlspecialchars($user['role']) ?>"
                data-user_id="<?= htmlspecialchars($user['user_id']) ?>"
                data-toggle="modal" 
                data-target="#editUserModal">
                Edit
              </button>

              <a href="delete_user.php?id=<?= $user['id'] ?>" 
                 class="btn btn-sm btn-danger" 
                 onclick="return confirm('Are you sure you want to delete this user?');">
                Delete
              </a>
            </td>
          </tr>
          <?php endforeach; else: ?>
          <tr>
            <td colspan="7" class="text-center">No users found</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- edite -->
<!-- Edit User Modal -->

<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered custom-modal-lg" role="document">
    <form action="update_user.php" method="post">
      <input type="hidden" name="id" id="edit_id">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
              </div>

              <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" id="edit_email" class="form-control" required>
              </div>

              <div class="col-md-6 mb-3">
                <label>Phone</label>
                <input type="text" name="phone" id="edit_phone" class="form-control">
              </div>

               <div class="col-md-6 mb-3">
                <label>User ID</label>
                <input type="text" name="user_id" id="user_id" class="form-control">
              </div>

              <div class="col-md-6 mb-3">
                <label>Role</label>
                <select name="role" id="edit_role" class="form-control" required>
                  <option value="admin">Admin</option>
                  <option value="shop_accountant">Shop Accountant</option>
                  <option value="employee">Employee</option>
                </select>
              </div>

              <div class="col-md-6 mb-3">
                <label>New Password <small class="text-muted">(optional)</small></label>
                <input type="text" name="password" id="edit_password" class="form-control" placeholder="Leave empty to keep current password">
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" name="update_user" class="btn btn-success">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>




<?php   require_once("views/admin/section/footer.php"); ?>

<script>
  $(document).ready(function() {
    $('.editBtn').on('click', function() {
      let button = $(this);
      $('#edit_id').val(button.data('id'));
      $('#user_id').val(button.data('user_id'));
      $('#edit_name').val(button.data('name'));
      $('#edit_email').val(button.data('email'));
      $('#edit_phone').val(button.data('phone'));
      $('#edit_role').val(button.data('role'));
    });
  });
</script>
