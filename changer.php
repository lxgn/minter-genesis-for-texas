#!/usr/bin/php
<?php

error_reporting(0);

$data = "2020-02-20";
$time = "18:40:00";

$net_name = "minter-texas-12";


$gf = "genesis.json";
$g = file_get_contents($gf);
$g2 = $g;


$devider = "<!-- liksagen -->";

$a = "changes.txt";
$a = file_get_contents($a);
$a = trim($a);
$mas = explode("\n",$a);

foreach($mas as $line)
{
    $line = trim($line);
    if(!$line)continue;
    if(strpos($line,":"))
    {
    $t = $line;
    $t = explode(":",$t);
    
    $name = $t[0];
    print "Validator: $name\n";
    }
    else
    {
	$t = explode(" ",$line);
	$from = $t[0];
	$to = $t[2];
	//print_r($t);
	$g2 = str_replace($to,$devider,$g2);
	$g2 = str_replace($from,$to,$g2);
	$g2 = str_replace($devider,$from,$g2);
    }
}

$preg_mas[g] = "/\"genesis_time\"\: \"(.*?)\"/sim";
$preg_mas[c] = "/\"chain_id\"\: \"(.*?)\"/sim";
foreach($preg_mas as $k=>$preg)
{
    switch($k)
    {
	case "g":
	    $val = $data."T".$time."Z";
	break;
	case "c":
	    $val = $net_name;
	break;
    }
    unset($reg);
    preg_match($preg,$g2,$reg);
    $g2 = str_replace($reg[1],$val,$g2);
}





$file = dirname($gf)."/genesis.".date("Y-m-d-H-i-s").".json";
file_put_contents($file,$g2);

?>