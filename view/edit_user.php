<?php
session_start();
require('config.php');
require('validation.php');

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
    $query = "SELECT * FROM users WHERE u_id='$u_id'";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["username"]) && isset($_POST["password"])) {
                $validation = [
                    'firstname'=>['required','isEmpty|isPersian','نام الزامی است|نام باید فارسی باشد'],
                    'lastname'=>['required','isEmpty|isPersian','نام خانوادگی الزامی است|نام خانوادگی باید فارسی باشد'],
                    'username'=>['required','isEmpty|isEnglish','نام کاربری الزامی است|نام کاربری باید انگلیسی باشد'],
                    'password'=>['required','isEmpty|isEnglish','رمزعبور الزامی است|رمزعبور باید انگلیسی باشد'],
                ];
                $val = new validation();
                $errors = $val->validate($_POST, $validation);
                if (count($errors) == 0) {
                    
                    $firstname = $_POST["firstname"];
                    $lastname = $_POST["lastname"];
                    $username = $_POST["username"];
                    $password = base64_encode($_POST["password"]);
                    
                    $user_check_query = "SELECT * FROM users WHERE u_username='$username'";
                    $result = $conn->query($user_check_query);
                    $user = $result->fetch_assoc();
                    if ($user && $user["u_id"] != $u_id) { 
                        $errors["username"] = "نام کاربری تکراری است";
                    }
                    else {
                        $query = "UPDATE users SET u_firstname='$firstname', u_lastname='$lastname', u_username='$username', u_password='$password' WHERE u_id='$u_id'";
                        $result = $conn->query($query); 
                        if ($result) {
                            header("Location: ../users");   
                        }
                    }
                }
            }
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
    <title>edit user</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/design.css">

    <script src="../assets/js/all.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <section class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 login-form mx-auto">
                    <h3 class="mt-4 mb-4">ویرایش مشخصات کاربر</h3>
                    <form method="post" action="<?php echo $u_id?>">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingFirstname" name="firstname" value="<?php echo $user['u_firstname']?>" placeholder="fname">
                            <label for="floatingFirstname">نام</label>
                        </div>
                        <?php
                        if (isset($errors) && array_key_exists("firstname", $errors)) {
                            $firstnameErr = $errors["firstname"];
                            echo "<span style='color:red'>$firstnameErr</span>";
                        }
                        ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatinglastname" name="lastname" value="<?php echo $user['u_lastname']?>" placeholder="lname">
                            <label for="floatinglastname">نام خانوادگی</label>
                        </div>
                        <?php
                        if (isset($errors) && array_key_exists("firstname", $errors)) {
                            $lastnameErr = $errors["lastname"];
                            echo "<span style='color:red'>$lastnameErr</span>";
                        }
                        ?>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" name="username" value="<?php echo $user['u_username']?>" placeholder="name@example.com">
                            <label for="floatingInput">نام کاربری</label>
                        </div>
                        <?php
                        if (isset($errors) && array_key_exists("username", $errors)) {
                            $usernameErr = $errors["username"];
                            echo "<span style='color:red'>$usernameErr</span>";
                        }
                        ?>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" name="password" value="<?php echo base64_decode($user['u_password'])?>" placeholder="Password">
                            <label for="floatingPassword">رمز عبور</label>
                        </div>
                        <?php 
                        if (isset($errors) && array_key_exists("password", $errors)) {
                            $passwordErr = $errors["password"];
                            echo "<span style='color:red'>$passwordErr</span>";
                        }
                        ?>

                        <button type="submit" class="btn btn-primary mt-4 mb-3 entry">تایید</button>

                </div>
                </form>
            </div>

        </div>


        </div>

    </section>

</body>

</html>