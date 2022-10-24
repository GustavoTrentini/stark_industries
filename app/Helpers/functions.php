<?php

function sanitizeStringData($str){
    $str = preg_replace("/[^a-zA-Z0-9]/", "", $str);
    return (string) $str;
}

function cepFormatter($str){
    return str_pad($str, 8, '0', STR_PAD_LEFT);
}
