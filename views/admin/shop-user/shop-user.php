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
<form action="" method="post">
    <div class="card p-4">

  <div class="form-group">
    <label for="role">Select Employee</label>
    <select name="role" id="select_employee_11" class="form-control" required>
      <option value="" selected disabled>-- Select Employee --</option>
      <?php
        $employee = $db->select("SELECT * FROM employees");
        foreach($employee as $em):
      ?>
      <option value="<?=$em['user_id']?>"><?=$em['name']?> | <?=$em['user_id']?></option>
      <?php
        endforeach;
      ?>
    </select>
  </div>


  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" value="" class="form-control"  required>
  </div>

  <div class="form-group">
    <label for="email">User ID</label>
    <input type="text" name="user_id" id="user_id" value="" class="form-control"  required>
  </div>

  <div class="form-group">
    <label for="email">Your Email Address</label>
    <input type="email" name="email" id="email" value="" class="form-control"  required>
  </div>



  <div class="form-group">
    <label for="phone">Phone (optional)</label>
    <input type="text" name="phone" id="phone" class="form-control" >
  </div>

  <div class="form-group">
    <label for="password">Password</label>
    <input type="text" name="password" id="password" class="form-control" required>
  </div>

  <div class="form-group">
    <label for="role">Select Role</label>
    <select name="role" id="role" class="form-control" required>
      <option value="">-- Select Role --</option>
      <option value="admin">Full Control</option>
      <option value="shop_accountant">Shop Accountant</option>
      <option value="employee">Employee</option>
    </select>
  </div>

   <div class="form-group">
        <button name="role_add" class='form-control form-control-sm btn btn-primary'> SUBMIT  </button>
   </div>


</div>

</form>


<?php   require_once("views/admin/section/footer.php"); ?>
<script>
  $('#select_employee_11').on('change', function() {
    var userId = $(this).val();

    $.ajax({
      url: '/admin/select-employee', // এখানে নিজের URL দাও
      type: 'POST',
      data: { user_id: userId },
      dataType:'json',
      success: function(response) {
        console.log(response); // সফল হলে কী করবে, সেটা এখানে লিখো
        $("#name").val(response.name)
         $("#user_id").val(response.user_id)
          $("#email").val(response.email)
           $("#password").val(response.user_id)
      },
      error: function(xhr, status, error) {
        console.error('AJAX Error:', error);
      }
    });
  });
</script>

<script>
  $('form').on('submit', function(e) {
  let valid = true;

  // যেসব ফিল্ড readonly ও required, সেগুলোর মান চেক করো
  $('#name, #user_id, #email').each(function() {
    if ($(this).val().trim() === '') {
      valid = false;
      alert('Please fill all required readonly fields.');
      $(this).focus();
      return false; // loop break
    }
  });

  // অন্য কোন রোল সিলেক্ট আছে কিনা চেক করো
  if ($('#role').val() === '') {
    valid = false;
    alert('Please select a role.');
    $('#role').focus();
  }

  if (!valid) {
    e.preventDefault();
  }
});

</script>
