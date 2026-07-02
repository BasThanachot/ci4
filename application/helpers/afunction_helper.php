<?php
date_default_timezone_set('Asia/Bangkok');
function today() {
    return GregorianToJD(date("m"), date("j"), date("Y"));
} //----------------- วันตามหมายเลข
function time_str() { return date("G") . ":" . date("i") . ":" . date("s");} //------------------------- เวลา HR:MN:SE
function udate() { return date("U"); }
function now() { return time(); }
function thai_daytime($n) {
    //print $num_day;
    $thaiweek = array("อา", "จ", "อ", "พ", "พฤ", "ศ", "ส", "อา");
    $thaimonth = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $nd = $thaiweek[date('w', $n)];
    $mm = $thaimonth[date('n', $n) - 1];

    $y = substr(date('Y', $n) + 543, -2);
    $t = date('G:i:s', $n);
//print $printselectday;
    $sd = "$nd " . date('j', $n) . " $mm $y [$t]";
    return $sd;
}