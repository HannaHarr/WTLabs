<?php
	//error_reporting(0);
	
	$id = trim(strip_tags($_POST['themes_id']));
	
	$host = '127.0.0.1';
	$db = 'laba_5';
	$user = 'root';
	$pass = '******';
	$charset = 'utf8';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);	
	
	$sth = $pdo->prepare('DELETE FROM themes WHERE id = :id');
	$sth->bindValue(':id', $id);
	$sth->execute();
	
	$pdo = null;
	
	header("Location: $_SERVER[HTTP_REFERER]");