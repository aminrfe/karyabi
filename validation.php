<?php

class Validation {

    public function validate($input, $validation) {
        $error_list = [];
  
        foreach($validation as $key=>$value) {
            $field_name = $key;
            $field_required = $value[0];
            $field_check_list = explode('|',$value[1]);
            $field_check_list_errors = explode('|',$value[2]);

                
            if ((array_key_exists($field_name,$input) && (($field_required == "required") || ($field_required == "optional" && !self::isEmpty($input[$field_name]))))) {
                $field_value = $input[$field_name];
                for($i = 0; $i < count($field_check_list); $i++)  {
                    if (($j = strpos($field_check_list[$i], "checkPassword")) !== false) {
                        $arr = explode("&", $field_check_list[$i]);
                        $pass_len = $arr[1];
                        $field_check_list[$i] = "checkPassword";
                    }
                    elseif (($j = strpos($field_check_list[$i], "inRange")) !== false) {
                        $arr = explode("&", $field_check_list[$i]);
                        $min = $arr[1];
                        $max = $arr[2];
                        $field_check_list[$i] = "inRange";
                    }

                    switch ($field_check_list[$i]) {
                        case "isEmpty":
                            if (self::isEmpty($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }
                            break;
                        case "isNumeric":
                            if(!self::isNumeric($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }
                            break;
                        case "inRange":
                            if(!self::inRange($field_value,$min,$max)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }
                            break;
                        case "checkEmail":
                            if(!self::checkEmail($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            } 
                            break;
                        case "checkPassword":
                            if(!self::checkPassword($field_value,$pass_len)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }   
                            break;
                        case "checkMobile":
                            if(!self::checkMobile($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }   
                            break;
                        case "checkPhone":
                            if(!self::checkPhone($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }   
                            break;
                        case "checkTelephone":
                            if(!self::checkTelephone($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }  
                            break;
                        case "checkNationalCode":
                            if(!self::checkNationalCode($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            } 
                            break;
                        case "isPersian":
                            if(!self::isPersian($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }   
                            break;
                        case "isEnglish":
                            if(!self::isEnglish($field_value)) {
                                if (!array_key_exists($field_name,$error_list)) {
                                    $error_list[$field_name] = $field_check_list_errors[$i];
                                }
                            }     
                            break;
                    }
                }
            }
            else {
                if($field_required == "required") {
                    $error_list[$field_name] = "پر کردن این فیلد الزامی است";
                }
            }
        
        }
        return $error_list;
    }
    
   private function isEmpty($input) {
        return empty($input);
   }

   private function isNumeric($input) {
    return is_numeric($input);
   }


   private function inRange($input, $min, $max) {
    return $input>=$min && $input<=$max;
   }

   private function checkEmail($input) {
    if (filter_var($input, FILTER_VALIDATE_EMAIL))
        return true;
    return false;    
   }

   function checkPassword($input, $len) {
    if (self::isEnglish($input) && strlen($input) >= $len)
        return true;
    return false;    
   }

   function checkMobile($input) {
    if (preg_match("/^09\d{9}$/", $input) && self::isNumeric($input))
        return true;
    return false;
   }

   private function checkTelephone($input) {
    if (preg_match("/^0\d{10}$/", $input))
        return true;
    return false;
   }

   private function checkPhone($input) {
    if (self::checkMobile($input) || self::checkTelephone($input))
        return true;
    return false;
   }

   private function checkNationalCode($input) {
    if (!preg_match('/^\d{10}$/',$input))
        return false;
    for ($i=0; $i<10; $i++) {
        if(preg_match('/^'.$i.'{10}$/',$input))
            return false;
    }
    for ($i=0,$sum=0; $i<9; $i++) {
        $sum += ((10 - $i) * intval(substr($input, $i, 1)));
    }
    $r = $sum % 11;
    $parity = intval(substr($input, 9,1));

    if(($r<2 && $r==$parity) || ($r>=2 && $r==11-$parity))
        return true;
    return false;
   }

   private function isPersian($input) {
    if (strlen($input) != mb_strlen($input, 'utf-8'))
        return true;
    return false;    
   }
   
   private function isEnglish($input) {
    return !self::isPersian($input);
   }


}

?>