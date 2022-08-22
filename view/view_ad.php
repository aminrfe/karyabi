<?php
session_start();
require('config.php');
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
    $query = "SELECT * FROM advertising_view WHERE ad_id = $ad_id";
    $result = $conn->query($query);
    if ($result) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
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
    <title>view</title>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="../assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/view.css">

    <script src="../assets/js/all.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/c5e9242800.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
    <a href="../report"><button type="button" class="btn btn-danger mt-5"><i class="fa-solid fa-rotate-left"></i> بازگشت </button></a>
        <div class="row contents">
            <div class="col-lg-6 right-contents">
                <h3 class="mt-4 col-8"><?php echo $row["ad_title"]?></h3>



                <table class="table-responsive mt-5">
                    <table class="table">

                        <tr class="row">
                            <td class="col-4">دسته بندی</td>
                            <td class="col-4" style="text-align:left"><?php echo $row["ad_category"]?></td>
                        </tr>

                        <tr class="row">
                            <td class="col-4">عنوان مجموعه آگهی </td>
                            <td class="col-4" style="text-align:left"><?php echo $row["ad_collection"]?></td>
                        </tr>

                        <tr class="row">
                            <td class="col-4">استان</td>
                            <td class="col-4" style="text-align:left"><?php echo $row["p_name"]?></td>
                        </tr>
                        <tr class="row">
                            <td class="col-4">شهر</td>
                            <td class="col-4" style="text-align:left"><?php echo $row["ct_name"]?></td>
                        </tr>
                        <tr class="row">
                            <td class="col-4">آدرس</td>
                            <td class="col-4" style="text-align:left"><?php echo $row["ad_address"]?></td>
                        </tr>

                        <tr class="row">
                            <td class="col-4">حقوق</td>
                            <td class="col-4" style="text-align:left"><?php echo $row["ad_salary"]?></td>
                        </tr>

                            <tr class="row">
                                <td class="col-4">حداقل دستمزد</td>
                                <td class="col-4" style="text-align:left"><?php echo $row["ad_minsalary"]?></td>
                            </tr>

                            <tr class="row">
                                <td class="col-4">حداکثر دستمزد</td>
                                <td class="col-4" style="text-align:left"><?php echo $row["ad_maxsalary"]?></td>
                            </tr>

                            <tr class="row">
                                <td class="col-4">شروع ساعت کاری</td>
                                <td class="col-4" style="text-align:left"><?php echo $row["ad_startworkhour"]?></td>
                            </tr>

                            <tr class="row">
                                <td class="col-4">پایان ساعت کاری</td>
                                <td class="col-4" style="text-align:left"><?php echo $row["ad_finishworkhour"]?></td>
                            </tr>

                            <tr class="row">
                                <td class="col-4">شماره موبایل / تلفن</td>
                                <td class="col-4" style="text-align:left"><?php echo $row["ad_phone"]?></td>
                            </tr>
                </table>
               
            </div>




            <div class="col-lg-6 left-contents container">
                <div>
                    <h4 class="mt-5"> توضیحات آگهی</h4>
                    <p class="col-md-8 mt-3"><?php echo $row["ad_details"]?></p>
                </div>

                <div>
                    <h5>برچسب ها
                    <br><?php
                     $arr = explode("#", $row["ad_labels"]);
                     foreach($arr as $label) {
                        if($label)
                            echo  "<span class=\"badge bg-secondary\">".'#'.trim($label)."</span> ";
                     }
                     ?>
                    </h5>
                </div>

            </div>





        </div>
    </div>
    </div>
</body>

</html>