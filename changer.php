#!/usr/bin/php
<?php

error_reporting(0);

// ----------- set start time for genesis
$data = "2020-02-16";
$time = "12:15:00";

//$data = "2020-02-15";
//$time = "23:00:00";

$net_name = "minter-texas-13";

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
//	if(substr($from,0,2)=="Mp")print $to." $name\n";
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

$g2 = str_replace("BIP",$devider,$g2);
$g2 = str_replace("MNT","BIP",$g2);
$g2 = str_replace($devider,"MNT",$g2);


//print_r($a);

// ----------- set if(0) for skip change modify status
if(1)
{
$a = json_decode($g2);
//print_r($a->app_state->candidates);
$nn=0;
$b = $a->app_state->candidates;

foreach($b as $num=>$v)
{
    $nn++;
    $preg = "/((\"pub_key\": \"".$v->pub_key."\",[\s]{1,1000}\"commission\":.*?\"status\":[\s]{1,100})([\d]))/sim";
    preg_match($preg,$g2,$reg);
    unset($reg);
	preg_match($preg,$g2,$reg);

    if(isset($autostart[$v->pub_key]))
    {
	$g2 = str_replace($reg[1],$reg[2]."2",$g2);
    }
    else 
    {
	$g2 = str_replace($reg[1],$reg[2]."1",$g2);
    $preg2 = "/\{[\s]{1,100}\"total_bip_stake\": \"[\d]{1,100}\",[\s]{1,100}\"pub_key\": \"".$v->pub_key."\",[\s]{1,100}\"accum_reward\": \"[\d]{1,100}\",[\s]{1,100}\"absent_times\": \".*?\"[\s]{1,100}\}/sim";
    unset($reg2);
    preg_match($preg2,$g2,$reg2);
$t = $reg2[0];
$t = trim($t);
if($t)
{
$t2 = $t.",";
    $g2 = str_replace($t2,"",$g2);
    $g2 = str_replace($t,"",$g2);
}
    }
    //------------
    
}
}
//-----------------------------

$g2 = preg_replace("/\n[\s]{1,1000}\n/sim","\n",$g2);
$preg = "/(\"validators\": \[.*?)\,([\s]{1,100}])/sim";
unset($reg);
preg_match($preg,$g2,$reg);
if($reg[1])
{
//print_r($reg);
$g2 = str_replace($reg[0],$reg[1].$reg[2],$g2);
}

$file = dirname($gf)."/genesis.new.json";
file_put_contents($file,$g2);

?>