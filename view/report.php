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
    $query = "SELECT * FROM advertising_report";
    $result = mysqli_query($conn,$query);
    if ($result) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report</title>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/rep.css">

    <script src="assets/js/all.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/c5e9242800.js" crossorigin="anonymous"></script>
</head>

<body>

    <section class="container">
        <h3 class="rep-txt">صفحه گزارش</h3>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>عنوان</th>
                        <th>تاریخ انتشار</th>
                        <th>دسته بندی</th>
                        <th>استان</th>
                        <th>شهر</th>
                        <th>بررسی</th>
                    </tr>
                </thead>
                <tbody class="body-color">
                <?php if (count($rows) > 0) {
                $i = 1;
                foreach ($rows as $row) { ?>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $row["ad_title"]?></td>
                        <td>
                        <?php
                        echo jdate('l j F Y', $row["ad_publishdate"]);
                        ?>
                        </td>
                        <td><?php echo $row["ad_category"]?></td>
                        <td>
                        <?php echo $row["p_name"]?>
                        </td>
                        <td>
                        <?php echo $row["ct_name"]?>
                        </td>
                        <td>
                            <a href='edit_ad/<?php echo $row['ad_id']?>'><button class="btn btn-dark"><i class="fa-regular fa-pen-to-square"></i> ویرایش</button></a>
                            <a href='del_ad/<?php echo $row['ad_id']?>'><button class="btn btn-danger"><i class="fa-regular fa-trash-can"></i> حذف </button></a>
                            <a href='view_ad/<?php echo $row['ad_id']?>'><button class="btn btn-primary"><i class="fa-regular fa-eye"></i> مشاهده </button></a>
                        </td>
                    </tr>
        <?php $i++; } } ?>
                    
                </tbody>

            </table>
        </div>
    </section>



</body>

</html>