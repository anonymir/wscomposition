<?php

$_POSTnbConcepts = 1541;
$_POSTmaxSC = 1;
$_POSTnbServices = 5000;
$_POSTmaxIn = 1;
$_POSTmaxOut = 1;
$_POSTnbConcrets = 1;
$_POSTidentifier = "S".$_POSTnbServices."-C".$_POSTnbConcepts."-ES".$_POSTmaxIn.$_POSTmaxOut;

$MAX = 10;
$NBR = array();

$services = array();
$concepts = array();

for($i = 0; $i < $_POSTnbConcepts; $i++)
{
	$NBR[$i] = 0;
		
	$ns = rand(1, $_POSTmaxSC);
	$sc = array();
	
	for($j = 0; $j < $ns; $j++)
	{
		$sc[] = "C" . $i . "_" . $j;
	}
	
	$concepts[] = array("id" => "C" . $i, "subconcept" => $sc);
}

for($i = 0; $i < $_POSTnbServices; $i++)
{
	$nin = rand(1, $_POSTmaxIn);
	$nou = rand(1, $_POSTmaxOut);
	$nbConcrets = 0;//rand(1, $_POSTnbConcrets);
	$qos = "";
	$inp = "";
	$out = "";
	$idsE = array();
	$idsS = array();
	
	$adresses = array();
	
	
	for($j = 0; $j < $nbConcrets; $j++)
	{
		$adresses[] = array(
			"wsdl" => "SC" . $i . "-" . $j . ".wsdl",
			"cost" => rand(100, 5000),
			"time" => rand(100, 5000),
			"disponibility" => rand(1, 100) / 100.0,
			"fiability" => rand(1, 100) / 100.0,
			"reputation" => rand(1, 100) / 100.0
			);
	}
	
	for($j = 0; $j < $nin; $j++)
	{
		do {
			$c = rand(0, $_POSTnbConcepts - 1);
		} while(in_array($c, $idsE) or $NBR[$c] >= $MAX);
		
		$NBR[$c]++;
		
		$idsE[] = $c;
		$inp[] = $concepts[$c]['subconcept'][rand(0, count($concepts[$c]['subconcept']) - 1)];
	}
	for($j = 0; $j < $nou; $j++)
	{
		do {
			$c = rand(0, $_POSTnbConcepts - 1);
		} while(in_array($c, $idsS) or in_array($c, $idsE) or $NBR[$c] >= $MAX);
		
		$NBR[$c]++;
		
		$idsS[] = $c;
		$out[] = $concepts[$c]['subconcept'][rand(0, count($concepts[$c]['subconcept']) - 1)];
	}
	
	$services[] = array("id" => "S" . $i, "adresses" => $adresses, "input" => $inp, "output" => $out);
}

$corpus = array('identifier' => $_POSTidentifier, 'concepts' => $concepts, 'services' => $services);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $_POSTidentifier . ".json");
header('Content-Transfer-Encoding: binary');
//header('Content-Length: ' . filesize($file));

echo str_replace("    ", "  ", json_encode($corpus, JSON_PRETTY_PRINT));
