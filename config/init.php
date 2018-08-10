<?php
	session_start();

	error_reporting(error_reporting() & ~E_NOTICE);

	$conn = new PDO('pgsql:host=dbm.fe.up.pt;port=5432;dbname=sibd17g22', 'sibd17g22', '1');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

	$conn->query("SET SCHEMA 'public'");
?>
