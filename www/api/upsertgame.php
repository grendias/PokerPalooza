<?php
	require_once('../../src/Repository.php');

	$repo = new Repository();
	$data = json_decode(file_get_contents('php://input'), true);
	$result = $repo->UpsertGame($data);
	header('HTTP/1.1 200 OK');
	header('Content-type: application/json');
	if (!$result || $result == null)
	{
		//$result['message'] = "We never made it to the Repository";
		$repo->UpsertLog('ERRO', 'upsertgame', "Repository didn't return anything");
	}
	
	$repo->UpsertLog('INFO', 'upsertgame', "Repository returned Success: {$result['success']}");
	echo json_encode($result);
?>
