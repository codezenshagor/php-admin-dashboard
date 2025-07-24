<!DOCTYPE html>
<html lang="en">
<head>
<title>Shriah Group | Employee manage</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
<meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
<meta name="author" content="colorlib" />

<link rel="icon" href="https://colorlib.com/polygon/admindek/files/assets/images/favicon.ico" type="image/x-icon">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
<link rel="stylesheet" href="<?=$urls?>views/admin/assets/css/sweetalert.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="<?=$urls?>views/admin/assets/css/bootstrap.min.css">

<link rel="stylesheet" href="<?=$urls?>views/admin/assets/css/waves.min.css" type="text/css" media="all"> <link rel="stylesheet" type="text/css" href="css/feather.css">

<link rel="stylesheet" type="text/css" href="<?=$urls?>views/admin/assets/themify-icons.css">

<link rel="stylesheet" type="text/css" href="<?=$urls?>views/admin/assets/css/icofont.css">

<link rel="stylesheet" type="text/css" href="<?=$urls?>views/admin/assets/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="<?=$urls?>views/admin/assets/css/style.css"><link rel="stylesheet" type="text/css" href="<?=$urls?>views/admin/assets/css/pages.css">
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

<!-- jQuery (required by toastr) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body themebg-pattern="theme1">
<?php
   flash_message()
?>
<div class="theme-loader">
<div class="loader-track">
<div class="preloader-wrapper">
<div class="spinner-layer spinner-blue">
<div class="circle-clipper left">
<div class="circle"></div>
</div>
<div class="gap-patch">
<div class="circle"></div>
</div>
<div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
<div class="spinner-layer spinner-red">
<div class="circle-clipper left">
<div class="circle"></div>
</div>
<div class="gap-patch">
<div class="circle"></div>
</div>
<div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
<div class="spinner-layer spinner-yellow">
<div class="circle-clipper left">
<div class="circle"></div>
</div>
<div class="gap-patch">
<div class="circle"></div>
</div>
<div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
<div class="spinner-layer spinner-green">
<div class="circle-clipper left">
<div class="circle"></div>
</div>
<div class="gap-patch">
<div class="circle"></div>
</div>
<div class="circle-clipper right">
<div class="circle"></div>
</div>
</div>
</div>
</div>
</div>

<section class="login-block">

<div class="container-fluid">
<div class="row">
<div class="col-sm-12">

<form class="md-float-material form-material"  method="post">
<div class="text-center">
<img src="<?=$urls?>views/admin/assets/png/logo.png" alt="logo.png">
</div>
<div class="auth-box card">
<div class="card-block">
<div class="row m-b-20">
<div class="col-md-12">

<h3 class="text-center txt-primary">Sign In</h3>
</div>
</div>
<div class="row m-b-20">
<div class="col-md-6">
<button class="btn btn-facebook m-b-20 btn-block"><i class="icofont icofont-social-facebook"></i>facebook</button>
</div>
<div class="col-md-6">
<button class="btn btn-twitter m-b-20 btn-block"><i class="icofont icofont-social-twitter"></i>twitter</button>
</div>
</div>
<p class="text-muted text-center p-b-5">Sign in with your regular account</p>
<div class="form-group form-primary">
<input type="email" name="email" class="form-control" required="">
<span class="form-bar"></span>
<label class="float-label">Email</label>
</div>
<div class="form-group form-primary">
<input type="text" name="password" class="form-control" required="">
<span class="form-bar"></span>
<label class="float-label">Password</label>
</div>
<div class="row m-t-25 text-left">
<div class="col-12">
<div class="checkbox-fade fade-in-primary">
<label>
<input type="checkbox" name="remember" value="">
<span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
<span class="text-inverse">Remember me</span>
</label>
</div>

<div class="forgot-phone text-right float-right">
<a href="<?=$urls?>reset-password" class="text-right f-w-600"> Forgot Password?</a>
</div>
</div>
</div>
<div class="row m-t-30">
<div class="col-md-12">
<button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">LOGIN</button>
</div>
</div>
<p class="text-inverse text-left">Don't have an account?<a href="/register"> <b>Register here </b></a>for free!</p>
</div>
</div>
</form>

</div>

</div>

</div>

</div>

</section>

<!-- start alert -->


<!-- end alert -->

<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="<?=$urls?>views/admin/assets/js/jquery.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="<?=$urls?>views/admin/assets/js/jquery-ui.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="<?=$urls?>views/admin/assets/js/popper.min.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="<?=$urls?>views/admin/assets/js/bootstrap.min.js"></script>

<script src="<?=$urls?>views/admin/assets/js/waves.min.js" type="4878d7dfa7bc22a8dfa99416-text/javascript"></script>

<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="<?=$urls?>views/admin/assets/js/jquery.slimscroll.js"></script>

<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="<?=$urls?>views/admin/assets/js/modernizr.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="<?=$urls?>views/admin/assets/js/css-scrollbars.js"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript" src="<?=$urls?>views/admin/assets/js/common-pages.js"></script>





<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="4878d7dfa7bc22a8dfa99416-text/javascript"></script>
<script type="4878d7dfa7bc22a8dfa99416-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script src="<?=$urls?>views/admin/assets/js/rocket-loader.min.js" data-cf-settings="4878d7dfa7bc22a8dfa99416-|49" defer=""></script></body>

<!-- Mirrored from colorlib.com/polygon/admindek/default/auth-sign-in-social.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 Dec 2019 16:08:30 GMT -->
</html>

