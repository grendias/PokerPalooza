<?php
	require_once('../../src/Repository.php');

	$repo = new Repository();
	$data = json_decode(file_get_contents('php://input'), true);
	$result = $repo->UpsertPayouts($data);
	header('HTTP/1.1 200 OK');
	header('Content-type: application/json');
	echo json_encode($result);
?>