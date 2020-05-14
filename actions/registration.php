<?php

	//error_reporting(0);
	
	$name = trim(strip_tags($_POST['name']));
	$login = trim(strip_tags($_POST['login']));
	$mail = trim(strip_tags($_POST['mail']));
	$password = trim(strip_tags($_POST['password']));
	
	if(empty($name) && empty($login) && empty($mail) && empty($password)){
		echo "Недопустипые значения полей регистрации";
		exit();
	}
	
	$host = '127.0.0.1';
	$db = 'laba_5';
	$user = 'root';
	$pass = '******';
	$charset = 'utf8';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		
	$pdo = new PDO($dsn, $user, $pass);
	
	$sth = $pdo->prepare('SELECT id FROM validation WHERE login = :login');
	$sth->bindValue(':login', $login);
	$sth->execute();	
	if (count($sth->fetchColumn()) > 0) {
		echo "Пользователь с таким логином уже существует";
		exit();
	}
	
	$password = md5($password."akGJmo717NBx85sd828cV78YTVc");
		
	$sth = $pdo->prepare('INSERT INTO validation (name, login, email, pass) VALUES (:name, :login, :mail, :password)');
	$sth->bindValue(':name', $name);
	$sth->bindValue(':login', $login);
	$sth->bindValue(':mail', $mail);
	$sth->bindValue(':password', $password);
	$sth->execute();
		
	$pdo = null;
		
	header("Location: $_SERVER[HTTP_REFERER]");