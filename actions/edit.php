<?php
	//error_reporting(0);
	
	$id = trim(strip_tags($_POST['themes_id']));
	$name = trim(strip_tags($_POST['name']));
	$description = trim(strip_tags($_POST['description']));
	
	$host = '127.0.0.1';
	$db = 'laba_5';
	$user = 'root';
	$pass = '******';
	$charset = 'utf8';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);	
	
	$sth = $pdo->prepare('UPDATE themes SET name=:name, description=:description WHERE id=:id');
	$sth->bindValue(':id', $id);
	$sth->bindValue(':name', $name);
	$sth->bindValue(':description', $description);
	$sth->execute();
	
	$pdo = null;
	
	header("Location: http://anna.garr/laba_3/mythemes.php");