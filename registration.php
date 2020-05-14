<?php
	//error_reporting(0);

	require_once('include/template_engine.php');
	require_once('include/data.php');
	
	$arrayTemplate = array();
	$arrayTemplate['header'] = file_get_contents($arrayFileTemplates['header']);
	$arrayTemplate['validation'] = file_get_contents($arrayFileTemplates['validation']);
	
	if (isset($_COOKIE['user']) and isset($_COOKIE['hash'])) {
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
		
		if ($_COOKIE['hash'] === ($sth->fetch(FETCH_ASSOC))['hash']) {
			$arrayTemplate['validation'] = file_get_contents($arrayFileTemplates['user']);
			$arrayTemplate['user'] = ($sth->fetch(FETCH_ASSOC))['name'];
		}
		
		$pdo = null;
	}
	
	$arrayTemplate['navigation'] = file_get_contents($arrayFileTemplates['navigation']);
	$arrayTemplate['footer'] = file_get_contents($arrayFileTemplates['footer']);
	$arrayTemplate['content'] = file_get_contents($arrayFileTemplates['registration']);
	echo getPage($arrayTemplate, file_get_contents($arrayFileTemplates['main_template']));