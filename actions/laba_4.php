<?php
	function addToBase($name, $description) {
		
		$host = '127.0.0.1';
		$db = 'laba_5';
		$user = 'root';
		$pass = '******';
		$charset = 'utf8';
	
		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		
		$pdo = new PDO($dsn, $user, $pass);
		
		$sth = $pdo->prepare('INSERT INTO themes (name, description, athor_id) VALUES (:name, :description, :id)');
		$sth->bindValue(':name', $name);
		$sth->bindValue(':description', $description);
		$sth->bindValue(':id', $_COOKIE['user']);
		$sth->execute();
		
		$pdo = null;
	}
	
	error_reporting(0);
	
	$error = "#Внешние ссылки запрещены#";
	$regularExpression = "/https?:\/\/(?!(www\.)?bsuir\.by(\/.*)*)[a-zA-ZА-Яа-яЁё]+(\.[a-zа-яё]+)*(\/[\S]*)*/";
	
	$name = trim(strip_tags($_POST['name']));
	$description = trim(strip_tags($_POST['description']));
	if(empty($name) && empty($description)){
		echo "Недопустипые значения полей";
		exit();
    }
	
	$description = preg_replace($regularExpression, $error, $description);
	addToBase($name, $description);
	header("Location: $_SERVER[HTTP_REFERER]");
