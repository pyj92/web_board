<?php
	header('Content-Type: text/html; charset=utf-8');
	$db = new mysqli('172.31.12.48', 'park2', '6510495', 'web_board');

	if($db->connect_error) {
		die('error');
	}

	$db->set_charset('utf8');
?>
