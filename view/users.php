<?php
session_start();
require('config.php');
require('validation.php');
require('jdf.php');

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
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn,$query);
    if ($result) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }

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
                $date = time();
                
                $user_check_query = "SELECT * FROM users WHERE u_username='$username'";
                $result = $conn->query($user_check_query);
                $user = $result->fetch_assoc();
                if ($user) { 
                    $errors["username"] = "نام کاربری تکراری است";
                }
                else {
                $query = "INSERT INTO users (u_firstname, u_lastname, u_username, u_password, u_date) VALUES ('$firstname', '$lastname', '$username', '$password', '$date')";
                $result = $conn->query($query); 
                if ($result) {
                    header("Location: users");   
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
    <title>users</title>
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/users.css">

    <script src="assets/js/all.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/c5e9242800.js" crossorigin="anonymous"></script>
</head>

<body>

    <section class="container-fluid">
        <h3 class="d-flex justify-content-center mt-5">صفحه کاربران </h3>
        <div class="table-responsive mt-5">
            <table class="table table-bordered">
                <thead class="table-dark col-md-12">
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>نام خانوادگی</th>
                        <th>نام کاربری</th>
                        <th>رمز عبور</th>
                        <th>تاریخ درج</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="body-color">
                    <?php if (count($rows) > 0) {
                        $i = 1;
                        foreach ($rows as $row) { ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $row["u_firstname"]?></td>
                        <td><?php echo $row["u_lastname"]?></td>
                        <td><?php echo $row["u_username"]?></td>
                        <td><?php echo base64_decode($row["u_password"])?></td>
                        <td>
                            <?php echo jdate('l j F Y', $row["u_date"]);?>
                        </td>
                        <td>
                            <a href='edit-user/<?php echo $row['u_id']?>'><button class="btn btn-dark"><i class="fa-regular fa-pen-to-square"></i> ویرایش</button></a>
                            <a href='del-user/<?php echo $row['u_id']?>'><button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i> حذف </button></a>
                        </td>
                    </tr>
                    <?php $i++; } } ?>
                    <tr>
                        <td class="pt-4">افزودن کاربر</td>
                        <form method="post" action="users">
                            <td class="pt-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sourceInput" name="firstname" placeholder="...">
                                    <label for="sourceInput" class="sorce-label">...</label>
                                </div>
                            </td>
                            <td class="pt-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sourceInput" name="lastname" placeholder="...">
                                    <label for="sourceInput" class="sorce-label">...</label>
                                </div>
                            </td>
                            <td class="pt-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sourceInput" name="username" placeholder="...">
                                    <label for="sourceInput" class="sorce-label">...</label>
                                </div>
                            </td>
                            <td class="pt-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sourceInput" name="password" placeholder="...">
                                    <label for="sourceInput" class="sorce-label">...</label>
                                </div>
                            </td>
                            <td class="pt-3">
                            </td>
                            <td class="pt-3">
                                <button class="btn btn-primary btn1"><i class="fa-solid fa-check"></i> ثبت </button>
                            </td>
                        </tr>
                    </form>
                </tbody>

            </table>

        </div>
    </section>

</body>

</html>