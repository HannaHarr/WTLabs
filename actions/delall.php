<?php
	//error_reporting(0);
	
	$host = '127.0.0.1';
	$db = 'laba_5';
	$user = 'root';
	$pass = '******';
	$charset = 'utf8';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);	
	
	$sth = $pdo->prepare('DELETE FROM themes WHERE athor_id = :id');
	$sth->bindValue(':id', $_COOKIE['user']);
	$sth->execute();
	
	$pdo = null;
	
	header("Location: $_SERVER[HTTP_REFERER]");