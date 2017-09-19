<?php

require_once("scrip.php");

$scrips = getScrips();

$phrase = "";

if(isset($_GET['phrase'])) {
	$phrase = $_GET['phrase'];
}

$dataType = "json";

if(isset($_GET['dataType'])) {
	$dataType = $_GET['dataType'];
}

$found_scrip = array();

foreach ($scrips as $key => $scrip) {

	if ($phrase == "" || stristr($scrip, $phrase) != false) {
		array_push($found_scrip	, $scrip);
	}
}


switch($dataType) {

	case "json":

		$json = '[';

		foreach($found_scrip as $key => $scrip) {
			$json .= '{"name": "' . $scrip . '"}';

			if ($scrip !== end($found_scrip)) {
				$json .= ',';	
			}
		}

		$json .= ']';


		header('Content-Type: application/json');
		echo $json;

	break;

	case "xml":
 	    $xml = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' . "\n";
		$xml .= '<data>';

		foreach($found_scrip as $key => $scrip) {
			$xml .= '<country>' . $scrip . '</country>';
		}

		$xml .= '</data>';


		header('Content-Type: text/xml');
		echo $xml;
	break;

	default:
	break;

}


?>
