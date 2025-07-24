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
<h5>Profile HRM</h5>
<span>User profile overview</span>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="page-header-breadcrumb">
<ul class=" breadcrumb breadcrumb-title">
<li class="breadcrumb-item">
<a href="index.html"><i class="feather icon-home"></i></a>
</li>
<li class="breadcrumb-item"><a href="/profile">Profile</a> </li>
</ul>
</div>
</div>
</div>
</div>
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">

<!-- main start -->
<?php
$profile = __get_profile_data__();
if (!$profile) {
    echo "<p>User not found.</p>";
    return;
}
?>


<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-6">
            <form method="post" enctype="multipart/form-data" action="/admin/update-profile" class="card p-4 shadow rounded">
                <div class="text-center mb-4">
                    <h4>Edit Profile</h4>
                    <p class="text-muted mb-0">Update your information and password</p>
                </div>

                <!-- Profile Image -->
                <div class="text-center mb-3">
                    <img src="<?= $urls ?><?= $profile['profile_image'] ?: 'uploads/default-avatar.png' ?>" width="100" class="rounded-circle border shadow-sm mb-2">
                    <input type="file" name="profile_image" class="form-control mt-2">
                </div>

                <!-- Name -->
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($profile['name']) ?>" required>
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($profile['email']) ?>" required>
                </div>

                <!-- Phone -->
                <div class="form-group mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($profile['phone']) ?>" required>
                </div>

                <hr>

                <!-- Password Change -->
                <h5 class="mb-3">Change Password <small class="text-muted">(optional)</small></h5>
                <div class="form-group mb-3">
                    <label>Current Password</label>
                    <input type="password" name="current_password" class="form-control" placeholder="Enter current password">
                </div>
                <div class="form-group mb-3">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Enter new password">
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary w-100 mt-3">Update Profile</button>
            </form>
        </div>
    </div>
</div>

 
<!-- main end -->




<?php   require_once("views/admin/section/footer.php"); ?>