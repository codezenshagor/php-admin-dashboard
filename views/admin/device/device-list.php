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
    .select2-selection__choice__remove{
        background-color:red!important;
        color:white!important;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice span{
        color:black!important;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple

 {
    border: solid black 1px;
    outline: 0;
    height: 44px!important;
}
.select2-container--default .select2-selection--multiple{
     height: 44px!important;
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
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">

<!-- now start main -->
<div class="card">
    <div class="card-header">
        DEVICE LOCATION
    </div>
    <div class="card-body">
        <!-- Add Button -->
<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addLocationModal">+ Add Location</button>

<!-- Location Table -->
<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Office</th>
                <th>Branch</th>
                <th>Address</th>
                <th>Device Serials</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($locations as $loc): ?>
            <tr>
                <td><?= $loc['id'] ?></td>
                <td><?= htmlspecialchars($loc['office_name']) ?></td>
                <td><?= htmlspecialchars($loc['branch_name']) ?></td>
                <td><?= nl2br(htmlspecialchars($loc['address'])) ?></td>
                <td><?= htmlspecialchars($loc['device_serials']) ?></td>
                <td>
                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editLocationModal<?= $loc['id'] ?>">Edit</button>
                    <a href="?delete_id=<?= $loc['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this location?')">Delete</a>
                </td>
            </tr>

            <!-- Edit Modal -->
<div class="modal fade" id="editLocationModal<?= $loc['id'] ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST">
            <input type="hidden" name="id" value="<?= $loc['id'] ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Location</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <input type="text" name="office_name" class="form-control" value="<?= $loc['office_name'] ?>" placeholder="Office Name" required>
                        </div>
                        <div class="col-12 mb-2">
                            <input type="text" name="branch_name" class="form-control" value="<?= $loc['branch_name'] ?>" placeholder="Branch Name" required>
                        </div>
                        <div class="col-12 mb-2">
                            <textarea name="address" class="form-control" placeholder="Address"><?= $loc['address'] ?></textarea>
                        </div>
                        <div class="col-12 mb-2">
                            <label>Device Serials</label>
                            <select name="device_serials[]" name="device_serials[]" style="width:100%;height:100px!important;" class="js-example-placeholder-multiple col-sm-12" multiple="multiple" required>
                                <?php
                                $available = get_unassigned_device_serials($db, $loc['id']);
                                $existing = explode(',', $loc['device_serials']);
                                $merged = array_unique(array_merge($available, $existing));
                                foreach ($merged as $serial):
                                ?>
                                    <option value="<?= $serial ?>" <?= in_array($serial, $existing) ? 'selected' : '' ?>><?= $serial ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_location" class="btn btn-success">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addLocationModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Location</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="text" name="office_name" class="form-control mb-2" placeholder="Office Name" required>
                    <input type="text" name="branch_name" class="form-control mb-2" placeholder="Branch Name" required>
                    <textarea name="address" class="form-control mb-2" placeholder="Address"></textarea>

                    <label>Device Serials</label>
                    <select name="device_serials[]" style="width:100%;height:100px!important;" class="js-example-placeholder-multiple col-sm-12" multiple="multiple" required>
                        <?php foreach (get_unassigned_device_serials($db) as $serial): ?>
                            <option value="<?= $serial ?>"><?= $serial ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="add_location" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
    </div>
</div>
<!-- write here location add modal and crud  -->

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<?php   require_once("views/admin/section/footer.php"); ?>
<script>
$(document).ready(function() {
    $('.js-example-placeholder-multiple').select2({
        placeholder: "Select device serials"
    });
});
</script>
