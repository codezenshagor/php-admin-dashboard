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
<div class="page-body">

<!-- now start main -->
 <h2>Shop Management</h2>

    <button class="btn btn-primary mb-3" id="addShopBtn">Add New Shop</button>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Shop Name</th>
                <th>Owner Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Sample shops data from DB
        $shops = $db->select("SELECT * FROM shops ORDER BY id DESC");
        foreach ($shops as $shop):
        ?>
            <tr>
                <td><?= $shop['id'] ?></td>
                <td><?= htmlspecialchars($shop['shop_name']) ?></td>
                <td><?= htmlspecialchars($shop['owner_name']) ?></td>
                <td><?= htmlspecialchars($shop['phone']) ?></td>
                <td><?= htmlspecialchars($shop['email']) ?></td>
                <td><?= htmlspecialchars($shop['address']) ?></td>
                <td><?= ucfirst($shop['status']) ?></td>
                <td>
                    <button class="btn btn-sm btn-warning editShopBtn"
                        data-id="<?= $shop['id'] ?>"
                        data-shop_name="<?= htmlspecialchars($shop['shop_name'], ENT_QUOTES) ?>"
                        data-owner_name="<?= htmlspecialchars($shop['owner_name'], ENT_QUOTES) ?>"
                        data-phone="<?= htmlspecialchars($shop['phone'], ENT_QUOTES) ?>"
                        data-email="<?= htmlspecialchars($shop['email'], ENT_QUOTES) ?>"
                        data-address="<?= htmlspecialchars($shop['address'], ENT_QUOTES) ?>"
                        data-status="<?= $shop['status'] ?>"
                    >Edit</button>
                    <a href="?delete=<?= $shop['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="shopModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="POST" action="">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="shopModalLabel">Add Shop</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="id" id="shopId" value="">

          <div class="form-group">
            <label>Shop Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="shop_name" id="shopName" required>
          </div>
          <div class="form-group">
            <label>Owner Name</label>
            <input type="text" class="form-control" name="owner_name" id="ownerName">
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="phone" id="phone">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" id="email">
          </div>
          <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" name="address" id="address"></textarea>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status" id="status" class="form-control">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="modalSubmitBtn">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </form>
  </div>



<?php   require_once("views/admin/section/footer.php"); ?>

<script>
$(document).ready(function(){

    // Show modal for adding new shop
    $('#addShopBtn').click(function() {
        $('#shopModalLabel').text('Add Shop');
        $('#modalSubmitBtn').text('Save');
        $('#shopModal form')[0].reset();
        $('#shopId').val('');
        $('#shopModal').modal('show');
    });

    // Show modal for editing shop and fill data
    $('.editShopBtn').click(function() {
        $('#shopModalLabel').text('Edit Shop');
        $('#modalSubmitBtn').text('Update');

        $('#shopId').val($(this).data('id'));
        $('#shopName').val($(this).data('shop_name'));
        $('#ownerName').val($(this).data('owner_name'));
        $('#phone').val($(this).data('phone'));
        $('#email').val($(this).data('email'));
        $('#address').val($(this).data('address'));
        $('#status').val($(this).data('status'));

        $('#shopModal').modal('show');
    });

});
</script>