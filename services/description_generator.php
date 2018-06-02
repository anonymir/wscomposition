<?php

if(isset($_POST["identifier"]) and isset($_POST["nbConcepts"])
	and isset($_POST["maxSC"]) and isset($_POST["nbServices"]) and isset($_POST["maxIn"])
	and isset($_POST["maxOut"]) and isset($_POST["nbConcrets"])) 
{
	
	$services = array();
	$concepts = array();
	
	for($i = 0; $i < $_POST["nbConcepts"]; $i++)
	{
		$ns = rand(1, $_POST["maxSC"]);
		$sc = array();
		
		for($j = 0; $j < $ns; $j++)
		{
			$sc[] = "C" . $i . "_" . $j;
		}
		
		$concepts[] = array("id" => "C" . $i, "subconcept" => $sc);
	}
	
	for($i = 0; $i < $_POST["nbServices"]; $i++)
	{
		$nin = rand(1, $_POST["maxIn"]);
		$nou = rand(1, $_POST["maxOut"]);
		$nbConcrets = rand(1, $_POST["nbConcrets"]);
		$qos = "";
		$inp = "";
		$out = "";
		$idsE = array();
		$idsS = array();
		
		$adresses = array();
		
		
		for($j = 0; $j < $nbConcrets; $j++)
		{
			$adresses[] = array(
				"wsdl" => "http://www.server.com/SC" . $i . "-" . $j . ".wsdl",
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
				$c = rand(0, $_POST["nbConcepts"] - 1);
			} while(in_array($c, $idsE));
			
			$idsE[] = $c;
			$inp[] = $concepts[$c]['subconcept'][rand(0, count($concepts[$c]['subconcept']) - 1)];
		}
		for($j = 0; $j < $nou; $j++)
		{
			do {
				$c = rand(0, $_POST["nbConcepts"] - 1);
			} while(in_array($c, $idsS) or in_array($c, $idsE));
			
			$idsS[] = $c;
			$out[] = $concepts[$c]['subconcept'][rand(0, count($concepts[$c]['subconcept']) - 1)];
		}
		
		$services[] = array("id" => "S" . $i, "adresses" => $adresses, "input" => $inp, "output" => $out);
	}
	
	$corpus = array('identifier' => $_POST["identifier"], 'concepts' => $concepts, 'services' => $services);
	
	echo str_replace("    ", "  ", json_encode($corpus, JSON_PRETTY_PRINT));
}