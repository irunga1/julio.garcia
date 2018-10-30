<?php
	session_start();
	ob_start();
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
	header("Cache-survey_control_type: private, no-store, no-cache, must-revalidate"); // HTTP/1.1
	header("Cache-survey_control_type: post-check=0, pre-check=0", false);
	header("Pragma: no-cache"); // HTTP/1.0
	header("Content-Type: application/json; charset=utf8");
	date_default_timezone_set('America/Guatemala');

	include_once("db.php");

	$conn = database_connect(HOST, USER, PASS, DB, PORT);
	$sqlCustom = "";
	$err = "";
	$nota_id = 0;
	$puntaje = 0;

    $action_name = trim(@$_POST["action_name"]);
	switch ($action_name)
	{
		case "GUARDAR_NOTA":
    		$nota_id = intval(@$_POST["nota_id"]);
    		$puntaje = intval(@$_POST["puntaje"]);
			
			if ($puntaje >100)
				$puntaje = 100;
			if ($puntaje < 0)
				$puntaje = 0;
			
			$sqlCustom = sprintf("UPDATE nota
									SET puntaje = '%d'
									WHERE nota_id = '%d'
						", $puntaje, $nota_id);
			
			database_query($sqlCustom,$conn)
					or $err = ("Fallo al ejecutarse la linea " . __LINE__ . ": " . database_error($conn) . '<br>SQL:' . $sqlCustom);
		break;
		default:
			$err = "Operaci&oacute;n no reconocida";
		break;
	}

    $response = array();
    $response["nota_id"] = $nota_id;    
	$response["puntaje"] = $puntaje;
    $response["errormsg"] = $err;

    echo json_encode($response);
	database_close($conn);
?>