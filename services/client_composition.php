<?php

require_once "NuSoap/nusoap.php";


if(!isset($_FILES['corpus']) or $_FILES['corpus']['name'] == "" or $_FILES['corpus']['size'] == 0)
{
	echo json_encode(array('Error' => 'Corpus Null'), JSON_PRETTY_PRINT);
	exit;
}

if(!isset($_POST['inputs']) or !isset($_POST['outputs']) or trim($_POST['inputs']) == "" or trim($_POST['outputs']) == "")
{
	echo json_encode(array('Error' => 'Inputs / Outputs'), JSON_PRETTY_PRINT);
	exit;
}

if(!isset($_POST['nmax']) or !isset($_POST['tmax']) or trim($_POST['nmax']) == "" or trim($_POST['tmax']) == "")
{
	echo json_encode(array('Error' => 'Max Compositions'), JSON_PRETTY_PRINT);
	exit;
}

$nmax		= $_POST['nmax'];
$tmax 		= $_POST['tmax'];
$algorithme = $_POST['algorithme'];
$outputs	= $_POST['outputs'];
$inputs 	= $_POST['inputs'];
$corpus 	= file_get_contents($_FILES['corpus']['tmp_name']);

$time_pre 	= microtime(true);
$client 	= new nusoap_client($algorithme, true);

$return		= $client->call("RechercheCompositions", array(
					"json" => $corpus,
					"inputs" => $inputs,
					"outputs" => $outputs,
					"nmax" => $nmax,
					"tmax" => $tmax
				));
				
$time_post 	= microtime(true);
$exec_time 	= $time_post - $time_pre;
$time 		= $exec_time . " s";

if(false and	isset($return['RechercheCompositionsResult']) &&
	isset($return['RechercheCompositionsResult']['error']) &&
	isset($return['RechercheCompositionsResult']['message']) &&
	isset($return['RechercheCompositionsResult']['compositions']) )
{
	if(isset($return['RechercheCompositionsResult']['compositions']['Composition']))
		$results	= json_encode(array(
						"time" => $time,
						"countServices" => $return['RechercheCompositionsResult']['countServices'],
						"countConcepts" => $return['RechercheCompositionsResult']['countConcepts'],
						"countCompositions" => $return['RechercheCompositionsResult']['countCompositions'],
						"results" => $return['RechercheCompositionsResult']['compositions']['Composition'],
						), JSON_PRETTY_PRINT);
	else
		$results	= json_encode(array(
						"time" => $time,
						"countServices" => $return['RechercheCompositionsResult']['countServices'],
						"countConcepts" => $return['RechercheCompositionsResult']['countConcepts'],
						"countCompositions" => $return['RechercheCompositionsResult']['countCompositions'],
						"results" => $return['RechercheCompositionsResult']['message'],
						), JSON_PRETTY_PRINT);
}
else
{
	$results	= json_encode(array(
					"time" => $time,
					//"count" => count($return),
					"results" => $return,
					), JSON_PRETTY_PRINT);
}

echo str_replace("    ", "  ", $results);
