<?php
class Validator{
    public static function chkEmpty($name, $value){
        global $errors;
        if (empty($value)){
            $errors[] =    ucfirst($name).    ' can\'t be empty';
        }
    }
}
?>