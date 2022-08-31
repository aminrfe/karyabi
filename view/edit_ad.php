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
    $query = "SELECT * FROM advertisings WHERE ad_id='$ad_id'";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        $adver = $result->fetch_assoc();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["source"]) && isset($_POST["publishdate"]) && isset($_POST["category"]) && isset($_POST["title"]) && isset($_POST["province"]) && isset($_POST["city"])) {
                $validation = [
                'category'=>['required','isEmpty|isPersian','دسته بندي آگهی الزامی است|دسته بندي آگهی باید فارسی باشد'],
                'title'=>['required','isEmpty|isPersian','عنوان آگهی الزامی است|عنوان آگهی باید فارسی باشد'],
                'province'=>['required','isEmpty|isNumeric','استان آگهی الزامی است| استان را انتخاب کنید'],
                'city'=>['required','isEmpty|isNumeric','شهر آگهی الزامی است|یک شهر را انتخاب کنید'],
                'phone'=>['optional','isEnglish|checkPhone','شماره موبايل/تلفن باید انگليسي باشد|شماره موبايل/تلفن صحيح نيست']
                ];
                $val = new validation();
                $errors = $val->validate($_POST, $validation);
                if (count($errors) == 0) {
        
                $ad_source = $_POST["source"];
                $publish_date = $_POST["publishdate"] / 1000;
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
                $ad_province = $_POST["province"];
                $ad_city = $_POST["city"];
                $address = $_POST["address"];
                $labels = $_POST["labels"];
                $insertdate = time();

                $query = "UPDATE advertisings SET ad_source='$ad_source', ad_publishdate='$publish_date', ad_salary='$salary', ad_minsalary='$min_salary', ad_maxsalary='$max_salary', ad_category='$category', ad_title='$title', ad_startworkhour='$startworkhour', ad_finishworkhour='$finishworkhour', ad_phone='$phone', ad_collection='$collection', ad_details='$details', ad_province='$ad_province', ad_city='$ad_city', ad_address='$address', ad_labels='$labels', ad_insertdate='$insertdate' WHERE ad_id='$ad_id'";
                $result = $conn->query($query); 
                if ($result) {
                    header("Location: ../report");   
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
    <title>edit</title>

    <link rel="stylesheet" href="../assets/css/persian-datepicker.min.css">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/persian-date.min.js"></script>
    <script src="../assets/js/persian-datepicker.min.js"></script>

    <link rel="stylesheet" href="../assets/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="../assets/css/all.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/register.css">
    <link rel="stylesheet" href="../assets/css/edit.css">

    <script src="../assets/js/all.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <header class="container">
        <h3 class="header mt-4 mb-4">لطفا فرم زیر را پر کنید</h3>
    </header>

    <section>
        <div class="container">

            <form method="post" action="<?php echo $ad_id?>">
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <label for="advertisement-source" class="form-label d-flex justify-content-center">منبع آگهی
                            را انتخاب کنید</label>
                        <select class="form-select" id="advertisement-source" name="source">
                        <?php 
                            $query = "SELECT * FROM advertising_sources";
                            $result = $conn->query($query);
                            while ($row = $result->fetch_assoc()) {
                                $source_id = $row["as_id"];
                                $source_name = $row["as_name"];
                                if ($adver['ad_source']==$source_id)
                                    echo "<option selected value=\"" . $source_id . "\">".$source_name . "</option>";
                                else     
                                    echo "<option value=\"" . $source_id . "\">".$source_name . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label for="calendar" class="form-label d-flex justify-content-center" value="">تاریخ آگهی
                            را انتخاب کنید</label>
                        <input id="calendar2" class="example1" value="<?php echo jdate('Y/n/j',$adver["ad_publishdate"])?>"/>
                        <input type="hidden" id="calendar" name="publishdate" class="example2">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-2 form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="salary" value="<?php echo $adver["ad_salary"]?>" placeholder="salary">
                        <label for="floatingInput">
                            <p class="label-position">حقوق</p>
                        </label>
                    </div>

                    <div class="col-md-2 form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="maxsalary" value="<?php echo $adver["ad_maxsalary"]?>" placeholder="salary-top">
                        <label for="floatingInput">
                            <p class="label-position">حداکثر حقوق</p>
                        </label>
                    </div>

                    <div class="col-md-2 form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="minsalary" value="<?php echo $adver["ad_minsalary"]?>" placeholder="salary-floor">
                        <label for="floatingInput">
                            <p class="label-position">حداقل حقوق</p>
                        </label>
                    </div>

                    <div class="col-md-6 form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="category" value="<?php echo $adver["ad_category"]?>" placeholder="Grouping">
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
                        <input type="text" class="form-control" id="floatingInput" name="title" value="<?php echo $adver["ad_title"]?>" placeholder="advertise-tite"
                            required>
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
                        <input type="text" class="form-control" id="floatingInput" name="startworkhour" value="<?php echo $adver["ad_startworkhour"]?>" placeholder="work-begin">
                        <label for="floatingInput">
                            <p class="label-position">شروع ساعت کاری</p>
                        </label>
                    </div>

                    <div class="col-md-3 form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="finishworkhour" value="<?php echo $adver["ad_finishworkhour"]?>" placeholder="work-end">
                        <label for="floatingInput">
                            <p class="label-position">پایان ساعت کاری</p>
                        </label>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-md-3 form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="collection" value="<?php echo $adver["ad_collection"]?>"
                            placeholder="The-title-of-the-advertiser-collection">
                        <label for="floatingInput">
                            <p class="label-position">عنوان مجموعه آگهی دهنده</p>
                        </label>
                    </div>

                    <div class="col-md-3 form-floating mb-2">
                        <input type="text" class="form-control" id="floatingInput" name="phone" value="<?php echo $adver["ad_phone"]?>" placeholder="phone">
                        <label for="floatingInput">
                            <p class="label-position">شماره موبایل / تلفن</p>
                        </label>
                    </div>

                    <div class="col-sm-3 state-fix-position">
                        <label for="state" class="form-label d-flex justify-content-center">استان</label>
                        <select class="form-select state-select" id="state" name="province">
                        <?php 
                            $query = "SELECT * FROM provinces";
                            $result = $conn->query($query);
                            echo "<option>__انتخاب کنید__</option>";
                            while ($row = $result->fetch_assoc()) {
                                $province_id = $row["p_id"];
                                $province_name = $row["p_name"];
                                    echo "<option value=\"" . $province_id . "\">".$province_name . "</option>";
                            }
                            ?>
                        </select>
                    </div>
        
                    <div class="col-sm-3 state-fix-position">
                        <label for="city" class="form-label d-flex justify-content-center">شهر</label>
                        <select class="form-select state-select" id="city" name="city">
                        </select>

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 form-group shadow-textarea mt-5">
                        <label for="Textarea"></label>
                        <textarea class="form-control mt-2" id="Textarea" name="details" rows="3"
                            placeholder="توضیحات آگهی"><?php echo $adver["ad_details"]?></textarea>
                    </div>
            


                    <div class="col-sm-6 form-group shadow-textarea mt-5">
                    <label for="Textarea"></label>
                        <textarea class="form-control mt-2" id="Textarea" name="labels" rows="3" placeholder="برچسب"><?php echo $adver["ad_labels"]?></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 form-group shadow-textarea mt-5">
                        <textarea class="form-control mt-2 mb-1" id="Textarea" name="address" rows="3" placeholder="آدرس"><?php echo $adver["ad_address"]?></textarea>
                    </div>
                </div>

                <div class="row icons mt-4 mb-1">

                <div class="col-sm-6 mx-auto">
                    <button class="btn btn-success">ثبت نام</button>
                </div>

            </div>

        </form>
        <div class="row icons">
                <div class="col-sm-6  mx-auto mb-4">
                <a href='../report'><button class="btn btn-danger mt-1"><i class="fa-solid fa-rotate-left"></i>
                        بازگشت </button></a>
                </div>
            </div>

        </div>
    </section>



</body>

<script type="text/javascript">
$('.example1').persianDatepicker({
        altField: '#calendar',
        onSelect: function (unix) {
            var handler = document.getElementById("calendar");
            handler.value = unix;
        }
    });

    $('.example1').persianDatepicker({
            initialValueType: 'persian',
            altField: '#calendar',
            format: 'dddd D MMMM YYYY',
            onSelect: function (unix) {
                var handler = document.getElementById("calendar");
                handler.value = unix;
            }
        });

$(document).on("change","#state",function(){
    $("#city").html("");
    var pid = $(this).val();
    if(pid > 0){
        $.post("http://localhost/karyabi/ajax",{form:"getCitiesList",p_id:pid},function(data,status){
            if(status === "success"){
                //console.log(data);
                if(data){
                    if(isJson(data)){
                        var result = $.parseJSON(data);
                        //console.log(result);
                        if(!$.isEmptyObject(result)){
                            if(result['status'] === "success"){
                                var data = result['data'];
                                var html = "<option>__انتخاب کنید__</option>";
                                for(content in data){
                                    ct_id = result['data'][content]['ct_id'];
                                    ct_name = result['data'][content]['ct_name'];
                                    html += "<option value=\"" + ct_id + "\">" + ct_name + "</option>";
                                }
                                $("#city").html(html);
                            }
                        }
                    }
                }
            }
        });
    }
});

function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

</script>



</html>