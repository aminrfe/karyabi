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
elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["source"]) && isset($_POST["publishdate"]) && isset($_POST["category"]) && isset($_POST["title"]) && isset($_POST["province"]) && isset($_POST["city"])) {
        $validation = [
        'category'=>['required','isEmpty|isPersian','دسته بندي آگهی الزامی است|دسته بندي آگهی باید فارسی باشد'],
        'title'=>['required','isEmpty|isPersian','عنوان آگهی الزامی است|عنوان آگهی باید فارسی باشد'],
        'phone'=>['optional','isEnglish|checkPhone','شماره موبايل/تلفن باید انگليسي باشد|شماره موبايل/تلفن صحيح نيست']
        ];
        $val = new validation();
        $errors = $val->validate($_POST, $validation);
        if (count($errors) == 0) {

        $as_name = $_POST["source"];
        $query = "SELECT * FROM advertising_sources WHERE as_name='$as_name'";
        $result = ($conn->query($query))->fetch_assoc(); 
        $source_id = $result["as_id"];
        // $publish_date = $_POST["publishdate"];
        $publish_date = time();
        $salary = $_POST["salary"];
        $min_salary = $_POST["minsalary"];
        $max_salary = $_POST["maxsalary"];
        $category = $_POST["category"];
        $title = $_POST["title"];
        $startworkhour = $_POST["startworkhour"];
        $finishworkhour = $_POST["finishworkhour"];
        $phone = $_POST["phone"];
        $collection = $_POST["collection"];
        $details = $_POST["details"];
        
        $p_name = $_POST["province"];
        $query = "SELECT * FROM provinces WHERE p_name='$p_name'";
        $result = ($conn->query($query))->fetch_assoc(); 
        $ad_province = $result["p_id"];

        $ct_name = $_POST["city"];
        $query = "SELECT * FROM cities WHERE ct_province='$ad_province' AND ct_name='$ct_name'";
        $result = ($conn->query($query))->fetch_assoc(); 
        $ad_city = $result["ct_id"];
    
        $address = $_POST["address"];
        $labels = $_POST["labels"];
        $insertdate = time();

        $query = "INSERT INTO advertisings (ad_source, ad_publishdate, ad_salary, ad_minsalary, ad_maxsalary, ad_category, ad_title, ad_startworkhour, ad_finishworkhour, ad_phone, ad_collection, ad_details, ad_province, ad_city, ad_address, ad_labels, ad_insertdate) 
        VALUES ('$source_id','$publish_date','$salary','$min_salary','$max_salary','$category','$title','$startworkhour','$finishworkhour','$phone','$collection','$details','$ad_province','$ad_city','$address','$labels','$insertdate')";
        $result = $conn->query($query); 
        if ($result) {
            header('Location:navbar');    
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
    <title>register form</title>

    <link rel="stylesheet" href="assets/css/persian-datepicker.min.css">
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/persian-date.min.js"></script>
    <script src="assets/js/persian-datepicker.min.js"></script>

    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/register.css">

    <script src="assets/js/all.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="container">
        <h3 class="header mt-4 mb-4">لطفا فرم زیر را پر کنید</h3>
    </header>

    <section>
        <div class="container">

            <form method="post" action="reg">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="advertisement-source" class="form-label d-flex justify-content-center">منبع آگهی
                            را انتخاب کنید</label>
                        <select class="form-select" id="advertisement-source" name="source">
                        <?php 
                            $query = "SELECT * FROM advertising_sources";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_assoc()) {
                                $as_name = $row["as_name"];
                                echo "<option>". "$as_name"."</option>";
                            }
                            ?>
                        </select>
                    </div>
                            

                    <div class="col-md-6 mt-3">
                        <label for="calendar" class="form-label d-flex justify-content-center">تاریخ آگهی
                            را انتخاب کنید</label>
                        <input type="text" id="calendar" name="publishdate" class="example1" />
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-2 form-floating mb-2">
                        <input type="text" class="form-control" name="salary" id="floatingInput" placeholder="salary">
                        <label for="floatingInput">
                            <p class="label-position">حقوق</p>
                        </label>
                    </div>

                    <div class="col-md-2 form-floating mb-2">
                        <input type="text" class="form-control" name="maxsalary" id="floatingInput" placeholder="salary-top">
                        <label for="floatingInput">
                            <p class="label-position">حداکثر حقوق</p>
                        </label>
                    </div>

                    <div class="col-md-2 form-floating mb-2">
                        <input type="text" class="form-control" name="minsalary" id="floatingInput" placeholder="salary-floor">
                        <label for="floatingInput">
                            <p class="label-position">حداقل حقوق</p>
                        </label>
                    </div>

                    <div class="col-md-6 form-floating mb-2">
                        <input type="text" class="form-control" name="category" id="floatingInput" placeholder="Grouping">
                        <label for="floatingInput">
                            <p class="label-position">دسته بندی</p>
                        </label>
                    </div>
                    <?php 
                      if (isset($errors) && array_key_exists("category", $errors)) {
                          $categoryErr = $errors["category"];
                          echo "<span style='color:red'>$categoryErr</span>";
                      }
                      ?>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6 form-floating mb-2">
                        <input type="text" class="form-control" name="title" id="floatingInput" placeholder="advertise-tite">
                        <label for="floatingInput">
                            <p class="label-position">عنوان آگهی</p>
                        </label>
                    </div>
                    <?php 
                      if (isset($errors) && array_key_exists("title", $errors)) {
                          $titleErr = $errors["title"];
                          echo "<span style='color:red'>$titleErr</span>";
                      }
                      ?>

                    <div class="col-md-3 form-floating mb-2">
                        <input type="text" class="form-control" name="startworkhour" id="floatingInput" placeholder="work-begin">
                        <label for="floatingInput">
                            <p class="label-position">شروع ساعت کاری</p>
                        </label>
                    </div>

                    <div class="col-md-3 form-floating mb-2">
                        <input type="text" class="form-control" name="finishworkhour" id="floatingInput" placeholder="work-end">
                        <label for="floatingInput">
                            <p class="label-position">پایان ساعت کاری</p>
                        </label>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-3 form-floating mb-2">
                        <input type="text" class="form-control" name="collection" id="floatingInput"
                            placeholder="The-title-of-the-advertiser-collection">
                        <label for="floatingInput">
                            <p class="label-position">عنوان مجموعه آگهی دهنده</p>
                        </label>
                    </div>

                    <div class="col-md-3 form-floating mb-2">
                        <input type="text" class="form-control phone-number" name="phone" id="floatingInput" placeholder="phone">
                        <label for="floatingInput">
                            <p class="label-position">شماره موبایل / تلفن</p>
                        </label>
                    </div>
                    <?php 
                      if (isset($errors) && array_key_exists("phone", $errors)) {
                          $phoneErr = $errors["phone"];
                          echo "<span style='color:red'>$phoneErr</span>";
                      }
                      ?>

                    <div class="col-sm-3 state-fix-position">
                        <label for="state" class="form-label d-flex justify-content-center">استان</label>
                        <select class="form-select state-select" name="province" id="state" name="select-list1">
                        <?php 
                            $query = "SELECT * FROM provinces";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_assoc()) {
                                $province = $row["p_name"];
                                echo "<option>". "$province"."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-sm-3 state-fix-position">
                        <label for="city" class="form-label d-flex justify-content-center">شهر</label>
                        <select class="form-select state-select" name="city" id="city" name="select-list1">
                        <option>تهران</option>

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group shadow-textarea mt-5">
                        <textarea class="form-control mt-2" name="details" id="Textarea" rows="3"
                            placeholder="توضیحات آگهی"></textarea>
                    </div>

                    <div class="col-sm-6 form-group shadow-textarea mt-5">
                        <textarea class="form-control mt-2" name="labels" id="Textarea" rows="3" placeholder="برچسب"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 form-group shadow-textarea mt-5">
                        <textarea class="form-control mt-2 mb-1" name="address" id="Textarea" rows="3"
                            placeholder="آدرس"></textarea>
                    </div>
                </div>
                <div class="row mt-4 mb-4 col-3 mx-auto">
                    <button class="btn btn-success">ثبت نام</button>
                </div>


            </form>
        </div>
    </section>



</body>

<script type="text/javascript">
    $(document).ready(function () {
        $(".example1").pDatepicker();
    });
</script>

</html>