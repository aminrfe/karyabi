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
    $query = "SELECT * FROM advertising_sources";
    $result = mysqli_query($conn,$query);
    if ($result) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["as_name"])) {
            $validation = [
            'as_name'=>['required','isEmpty|isPersian','نام منبع الزامی است|نام منبع آگهی باید فارسی باشد'],
            ];
            $val = new validation();
            $errors = $val->validate($_POST, $validation);
            if (count($errors) == 0) {
                $as_name = $_POST["as_name"];
                $query = "INSERT INTO advertising_sources (as_name) VALUES ('$as_name')";
                $result = $conn->query($query); 
                if ($result) {
                    header('Location:sources');    
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
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/source.css">

    <script src="assets/js/all.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/c5e9242800.js" crossorigin="anonymous"></script>
    <title>advertise source</title>
</head>

<body>
    <section class="container">
        <h3 class="d-flex justify-content-center mt-5">صفحه منابع آگهی</h3>
        <div class="table-responsive mt-5">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ردیف</th>
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody class="body-color">
                <?php if (count($rows) > 0) {
                $i = 1;
                foreach ($rows as $row) { ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $row["as_id"]?></td>
                        <td><?php echo $row["as_name"];?></td>
                        <td><a href='del-as/<?php echo $row['as_id']?>'><button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i> حذف </button></a></td>
                    </tr>
        <?php $i++; } } ?>
                    <tr>
                        <td>افزودن منبع</td>
                        <td></td>
                        <form method="post" action="sources">
                        <td>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="sourceInput" name="as_name" placeholder="...">
                                <label for="sourceInput">...</label>
                                <?php if(isset($errors) && array_key_exists("as_name", $errors)) {
                                    $asErr = $errors["as_name"];
                                    echo "<span style='color:red'>$asErr</span>";
                                }?>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-primary"><i class="fa-solid fa-check"></i> ثبت </button>
                        </td>
                        </form>
                    </tr>
                </tbody>

            </table>

        </div>
    </section>



</body>

</html>