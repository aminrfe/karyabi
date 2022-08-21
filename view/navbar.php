<?php
session_start();
if (!isset($_SESSION["user"])) {
  header('Location:login');
  die();
}
elseif (isset($_SESSION["start"]) && time() > $_SESSION['expire']) {
  session_destroy();
  header('Location:login');
  die();
}
else {
 $user = $_SESSION["user"];
 
 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>navbar</title>
  <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="assets/css/all.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/nav.css">
  <script src="assets/js/all.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>

</head>

<body>

  <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">صفحه ی اصلی</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link" href="report">گزارش</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="reg">فرم ثبت نام</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">نمایش</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">منبع آگهی</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">کاربران</a>
          </li> 
        </ul>
        
      </div>
    </div>
  </nav>

  <h2 class="mt-sm-5 m-3">به صفحه اصلی خوش آمدید.</h2>





</body>

</html>