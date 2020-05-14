<?php
	//error_reporting(0);
	
	function generateCode($length=6) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;
		while (strlen($code) < $length) {
			$code .= $chars[mt_rand(0,$clen)];
		}
		return $code;
	}
	
	require_once( $_SERVER['DOCUMENT_ROOT'].'laba_3/include/PHPMailer/src/PHPMailer.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'laba_3/include/PHPMailer/src/SMTP.php' );
	require_once( $_SERVER['DOCUMENT_ROOT'].'laba_3/include/PHPMailer/src/Exception.php' );
	
	$login = trim(strip_tags($_POST['login']));
	$password = trim(strip_tags($_POST['password']));
	
	$password = md5($password."akGJmo717NBx85sd828cV78YTVc");
	
	$host = '127.0.0.1';
	$db = 'laba_5';
	$user = 'root';
	$pass = '******';
	$charset = 'utf8';
	
	$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
	$opt = [
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	];
	$pdo = new PDO($dsn, $user, $pass, $opt);
		
	$sth = $pdo->prepare('SELECT * FROM validation WHERE login = :login AND pass = :password');
	$sth->bindValue(':login', $login);
	$sth->bindValue(':password', $password);
	$sth->execute();
	
	$data = $sth->fetch();
	$id = $data['id'];
	
	if (count($data) == 0) {
		echo "Такой пользователь не найден";
		exit();
	}
	
	$hash = md5(generateCode(10));
	
	$sth = $pdo->prepare('UPDATE validation SET hash=:hash WHERE id=:id');
	$sth->bindValue(':hash', $hash);
	$sth->bindValue(':id', $id);
	$sth->execute();
	
	setcookie('user', $id, time() + 3600*24, "/laba_3/");
	setcookie('hash', $hash, time() + 3600*24, "/laba_3/");
	
	$mail = new PHPMailer\PHPMailer\PHPMailer();
	
	$mail->IsSMTP();
	$mail->Host		  = "smtp.gmail.com";
	$mail->SMTPAuth   = true;
	$mail->SMTPSecure = "ssl";
	$mail->Port		  = 465;
	$mail->CharSet	  = 'UTF-8';
	
	$mail->Username = '*********';
	$mail->Password = '*********';
	$mail->SetFrom('***********', 'Сайт в добрые руки');
	$mail->Subject  = "В добрые руки";
	$mail->MsgHTML("Вход в аккаунт ".date("H:i d.m.y"));
	
	$mail->AddAddress($data['email'], $data['name']);
	
	$mail->Send();

	$pdo = null;
	
	header("Location: $_SERVER[HTTP_REFERER]");
