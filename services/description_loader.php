<?php
	
if(!isset($_FILES['corpus']) or $_FILES['corpus']['size'] == 0 or pathinfo(basename($_FILES["corpus"]["name"]), PATHINFO_EXTENSION) != "json")
	echo str_replace("    ", "  ", json_encode(array('error' => 'corpus incorrecte'), JSON_PRETTY_PRINT));
else
{
	
	echo file_get_contents($_FILES['corpus']['tmp_name']);
	exit;
	
	
	$json = file_get_contents($_FILES['corpus']['tmp_name']);
	$json = json_decode($json, true);
	
	$concepts = array();
	$services = array();
	
	foreach($json['network']['networkStructure']['nodes']['node'] as $c)
	{
		$concepts[] = array("id" => $c['id'], "subconcept" => array($c['id'] . 'X'));
	}
	
	foreach($json['network']['networkStructure']['links']['link'] as $s)
	{
		$services[] = array("id" => $s['source'].$s['target'], "adresses" => array(), "input" => array($s['source']), "output" => array($s['target']));
		$services[] = array("id" => $s['target'].$s['source'], "adresses" => array(), "input" => array($s['target']), "output" => array($s['source']));
	}
	
	$corpus = array('identifier' => 'graphe', 'concepts' => $concepts, 'services' => $services);
	
	echo str_replace("    ", "  ", json_encode($corpus, JSON_PRETTY_PRINT));
}