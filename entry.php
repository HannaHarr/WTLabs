<?php
	//error_reporting(0);

	require_once('include/template_engine.php');
	require_once('include/data.php');
	
	$arrayTemplate = array();
	$arrayTemplate['header'] = file_get_contents($arrayFileTemplates['header']);
	
	if (!isset($_COOKIE['user'])) {
		$arrayTemplate['validation'] = file_get_contents($arrayFileTemplates['validation']);
	}
	else {
		$arrayTemplate['validation'] = file_get_contents($arrayFileTemplates['user']);
		
		$host = '127.0.0.1';
		$db = 'laba_5';
		$user = 'root';
		$pass = '******';
		$charset = 'utf8';
	
		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$pdo = new PDO($dsn, $user, $pass);
		
		$sth = $pdo->prepare('SELECT name FROM validation WHERE id = :id');
		$sth->bindValue(':id', $_COOKIE['user']);
		$sth->execute();
		$arrayTemplate['user'] = $sth->fetchColumn();
		$pdo = null;
	}
	
	$arrayTemplate['navigation'] = file_get_contents($arrayFileTemplates['navigation']);
	$arrayTemplate['footer'] = file_get_contents($arrayFileTemplates['footer']);
	$arrayTemplate['content'] = file_get_contents($arrayFileTemplates['entry']);
	echo getPage($arrayTemplate, file_get_contents($arrayFileTemplates['main_template']));