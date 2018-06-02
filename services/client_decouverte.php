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

$algorithme = $_POST['algorithme'];
$outputs	= $_POST['outputs'];
$inputs 	= $_POST['inputs'];
$corpus 	= file_get_contents($_FILES['corpus']['tmp_name']);

$time_pre 	= microtime(true);
$client 	= new nusoap_client($algorithme, true);

$return		= $client->call("RechercheServices", array(
					"json" => $corpus,
					"inputs" => $inputs,
					"outputs" => $outputs
				));
				
$time_post 	= microtime(true);
$exec_time 	= $time_post - $time_pre;
$time 		= $exec_time . " s";

if(	isset($return['RechercheServicesResult']) &&
	isset($return['RechercheServicesResult']['error']) &&
	isset($return['RechercheServicesResult']['message']) &&
	isset($return['RechercheServicesResult']['services']) )
{
	if(isset($return['RechercheServicesResult']['services']['Service']))
		$results	= json_encode(array(
						"time" => $time,
						"count" => count($return['RechercheServicesResult']['services']['Service']),
						"results" => $return['RechercheServicesResult']['services']['Service'],
						), JSON_PRETTY_PRINT);
	else
		$results	= json_encode(array(
						"time" => $time,
						"count" => 0,
						"results" => $return['RechercheServicesResult']['message'],
						), JSON_PRETTY_PRINT);
}
else
{
	$results	= json_encode(array(
					"time" => $time,
					"count" => count($return),
					"results" => $return,
					), JSON_PRETTY_PRINT);
}
echo str_replace("    ", "  ", $results);
