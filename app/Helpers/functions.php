<?php

function sanitizeStringData($str){
    $str = preg_replace("/[^a-zA-Z0-9]/", "", $str);
    return (string) $str;
}

function isFraud($document, $data_nasc){
    $isFraud = true;
    $firstNumber = substr($document, 0, 1);
    $year = (integer) date("Y", strtotime($data_nasc));

    $x = ['0','1','2','3'];
    $y = ['4','5','6'];
    $z = ['7','8','9'];

    if(($year <= 1950 && in_array($firstNumber, $x))){
        $isFraud = false;
    }

    if($year > 1950 && $year <= 2000 && in_array($firstNumber, $y)){
        $isFraud = false;
    }

    if($year >= 2001 && in_array($firstNumber, $z)){
        $isFraud = false;
    }

    return $isFraud;
}
