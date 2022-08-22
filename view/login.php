<?php 
session_start();
require('config.php');
require('validation.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["username"]) && isset($_POST["password"])) {
    $validation = [
      'username'=>['required','isEmpty|isEnglish','نام کاربری الزامی است|نام کاربری باید انگلیسی باشد'],
      'password'=>['required','isEmpty|checkPassword&8','رمز عبور الزامی است|رمز عبور بايد حداقل 8 كاركتر و دارای حروف و اعداد انگلیسی باشد'],
    ];
    $val = new validation();
    $errors = $val->validate($_POST, $validation);
    if (count($errors) == 0) {
      $username = $_POST["username"];
      $encode_password = base64_encode($_POST["password"]);
      $query = "SELECT * FROM users WHERE u_username='$username' AND u_password ='$encode_password'";
      $result = $conn->query($query);
      if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        $_SESSION["user"] = $user;
        $_SESSION["start"] = time();
        $_SESSION["expire"] = $_SESSION["start"] + (90 * 24 * 60 * 60);

        if (!empty($_POST["remember"])) {
          setcookie("username", $username, time() + (90 * 24 * 60 * 60));
          setcookie("password", $_POST["password"], time() + (90 * 24 * 60 * 60));
        }
        elseif (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
            setcookie("username", "");
            setcookie("password", "");
          }
        }
        else 
          $errors["username"] = "نام كاربري يا رمز عبور صحيح نيست";

        header('Location:navbar');
      }     
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/design.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/all.js"></script>
    <title>login</title>
</head>
<body>

  <section class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 login-form mx-auto">
                <h3 class="mt-4 mb-4">ورود به کنترل پنل</h3>
                <form method="post" action="login">
    
                    <div class="form-floating">
                        <input type="text" class="form-control" name="username" value="<?php if(isset($_COOKIE["username"])) echo $_COOKIE["username"];?>" id="floatingInput" placeholder="username">
                        <label for="floatingInput">:نام کاربری</label>
                      </div>
                      <?php
                      if (isset($errors) && array_key_exists("username", $errors)) {
                          $usernameErr = $errors["username"];
                          echo "<span style='color:red'>$usernameErr</span>";
                      }
                      ?>
                      <div class="form-floating  mt-3">
                        <input type="password" class="form-control" name="password" value="<?php if(isset($_COOKIE["password"])) echo $_COOKIE["password"];?>" id="floatingPassword" placeholder="password">
                        <label for="floatingPassword">:رمز عبور</label>
                      </div>
                      <?php 
                      if (isset($errors) && array_key_exists("password", $errors)) {
                          $passwordErr = $errors["password"];
                          echo "<span style='color:red'>$passwordErr</span>";
                      }
                      ?>
                      <button type="submit" class="btn btn-primary mt-4 mb-3 entry">ورود</button>
            
                    <div class="row mb-4">
                        <div class="col d-flex justify-content-center mt-2">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="form2Example31" checked/>
                            <label class="form-check-label" for="form2Example31">به خاطر سپردن من</label>
                          </div>
                        </div>
                    
                        <div class="col mt-2">
                          <a href="#!" class="forget-password">فراموشی رمز عبور</a>
                        </div>
                      </div>
                </form>
            </div>

        </div>
        

    </div>

  </section>

</body>
</html>