<?php

require_once "NuSoap/nusoap.php";

$error = 0;

if(!isset($_FILES['corpus']) or $_FILES['corpus']['name'] == "" or $_FILES['corpus']['size'] == 0 or (pathinfo(basename($_FILES["corpus"]["name"]), PATHINFO_EXTENSION) != "json" and pathinfo(basename($_FILES["corpus"]["name"]), PATHINFO_EXTENSION) != "xml"))
{
	$corpus = array('error' => 'corpus incorrecte');
	$error = 1;
}
else
	$corpus = json_decode(file_get_contents($_FILES['corpus']['tmp_name']), true);

if(!isset($_POST['algorithme']))
{
	$return = array('error' => 'algorithme incorrecte');
	$error = 2;
}
else
{
	$algorithme = $_POST['algorithme'];
	$time_pre = microtime(true);
	$client = new nusoap_client($algorithme, true);
	$result = $client->call("Generer", array("corpus" => $corpus, "requete" => $requete));
	$time_post = microtime(true);
	$exec_time = $time_post - $time_pre;
	$return['time'] = $exec_time . "ms";
}
	
echo str_replace("    ", "  ", json_encode(array("corpus" => $corpus, "return" => $return, 'error' => $error), JSON_PRETTY_PRINT));