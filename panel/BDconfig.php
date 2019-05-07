<?php
if(trim(strtolower($_SERVER['SERVER_NAME'])) == "localhost"){
	$_dbhost   = "localhost:3306";
	$_dbuname  = "root";
	$_dbpass   = "";
	if(PHP_OS != "WINNT"){
		$_dbpass   = "vallesoswa";
	}
	$_dbname   = "soyfuncionalmxv2";
	$_port     = "3306";
}
?>