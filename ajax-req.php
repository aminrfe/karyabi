<?php
require_once('config.php');

if(@$_POST['form'] == 'getCitiesList') {
    if(isset($_POST['p_id']) && is_numeric(@$_POST['p_id'])) {
        $p_id = htmlspecialchars(addslashes(trim($_POST['p_id'])));
        $query = "SELECT * FROM cities WHERE ct_province = '$p_id'";
        $result = $conn->query($query);
        $return_array = array();
        if ($result) {
            if ($result->num_rows > 0) {
                $return_array["status"] = "success";  
                $return_array["data"] = array();
                while ($obj = $result->fetch_object()) {
                    $obj_arr["ct_id"] = $obj->ct_id;
                    $obj_arr["ct_name"] = $obj->ct_name;
                    array_push($return_array["data"], $obj_arr);
                }
            } else {
                $return_array["status"] = "error";  
                $return_array["error_code"] = "-1";
                $return_array["error_message"] = "ركوردي يافت نشد";

            }
        } else {
            $return_array["status"] = "error";
            $return_array["error_code"] = "-2";
            $return_array["error_message"] = "خطاي ديتابيس: " . $conn->error;


        }
    } else {
        $return_array["status"] = "error";
        $return_array["error_code"] = "-3";
        $return_array["error_message"] = "شناسه استان ارسال نشد";

    }

    echo json_encode($return_array);
} 
?>