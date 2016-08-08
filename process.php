<?php
/* 
 * ProSoft Programming test
 * Monthly Calendar
 */

$start = filter_input(INPUT_POST,'start',FILTER_SANITIZE_STRING);
$days = filter_input(INPUT_POST,'days',FILTER_SANITIZE_NUMBER_INT);
$country = filter_input(INPUT_POST,'country',FILTER_SANITIZE_STRING);

//$start_date = new DateTime(strtotime($start));
//echo "<pre>";
$startdate = new DateTime($start);
$enddate = new DateTime($start);
$enddate->modify("+$days days");
$datediff = $startdate->diff($enddate);
//var_dump($datediff->d);
//var_dump($datediff->m);
//var_dump($datediff->y);
//echo "</pre>";
echo GenerateCalendar($startdate, $enddate, $datediff->d, $datediff->m, $datediff->y);

function GenerateCalendar($start,$end,$d,$m,$y){
    $sday = $start->format("d");
    $month = $start->format("n");
    $year = $start->format("Y");
    $eday = $end->format("d");
    $emonth = $end->format("n");
    $eyear = $end->format("Y");
    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
   
    $out = "";
    for($i=-1;$i<$m;$i++){
        $out .= <<<'STR'
<div id="calendar" class="col-xs-6 col-xs-offset-3">
    <table class="table table-responsive">
        <thead>
            <tr>
                <th class="text-center">S</th>
                <th class="text-center">M</th>
                <th class="text-center">T</th>
                <th class="text-center">W</th>
                <th class="text-center">T</th>
                <th class="text-center">F</th>
                <th class="text-center">S</th>
            </tr>
            <tr>
                <th colspan="7" class="text-center mth-head">
STR;
    $out .= numberToMonth($month)." $y";
    $out .= <<<'STR'
            </th>
            </tr>
        </thead>
STR;
    
        if($month==12){
            $month=1;
            $year++;
        } else {
            $month++;
        }
    }
    return $out;
}

function numberToMonth($m){
    switch($m){
        case "1":
            $month = "January";
            break;
        case "2":
            $month = "February";
            break;
        case "3":
            $month = "March";
            break;
        case "4":
            $month = "April";
            break;
        case "5":
            $month = "May";
            break;
        case "6":
            $month = "June";
            break;
        case "7":
            $month = "July";
            break;
        case "8":
            $month = "August";
            break;
        case "9":
            $month = "September";
            break;
        case "10":
            $month = "October";
            break;
        case "11":
            $month = "November";
            break;
        case "12":
            $month = "December";
            break;
    }
    return $month;
}
//add a "die()" to make sure ajax call doesn't "leak" in some browsers
die();