#!/usr/bin/php
<?php

error_reporting(0);


// ----------- set start time for genesis
$data = "2020-02-16";
$time = "10:00:00";

$net_name = "minter-texas-12";

// ------------ select genesis file
$gf = "genesis.json";
$g = file_get_contents($gf);
$g2 = $g;


// ==================== get validators with status = 2
$a = "status_nodes_autostart.txt";
$a = file_get_contents($a);
$a = trim($a);
$mas = explode("\n",$a);
foreach($mas as $line)
{
    $t = explode(" ",$line);
    $autostart[$t[0]] = $t[0];
}
// -------------------------------

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

$g2 = str_replace("BIP","MNT",$g2);


//print_r($a);

// ----------- set if(0) for skip change modify status
if(1)
{
$a = json_decode($g2,1);
$nn=0;
foreach($a[app_state][candidates] as $num=>$v)
{
    $nn++;
//    print $nn."\t".$v[pub_key]."\t".$v[status]."\n";
    if(isset($autostart[$v[pub_key]]))$a[app_state][candidates][status] = 2;
    else $a[app_state][candidates][status] = 1;
    print $nn."\t".$v[pub_key]."\tstatus:".$a[app_state][candidates][status]."\n";
}
$o += JSON_PRETTY_PRINT;
$g2 = json_encode($a,$o);
}
//-----------------------------



//$file = dirname($gf)."/genesis.".date("Y-m-d-H-i-s").".json";
$file = dirname($gf)."/genesis.new.json";
file_put_contents($file,$g2);

?>